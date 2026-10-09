<?php
require __DIR__.'/../helpers/lending.php';
require __DIR__.'/../helpers/agreement_pdf.php';
require __DIR__.'/../helpers/mail.php';
require __DIR__.'/../ajax/borrower.php';
$lender=lender_user();lender_post();
$action=$_POST['action']??'';
$emailId=null;
try {
    if(in_array($action,['quote','preview'],true)) {
        $borrower=lender_borrower((int)($_POST['borrower_id']??0),$lender['user_id']);
        if($borrower['account_status']!=='pending')throw new DomainException('Only pending applications can be reviewed.');
        $q=contract_quote($_POST);
        if($action==='quote')lender_json(['quote'=>$q]);
        $pdf=agreement_pdf($borrower,$lender,$q);
        header('Content-Type: application/pdf');header('Content-Disposition: inline; filename="agreement-preview.pdf"');header('X-Content-Type-Options: nosniff');echo $pdf;exit;
    }
    if($action==='retry-email') {
        $status=send_lender_email((int)($_POST['email_id']??0),$lender['user_id'],($_POST['acknowledge_duplicate']??'')==='yes');
        lender_json(['ok'=>true,'email_status'=>$status]);
    }
    $conn->begin_transaction();
    if($action==='decide-application') {
        $borrower=lender_borrower((int)($_POST['borrower_id']??0),$lender['user_id'],true);
        if($borrower['account_status']!=='pending')throw new DomainException('This application was already reviewed or is not pending. Refresh the list.');
        $decision=$_POST['decision']??'';
        if(!in_array($decision,['approved','rejected'],true))throw new DomainException('Choose approve or reject.');
        $agreementId=null;$note='';$name=$borrower['user_fn'].' '.$borrower['user_ln'];
        if($decision==='approved') {
            if(in_array(false,borrower_complete($borrower['user_id'],profile($borrower['user_id'])),true))throw new DomainException('This application has incomplete or invalid profiling details.');
            $q=contract_quote($_POST);
            if($q['release_date']<date('Y-m-d'))throw new DomainException('The planned release date cannot be in the past.');
            if(($_POST['confirm_terms']??'')!=='yes')throw new DomainException('Confirm that you reviewed the agreement terms.');
            // Placeholder remains inside this transaction until PDF generation succeeds.
            db("INSERT INTO loan_agreements(borrower_id,lender_id,approval_date,first_due_date,principal,monthly_interest_percent,term_months,total_interest,total_due,monthly_payment,status,pdf_contents) VALUES(?,?,?,?,?,?,?,?,?,?,'draft','')",[$borrower['user_id'],$lender['user_id'],date('Y-m-d'),$q['first_due_date'],$q['principal_cents']/100,$q['rate'],$q['term'],$q['interest_cents']/100,$q['total_cents']/100,$q['regular_cents']/100]);
            $agreementId=$conn->insert_id;
            $pdf=agreement_pdf($borrower,$lender,$q,'UW-'.$agreementId);
            db('UPDATE loan_agreements SET pdf_contents=? WHERE agreement_id=?',[$pdf,$agreementId]);
            $personal=profile($borrower['user_id'])['personal-details']??[];
            $address=implode(', ',array_filter(array_map(fn($k)=>$personal[$k]??'', ['street','barangay','city','province','region','zip_code'])));
            db('INSERT INTO lender_contracts(agreement_id,purpose,borrower_name,borrower_address,lender_name,planned_release_date) VALUES(?,?,?,?,?,?)',[$agreementId,$q['purpose'],$name,$address,$lender['user_fn'].' '.$lender['user_ln'],$q['release_date']]);
            foreach($q['schedule'] as $row)db('INSERT INTO loan_installments(agreement_id,installment_number,due_date,amount_due) VALUES(?,?,?,?)',[$agreementId,$row['number'],$row['due_date'],$row['cents']/100]);
            $body="Dear $name,\n\nYour Utang Wise borrower account has been approved by ".$lender['user_fn'].' '.$lender['user_ln'].". You may now sign in using your registered email.\n\nAttached is your loan agreement for review and signature.\nPrincipal: ".money($q['principal_cents']/100)."\nPurpose: ".$q['purpose']."\nFlat monthly interest: ".$q['rate']."% of original principal\nTotal interest: ".money($q['interest_cents']/100)."\nTotal repayment: ".money($q['total_cents']/100)."\nInstallments: ".$q['term']." monthly payments\nRegular installment: ".money($q['regular_cents']/100)."\nFirst due date: ".$q['first_due_date']."\n\nPlease read the full schedule, sign the borrower signature section, and reply with the signed PDF. Sign the receipt-of-proceeds section only after actually receiving the funds. The loan remains awaiting signature and release; this email is not proof that money has been disbursed.\n\nUtang Wise";
        } else {
            $note=trim($_POST['reason']??'');
            if(mb_strlen($note)<5||mb_strlen($note)>2000)throw new DomainException('Please provide a rejection reason between 5 and 2,000 characters.');
            $body="Dear $name,\n\nAfter reviewing your application, your selected lender has not approved your Utang Wise borrower account.\n\nReason:\n$note\n\nIf you need clarification, reply to this email.\n\nUtang Wise";
        }
        db('UPDATE users SET account_status=?,review_note=?,reviewed_by=?,reviewed_at=NOW() WHERE user_id=?',[$decision,$note,$lender['user_id'],$borrower['user_id']]);
        $emailId=queue_lender_email('account-'.$borrower['user_id'],$borrower,$lender['user_id'],$decision==='approved'?'Utang Wise - Account approved and loan agreement':'Utang Wise - Application decision',$body,$agreementId);
    } elseif($action==='decide-extension') {
        $requestId=(int)($_POST['request_id']??0);
        $lookup=db('SELECT agreement_id FROM extension_requests WHERE request_id=? AND lender_id=?',[$requestId,$lender['user_id']])->get_result()->fetch_assoc();
        if(!$lookup)throw new DomainException('Extension request not found.');
        $agreement=db('SELECT * FROM loan_agreements WHERE agreement_id=? AND lender_id=? FOR UPDATE',[$lookup['agreement_id'],$lender['user_id']])->get_result()->fetch_assoc();
        $request=db('SELECT * FROM extension_requests WHERE request_id=? FOR UPDATE',[$requestId])->get_result()->fetch_assoc();
        if($request['status']!=='pending')throw new DomainException('This extension was already reviewed.');
        $decision=$_POST['decision']??'';$reason=trim($_POST['reason']??'');
        if(!in_array($decision,['approved','rejected'],true))throw new DomainException('Choose approve or reject.');
        if(mb_strlen($reason)>2000||($decision==='rejected'&&mb_strlen($reason)<5))throw new DomainException('A rejection reason of 5–2,000 characters is required.');
        if($decision==='approved') {
            if($agreement['status']!=='active')throw new DomainException('Only active loans can be extended.');
            $installment=db('SELECT * FROM loan_installments WHERE installment_id=? AND agreement_id=? FOR UPDATE',[$request['installment_id'],$agreement['agreement_id']])->get_result()->fetch_assoc();
            if(!$installment || $installment['due_date']!==$request['original_due_date'] || (float)$installment['amount_paid']>=(float)$installment['amount_due'])throw new DomainException('The installment has changed or is already paid. Reject this request and ask for a new one.');
            $days=(int)lender_date($request['original_due_date'])->diff(lender_date($request['requested_due_date']))->format('%r%a');
            if($days<1||$days>365)throw new DomainException('Invalid extension length.');
            db('UPDATE loan_installments SET due_date=DATE_ADD(due_date,INTERVAL ? DAY) WHERE agreement_id=? AND installment_number>=? AND amount_paid<amount_due',[$days,$agreement['agreement_id'],$installment['installment_number']]);
        }
        db('UPDATE extension_requests SET status=?,review_reason=?,reviewed_at=NOW(),reviewed_by=? WHERE request_id=?',[$decision,$reason,$lender['user_id'],$requestId]);
        $borrower=lender_borrower($request['borrower_id'],$lender['user_id']);
        $body='Dear '.$borrower['user_fn'].",\n\nYour extension request EXT-$requestId was ".$decision.'.'.($decision==='approved'?"\nThe installment formerly due on ".$request['original_due_date'].' is now due on '.$request['requested_due_date'].". This and the following unpaid installments move by $days days. No additional interest or fees are charged.":"\nReason: $reason")."\n\nUtang Wise";
        $emailId=queue_lender_email('extension-'.$requestId,$borrower,$lender['user_id'],'Utang Wise - Extension request '.$decision,$body);
    } elseif($action==='release-loan') {
        $id=(int)($_POST['agreement_id']??0);
        $agreement=db('SELECT a.*,c.planned_release_date FROM loan_agreements a JOIN lender_contracts c ON c.agreement_id=a.agreement_id WHERE a.agreement_id=? AND a.lender_id=? FOR UPDATE',[$id,$lender['user_id']])->get_result()->fetch_assoc();
        if(!$agreement||$agreement['status']!=='draft')throw new DomainException('This loan is not awaiting signature and release.');
        if(($_POST['confirm_release']??'')!=='yes')throw new DomainException('Confirm that the agreement is signed and proceeds were actually released.');
        $release=lender_date($_POST['release_date']??'')->format('Y-m-d');
        if($release>$agreement['first_due_date']||$release<$agreement['planned_release_date']||$release>date('Y-m-d'))throw new DomainException('Release date must be between the planned release and first due date, and cannot be in the future.');
        $f=$_FILES['signed_agreement']??null;
        if(!$f||$f['error']!==UPLOAD_ERR_OK||$f['size']>5*1024*1024||!is_uploaded_file($f['tmp_name'])||(new finfo(FILEINFO_MIME_TYPE))->file($f['tmp_name'])!=='application/pdf')throw new DomainException('Upload the signed agreement as a PDF, up to 5 MB.');
        db('UPDATE lender_contracts SET signed_pdf=?,released_at=? WHERE agreement_id=?',[file_get_contents($f['tmp_name']),$release.' 00:00:00',$id]);
        db("UPDATE loan_agreements SET status='active' WHERE agreement_id=?",[$id]);
    } else throw new DomainException('Unknown action.');
    $conn->commit();
} catch(DomainException $error) {
    rollback_safely(); lender_json(['error'=>$error->getMessage()],422);
} catch(Throwable $error) {
    rollback_safely();error_log('Lender action failed: '.$error->getMessage());lender_json(['error'=>'The action could not be saved. No decision was completed. Please try again.'],500);
}
// Delivery happens only after the decision, schedule and outbox commit successfully.
$emailStatus=null;
if($emailId) { try{$emailStatus=send_lender_email($emailId,$lender['user_id']);}catch(Throwable $error){$emailStatus='uncertain';} }
lender_json(['ok'=>true,'email_id'=>$emailId,'email_status'=>$emailStatus]);

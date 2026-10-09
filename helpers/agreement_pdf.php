<?php
require_once __DIR__.'/lending.php';
require_once __DIR__.'/../vendor/tcpdf/tcpdf.php';

function agreement_pdf($borrower,$lender,$q,$reference='PREVIEW') {
    $p=profile($borrower['user_id']);
    $personal=$p['personal-details']??[];
    $name=$borrower['user_fn'].' '.$borrower['user_ln'];
    $lenderName=$lender['user_fn'].' '.$lender['user_ln'];
    $address=implode(', ',array_filter(array_map(fn($k)=>$personal[$k]??'', ['street','barangay','city','province','region','zip_code'])));
    $pdf=new TCPDF('P','mm','A4',true,'UTF-8',false);
    $pdf->SetCreator('Utang Wise'); $pdf->SetAuthor('Utang Wise'); $pdf->SetTitle('Loan Agreement - '.$reference);
    $pdf->setPrintHeader(false); $pdf->setPrintFooter(false); $pdf->SetMargins(18,17,18); $pdf->SetAutoPageBreak(true,18);
    $pdf->SetFont('dejavusans','',9); $pdf->AddPage();
    $h='<h1 style="color:#062347;font-size:21pt">UTANG WISE</h1><h2>LOAN AGREEMENT &amp; REPAYMENT SCHEDULE</h2><p>Reference: '.e($reference).' | Prepared: '.date('Y-m-d').'</p>';
    $h.='<p><b>Borrower:</b> '.e($name).'<br><b>Address:</b> '.e($address ?: 'As provided in the account application').'<br><b>Email:</b> '.e($borrower['email']).'<br><b>Lender:</b> '.e($lenderName).'</p>';
    $h.='<p>I, <b>'.e($name).'</b>, request to borrow <b>'.money($q['principal_cents']/100).'</b> from <b>'.e($lenderName).'</b> for <b>'.e($q['purpose']).'</b>. Upon receipt of the loan proceeds, I undertake to repay the principal and the interest expressly stated below in <b>'.$q['term'].' monthly installments</b>, according to this agreement.</p>';
    $h.='<table cellpadding="6" border="1"><tr><td width="58%">Principal / net proceeds (no deductions)</td><td width="42%">'.money($q['principal_cents']/100).'</td></tr>';
    foreach (['Flat interest per month'=>$q['rate'].'% of original principal','Monthly interest amount'=>money($q['monthly_interest_cents']/100),'Total interest for the full term'=>money($q['interest_cents']/100),'Other fees / added charges'=>'PHP 0.00','Total amount repayable'=>money($q['total_cents']/100),'Regular monthly installment'=>money($q['regular_cents']/100),'Planned release date'=>$q['release_date'],'First installment due'=>$q['first_due_date']] as $label=>$value) $h.='<tr><td>'.e($label).'</td><td>'.e($value).'</td></tr>';
    $h.='</table><p><b>Interest calculation:</b> original principal × monthly rate × number of months. Interest is flat, not compounded and not calculated on the declining balance. The final installment absorbs any centavo rounding difference.</p>';
    $h.='<h3>Terms and acknowledgment</h3><p>1. Account approval alone does not acknowledge receipt of funds. The lender shall release the proceeds after receiving the signed agreement. The borrower shall confirm receipt separately.</p><p>2. Payments are due on the dates in the schedule. The lender shall provide payment instructions and a record of payments received. No additional fee, penalty or increase in interest is included in this agreement.</p><p>3. Any extension or change to the repayment schedule must be recorded in writing and accepted by both parties. An extension approved through Utang Wise does not add interest or fees.</p><p>4. The borrower and lender confirm that they have read the stated amounts, interest method, and repayment schedule. Each party shall retain a copy. This unsigned document is provided for review and signing; it is not proof of disbursement or a signed acceptance.</p>';
    $pdf->writeHTML($h,true,false,true,false,'');
    $pdf->AddPage();
    $h='<h2 style="color:#062347">REPAYMENT SCHEDULE</h2><p>Reference: '.e($reference).' | Borrower: '.e($name).'</p><table cellpadding="7" border="1"><thead><tr style="background-color:#062347;color:white"><th width="18%">Installment</th><th width="40%">Due date</th><th width="42%">Amount payable</th></tr></thead><tbody>';
    foreach($q['schedule'] as $row) $h.='<tr><td width="18%">'.$row['number'].'</td><td width="40%">'.$row['due_date'].'</td><td width="42%">'.money($row['cents']/100).'</td></tr>';
    $h.='<tr><td colspan="2"><b>Total</b></td><td><b>'.money($q['total_cents']/100).'</b></td></tr></tbody></table><p>All amounts are in Philippine pesos. If a scheduled day is not present in a later month, that installment falls on the last day of that month.</p><br><h3>Signatures</h3><p>By signing, each party confirms acceptance of the terms and repayment schedule above.</p><br><table cellpadding="7"><tr><td>________________________________<br>Borrower signature over printed name<br>'.e($name).'<br>Date: __________________________</td><td>________________________________<br>Lender signature over printed name<br>'.e($lenderName).'<br>Date: __________________________</td></tr></table><br><h3>Receipt of proceeds (complete only upon release)</h3><p>I acknowledge receipt of '.money($q['principal_cents']/100).' on __________________.</p><p>Borrower signature: ________________________________________</p>';
    $pdf->writeHTML($h,true,false,true,false,'');
    return $pdf->Output('loan-agreement.pdf','S');
}

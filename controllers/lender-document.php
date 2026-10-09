<?php
require __DIR__.'/../helpers/lending.php';
$lender=lender_user();
$kind=$_GET['kind']??'';
try {
    if(in_array($kind,['valid_id','coe'],true)) {
        $borrower=lender_borrower((int)($_GET['borrower_id']??0),$lender['user_id']);
        $row=db('SELECT mime_type,contents FROM application_documents WHERE user_id=? AND kind=?',[$borrower['user_id'],$kind])->get_result()->fetch_assoc();
        $mime=$row['mime_type']??'';$contents=$row['contents']??null;
    } else {
        $row=db('SELECT a.pdf_contents,c.signed_pdf FROM loan_agreements a LEFT JOIN lender_contracts c ON c.agreement_id=a.agreement_id WHERE a.agreement_id=? AND a.lender_id=?',[(int)($_GET['agreement_id']??0),$lender['user_id']])->get_result()->fetch_assoc();
        $mime='application/pdf';$contents=$row[$kind==='signed'?'signed_pdf':'pdf_contents']??null;
    }
    if(!$contents||!in_array($mime,['image/png','image/jpeg','application/pdf'],true))throw new DomainException('Document not found.');
    header('Content-Type: '.$mime);header('X-Content-Type-Options: nosniff');header('Content-Disposition: attachment; filename="utang-wise-document.'.(['image/png'=>'png','image/jpeg'=>'jpg','application/pdf'=>'pdf'][$mime]).'"');echo $contents;
} catch(DomainException $e){http_response_code(404);echo 'Document not found.';}

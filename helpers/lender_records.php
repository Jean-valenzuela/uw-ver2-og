<?php
require_once __DIR__.'/lending.php';
function lender_loans($lenderId) {
    $rows=lender_rows("SELECT a.agreement_id,a.borrower_id,a.lender_id,a.approval_date,a.first_due_date,a.principal,a.monthly_interest_percent,a.term_months,a.total_interest,a.total_due,a.monthly_payment,a.status,a.created_at,u.user_fn,u.user_ln,u.phone,u.email,c.purpose,c.planned_release_date,c.released_at,(c.signed_pdf IS NOT NULL) AS has_signed,COALESCE(i.amount_paid,0) AS amount_paid,COALESCE(i.balance,0) AS balance,i.next_due_date,COALESCE(i.overdue_count,0) AS overdue_count,COALESCE(i.installment_count,0) AS installment_count FROM loan_agreements a JOIN users u ON u.user_id=a.borrower_id LEFT JOIN lender_contracts c ON c.agreement_id=a.agreement_id LEFT JOIN (SELECT agreement_id,SUM(amount_paid) AS amount_paid,SUM(GREATEST(amount_due-amount_paid,0)) AS balance,MIN(CASE WHEN amount_due>amount_paid THEN due_date END) AS next_due_date,SUM(CASE WHEN amount_due>amount_paid AND due_date<CURDATE() THEN 1 ELSE 0 END) AS overdue_count,COUNT(*) AS installment_count FROM loan_installments GROUP BY agreement_id) i ON i.agreement_id=a.agreement_id WHERE a.lender_id=? ORDER BY a.agreement_id DESC",[$lenderId]);
    foreach($rows as &$row) {
        if(!$row['installment_count'])$row['balance']=$row['total_due'];
        $row['display_status']=$row['status']==='draft'?'Awaiting signature':($row['status']==='completed'||((float)$row['balance']<=0&&$row['installment_count'])?'Completed':($row['overdue_count']?'Overdue':'Active'));
        $row['loan_type']='Money';
    }unset($row);return $rows;
}
function lender_applicants($lenderId) {
    $rows=lender_rows("SELECT u.*,p.details,s.submitted_at FROM users u LEFT JOIN application_profiles p ON p.user_id=u.user_id LEFT JOIN borrower_submissions s ON s.user_id=u.user_id WHERE u.selected_lender_id=? AND u.user_type_id=2 AND u.account_status<>'incomplete' ORDER BY s.submitted_at DESC,u.user_id DESC",[$lenderId]);
    foreach($rows as &$row) {
        $row['profile']=json_decode($row['details']??'{}',true)?:[];
        $row['preferences']=$row['profile']['loan-preferences']??[];
        $row['display_status']=['pending'=>'Pending','approved'=>'Approved','rejected'=>'Denied'][$row['account_status']];
    }unset($row);return $rows;
}
function lender_extensions($lenderId) {
    return lender_rows('SELECT r.*,u.user_fn,u.user_ln,a.term_months FROM extension_requests r JOIN users u ON u.user_id=r.borrower_id JOIN loan_agreements a ON a.agreement_id=r.agreement_id WHERE r.lender_id=? ORDER BY r.requested_at DESC,r.request_id DESC',[$lenderId]);
}

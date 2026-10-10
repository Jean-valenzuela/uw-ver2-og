<?php
require __DIR__ . '/../helpers/lender_records.php';
$lender = lender_user();
try {
    $kind = $_GET['kind'] ?? 'application';
    $id = (int) ($_GET['id'] ?? 0);
    if ($kind === 'application') {
        $u = lender_borrower($id, $lender['user_id']);
        if ($u['account_status'] === 'incomplete')
            throw new DomainException('The borrower has not submitted the application.');
        $docs = lender_rows('SELECT kind,mime_type FROM application_documents WHERE user_id=? AND kind IN (\'valid_id\',\'coe\',\'profile_photo\')', [$id]);
        $emails = lender_rows('SELECT email_id,subject,status,attempts,last_error,sent_at,created_at FROM lender_outbox WHERE borrower_id=? AND lender_id=? ORDER BY email_id DESC', [$id, $lender['user_id']]);
        lender_json(['user' => array_intersect_key($u, array_flip(['user_id', 'user_fn', 'user_ln', 'email', 'phone', 'account_status', 'review_note', 'reviewed_at'])), 'profile' => profile($id), 'documents' => $docs, 'emails' => $emails]);
    }
    if ($kind === 'loan') {
        $loan = array_values(array_filter(lender_loans($lender['user_id']), fn($r) => (int) $r['agreement_id'] === $id))[0] ?? null;
        if (!$loan)
            throw new DomainException('Loan not found.');
        $loan['disbursement'] = db('SELECT receiving_method,account_holder_name,bank_name,bank_account_number,gcash_mobile_number,qr_contents IS NOT NULL AS has_qr FROM loan_disbursement_details WHERE agreement_id=?', [$id])->get_result()->fetch_assoc();
        $loan['has_repayment_qr'] = db('SELECT agreement_id FROM loan_repayment_qr WHERE agreement_id=?', [$id])->get_result()->num_rows > 0;
        lender_json(['loan' => $loan, 'installments' => lender_rows('SELECT installment_number,due_date,amount_due,amount_paid FROM loan_installments WHERE agreement_id=? ORDER BY installment_number', [$id])]);
    }
    if ($kind === 'extension') {
        $row = array_values(array_filter(lender_extensions($lender['user_id']), fn($r) => (int) $r['request_id'] === $id))[0] ?? null;
        if (!$row)
            throw new DomainException('Extension request not found.');
        $emails = lender_rows('SELECT email_id,subject,status,attempts,last_error FROM lender_outbox WHERE event_key=? AND lender_id=?', ['extension-' . $id, $lender['user_id']]);
        lender_json(['request' => $row, 'emails' => $emails]);
    }
    throw new DomainException('Unknown request.');
} catch (DomainException $e) {
    lender_json(['error' => $e->getMessage()], 404);
} catch (Throwable $e) {
    error_log($e->getMessage());
    lender_json(['error' => 'The details could not be loaded.'], 500);
}

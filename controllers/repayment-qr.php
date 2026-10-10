<?php
require __DIR__ . '/../helpers/lending.php';
$user = require_user();
$role = (int) $user['user_type_id'];
if ($user['account_status'] !== 'approved' || !in_array($role, [1, 2], true)) {
    http_response_code(403);
    exit('Access denied.');
}
$owner = $role === 1 ? 'lender_id' : 'borrower_id';
$row = db("SELECT q.mime_type,q.contents FROM loan_repayment_qr q JOIN loan_agreements a ON a.agreement_id=q.agreement_id WHERE a.agreement_id=? AND a.$owner=?", [(int) ($_GET['agreement_id'] ?? 0), $user['user_id']])->get_result()->fetch_assoc();
if (!$row || !in_array($row['mime_type'], ['image/png', 'image/jpeg'], true)) {
    http_response_code(404);
    exit('Repayment QR not found.');
}
header('Content-Type: ' . $row['mime_type']);
header('X-Content-Type-Options: nosniff');
header('Cache-Control: no-store, private');
header('Content-Disposition: ' . (isset($_GET['download']) ? 'attachment' : 'inline') . '; filename="loan-repayment-qr.' . ($row['mime_type'] === 'image/png' ? 'png' : 'jpg') . '"');
echo $row['contents'];

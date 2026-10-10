<?php define('UW_AGREEMENT_PAGE', true);
require __DIR__ . '/../helpers/borrower_portal.php';
$u = borrower_user();
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $r = db('SELECT a.pdf_contents,c.signed_pdf FROM loan_agreements a LEFT JOIN lender_contracts c ON c.agreement_id=a.agreement_id WHERE a.agreement_id=? AND a.borrower_id=?', [(int) ($_GET['id'] ?? 0), $u['user_id']])->get_result()->fetch_assoc();
    $bytes = $r[isset($_GET['signed']) ? 'signed_pdf' : 'pdf_contents'] ?? null;
    if (!$bytes) {
        http_response_code(404);
        exit('Agreement not found.');
    }
    header('Content-Type: application/pdf');
    header('X-Content-Type-Options: nosniff');
    header('Cache-Control: no-store');
    header('Content-Disposition: attachment; filename="loan-agreement.pdf"');
    echo $bytes;
    exit;
}
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit;
}
check_csrf();
try {
    $conn->begin_transaction();
    $a = db('SELECT a.agreement_id,c.signed_pdf IS NOT NULL signed FROM loan_agreements a JOIN lender_contracts c ON c.agreement_id=a.agreement_id WHERE a.agreement_id=? AND a.borrower_id=? FOR UPDATE', [(int) ($_POST['agreement_id'] ?? 0), $u['user_id']])->get_result()->fetch_assoc();
    if (!$a || $a['signed'])
        throw new DomainException('This agreement is unavailable or already submitted.');
    $f = $_FILES['signed_agreement'] ?? null;
    if (($_POST['confirm'] ?? '') !== 'yes' || !$f || $f['error'] !== UPLOAD_ERR_OK || $f['size'] > 5 * 1024 * 1024 || !is_uploaded_file($f['tmp_name']) || (new finfo(FILEINFO_MIME_TYPE))->file($f['tmp_name']) !== 'application/pdf')
        throw new DomainException('Confirm and upload a signed PDF up to 5 MB.');
    $bytes = file_get_contents($f['tmp_name']);
    if (strncmp($bytes, '%PDF-', 5) !== 0 || strpos($bytes, '%%EOF') === false)
        throw new DomainException('Upload a complete PDF document.');
    db('UPDATE lender_contracts SET signed_pdf=? WHERE agreement_id=?', [$bytes, $a['agreement_id']]);
    db('INSERT INTO borrower_agreement_uploads(agreement_id,borrower_id) VALUES (?,?)', [$a['agreement_id'], $u['user_id']]);
    $conn->commit();
    unset($_SESSION['notice'], $_SESSION['notice_kind']);
    $_SESSION['uw_success'] = ['title' => 'Agreement submitted', 'text' => 'Your signed agreement has been saved. Welcome to your dashboard.'];
    go('borrower/client-dashboard.php');
} catch (Throwable $e) {
    rollback_safely();
    fail_form($e instanceof DomainException ? $e->getMessage() : 'The agreement could not be saved. Try again.', 'borrower/signed-agreement.php');
}
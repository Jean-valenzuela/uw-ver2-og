<?php
require __DIR__ . '/../ajax/app.php';
require __DIR__ . '/../helpers/lender_photo.php';
$u = require_user(1);
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Allow: POST');
    http_response_code(405);
    exit('POST required.');
}
check_csrf();
try {
    $conn->begin_transaction();
    $u = db('SELECT * FROM users WHERE user_id=? FOR UPDATE', [$u['user_id']])->get_result()->fetch_assoc();
    if ($u['account_status'] !== 'incomplete')
        throw new RuntimeException('This application has already been submitted.');
    $v = ['source_of_funds' => trim($_POST['source_of_funds'] ?? ''), 'lending_limit' => trim($_POST['lending_limit'] ?? ''), 'lender_reason' => trim($_POST['lender_reason'] ?? '')];
    if (!$v['source_of_funds'] || strlen($v['source_of_funds']) > 1000) throw new RuntimeException(uw_field_message('source_of_funds','Enter your source of funds (up to 1,000 characters).'));
    if (!$v['lender_reason'] || strlen($v['lender_reason']) > 2000) throw new RuntimeException(uw_field_message('lender_reason','Enter your reason for lending (up to 2,000 characters).'));
    if (!preg_match('/^\d{1,10}(\.\d{1,2})?$/D', $v['lending_limit']) || (float)$v['lending_limit'] <= 0) throw new RuntimeException(uw_field_message('lending_limit','Enter a positive lending limit with up to two decimal places.'));
    upload_lender_photo($u['user_id']);
    $v['photo_required'] = true;
    $v['photo_public'] = true;
    upload_document($u['user_id'], 'source_proof');
    upload_document($u['user_id'], 'valid_id');
    $p = profile($u['user_id']) ?: [];
    $p['requirements'] = $v;
    db('INSERT INTO application_profiles(user_id,details) VALUES (?,?) ON DUPLICATE KEY UPDATE details=VALUES(details)', [$u['user_id'], json_encode($p)]);
    db('INSERT INTO lender_submissions(user_id,submitted_at) VALUES (?,NOW())', [$u['user_id']]);
    db("UPDATE users SET account_status='pending' WHERE user_id=?", [$u['user_id']]);
    $conn->commit();
    unset($_SESSION['uid']);
    session_regenerate_id(true);
    $_SESSION['csrf'] = bin2hex(random_bytes(32));
    $_SESSION['uw_success'] = ['title' => 'Requirements submitted', 'text' => 'Your lender application is under administrator review. Your profile picture will appear on the lenders list once approved. We will email your decision.'];
    $_SESSION['notice_kind'] = 'success';
    $_SESSION['notice'] = 'Your application was submitted for admin review. You can sign in after approval. We will email your decision.';
    go('login.php');
} catch (RuntimeException $e) {
    rollback_safely();
    fail_form($e instanceof mysqli_sql_exception ? 'Submission could not be saved. Please try again.' : $e->getMessage(), 'lender/new-acc-profiling/requirements.php');
}

<?php require __DIR__ . '/../helpers/borrower_portal.php';
require __DIR__ . '/../helpers/borrower_photo.php';
$u = borrower_user();
if ($_SERVER['REQUEST_METHOD'] !== 'POST')
    go('borrower/profile.php');
check_csrf();
$step = $_POST['step'] ?? '';
try {
    if (!in_array($step, ['idverification', 'personal-details', 'financial-details', 'reference-person'], true))
        throw new DomainException('Choose a valid section.');
    $conn->begin_transaction();
    db('SELECT user_id FROM users WHERE user_id=? FOR UPDATE', [$u['user_id']]);
    $p = profile($u['user_id']);
    $v = validate_borrower_step($step, $_POST);
    if ($step === 'idverification') {
        upload_document($u['user_id'], 'valid_id');
        if (($_FILES['profile_photo']['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_NO_FILE)
            upload_borrower_photo($u['user_id']);
        $v['profile_photo_required'] = document_exists($u['user_id'], 'profile_photo');
    }
    if ($step === 'financial-details')
        upload_document($u['user_id'], 'coe', $v['employment_status'] === 'employed');
    if ($step === 'personal-details') {
        $v['email'] = $u['email'];
        db('UPDATE users SET user_fn=?,user_ln=?,phone=? WHERE user_id=?', [$v['first_name'], $v['last_name'], '0' . $v['mobile'], $u['user_id']]);
    }
    db('INSERT INTO borrower_profile_audit(borrower_id,section,previous_details) VALUES (?,?,?)', [$u['user_id'], $step, json_encode($p[$step] ?? [])]);
    $p[$step] = $v;
    db('INSERT INTO application_profiles(user_id,details) VALUES (?,?) ON DUPLICATE KEY UPDATE details=VALUES(details)', [$u['user_id'], json_encode($p)]);
    $conn->commit();
    unset($_SESSION['notice'], $_SESSION['notice_kind']);
    $_SESSION['uw_success'] = ['title' => 'Profile updated', 'text' => 'Your details have been saved.'];
    go('borrower/profile.php');
} catch (Throwable $e) {
    rollback_safely();
    error_log("Profile save: " . $e->getMessage());
    fail_form($e instanceof RuntimeException && !($e instanceof mysqli_sql_exception) ? $e->getMessage() : 'Your changes could not be saved.', 'borrower/edit-profile.php?section=' . urlencode(in_array($step, ['idverification', 'personal-details', 'financial-details', 'reference-person']) ? $step : 'personal-details'));
}
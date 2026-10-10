<?php
require __DIR__ . '/borrower.php';require __DIR__.'/../helpers/borrower_photo.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') go('borrower/new-acc-profiling/verifyacc.php');
check_csrf();
$u = borrower_user(true);
$step = $_POST['step'] ?? '';
$schema = borrower_schema();
$back = 'borrower/new-acc-profiling/'.(isset($schema[$step]) ? $step : 'ready-for-review').'.php';
try {
    $conn->begin_transaction();
    $locked = db('SELECT account_status FROM users WHERE user_id = ? FOR UPDATE', [$u['user_id']])->get_result()->fetch_assoc();
    if ($locked['account_status'] !== 'incomplete') throw new RuntimeException('This application has already been submitted.');
    $p = profile($u['user_id']);
    if ($step === 'submit') {
        $complete = borrower_complete($u['user_id'], $p);
        if (in_array(false, $complete, true)) throw new RuntimeException('Complete all five profiling steps before submitting.');
        if (($_POST['confirm'] ?? '') !== 'yes') throw new RuntimeException('Please confirm that your information is correct.');
        if (!selected_lender($u['selected_lender_id'])) throw new RuntimeException('Your selected lender is unavailable. Please contact support.');
        db("UPDATE users SET account_status = 'pending' WHERE user_id = ?", [$u['user_id']]);
        db('INSERT INTO borrower_submissions (user_id, submitted_at) VALUES (?, NOW()) ON DUPLICATE KEY UPDATE submitted_at = NOW()', [$u['user_id']]);
        $conn->commit();
        unset($_SESSION['notice'], $_SESSION['notice_kind']);
        $_SESSION['uw_success']=['title'=>'Application submitted','text'=>'Your application has been submitted to your selected lender for review. You can access the borrower dashboard after approval. Your account email is '.$u['email'].'.'];
        go('borrower/new-acc-profiling/ready-for-review.php');
    }
    $values = validate_borrower_step($step, $_POST);
    if ($step === 'idverification') { upload_document($u['user_id'], 'valid_id');upload_borrower_photo($u['user_id']);$values['profile_photo_required']=true; }
    if ($step === 'financial-details') upload_document($u['user_id'], 'coe', $values['employment_status'] === 'employed');
    if ($step === 'personal-details') {
        $values['email'] = $u['email'];
        db('UPDATE users SET user_fn = ?, user_ln = ?, phone = ? WHERE user_id = ?', [$values['first_name'], $values['last_name'], '0'.$values['mobile'], $u['user_id']]);
    }
    $p[$step] = $values;
    db('INSERT INTO application_profiles (user_id, details) VALUES (?, ?) ON DUPLICATE KEY UPDATE details = VALUES(details)', [$u['user_id'], json_encode($p, JSON_THROW_ON_ERROR)]);
    $conn->commit();
    unset($_SESSION['borrower_old']);
    unset($_SESSION['notice'], $_SESSION['notice_kind']);
    $_SESSION['uw_success'] = ['title'=>'Details saved', 'text'=>'Your details have been saved.'];
    go('borrower/new-acc-profiling/'.($step === 'loan-preferences' ? 'ready-for-review' : 'verifyacc').'.php');
} catch (RuntimeException $error) {
    rollback_safely();
    if ($error instanceof mysqli_sql_exception) {
        error_log('Borrower database save failed: '.$error->getCode());
        fail_form('Your changes could not be saved. Please try again.', $back);
    }
    $_SESSION['borrower_old'] = ['step' => $step, 'values' => array_intersect_key($_POST, $schema[$step] ?? [])];
    fail_form($error->getMessage(), $back);
} catch (Throwable $error) {
    rollback_safely();
    error_log('Borrower save failed: '.$error->getMessage());
    fail_form('Your changes could not be saved. Please try again.', $back);
}

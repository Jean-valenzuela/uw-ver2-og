<?php
require __DIR__ . '/../helpers/admin.php';
require __DIR__ . '/../helpers/admin_mail.php';
$admin = admin_user();
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Allow: POST');
    admin_json(['error' => 'POST required.'], 405);
}
check_csrf();
$action = $_POST['action'] ?? '';
$id = (int) ($_POST['id'] ?? 0);
try {
    if ($action === 'read') {
        admin_lender($id);
        db('INSERT IGNORE INTO admin_notification_reads(admin_id,lender_id) VALUES (?,?)', [$admin['user_id'], $id]);
        admin_json(['ok' => true]);
    }
    if ($action === 'retry') {
        $m = db('SELECT applicant_id FROM admin_outbox WHERE email_id=?', [$id])->get_result()->fetch_assoc();
        if (!$m)
            throw new DomainException('Email not found.');
        admin_lender($m['applicant_id']);
        admin_json(['ok' => true, 'mail_status' => send_admin_email($id, $admin['user_id'], ($_POST['confirm_uncertain'] ?? '') === '1')]);
    }
    if (!in_array($action, ['approve', 'reject', 'delete'], true))
        throw new DomainException('Unknown action.');
    $conn->begin_transaction();
    $u = admin_lender($id, true);
    if ($action === 'delete') {
        if ($u['account_status'] !== 'approved')
            throw new DomainException('Only approved lender profiles can be deleted.');
        if (($_POST['confirm_delete'] ?? '') !== 'DELETE')
            throw new DomainException('Type DELETE to confirm profile removal.');
        db('INSERT INTO lender_submissions(user_id,deleted_at,deleted_by) VALUES (?,NOW(),?) ON DUPLICATE KEY UPDATE deleted_at=NOW(),deleted_by=VALUES(deleted_by)', [$id, $admin['user_id']]);
        db("UPDATE users SET account_status='rejected',review_note='Profile removed by administrator.',reviewed_by=?,reviewed_at=NOW() WHERE user_id=?", [$admin['user_id'], $id]);
        db("INSERT INTO admin_audit(admin_id,lender_id,action,note) VALUES (?,?,'delete','Profile removed; linked financial records retained.')", [$admin['user_id'], $id]);
        $conn->commit();
        admin_json(['ok' => true, 'message' => 'Profile removed and login disabled. Linked financial records are retained.']);
    }
    if ($u['account_status'] !== 'pending')
        throw new DomainException('This application is no longer pending. Refresh the list.');
    $note = trim($_POST['note'] ?? '');
    if (strlen($note) > 2000 || ($action === 'reject' && strlen($note) < 5))
        throw new DomainException('Enter a rejection reason of 5 to 2,000 characters.');
    if ($action === 'approve' && !admin_requirements_complete($id))
        throw new DomainException('Approval requires source of funds, lending limit, reason, proof of funds and valid ID.');
    $decision = $action === 'approve' ? 'approved' : 'rejected';
    db('UPDATE users SET account_status=?,review_note=?,reviewed_by=?,reviewed_at=NOW() WHERE user_id=?', [$decision, $note, $admin['user_id'], $id]);
    db('INSERT INTO admin_audit(admin_id,lender_id,action,note) VALUES (?,?,?,?)', [$admin['user_id'], $id, $decision, $note]);
    $subject = 'Utang Wise lender application ' . $decision;
    $body = 'Dear ' . $u['user_fn'] . ' ' . $u['user_ln'] . ",\n\nYour lender application has been " . $decision . ".\n\n" . ($decision === 'approved' ? 'You can now sign in to your Utang Wise lender account using your registered email and password.' : 'You cannot sign in to the lender dashboard. Reason: ' . $note) . ($decision === 'approved' && $note !== '' ? "\n\nReview note: " . $note : '') . "\n\nUtang Wise Administration";
    db("INSERT INTO admin_outbox(event_key,applicant_id,admin_id,recipient,subject,body,message_id) VALUES (?,?,?,?,?,?,?)", ['lender-decision-' . $id, $id, $admin['user_id'], $u['email'], $subject, $body, '<' . bin2hex(random_bytes(16)) . '@utangwise.local>']);
    $mailId = $conn->insert_id;
    db('INSERT IGNORE INTO admin_notification_reads(admin_id,lender_id) VALUES (?,?)', [$admin['user_id'], $id]);
    $conn->commit();
    // The decision is durable before contacting Gmail. Retrying never reviews twice.
    try {
        $status = send_admin_email($mailId, $admin['user_id']);
    } catch (Throwable $e) {
        error_log('Admin mail failed: ' . $e->getCode());
        $status = 'queued';
    }
    admin_json(['ok' => true, 'message' => 'Application ' . $decision . '.', 'mail_status' => $status]);
} catch (DomainException $e) {
    rollback_safely();
    admin_json(['error' => $e->getMessage()], 422);
} catch (Throwable $e) {
    rollback_safely();
    error_log('Admin action failed: ' . $e->getCode());
    admin_json(['error' => 'The action could not be completed. Refresh and try again.'], 500);
}

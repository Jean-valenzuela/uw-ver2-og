<?php require __DIR__ . '/../helpers/borrower_portal.php';
$u = borrower_user();
if ($_SERVER['REQUEST_METHOD'] !== 'POST')
    go('borrower/client-dashboard.php');
check_csrf();
foreach (borrower_notices($u['user_id']) as $n)
    if (hash_equals($n['key'], $_POST['event_key'] ?? ''))
        db('INSERT IGNORE INTO borrower_notification_reads(borrower_id,event_key) VALUES (?,?)', [$u['user_id'], $n['key']]);
go('borrower/client-dashboard.php');
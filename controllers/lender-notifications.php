<?php
require __DIR__ . '/../helpers/lender_dashboard.php';
$lender = lender_user();
if ($_SERVER['REQUEST_METHOD'] === 'GET')
    lender_json(lender_notifications($lender['user_id']));
lender_post();
if (($_POST['action'] ?? '') === 'read-all') {
    try {
        $conn->begin_transaction();
        foreach (lender_event_rows($lender['user_id']) as $event)
            db('INSERT IGNORE INTO lender_notification_reads(lender_id,event_type,event_id) VALUES (?,?,?)', [$lender['user_id'], $event['kind'], $event['id']]);
        $conn->commit();
        lender_json(['ok' => true]);
    } catch (Throwable $e) {
        rollback_safely();
        lender_json(['error' => 'Notifications could not be marked as read.'], 500);
    }
}
$kind = $_POST['kind'] ?? '';
$id = (int) ($_POST['id'] ?? 0);
$found = false;
foreach (lender_event_rows($lender['user_id']) as $e)
    if ($e['kind'] === $kind && (int) $e['id'] === $id) {
        $found = true;
        break;
    }
if (!$found)
    lender_json(['error' => 'Notification not found.'], 404);
db('INSERT IGNORE INTO lender_notification_reads(lender_id,event_type,event_id) VALUES (?,?,?)', [$lender['user_id'], $kind, $id]);
lender_json(['ok' => true]);

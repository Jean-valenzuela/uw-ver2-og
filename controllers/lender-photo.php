<?php
require __DIR__ . '/../ajax/app.php';
header('Cache-Control: no-store');
$id = (int) ($_GET['id'] ?? 0);
$u = db("SELECT user_id FROM users WHERE user_id=? AND user_type_id=1 AND account_status='approved'", [$id])->get_result()->fetch_assoc();
$p = $u ? profile($id) : [];
if (!$u || empty($p['requirements']['photo_public'])) {
    http_response_code(404);
    exit('Photo unavailable.');
}
$d = db("SELECT mime_type,contents FROM application_documents WHERE user_id=? AND kind='lender_photo'", [$id])->get_result()->fetch_assoc();
if (!$d || !in_array($d['mime_type'], ['image/jpeg', 'image/png'], true)) {
    http_response_code(404);
    exit('Photo unavailable.');
}
header('Content-Type: ' . $d['mime_type']);
header('X-Content-Type-Options: nosniff');
echo $d['contents'];

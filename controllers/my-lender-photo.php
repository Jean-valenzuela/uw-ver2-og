<?php
require __DIR__ . '/../helpers/lending.php';

$lender = lender_user();
$photo = db(
    "SELECT mime_type, contents FROM application_documents WHERE user_id=? AND kind='lender_photo'",
    [$lender['user_id']]
)->get_result()->fetch_assoc();

if (!$photo || !in_array($photo['mime_type'], ['image/jpeg', 'image/png'], true)) {
    http_response_code(404);
    exit;
}

header('Cache-Control: private, no-store');
header('Content-Type: ' . $photo['mime_type']);
header('X-Content-Type-Options: nosniff');
echo $photo['contents'];

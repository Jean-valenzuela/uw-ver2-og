<?php
require __DIR__ . '/borrower.php';
$u = require_user(2);
$kind = $_GET['kind'] ?? '';
if (!in_array($kind, ['valid_id','coe'], true)) { http_response_code(404); exit; }
$d = db('SELECT mime_type, contents FROM application_documents WHERE user_id = ? AND kind = ?', [$u['user_id'], $kind])->get_result()->fetch_assoc();
if (!$d) { http_response_code(404); exit; }
header('X-Content-Type-Options: nosniff');
header('Content-Type: '.$d['mime_type']);
header('Content-Disposition: attachment; filename="'.$kind.'.'.(['image/jpeg'=>'jpg','image/png'=>'png','application/pdf'=>'pdf'][$d['mime_type']] ?? 'bin').'"');
echo $d['contents'];

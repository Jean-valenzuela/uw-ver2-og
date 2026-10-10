<?php
require __DIR__ . '/../helpers/admin.php';
admin_user();
try {
    $u = admin_lender((int) ($_GET['id'] ?? 0));
    $d = db('SELECT kind,mime_type,contents FROM application_documents WHERE user_id=? AND document_id=?', [$u['user_id'], (int) ($_GET['document'] ?? 0)])->get_result()->fetch_assoc();
    if (!$d || !in_array($d['mime_type'], ['image/jpeg', 'image/png', 'application/pdf'], true))
        throw new DomainException('Document not found.');
    header('X-Content-Type-Options: nosniff');
    header("Content-Security-Policy: sandbox");
    header('Content-Type: ' . $d['mime_type']);
    $ext = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'application/pdf' => 'pdf'][$d['mime_type']];
    header('Content-Disposition: inline; filename="requirement-' . $u['user_id'] . '-' . (int) $_GET['document'] . '.' . $ext . '"');
    echo $d['contents'];
} catch (DomainException $e) {
    http_response_code(404);
    echo e($e->getMessage());
}

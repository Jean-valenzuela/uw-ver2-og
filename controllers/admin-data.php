<?php
require __DIR__ . '/../helpers/admin.php';
$admin = admin_user();
try {
    if (($_GET['kind'] ?? '') === 'notifications')
        admin_json(admin_notifications($admin['user_id']));
    $id = (int) ($_GET['id'] ?? 0);
    $u = admin_lender($id);
    $u['requirements'] = admin_requirements($id);
    $u['documents'] = db('SELECT document_id,kind,mime_type FROM application_documents WHERE user_id=?', [$id])->get_result()->fetch_all(MYSQLI_ASSOC);
    $u['emails'] = db('SELECT email_id,status,last_error,created_at,sent_at FROM admin_outbox WHERE applicant_id=? ORDER BY email_id DESC', [$id])->get_result()->fetch_all(MYSQLI_ASSOC);
    admin_json($u);
} catch (DomainException $e) {
    admin_json(['error' => $e->getMessage()], 404);
}

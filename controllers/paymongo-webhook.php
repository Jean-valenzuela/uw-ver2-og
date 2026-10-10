<?php require __DIR__ . '/../helpers/paymongo.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit;
}
try {
    $lenderId = (int) ($_GET['lender'] ?? 0);
    $c = pm_config($lenderId);
    $raw = file_get_contents('php://input');
    if (strlen($raw) > 1048576 || !pm_signature_valid($raw, $_SERVER['HTTP_PAYMONGO_SIGNATURE'] ?? '', $c)) {
        http_response_code(401);
        exit('Invalid signature.');
    }
    $event = json_decode($raw, true, 512, JSON_THROW_ON_ERROR)['data']['attributes'] ?? [];
    if (!isset($event['livemode']) || (bool) $event['livemode'] !== $c['live']) {
        http_response_code(400);
        exit('Invalid mode.');
    }
    if (($event['type'] ?? '') === 'checkout_session.payment.paid')
        pm_settle($lenderId, $event['data'] ?? []);
    http_response_code(200);
    echo 'OK';
} catch (DomainException $e) {
    error_log('PayMongo rejected event: ' . $e->getMessage());
    http_response_code(422);
    echo 'Event could not be matched.';
} catch (Throwable $e) {
    error_log('PayMongo event processing failed.');
    http_response_code(500);
    echo 'Please retry.';
}

<?php require __DIR__ . '/../helpers/paymongo.php';
$u = lender_user();
if ($_SERVER['REQUEST_METHOD'] !== 'POST')
    go('lender/online-payments.php');
check_csrf();
try {
    $o = db('SELECT * FROM paymongo_orders WHERE order_id=? AND lender_id=?', [$_POST['order_id'] ?? '', $u['user_id']])->get_result()->fetch_assoc();
    if (!$o)
        throw new DomainException('Checkout not found.');
    $session = $o['session_id'] ?: ($_POST['session_id'] ?? '');
    if (!preg_match('/^cs_[a-zA-Z0-9]+$/D', $session))
        throw new DomainException('Enter the matching checkout session ID.');
    $c = pm_config($u['user_id']);
    $r = pm_http($c, 'v1/checkout_sessions/' . $session);
    if (($r['attributes']['reference_number'] ?? '') !== $o['order_id'])
        throw new DomainException('The session does not match this order.');
    $state = pm_settle($u['user_id'], $r);
    if (($_POST['action'] ?? '') === 'expire' && $state === 'pending') {
        pm_http($c, 'v1/checkout_sessions/' . $session . '/expire', new stdClass());
        $state = pm_settle($u['user_id'], pm_http($c, 'v1/checkout_sessions/' . $session));
    }
    db('UPDATE paymongo_orders SET session_id=? WHERE order_id=? AND session_id IS NULL', [$session, $o['order_id']]);
    $_SESSION['uw_success'] = ['title' => 'Payment status checked', 'text' => 'Current status: ' . $state];
} catch (Throwable $e) {
    $_SESSION['notice_kind'] = 'error';
    $_SESSION['notice'] = $e instanceof DomainException ? $e->getMessage() : 'PayMongo could not confirm the status. No balance was changed.';
}
go('lender/online-payments.php');
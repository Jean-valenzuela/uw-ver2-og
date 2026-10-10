<?php require __DIR__ . '/../helpers/paymongo.php';
$u = borrower_user();
if ($_SERVER['REQUEST_METHOD'] !== 'POST')
    go('borrower/payment-history.php');
check_csrf();
try {
    $o = db('SELECT * FROM paymongo_orders WHERE order_id=? AND borrower_id=?', [$_POST['order_id'] ?? '', $u['user_id']])->get_result()->fetch_assoc();
    if (!$o || !$o['session_id'])
        throw new DomainException('Your lender needs to confirm this checkout with the payment provider.');
    $r = pm_http(pm_config($o['lender_id']), 'v1/checkout_sessions/' . rawurlencode($o['session_id']));
    $state = pm_settle($o['lender_id'], $r);
    $_SESSION['notice_kind'] = 'success';
    $_SESSION['notice'] = $state === 'paid' ? 'Your payment is confirmed.' : ($state === 'review' ? 'Payment received; your lender must reconcile the changed schedule.' : 'Payment is still awaiting confirmation.');
} catch (Throwable $e) {
    $_SESSION['notice_kind'] = 'error';
    $_SESSION['notice'] = 'Payment status could not be confirmed. Please contact your lender before trying again.';
}
go('borrower/payment-history.php');
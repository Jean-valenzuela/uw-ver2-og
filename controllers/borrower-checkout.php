<?php require __DIR__ . '/../helpers/paymongo.php';
$u = borrower_user();
if ($_SERVER['REQUEST_METHOD'] !== 'POST')
    go('borrower/payments.php');
check_csrf();
$orderId = null;
$started = false;
try {
    $conn->begin_transaction();
    $a = db("SELECT * FROM loan_agreements WHERE agreement_id=? AND borrower_id=? FOR UPDATE", [(int) ($_POST['agreement_id'] ?? 0), $u['user_id']])->get_result()->fetch_assoc();
    if (!$a)
        throw new DomainException('Loan not found.');
    $c = pm_config($a['lender_id']);
    if (!$c['live'] && !in_array((int) $u['user_id'], array_map('intval', $c['test_borrower_ids'] ?? []), true))
        throw new DomainException('Your lender is setting up online payments. Test payments are restricted to test borrower accounts.');
    if (db("SELECT order_id FROM paymongo_orders WHERE agreement_id=? AND state IN ('creating','pending','uncertain','review')", [$a['agreement_id']])->get_result()->num_rows)
        throw new DomainException('An online payment is already open. Resume or check it in payment history before starting another.');
    if (db("SELECT request_id FROM extension_requests WHERE agreement_id=? AND status='pending'", [$a['agreement_id']])->get_result()->num_rows)
        throw new DomainException('Ask your lender to resolve the existing extension request before paying online.');
    $q = pm_quote($a, $_POST['mode'] ?? 'regular', true);
    if (($_POST['confirm'] ?? '') !== 'yes' || !hash_equals(hash('sha256', json_encode($q)), $_POST['quote_token'] ?? ''))
        throw new DomainException('The payment terms changed. Review and confirm them again.');
    $orderId = bin2hex(random_bytes(16));
    db('INSERT INTO paymongo_orders(order_id,agreement_id,borrower_id,lender_id,installment_id,mode,amount_cents,quote_json,livemode) VALUES (?,?,?,?,?,?,?,?,?)', [$orderId, $a['agreement_id'], $u['user_id'], $a['lender_id'], $q['installment_id'], $q['mode'], $q['amount_cents'], json_encode($q), $c['live'] ? 1 : 0]);
    $conn->commit();
    $started = true;
    $resource = pm_http($c, 'v2/checkout_sessions', ['data' => ['attributes' => ['line_items' => [['name' => 'UW-' . $a['agreement_id'] . ' ' . ($q['mode'] === 'interest-only' ? 'Monthly interest' : 'Installment'), 'amount' => $q['amount_cents'], 'currency' => 'PHP', 'quantity' => 1]], 'payment_method_types' => ['gcash', 'card'], 'success_url' => $c['public_url'] . '/borrower/payment-history.php?checkout=' . $orderId, 'cancel_url' => $c['public_url'] . '/borrower/payments.php?checkout=' . $orderId, 'reference_number' => $orderId, 'description' => 'Utang Wise loan payment', 'send_email_receipt' => true, 'billing' => ['name' => $u['user_fn'] . ' ' . $u['user_ln'], 'email' => $u['email']]]]]);
    $url = $resource['attributes']['checkout_url'] ?? '';
    $session = $resource['id'] ?? '';
    if (!preg_match('/^cs_[a-zA-Z0-9]+$/D', $session) || parse_url($url, PHP_URL_SCHEME) !== 'https' || parse_url($url, PHP_URL_HOST) !== 'checkout.paymongo.com')
        throw new RuntimeException('Payment checkout response requires verification.');
    db("UPDATE paymongo_orders SET session_id=?,checkout_url=?,state=CASE WHEN state='creating' THEN 'pending' ELSE state END WHERE order_id=?", [$session, $url, $orderId]);
    header('Location: ' . $url);
    exit;
} catch (Throwable $e) {
    rollback_safely();
    if ($started)
        db("UPDATE paymongo_orders SET state=?,error_note=? WHERE order_id=? AND state='creating'", [$e instanceof DomainException ? 'failed' : 'uncertain', 'Provider checkout creation needs confirmation.', $orderId]);
    fail_form($e instanceof DomainException || $e instanceof RuntimeException && !($e instanceof mysqli_sql_exception) ? $e->getMessage() : 'The payment could not be started. Check payment history before retrying.', 'borrower/payments.php');
}

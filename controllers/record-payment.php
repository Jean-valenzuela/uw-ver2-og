<?php
require __DIR__ . '/../helpers/apply_payment.php';
$lender = lender_user();
lender_post();
try {
    $conn->begin_transaction();
    $id = (int) ($_POST['agreement_id'] ?? 0);
    $a = db('SELECT * FROM loan_agreements WHERE agreement_id=? AND lender_id=? FOR UPDATE', [$id, $lender['user_id']])->get_result()->fetch_assoc();
    if (!$a || $a['status'] !== 'active')
        throw new DomainException('Select an active loan belonging to your account.');
    if (db("SELECT order_id FROM paymongo_orders WHERE agreement_id=? AND state IN ('creating','pending','uncertain','review')", [$id])->get_result()->num_rows)
        throw new DomainException('An online payment is awaiting confirmation. Resolve it before recording another payment.');
    $mode = $_POST['mode'] ?? 'regular';
    if (!in_array($mode, ['regular', 'interest-only'], true))
        throw new DomainException('Choose a valid payment type.');
    $rows = payment_components($a, true);
    if (($_POST['preview'] ?? '') === '1') {
        $q = interest_only_preview($a, $rows);
        $conn->rollback();
        unset($q['from'], $q['next']);
        lender_json($q);
    }
    $token = $_POST['request_token'] ?? '';
    if (!preg_match('/^[a-f0-9]{64}$/D', $token))
        throw new DomainException('Reload the payment form.');
    if (db('SELECT payment_id FROM loan_payments WHERE request_token=?', [$token])->get_result()->num_rows)
        throw new DomainException('This payment was already recorded. Reload the history.');
    $date = lender_date($_POST['payment_date'] ?? '', 'payment_date')->format('Y-m-d');
    $release = db('SELECT released_at FROM lender_contracts WHERE agreement_id=?', [$id])->get_result()->fetch_assoc();
    $earliest = substr($release['released_at'] ?? $a['approval_date'], 0, 10);
    if ($date > date('Y-m-d') || $date < $earliest)
        throw new DomainException('Payment date must be between loan release and today.');
    $amount = amount_cents($_POST['amount'] ?? '');
    $balance = array_sum(array_map(fn($i) => $i['principal_remaining'] + $i['interest_remaining'], $rows));
    if ($amount < 1 || $amount > $balance)
        throw new DomainException('Enter a positive amount no greater than the outstanding balance.');
    $note = trim($_POST['reference_note'] ?? '');
    if (strlen($note) > 255)
        throw new DomainException('Payment reference must be 255 characters or fewer.');
    $q = null;
    if ($mode === 'interest-only') {
        $q = interest_only_preview($a, $rows);
        if (($_POST['confirm_carry'] ?? '') !== 'yes')
            throw new DomainException('Confirm that the borrower requested interest-only payment and agreed to the displayed schedule change.');
        if ($amount !== $q['payment_cents'])
            throw new DomainException('Interest-only payment must match the unpaid interest for the earliest unpaid installment. Refresh the preview.');
        // Prevent saving terms from a stale preview after another payment or extension.
        if (($_POST['next_due_date'] ?? '') !== $q['next_due_date'] || (int) ($_POST['next_amount_cents'] ?? -1) !== $q['next_amount_cents'])
            throw new DomainException('The schedule changed. Preview it again before saving.');
        $note = 'Interest only. ' . $note;
    }
    $paymentId = apply_loan_payment($a, $rows, $amount, $mode, $date, $note, $token, $lender['user_id'], $q);
    $conn->commit();
    lender_json(['ok' => true, 'payment_id' => $paymentId, 'message' => $q ? 'Interest payment recorded and principal carried forward.' : 'Payment recorded.']);
} catch (DomainException $e) {
    rollback_safely();
    lender_json(['error' => $e->getMessage()], 422);
} catch (Throwable $e) {
    rollback_safely();
    error_log('Record payment: ' . $e->getMessage());
    lender_json(['error' => 'Payment could not be saved. Refresh the history before retrying.'], 500);
}

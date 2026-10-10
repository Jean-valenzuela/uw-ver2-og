<?php require __DIR__ . '/../helpers/borrower_portal.php';
$u = borrower_user();
if ($_SERVER['REQUEST_METHOD'] !== 'POST')
    go('borrower/request-loan.php');
check_csrf();
try {
    $conn->begin_transaction();
    db('SELECT user_id FROM users WHERE user_id=? FOR UPDATE', [$u['user_id']]);
    if (!borrower_can_request($u['user_id']))
        throw new DomainException('Clear all dues and existing requests before requesting another loan.');
    if (!selected_lender($u['selected_lender_id']))
        throw new DomainException('Your lender is unavailable. Contact support.');
    $amount = amount_cents($_POST['amount'] ?? '');
    $term = (int) ($_POST['term_months'] ?? 0);
    $purpose = trim($_POST['purpose'] ?? '');
    if ($amount < 100 || $amount > 100000000 || !in_array($term, [3, 6, 12], true) || !$purpose || mb_strlen($purpose) > 1000)
        throw new DomainException('Enter a valid amount, term and purpose.');
    db('INSERT INTO borrower_loan_requests(borrower_id,lender_id,amount,term_months,purpose) VALUES (?,?,?,?,?)', [$u['user_id'], $u['selected_lender_id'], $amount / 100, $term, $purpose]);
    $conn->commit();
    unset($_SESSION['notice'], $_SESSION['notice_kind']);
    $_SESSION['uw_success'] = ['title' => 'Loan request submitted', 'text' => 'Your lender can now review your request.'];
} catch (Throwable $e) {
    rollback_safely();
    fail_form($e instanceof DomainException ? $e->getMessage() : 'Your request could not be saved.', 'borrower/request-loan.php');
}
go('borrower/request-loan.php');
<?php
session_start();

/*
|--------------------------------------------------------------------------
| TEMPORARY DATA
|--------------------------------------------------------------------------
| Replace these values with database data later.
*/

$user = [
    'name' => 'Juan Dela Cruz',
    'role' => 'Client'
];

$activeLoan = [
    'id' => 'LN-2025-001',
    'amount' => '₱5,000.00',
    'monthly_due' => '₱958.33',
    'remaining_balance' => '₱2,874.99',
    'next_due' => 'Sep 12, 2025',
    'interest' => '2.5%',
    'total_payable' => '₱5,750.00',
    'amount_paid' => '₱2,875.01',
    'status' => 'On-going'
];

function initials($name) {
    $parts = preg_split('/\s+/', trim($name));
    $first = isset($parts[0][0]) ? $parts[0][0] : '';
    $last = count($parts) > 1 ? $parts[count($parts) - 1][0] : '';
    return strtoupper($first . $last);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Payment | Utang Wise</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">

    <link rel="stylesheet" href="css/payments.css">
</head>

<body>

<div class="client-layout">

    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">

        <div class="brand">
            <div class="brand-icon">₱</div>

            <div class="brand-text">
                <h2>UTANG WISE</h2>
                <span>LENDING MADE SIMPLE</span>
            </div>
        </div>

        <nav class="sidebar-menu">

            <a href="client-dashboard.php" class="menu-item">
                <span class="material-symbols-outlined">home</span>
                <span>Dashboard</span>
            </a>

            <a href="profile.php" class="menu-item">
                <span class="material-symbols-outlined">person</span>
                <span>Profile</span>
            </a>

            <a href="my-loans.php" class="menu-item">
                <span class="material-symbols-outlined">description</span>
                <span>My Loans</span>
            </a>

            <a href="request-loan.php" class="menu-item">
                <span class="material-symbols-outlined">add_circle</span>
                <span>Request Loan</span>
            </a>

            <a href="payments.php" class="menu-item active">
                <span class="material-symbols-outlined">credit_card</span>
                <span>Payments</span>
            </a>

            <a href="payment-extension.php" class="menu-item">
                <span class="material-symbols-outlined">calendar_month</span>
                <span>Payment Extension</span>
            </a>

            

            <a href="payment-history.php" class="menu-item">
                <span class="material-symbols-outlined">history</span>
                <span>Payment History</span>
            </a>

            <a href="agreements.php" class="menu-item">
                <span class="material-symbols-outlined">receipt_long</span>
                <span>Agreements</span>
            </a>

        </nav>

        <div class="sidebar-divider"></div>

        <div class="bottom-menu">
            <a href="logout.php" class="menu-item">
                <span class="material-symbols-outlined">logout</span>
                <span>Log Out</span>
            </a>
        </div>

    </aside>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- MAIN -->
    <main class="main-content">

        <header class="topbar">

            <button type="button" class="mobile-menu-btn" id="mobileMenuBtn" aria-label="Open menu">
                <span class="material-symbols-outlined">menu</span>
            </button>
<div class="user-area">

                <div class="notification">
                    <span class="material-symbols-outlined">notifications</span>
                    <span class="notification-dot"></span>
                </div>

                <div class="user-avatar">
                    <?= htmlspecialchars(initials($user['name'])) ?>
                </div>

                <div class="user-text">
                    <strong><?= htmlspecialchars($user['name']) ?></strong>
                    <span><?= htmlspecialchars($user['role']) ?></span>
                </div>

                <span class="material-symbols-outlined dropdown-icon">
                    keyboard_arrow_down
                </span>

            </div>

        </header>

        <section class="page-content">

            <div class="page-heading-row">
                <div class="breadcrumb">
                    <span>Home</span>
                    <span>›</span>
                    <strong>Payment</strong>
                </div>

                <div class="page-heading">
                    <h1>Payment</h1>
                    <p>Make a payment for your loan and keep track of your progress.</p>
                </div>
            </div>

            <div class="payment-layout">

                <!-- LEFT -->
                <form class="payment-form" id="paymentForm" action="#" method="post" enctype="multipart/form-data">

                    <div class="steps">
                        <div class="step active">
                            <span>1</span>
                            <strong>Select Loan</strong>
                        </div>

                        <div class="step-line"></div>

                        <div class="step">
                            <span>2</span>
                            <strong>Payment Method</strong>
                        </div>

                        <div class="step-line"></div>

                        <div class="step">
                            <span>3</span>
                            <strong>Confirm & Submit</strong>
                        </div>
                    </div>

                    <!-- STEP 1 -->
                    <section class="form-section">

                        <div class="section-heading">
                            <span class="section-number">1</span>

                            <div>
                                <h2>Select Loan to Pay</h2>
                                <p>Choose the loan you want to make a payment for.</p>
                            </div>
                        </div>

                        <select name="loan_id" class="loan-select">
                            <option value="LN-2025-001">LN-2025-001</option>
                        </select>

                        <div class="selected-loan-summary">

                            <div>
                                <span>Loan Amount</span>
                                <strong><?= htmlspecialchars($activeLoan['amount']) ?></strong>
                            </div>

                            <div>
                                <span>Monthly Due</span>
                                <strong><?= htmlspecialchars($activeLoan['monthly_due']) ?></strong>
                            </div>

                            <div>
                                <span>Remaining Balance</span>
                                <strong><?= htmlspecialchars($activeLoan['remaining_balance']) ?></strong>
                            </div>

                            <div>
                                <span>Next Due Date</span>
                                <strong><?= htmlspecialchars($activeLoan['next_due']) ?></strong>
                            </div>

                        </div>

                    </section>

                    <!-- STEP 2 -->
                    <section class="form-section">

                        <div class="section-heading">
                            <span class="section-number">2</span>

                            <div>
                                <h2>Choose Payment Method</h2>
                                <p>Select how you want to make your payment.</p>
                            </div>
                        </div>

                        <div class="payment-methods">

                            <label class="method-card selected" data-method="gcash">

                                <input type="radio" name="payment_method" value="gcash" checked>

                                <span class="radio-circle"></span>

                                <span class="method-icon gcash-icon">G</span>

                                <span class="method-text">
                                    <strong>GCash</strong>
                                    <small>Pay via GCash and upload your receipt.</small>
                                </span>

                            </label>

                            <label class="method-card" data-method="cash">

                                <input type="radio" name="payment_method" value="cash">

                                <span class="radio-circle"></span>

                                <span class="method-icon">
                                    <span class="material-symbols-outlined">payments</span>
                                </span>

                                <span class="method-text">
                                    <strong>Cash</strong>
                                    <small>Pay directly to the lender.</small>
                                </span>

                            </label>

                        </div>

                    </section>

                    <!-- STEP 3 -->
                    <section class="form-section">

                        <div class="section-heading">
                            <span class="section-number">3</span>

                            <div>
                                <h2>Payment Details</h2>
                                <p>Enter the payment amount and provide your proof of payment.</p>
                            </div>
                        </div>

                        <div class="payment-details-grid">

                            <div class="field-group">
                                <label for="paymentAmount">Payment Amount</label>

                                <div class="amount-input">
                                    <span>₱</span>
                                    <input
                                        type="number"
                                        id="paymentAmount"
                                        name="payment_amount"
                                        value="958.33"
                                        min="1"
                                        step="0.01"
                                    >
                                </div>

                                <small>Enter the amount you are paying.</small>
                            </div>

                            <div class="field-group receipt-field" id="receiptField">
                                <label>Upload Receipt</label>

                                <label class="upload-box" for="receiptInput">

                                    <input
                                        type="file"
                                        id="receiptInput"
                                        name="receipt"
                                        accept=".png,.jpg,.jpeg,.pdf"
                                    >

                                    <span class="material-symbols-outlined">upload</span>

                                    <strong id="uploadText">
                                        Click to upload or drag and drop
                                    </strong>

                                    <small>
                                        PNG, JPG, or PDF (Max 5MB)
                                    </small>

                                </label>
                            </div>

                        </div>

                        <div class="cash-message" id="cashMessage">
                            <span class="material-symbols-outlined">info</span>

                            <div>
                                <strong>Cash Payment</strong>
                                <p>
                                    Pay directly to the lender. Your payment will be recorded
                                    after it is confirmed by the admin.
                                </p>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="button" class="cancel-btn">Cancel</button>
                            <button type="submit" class="submit-btn">Submit Payment</button>
                        </div>

                    </section>

                </form>

                <!-- RIGHT -->
                <aside class="right-column">

                    <section class="side-card">

                        <div class="side-heading">
                            <div class="side-icon">
                                <span class="material-symbols-outlined">description</span>
                            </div>

                            <div>
                                <h2>Loan Summary</h2>
                                <p>Overview of your selected loan.</p>
                            </div>
                        </div>

                        <div class="loan-summary-list">
                            <div>
                                <span>Loan ID</span>
                                <strong><?= htmlspecialchars($activeLoan['id']) ?></strong>
                            </div>

                            <div>
                                <span>Original Loan Amount</span>
                                <strong><?= htmlspecialchars($activeLoan['amount']) ?></strong>
                            </div>

                            <div>
                                <span>Interest Rate</span>
                                <strong><?= htmlspecialchars($activeLoan['interest']) ?> (per month)</strong>
                            </div>

                            <div>
                                <span>Total Payable</span>
                                <strong><?= htmlspecialchars($activeLoan['total_payable']) ?></strong>
                            </div>

                            <div>
                                <span>Amount Paid</span>
                                <strong><?= htmlspecialchars($activeLoan['amount_paid']) ?></strong>
                            </div>

                            <div>
                                <span>Remaining Balance</span>
                                <strong><?= htmlspecialchars($activeLoan['remaining_balance']) ?></strong>
                            </div>

                            <div>
                                <span>Next Due Date</span>
                                <strong><?= htmlspecialchars($activeLoan['next_due']) ?></strong>
                            </div>

                            <div>
                                <span>Status</span>
                                <strong class="status-pill">On-going</strong>
                            </div>
                        </div>

                    </section>

                    <section class="side-card">

                        <div class="side-heading">
                            <div class="side-icon">
                                <span class="material-symbols-outlined">info</span>
                            </div>

                            <div>
                                <h2>Payment Instructions</h2>
                                <p>Follow the instructions based on your chosen payment method.</p>
                            </div>
                        </div>

                        <div class="instruction-tabs">
                            <button type="button" class="instruction-tab active" data-instruction="gcash">
                                GCash
                            </button>

                            <button type="button" class="instruction-tab" data-instruction="cash">
                                Cash
                            </button>
                        </div>

                        <div class="instruction-content gcash-instructions active">

                            <div class="qr-placeholder">
                                
                            </div>

                            <div class="gcash-details">
                                <p>Scan the QR code or send to:</p>

                                <span>GCash Name</span>
                                <strong>Rheeze mamaw magmahal</strong>

                                <span>GCash Number</span>

                                <div class="copy-row">
                                    <strong id="gcashNumber">09560547026</strong>

                                    <button type="button" id="copyNumber" aria-label="Copy GCash number">
                                        <span class="material-symbols-outlined">content_copy</span>
                                    </button>
                                </div>
                            </div>

                        </div>

                        <div class="instruction-content cash-instructions">

                            <div class="cash-instruction-icon">
                                <span class="material-symbols-outlined">payments</span>
                            </div>

                            <div>
                                <strong>Pay directly to the lender</strong>
                                <p>
                                    Please coordinate your cash payment with your assigned lender.
                                    The admin will confirm the payment before it appears in your history.
                                </p>
                            </div>

                        </div>

                        <div class="instruction-note" id="instructionNote">
                            <span class="material-symbols-outlined">info</span>
                            <p>
                                After payment, upload your receipt and click
                                <strong>Submit Payment</strong>. Your payment will be verified by the admin.
                            </p>
                        </div>

                    </section>

                 

                </aside>

            </div>

        </section>

    </main>

</div>

<script src="js/payment.js"></script>
</body>
</html>

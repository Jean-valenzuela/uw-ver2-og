<?php require_once __DIR__.'/../ajax/borrower.php'; $borrowerAccount = borrower_user(); ?>
<?php




$user = [
    'name' => 'Juan Dela Cruz',
    'role' => 'Client'
];

$activeLoan = [
    'id' => 'LN-2025-001',
    'amount' => '₱5,000.00',
    'monthly_due' => '₱958.33',
    'remaining_balance' => '₱2,874.99',
    'current_due' => 'Sep 12, 2025',
    'interest' => '2.5%',
    'total_payable' => '₱5,750.00',
    'amount_paid' => '₱2,875.01',
    'status' => 'On-going'
];

function initials($name)
{
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

    <title>Payment Extension | Utang Wise</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap"
        rel="stylesheet"
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"
        rel="stylesheet"
    >

    <link rel="stylesheet" href="css/payment-extension.css">
<link rel="stylesheet" href="../assets/css/borrower-flow.css"></head>

<body>

<div class="client-layout">

    <!-- =========================================
         SIDEBAR
    ========================================== -->
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

            <a href="payments.php" class="menu-item">
                <span class="material-symbols-outlined">credit_card</span>
                <span>Payments</span>
            </a>

            <a href="payment-extension.php" class="menu-item active">
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

            <?php borrower_logout_button(); ?>

        </div>

    </aside>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>


    <!-- =========================================
         MAIN CONTENT
    ========================================== -->
    <main class="main-content">

        <!-- TOPBAR -->
        <header class="topbar">

            <button
                type="button"
                class="mobile-menu-btn"
                id="mobileMenuBtn"
                aria-label="Open menu"
            >
                <span class="material-symbols-outlined">menu</span>
            </button>

            <div class="user-area">

                <div class="notification">
                    <span class="material-symbols-outlined">
                        notifications
                    </span>

                    <span class="notification-dot"></span>
                </div>

                <div class="user-avatar">
                    <?= htmlspecialchars(initials($user['name'])) ?>
                </div>

                <div class="user-text">
                    <strong>
                        <?= htmlspecialchars($user['name']) ?>
                    </strong>

                    <span>
                        <?= htmlspecialchars($user['role']) ?>
                    </span>
                </div>

                <span class="material-symbols-outlined dropdown-icon">
                    keyboard_arrow_down
                </span>

            </div>

        </header>


        <!-- =========================================
             PAGE
        ========================================== -->
        <section class="page-content">

            <div class="breadcrumb">
                <span>Home</span>
                <span>›</span>
                <strong>Payment Extension</strong>
            </div>

            <div class="page-heading">
                <h1>Payment Extension</h1>

                <p>
                    Request additional time for an upcoming loan payment.
                </p>
            </div>


            <!-- =====================================
                 PAGE GRID
            ====================================== -->
            <div class="extension-layout">

                <!-- LEFT -->
                <form
                    class="extension-form"
                    id="extensionForm"
                    action="#"
                    method="post"
                >

                    <!-- PROGRESS -->
                    <div class="steps">

                        <div class="step active">
                            <span>1</span>
                            <strong>Request</strong>
                        </div>

                        <div class="step-line"></div>

                        <div class="step">
                            <span>2</span>
                            <strong>Review</strong>
                        </div>

                        <div class="step-line"></div>

                        <div class="step">
                            <span>3</span>
                            <strong>Confirmation</strong>
                        </div>

                    </div>


                    <!-- =================================
                         STEP 1
                    ================================== -->
                    <section class="form-section">

                        <div class="section-heading">

                            <span class="section-number">1</span>

                            <div>
                                <h2>Select Loan</h2>

                                <p>
                                    Choose the loan you want to request
                                    an extension for.
                                </p>
                            </div>

                        </div>


                        <select
                            name="loan_id"
                            id="loanSelect"
                            class="loan-select"
                        >
                            <option value="LN-2025-001">
                                LN-2025-001 — ₱5,000.00 (On-going)
                            </option>
                        </select>


                        <div class="selected-loan-summary">

                            <div>
                                <span>Monthly Due</span>
                                <strong>
                                    <?= htmlspecialchars($activeLoan['monthly_due']) ?>
                                </strong>
                            </div>

                            <div>
                                <span>Remaining Balance</span>
                                <strong>
                                    <?= htmlspecialchars($activeLoan['remaining_balance']) ?>
                                </strong>
                            </div>

                            <div>
                                <span>Current Due Date</span>
                                <strong>
                                    <?= htmlspecialchars($activeLoan['current_due']) ?>
                                </strong>
                            </div>

                            <div>
                                <span>Status</span>

                                <strong class="summary-status">
                                    <span></span>
                                    <?= htmlspecialchars($activeLoan['status']) ?>
                                </strong>
                            </div>

                        </div>

                    </section>


                    <!-- =================================
                         STEP 2
                    ================================== -->
                    <section class="form-section">

                        <div class="section-heading">

                            <span class="section-number">2</span>

                            <div>
                                <h2>Extension Details</h2>

                                <p>
                                    Provide the details of your extension request.
                                </p>
                            </div>

                        </div>


                        <div class="date-grid">

                            <!-- CURRENT DATE -->
                            <div class="field-group">

                                <label for="currentDueDate">
                                    Current Due Date
                                </label>

                                <div class="date-field disabled-field">

                                    <span class="material-symbols-outlined">
                                        calendar_month
                                    </span>

                                    <input
                                        type="text"
                                        id="currentDueDate"
                                        value="<?= htmlspecialchars($activeLoan['current_due']) ?>"
                                        readonly
                                    >

                                </div>

                            </div>


                            <!-- NEW DATE -->
                            <div class="field-group">

                                <label for="requestedDueDate">
                                    Requested New Due Date
                                </label>

                                <div class="date-field">

                                    <span class="material-symbols-outlined">
                                        calendar_month
                                    </span>

                                    <input
                                        type="date"
                                        id="requestedDueDate"
                                        name="requested_due_date"
                                        required
                                    >

                                </div>

                            </div>

                        </div>


                        <!-- REASON -->
                        <div class="field-group reason-field">

                            <label for="extensionReason">
                                Reason for Extension
                            </label>

                            <select
                                id="extensionReason"
                                name="extension_reason"
                                required
                            >
                                <option value="" selected disabled>
                                    Select a reason
                                </option>

                                <option value="financial">
                                    Financial difficulty
                                </option>

                                <option value="salary">
                                    Delayed salary or income
                                </option>

                                <option value="emergency">
                                    Emergency expense
                                </option>

                                <option value="medical">
                                    Medical or family emergency
                                </option>

                                <option value="other">
                                    Other
                                </option>
                            </select>

                        </div>


                        <!-- EXPLANATION -->
                        <div class="field-group explanation-field">

                            <div class="label-row">

                                <label for="extensionExplanation">
                                    Additional Explanation
                                    <span>(Optional)</span>
                                </label>

                            </div>

                            <textarea
                                id="extensionExplanation"
                                name="extension_explanation"
                                maxlength="300"
                                placeholder="Briefly explain your reason for requesting an extension..."
                            ></textarea>

                            <div class="character-count">
                                <span id="characterCount">0</span>/300
                            </div>

                        </div>


                        <!-- ACTIONS -->
                        <div class="form-actions">

                            <button
                                type="button"
                                class="cancel-btn"
                                id="cancelBtn"
                            >
                                Cancel
                            </button>

                            <button
                                type="submit"
                                class="submit-btn"
                            >
                                <span class="material-symbols-outlined">
                                    send
                                </span>

                                Submit Request
                            </button>

                        </div>

                    </section>

                </form>


                <!-- =====================================
                     RIGHT COLUMN
                ====================================== -->
                <aside class="right-column">

                    <!-- LOAN SUMMARY -->
                    <section class="side-card">

                        <div class="side-heading">

                            <div class="side-icon">
                                <span class="material-symbols-outlined">
                                    description
                                </span>
                            </div>

                            <div>
                                <h2>Loan Summary</h2>

                                <p>
                                    Overview of your selected loan.
                                </p>
                            </div>

                        </div>


                        <div class="loan-summary-list">

                            <div>
                                <span>Loan ID</span>
                                <strong>
                                    <?= htmlspecialchars($activeLoan['id']) ?>
                                </strong>
                            </div>

                            <div>
                                <span>Original Loan Amount</span>
                                <strong>
                                    <?= htmlspecialchars($activeLoan['amount']) ?>
                                </strong>
                            </div>

                            <div>
                                <span>Interest Rate</span>

                                <strong>
                                    <?= htmlspecialchars($activeLoan['interest']) ?>
                                    (per month)
                                </strong>
                            </div>

                            <div>
                                <span>Total Payable</span>
                                <strong>
                                    <?= htmlspecialchars($activeLoan['total_payable']) ?>
                                </strong>
                            </div>

                            <div>
                                <span>Amount Paid</span>
                                <strong>
                                    <?= htmlspecialchars($activeLoan['amount_paid']) ?>
                                </strong>
                            </div>

                            <div>
                                <span>Remaining Balance</span>
                                <strong>
                                    <?= htmlspecialchars($activeLoan['remaining_balance']) ?>
                                </strong>
                            </div>

                            <div>
                                <span>Next Due Date</span>
                                <strong>
                                    <?= htmlspecialchars($activeLoan['current_due']) ?>
                                </strong>
                            </div>

                            <div>
                                <span>Status</span>

                                <strong class="status-pill">
                                    <span></span>
                                    <?= htmlspecialchars($activeLoan['status']) ?>
                                </strong>
                            </div>

                        </div>

                    </section>


                    <!-- IMPORTANT NOTES -->
                    <section class="side-card notes-card">

                        <div class="side-heading">

                            <div class="side-icon warning-icon">
                                <span class="material-symbols-outlined">
                                    priority_high
                                </span>
                            </div>

                            <div>
                                <h2>Important Notes</h2>

                                <p>
                                    Please read the following before submitting.
                                </p>
                            </div>

                        </div>


                        <div class="notes-box">

                            <ul>
                                <li>
                                    Extension requests are subject to
                                    lender approval.
                                </li>

                                <li>
                                    Submitting a request does not automatically
                                    extend your due date.
                                </li>

                                <li>
                                    Please provide a valid reason for your request.
                                </li>

                                <li>
                                    You will be notified once your request
                                    has been reviewed.
                                </li>

                                <li>
                                    For urgent concerns, you may contact
                                    your lender directly.
                                </li>
                            </ul>

                        </div>

                    </section>

                </aside>

            </div>

        </section>

    </main>

</div>

<script src="js/payment-extension.js"></script>

</body>
</html>
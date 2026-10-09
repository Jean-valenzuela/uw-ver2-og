<?php
session_start();

/*
|--------------------------------------------------------------------------
| TEMPORARY DATA
|--------------------------------------------------------------------------
| Replace with database data later.
*/

$user = [
    'name' => 'Juan Dela Cruz',
    'role' => 'Client'
];

$summary = [
    'total_paid' => '₱2,875.01',
    'total_payments' => 3,
    'on_time' => 2,
    'late' => 1
];

$payments = [
    [
        'date' => 'Aug 12, 2025',
        'loan_id' => 'LN-2025-001',
        'amount' => '₱500.00',
        'method' => 'GCash',
        'reference' => 'GC123456789',
        'status' => 'Paid'
    ],
    [
        'date' => 'Jul 12, 2025',
        'loan_id' => 'LN-2025-001',
        'amount' => '₱958.33',
        'method' => 'Cash',
        'reference' => 'N/A',
        'status' => 'Paid'
    ],
    [
        'date' => 'Jun 12, 2025',
        'loan_id' => 'LN-2025-001',
        'amount' => '₱958.33',
        'method' => 'GCash',
        'reference' => 'GC987654321',
        'status' => 'Paid'
    ],
    [
        'date' => 'May 12, 2025',
        'loan_id' => 'LN-2025-001',
        'amount' => '₱958.33',
        'method' => 'Cash',
        'reference' => 'N/A',
        'status' => 'Late'
    ]
];

function initials($name)
{
    $parts = preg_split('/\s+/', trim($name));

    $first = isset($parts[0][0]) ? $parts[0][0] : '';
    $last = count($parts) > 1
        ? $parts[count($parts) - 1][0]
        : '';

    return strtoupper($first . $last);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Payment History | Utang Wise</title>

    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin
    >

    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap"
        rel="stylesheet"
    >

    <!-- MATERIAL SYMBOLS -->
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="css/payment-history.css"
    >

    <link rel="stylesheet" href="css/datatables.min.css">

</head>

<body>

<div class="client-layout">

    <!-- =========================================
         SIDEBAR
    ========================================== -->

    <aside class="sidebar" id="sidebar">

        <div class="brand">

            <div class="brand-icon">
                ₱
            </div>

            <div class="brand-text">

                <h2>UTANG WISE</h2>

                <span>
                    LENDING MADE SIMPLE
                </span>

            </div>

        </div>


        <nav class="sidebar-menu">

            <a
                href="client-dashboard.php"
                class="menu-item"
            >
                <span class="material-symbols-outlined">
                    home
                </span>

                <span>Dashboard</span>
            </a>


            <a
                href="profile.php"
                class="menu-item"
            >
                <span class="material-symbols-outlined">
                    person
                </span>

                <span>Profile</span>
            </a>


            <a
                href="my-loans.php"
                class="menu-item"
            >
                <span class="material-symbols-outlined">
                    description
                </span>

                <span>My Loans</span>
            </a>


            <a
                href="request-loan.php"
                class="menu-item"
            >
                <span class="material-symbols-outlined">
                    add_circle
                </span>

                <span>Request Loan</span>
            </a>


            <a
                href="payments.php"
                class="menu-item"
            >
                <span class="material-symbols-outlined">
                    credit_card
                </span>

                <span>Payments</span>
            </a>


            <a
                href="payment-extension.php"
                class="menu-item"
            >
                <span class="material-symbols-outlined">
                    calendar_month
                </span>

                <span>Payment Extension</span>
            </a>


            <a
                href="payment-history.php"
                class="menu-item active"
            >
                <span class="material-symbols-outlined">
                    history
                </span>

                <span>Payment History</span>
            </a>


            <a
                href="agreements.php"
                class="menu-item"
            >
                <span class="material-symbols-outlined">
                    receipt_long
                </span>

                <span>Agreements</span>
            </a>

        </nav>


        <div class="sidebar-divider"></div>


        <div class="bottom-menu">

            <a
                href="logout.php"
                class="menu-item"
            >
                <span class="material-symbols-outlined">
                    logout
                </span>

                <span>Log Out</span>
            </a>

        </div>

    </aside>


    <div
        class="sidebar-overlay"
        id="sidebarOverlay"
    ></div>


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
                <span class="material-symbols-outlined">
                    menu
                </span>
            </button>


            <div class="user-area">

                <div class="notification">

                    <span class="material-symbols-outlined">
                        notifications
                    </span>

                    <span class="notification-dot"></span>

                </div>


                <div class="user-avatar">

                    <?= htmlspecialchars(
                        initials($user['name'])
                    ) ?>

                </div>


                <div class="user-text">

                    <strong>
                        <?= htmlspecialchars($user['name']) ?>
                    </strong>

                    <span>
                        <?= htmlspecialchars($user['role']) ?>
                    </span>

                </div>


                <span
                    class="material-symbols-outlined dropdown-icon"
                >
                    keyboard_arrow_down
                </span>

            </div>

        </header>


        <!-- =========================================
             PAGE
        ========================================== -->

        <section class="page-content">


            <!-- BREADCRUMB -->

            <div class="breadcrumb">

                <span>Home</span>

                <span>›</span>

                <strong>
                    Payment History
                </strong>

            </div>


            <!-- PAGE TITLE -->

            <div class="page-heading">

                <h1>
                    Payment History
                </h1>

                <p>
                    View your past payments and keep track
                    of your loan progress.
                </p>

            </div>


            <!-- =====================================
                 SUMMARY CARDS
            ====================================== -->

            <div class="summary-grid">


                <div class="summary-card total-paid">

                    <div class="summary-icon">

                        <span class="material-symbols-outlined">
                            credit_card
                        </span>

                    </div>

                    <div>

                        <span>
                            Total Amount Paid
                        </span>

                        <strong>
                            <?= htmlspecialchars(
                                $summary['total_paid']
                            ) ?>
                        </strong>

                    </div>

                </div>


                <div class="summary-card total-payments">

                    <div class="summary-icon">

                        <span class="material-symbols-outlined">
                            description
                        </span>

                    </div>

                    <div>

                        <span>
                            Total Payments
                        </span>

                        <strong>
                            <?= $summary['total_payments'] ?>
                        </strong>

                    </div>

                </div>


                <div class="summary-card on-time">

                    <div class="summary-icon">

                        <span class="material-symbols-outlined">
                            check
                        </span>

                    </div>

                    <div>

                        <span>
                            On-time Payments
                        </span>

                        <strong>
                            <?= $summary['on_time'] ?>
                        </strong>

                    </div>

                </div>


                <div class="summary-card late">

                    <div class="summary-icon">

                        <span class="material-symbols-outlined">
                            priority_high
                        </span>

                    </div>

                    <div>

                        <span>
                            Late Payments
                        </span>

                        <strong>
                            <?= $summary['late'] ?>
                        </strong>

                    </div>

                </div>

            </div>



            <!-- =====================================
                 PAYMENT RECORDS
            ====================================== -->

            <section class="records-card">


                <div class="records-header">

                    <div class="records-title">

                        <div class="records-icon">

                            <span class="material-symbols-outlined">
                                history
                            </span>

                        </div>

                        <h2>
                            Payment Records
                        </h2>

                    </div>


                    <button
                        type="button"
                        class="pdf-btn"
                        id="downloadPdfBtn"
                    >

                        <span class="material-symbols-outlined">
                            description
                        </span>

                        Download PDF

                    </button>

                </div>


                <div class="table-wrapper">

                    <table id="paymentTable">

                        <thead>

                            <tr>

                                <th>#</th>

                                <th>
                                    Payment Date
                                </th>

                                <th>
                                    Loan ID
                                </th>

                                <th>
                                    Amount Paid
                                </th>

                                <th>
                                    Payment Method
                                </th>

                                <th>
                                    Reference No.
                                </th>

                                <th>
                                    Status
                                </th>

                                <th>
                                    Actions
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            <?php foreach (
                                $payments as $index => $payment
                            ): ?>

                                <tr
                                    data-loan="<?= htmlspecialchars(
                                        $payment['loan_id']
                                    ) ?>"
                                    data-method="<?= htmlspecialchars(
                                        $payment['method']
                                    ) ?>"
                                    data-status="<?= htmlspecialchars(
                                        $payment['status']
                                    ) ?>"
                                >

                                    <td>
                                        <?= $index + 1 ?>
                                    </td>


                                    <td>
                                        <?= htmlspecialchars(
                                            $payment['date']
                                        ) ?>
                                    </td>


                                    <td>
                                        <?= htmlspecialchars(
                                            $payment['loan_id']
                                        ) ?>
                                    </td>


                                    <td class="amount-cell">
                                        <?= htmlspecialchars(
                                            $payment['amount']
                                        ) ?>
                                    </td>


                                    <td>
                                        <?= htmlspecialchars(
                                            $payment['method']
                                        ) ?>
                                    </td>


                                    <td>
                                        <?= htmlspecialchars(
                                            $payment['reference']
                                        ) ?>
                                    </td>


                                    <td>

                                        <span
                                            class="status-badge
                                            <?= strtolower(
                                                $payment['status']
                                            ) ?>"
                                        >

                                            <span
                                                class="material-symbols-outlined"
                                            >
                                                <?= $payment['status']
                                                    === 'Paid'
                                                    ? 'check'
                                                    : 'schedule'
                                                ?>
                                            </span>

                                            <?= htmlspecialchars(
                                                $payment['status']
                                            ) ?>

                                        </span>

                                    </td>


                                    <td>

                                        <button
                                            type="button"
                                            class="view-btn"
                                            data-payment-index="<?= $index ?>"
                                        >

                                            <span
                                                class="material-symbols-outlined"
                                            >
                                                visibility
                                            </span>

                                            View

                                        </button>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        </tbody>

                    </table>

                </div>


               

            </section>

        </section>

    </main>

</div>


<!-- =========================================
     PAYMENT DETAILS MODAL
========================================== -->

<div
    class="payment-modal"
    id="paymentModal"
    aria-hidden="true"
>

    <div
        class="modal-overlay"
        data-close-payment-modal
    ></div>


    <div class="modal-dialog">

        <button
            type="button"
            class="modal-close"
            data-close-payment-modal
        >
            <span class="material-symbols-outlined">
                close
            </span>
        </button>


        <div class="modal-icon">

            <span class="material-symbols-outlined">
                receipt_long
            </span>

        </div>


        <h2>
            Payment Details
        </h2>


        <p>
            View the information for this payment.
        </p>


        <div class="modal-details">

            <div>
                <span>Payment Date</span>
                <strong id="modalDate">—</strong>
            </div>

            <div>
                <span>Loan ID</span>
                <strong id="modalLoan">—</strong>
            </div>

            <div>
                <span>Amount Paid</span>
                <strong id="modalAmount">—</strong>
            </div>

            <div>
                <span>Payment Method</span>
                <strong id="modalMethod">—</strong>
            </div>

            <div>
                <span>Reference No.</span>
                <strong id="modalReference">—</strong>
            </div>

            <div>
                <span>Status</span>
                <strong id="modalStatus">—</strong>
            </div>

        </div>


        <button
            type="button"
            class="modal-done"
            data-close-payment-modal
        >
            Done
        </button>

    </div>

</div>


<script>
    window.paymentHistoryData =
        <?= json_encode($payments) ?>;
</script>

<script src="js/datatables.min.js"></script>
<script src="js/payment-history.js"></script>
</body>
</html>
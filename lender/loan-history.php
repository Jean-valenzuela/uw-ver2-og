<?php require_once __DIR__.'/../helpers/lending.php'; $lenderAccount=lender_user(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Loan History | Utang Wise</title>

    <link rel="stylesheet" href="../css/loaners-priv.css">

    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600&family=Playfair+Display:wght@600;700&display=swap"
        rel="stylesheet"
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"
        rel="stylesheet"
    >
</head>

<body>

<div class="admin-layout">

    <!-- =========================================
         SIDEBAR
    ========================================== -->
    <aside class="sidebar">

        <div class="brand">

            <div class="brand-icon">
                ₱
            </div>

            <div>
                <h2>UTANG WISE</h2>
                <span>LENDING MADE SIMPLE</span>
            </div>

        </div>


        <nav class="sidebar-menu">

            <a href="#" class="menu-item">
                <span class="material-symbols-outlined">home</span>
                Dashboard
            </a>

            <a href="loaners-priv.php" class="menu-item active">
                <span class="material-symbols-outlined">groups</span>
                Loaners
            </a>

            <a href="#" class="menu-item">
                <span class="material-symbols-outlined">description</span>
                Applications
            </a>

            <a href="#" class="menu-item">
                <span class="material-symbols-outlined">schedule</span>
                Extension Requests
            </a>

            <a href="#" class="menu-item">
                <span class="material-symbols-outlined">
                    account_balance_wallet
                </span>
                Debts / Loans
            </a>

            <a href="#" class="menu-item">
                <span class="material-symbols-outlined">payments</span>
                Payments
            </a>

            <a href="#" class="menu-item">
                <span class="material-symbols-outlined">bar_chart</span>
                Reports
            </a>

            <a href="#" class="menu-item">
                <span class="material-symbols-outlined">contract</span>
                Legal Agreements
            </a>

        </nav>


        <div class="sidebar-divider"></div>


        <nav class="sidebar-menu bottom-menu">

            <a href="#" class="menu-item">
                <span class="material-symbols-outlined">settings</span>
                Settings
            </a>

            <a href="#" class="menu-item">
                <span class="material-symbols-outlined">support_agent</span>
                Help & Support
            </a>

            <a href="#" class="menu-item">
                <span class="material-symbols-outlined">logout</span>
                Log Out
            </a>

        </nav>


        <div class="security-box">

            <span class="material-symbols-outlined">
                lock
            </span>

            <div>
                <h4>Secure & Trusted</h4>

                <p>
                    Client information is protected
                    and handled securely.
                </p>
            </div>

        </div>

    </aside>


    <!-- =========================================
         MAIN
    ========================================== -->
    <main class="main-content">


        <!-- TOPBAR -->
        <header class="topbar">

            <div class="search-box">

                <span class="material-symbols-outlined">
                    search
                </span>

                <input
                    type="text"
                    placeholder="Search client name, phone number, or ID..."
                >

            </div>


            <div class="top-user">

                <span class="material-symbols-outlined notification">
                    notifications
                </span>

                <div class="admin-avatar">
                    <span class="material-symbols-outlined">
                        person
                    </span>
                </div>

                <div class="admin-text">
                    <strong>Admin</strong>
                    <span>Loan Officer</span>
                </div>

                <span class="material-symbols-outlined">
                    keyboard_arrow_down
                </span>

            </div>

        </header>


        <!-- =========================================
             PAGE
        ========================================== -->
        <div class="page-content">


            <!-- HEADING -->
            <div class="page-heading">

                <div>

                    <div class="breadcrumb">
                        Loaners
                        <span>›</span>
                        Juan Dela Cruz
                        <span>›</span>
                        Loan History
                    </div>

                    <h1>Client Profile</h1>

                    <p>
                        View and manage client information,
                        loans, and documents.
                    </p>

                </div>


                <div class="heading-actions">

                    <a href="loaners-priv.php" class="secondary-button">

                        <span class="material-symbols-outlined">
                            arrow_back
                        </span>

                        Back to Loaners

                    </a>

                </div>

            </div>


            <!-- =========================================
                 TABS
            ========================================== -->
            <div class="tabs">

                <a href="loaners-priv.php" class="tab">

                    <span class="material-symbols-outlined">
                        person
                    </span>

                    Basic Information

                </a>


                <a href="supporting-documents.php" class="tab">

                    <span class="material-symbols-outlined">
                        description
                    </span>

                    Supporting Documents

                </a>


                <a href="loan-history.php" class="tab active">

                    <span class="material-symbols-outlined">
                        history
                    </span>

                    Loan History

                </a>


                <a href="legal-agreements.php" class="tab">

                    <span class="material-symbols-outlined">
                        contract
                    </span>

                    Legal Agreements

                </a>


                <a href="reference-person-admin.php" class="tab">

                    <span class="material-symbols-outlined">
                        groups
                    </span>

                    Reference Person

                </a>

            </div>


            <!-- =========================================
                 LOAN HISTORY HEADER
            ========================================== -->
            <section class="loan-history-card">

                <div class="loan-history-heading">

                    <div class="loan-history-title">

                        <span class="material-symbols-outlined">
                            history
                        </span>

                        <div>
                            <h2>Loan History</h2>

                            <p>
                                Complete borrowing and payment
                                record of this client.
                            </p>
                        </div>

                    </div>


                    <button class="export-button">

                        <span class="material-symbols-outlined">
                            download
                        </span>

                        Export Record

                    </button>

                </div>


                <!-- =========================================
                     SUMMARY CARDS
                ========================================== -->
                <div class="history-summary-grid">


                    <!-- TOTAL LOANS -->
                    <div class="history-summary-box">

                        <div class="history-summary-icon">

                            <span class="material-symbols-outlined">
                                request_quote
                            </span>

                        </div>

                        <div>
                            <span>Total Loans</span>

                            <strong>4</strong>

                            <small>
                                All recorded loans
                            </small>
                        </div>

                    </div>


                    <!-- TOTAL BORROWED -->
                    <div class="history-summary-box">

                        <div class="history-summary-icon">

                            <span class="material-symbols-outlined">
                                payments
                            </span>

                        </div>

                        <div>
                            <span>Total Borrowed</span>

                            <strong>₱55,000</strong>

                            <small>
                                Overall loan amount
                            </small>
                        </div>

                    </div>


                    <!-- TOTAL PAID -->
                    <div class="history-summary-box">

                        <div class="history-summary-icon green-icon">

                            <span class="material-symbols-outlined">
                                check_circle
                            </span>

                        </div>

                        <div>
                            <span>Total Paid</span>

                            <strong>₱35,000</strong>

                            <small>
                                Successfully paid
                            </small>
                        </div>

                    </div>


                    <!-- REMAINING -->
                    <div class="history-summary-box">

                        <div class="history-summary-icon red-icon">

                            <span class="material-symbols-outlined">
                                account_balance_wallet
                            </span>

                        </div>

                        <div>
                            <span>Remaining Balance</span>

                            <strong>₱20,000</strong>

                            <small>
                                Pending / overdue
                            </small>
                        </div>

                    </div>

                </div>


                <!-- =========================================
                     PAYMENT BEHAVIOR
                ========================================== -->
                <div class="payment-behavior">

                    <div class="behavior-left">

                        <div class="behavior-icon">
                            <span class="material-symbols-outlined">
                                verified
                            </span>
                        </div>

                        <div>
                            <span>Payment Behavior</span>

                            <h3>Good Payer</h3>

                            <p>
                                Most payments were completed
                                on or before the due date.
                            </p>
                        </div>

                    </div>


                    <div class="behavior-stats">

                        <div>
                            <strong>3</strong>
                            <span>Paid Loans</span>
                        </div>

                        <div>
                            <strong>1</strong>
                            <span>Active Loan</span>
                        </div>

                        <div>
                            <strong>0</strong>
                            <span>Late Payments</span>
                        </div>

                    </div>

                </div>


                <!-- =========================================
                     TABLE HEADER
                ========================================== -->
                <div class="history-table-heading">

                    <div>

                        <span class="material-symbols-outlined">
                            receipt_long
                        </span>

                        <h3>Loan Records</h3>

                    </div>


                    <select class="history-filter">

                        <option>All Status</option>
                        <option>Paid</option>
                        <option>Pending</option>
                        <option>Overdue</option>

                    </select>

                </div>


                <!-- =========================================
                     LOAN HISTORY TABLE
                ========================================== -->
                <div class="table-wrapper">

                    <table class="loan-history-table">

                        <thead>

                            <tr>
                                <th>#</th>
                                <th>Loan Date</th>
                                <th>Loan Type</th>
                                <th>Amount</th>
                                <th>Repayment Term</th>
                                <th>Due Date</th>
                                <th>Amount Paid</th>
                                <th>Balance</th>
                                <th>Payment Method</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>

                        </thead>


                        <tbody>

                            <!-- LOAN 1 -->
                            <tr>

                                <td>1</td>

                                <td>
                                    Jan 15, 2025
                                </td>

                                <td>
                                    Money
                                </td>

                                <td>
                                    ₱10,000
                                </td>

                                <td>
                                    1 Month
                                </td>

                                <td>
                                    Feb 15, 2025
                                </td>

                                <td>
                                    ₱10,000
                                </td>

                                <td>
                                    ₱0
                                </td>

                                <td>
                                    GCash
                                </td>

                                <td>
                                    <span class="status paid">
                                        Paid
                                    </span>
                                </td>

                                <td>
                                    <a href="#" class="view-record">
                                        View
                                    </a>
                                </td>

                            </tr>


                            <!-- LOAN 2 -->
                            <tr>

                                <td>2</td>

                                <td>
                                    Mar 10, 2025
                                </td>

                                <td>
                                    Item - Laptop
                                </td>

                                <td>
                                    ₱25,000
                                </td>

                                <td>
                                    3 Months
                                </td>

                                <td>
                                    Jun 10, 2025
                                </td>

                                <td>
                                    ₱25,000
                                </td>

                                <td>
                                    ₱0
                                </td>

                                <td>
                                    Cash
                                </td>

                                <td>
                                    <span class="status paid">
                                        Paid
                                    </span>
                                </td>

                                <td>
                                    <a href="#" class="view-record">
                                        View
                                    </a>
                                </td>

                            </tr>


                            <!-- LOAN 3 -->
                            <tr>

                                <td>3</td>

                                <td>
                                    Jun 12, 2025
                                </td>

                                <td>
                                    Money
                                </td>

                                <td>
                                    ₱15,000
                                </td>

                                <td>
                                    3 Months
                                </td>

                                <td>
                                    Sep 12, 2025
                                </td>

                                <td>
                                    ₱0
                                </td>

                                <td>
                                    ₱15,000
                                </td>

                                <td>
                                    GCash
                                </td>

                                <td>
                                    <span class="status overdue">
                                        Overdue
                                    </span>
                                </td>

                                <td>
                                    <a href="#" class="view-record">
                                        View
                                    </a>
                                </td>

                            </tr>


                            <!-- LOAN 4 -->
                            <tr>

                                <td>4</td>

                                <td>
                                    Aug 01, 2025
                                </td>

                                <td>
                                    Money
                                </td>

                                <td>
                                    ₱5,000
                                </td>

                                <td>
                                    1 Month
                                </td>

                                <td>
                                    Sep 01, 2025
                                </td>

                                <td>
                                    ₱0
                                </td>

                                <td>
                                    ₱5,000
                                </td>

                                <td>
                                    Cash
                                </td>

                                <td>
                                    <span class="status pending">
                                        Pending
                                    </span>
                                </td>

                                <td>
                                    <a href="#" class="view-record">
                                        View
                                    </a>
                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </section>

        </div>

    </main>

</div>

<?php if(function_exists('uw_success_assets'))uw_success_assets(); ?></body>
</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Debts / Loans | Utang Wise</title>

    <!-- DataTables -->
    <link rel="stylesheet" href="../css/datatables.min.css">

    <!-- Page CSS -->
    <link rel="stylesheet" href="../css/debts-loans.css">

    <!-- Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap"
        rel="stylesheet"
    >

    <!-- Material Symbols -->
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"
        rel="stylesheet"
    >
</head>

<body>

<div class="admin-layout">

    <!-- ==================================================
         SIDEBAR
    =================================================== -->

    <aside class="sidebar">

        <div class="brand">

            <div class="brand-icon">
                ₱
            </div>

            <div class="brand-text">
                <h2>UTANG WISE</h2>
                <span>LENDING MADE SIMPLE</span>
            </div>

        </div>


        <nav class="sidebar-menu">

            <a href="#" class="menu-item">
                <span class="material-symbols-outlined">home</span>
                Dashboard
            </a>

            <a href="loaners.php" class="menu-item">
                <span class="material-symbols-outlined">groups</span>
                Loaners
            </a>

            <a href="applications.php" class="menu-item">

                <span class="material-symbols-outlined">
                    description
                </span>

                Applications

                <span class="menu-badge">
                    3
                </span>

            </a>

            <a href="extension-requests.php" class="menu-item">

                <span class="material-symbols-outlined">
                    schedule
                </span>

                Extension Requests

                <span class="menu-badge">
                    1
                </span>

            </a>

            <a href="debts-loans.php" class="menu-item active">
                <span class="material-symbols-outlined">
                    account_balance_wallet
                </span>
                Debts / Loans
            </a>

            <a href="#" class="menu-item">
                <span class="material-symbols-outlined">
                    bar_chart
                </span>
                Payments
            </a>

            <a href="#" class="menu-item">
                <span class="material-symbols-outlined">
                    history
                </span>
                Reports
            </a>

            <a href="#" class="menu-item">
                <span class="material-symbols-outlined">
                    contract
                </span>
                Legal Agreements
            </a>

        </nav>


        <div class="sidebar-divider"></div>


        <nav class="sidebar-menu sidebar-bottom">

            <a href="#" class="menu-item">
                <span class="material-symbols-outlined">
                    settings
                </span>
                Settings
            </a>

            <a href="#" class="menu-item">
                <span class="material-symbols-outlined">
                    support_agent
                </span>
                Help & Support
            </a>

            <a href="#" class="menu-item">
                <span class="material-symbols-outlined">
                    logout
                </span>
                Log Out
            </a>

        </nav>

    </aside>


    <!-- ==================================================
         MAIN
    =================================================== -->

    <main class="main-content">

        <!-- TOPBAR -->

        <header class="topbar">

            <div class="top-search">

                <span class="material-symbols-outlined">
                    search
                </span>

                <input
                    type="text"
                    placeholder="Search borrower name or loan ID..."
                >

            </div>


            <div class="admin-area">

                <div class="notification-icon">

                    <span class="material-symbols-outlined">
                        notifications
                    </span>

                    <span class="notification-dot"></span>

                </div>


                <div class="admin-avatar">
                    A
                </div>


                <div class="admin-info">
                    <strong>Admin</strong>
                    <span>Loan Officer</span>
                </div>


                <span class="material-symbols-outlined">
                    keyboard_arrow_down
                </span>

            </div>

        </header>


        <!-- ==================================================
             PAGE CONTENT
        =================================================== -->

        <div class="page-content">

            <div class="page-heading">

                <div class="heading-left">

                    <div class="breadcrumb">
                        Dashboard
                        <span>›</span>
                        Debts / Loans
                    </div>

                    <h1>Debts / Loans</h1>

                    <p>
                        Manage and monitor all active loans
                        and outstanding balances.
                    </p>

                </div>

            </div>


            <!-- ==================================================
                 SUMMARY CARDS
            =================================================== -->

            <section class="summary-grid">

                <div class="summary-card">

                    <div class="summary-icon blue">
                        <span class="material-symbols-outlined">
                            account_balance_wallet
                        </span>
                    </div>

                    <div>
                        <span>Total Active Loans</span>
                        <strong>24</strong>
                        <small>Currently active records</small>
                    </div>

                </div>


                <div class="summary-card">

                    <div class="summary-icon gold">
                        <span class="material-symbols-outlined">
                            payments
                        </span>
                    </div>

                    <div>
                        <span>Total Outstanding</span>
                        <strong>₱48,500</strong>
                        <small>Remaining loan balance</small>
                    </div>

                </div>


                <div class="summary-card">

                    <div class="summary-icon red">
                        <span class="material-symbols-outlined">
                            warning
                        </span>
                    </div>

                    <div>
                        <span>Overdue Loans</span>
                        <strong>4</strong>
                        <small>Require monitoring</small>
                    </div>

                </div>


                <div class="summary-card">

                    <div class="summary-icon green">
                        <span class="material-symbols-outlined">
                            task_alt
                        </span>
                    </div>

                    <div>
                        <span>Completed Loans</span>
                        <strong>18</strong>
                        <small>Fully settled records</small>
                    </div>

                </div>

            </section>


            <!-- ==================================================
                 TABLE CARD
            =================================================== -->

            <section class="loans-card">

                <!-- FILTERS -->

                <div class="filter-bar">

                    <div class="custom-search">

                        <span class="material-symbols-outlined">
                            search
                        </span>

                        <input
                            type="text"
                            id="loanSearch"
                            placeholder="Search borrower or loan ID..."
                        >

                    </div>


                    <select id="statusFilter">

                        <option value="">
                            All Status
                        </option>

                        <option value="Active">
                            Active
                        </option>

                        <option value="Overdue">
                            Overdue
                        </option>

                        <option value="Completed">
                            Completed
                        </option>

                    </select>


                    <select id="termFilter">

                        <option value="">
                            All Terms
                        </option>

                        <option value="1 Month">
                            1 Month
                        </option>

                        <option value="3 Months">
                            3 Months
                        </option>

                        <option value="6 Months">
                            6 Months
                        </option>

                        <option value="9 Months">
                            9 Months
                        </option>

                        <option value="12 Months">
                            12 Months
                        </option>

                    </select>


                    <button
                        type="button"
                        class="reset-btn"
                        id="resetFilters"
                    >

                        <span class="material-symbols-outlined">
                            refresh
                        </span>

                        Reset Filters

                    </button>

                </div>


                <!-- TABLE -->

                <div class="table-wrapper">

                    <table id="loansTable">

                        <thead>

                            <tr>
                                <th>#</th>
                                <th>Borrower</th>
                                <th>Loan ID</th>
                                <th>Loan Amount</th>
                                <th>Amount Paid</th>
                                <th>Balance</th>
                                <th>Term</th>
                                <th>Next Due Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>

                        </thead>


                        <tbody>

                            <tr>

                                <td>1</td>

                                <td>
                                    <div class="borrower-cell">

                                        <div class="small-avatar">
                                            MS
                                        </div>

                                        <div>
                                            <strong>Maria Santos</strong>
                                            <span>+63 915 123 4567</span>
                                        </div>

                                    </div>
                                </td>

                                <td>LN-2026-001</td>

                                <td>₱3,000</td>

                                <td>₱550</td>

                                <td class="balance-cell">
                                    ₱2,450
                                </td>

                                <td>3 Months</td>

                                <td data-order="2026-03-15">
                                    Mar 15, 2026
                                </td>

                                <td>
                                    <span class="status active">
                                        Active
                                    </span>
                                </td>

                                <td>

                                    <button
                                        type="button"
                                        class="view-loan-btn"
                                        data-loan="maria"
                                    >

                                        <span class="material-symbols-outlined">
                                            visibility
                                        </span>

                                        View

                                    </button>

                                </td>

                            </tr>


                            <tr>

                                <td>2</td>

                                <td>
                                    <div class="borrower-cell">

                                        <div class="small-avatar">
                                            JD
                                        </div>

                                        <div>
                                            <strong>Juan Dela Cruz</strong>
                                            <span>+63 912 345 6789</span>
                                        </div>

                                    </div>
                                </td>

                                <td>LN-2026-002</td>

                                <td>₱2,500</td>

                                <td>₱1,200</td>

                                <td class="balance-cell">
                                    ₱1,300
                                </td>

                                <td>6 Months</td>

                                <td data-order="2026-03-20">
                                    Mar 20, 2026
                                </td>

                                <td>
                                    <span class="status active">
                                        Active
                                    </span>
                                </td>

                                <td>

                                    <button
                                        type="button"
                                        class="view-loan-btn"
                                        data-loan="juan"
                                    >
                                        <span class="material-symbols-outlined">
                                            visibility
                                        </span>
                                        View
                                    </button>

                                </td>

                            </tr>


                            <tr>

                                <td>3</td>

                                <td>
                                    <div class="borrower-cell">

                                        <div class="small-avatar">
                                            AC
                                        </div>

                                        <div>
                                            <strong>Ana Cruz</strong>
                                            <span>+63 918 567 8901</span>
                                        </div>

                                    </div>
                                </td>

                                <td>LN-2026-003</td>

                                <td>₱3,000</td>

                                <td>₱1,100</td>

                                <td class="balance-cell">
                                    ₱1,900
                                </td>

                                <td>6 Months</td>

                                <td data-order="2026-02-25">
                                    Feb 25, 2026
                                </td>

                                <td>
                                    <span class="status overdue">
                                        Overdue
                                    </span>
                                </td>

                                <td>

                                    <button
                                        type="button"
                                        class="view-loan-btn"
                                        data-loan="ana"
                                    >
                                        <span class="material-symbols-outlined">
                                            visibility
                                        </span>
                                        View
                                    </button>

                                </td>

                            </tr>


                            <tr>

                                <td>4</td>

                                <td>
                                    <div class="borrower-cell">

                                        <div class="small-avatar">
                                            PR
                                        </div>

                                        <div>
                                            <strong>Pedro Reyes</strong>
                                            <span>+63 917 456 7890</span>
                                        </div>

                                    </div>
                                </td>

                                <td>LN-2026-004</td>

                                <td>₱2,000</td>

                                <td>₱2,000</td>

                                <td class="balance-cell">
                                    ₱0
                                </td>

                                <td>3 Months</td>

                                <td>—</td>

                                <td>
                                    <span class="status completed">
                                        Completed
                                    </span>
                                </td>

                                <td>

                                    <button
                                        type="button"
                                        class="view-loan-btn"
                                        data-loan="pedro"
                                    >
                                        <span class="material-symbols-outlined">
                                            visibility
                                        </span>
                                        View
                                    </button>

                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </section>

        </div>

    </main>

</div>


<!-- ==================================================
     LOAN DETAILS MODAL
=================================================== -->

<div
    class="loan-modal-overlay"
    id="loanModal"
    aria-hidden="true"
>

    <div
        class="loan-modal"
        role="dialog"
        aria-modal="true"
        aria-labelledby="loanModalTitle"
    >

        <!-- HEADER -->

        <div class="modal-header">

            <div class="modal-heading">

                <div class="modal-icon">
                    <span class="material-symbols-outlined">
                        account_balance_wallet
                    </span>
                </div>


                <div>

                    <h2 id="loanModalTitle">
                        Loan Details
                    </h2>

                    <p>
                        View complete loan information,
                        balance, and payment schedule.
                    </p>

                </div>

            </div>


            <button
                type="button"
                class="modal-x"
                id="closeLoanModal"
                aria-label="Close loan details"
            >
                <span class="material-symbols-outlined">
                    close
                </span>
            </button>

        </div>


        <!-- BORROWER SUMMARY -->

        <div class="borrower-summary">

            <div class="borrower-profile">

                <div
                    class="modal-avatar"
                    id="modalAvatar"
                >
                    MS
                </div>


                <div>
                    <strong id="modalBorrower">
                        Maria Santos
                    </strong>

                    <span id="modalLoanId">
                        LN-2026-001
                    </span>
                </div>

            </div>


            <div class="summary-detail">

                <span>Loan Status</span>

                <strong>
                    <span
                        class="status active"
                        id="modalStatus"
                    >
                        Active
                    </span>
                </strong>

            </div>


            <div class="summary-detail">

                <span>Loan Type</span>

                <strong id="modalLoanType">
                    Personal Loan
                </strong>

            </div>


            <div class="summary-detail">

                <span>Date Granted</span>

                <strong id="modalGranted">
                    Jan 15, 2026
                </strong>

            </div>

        </div>


        <!-- TOP DETAIL GRID -->

        <div class="modal-top-grid">

            <!-- LOAN INFO -->

            <section class="modal-section">

                <div class="section-header blue-header">

                    <span class="material-symbols-outlined">
                        description
                    </span>

                    <strong>
                        Loan Information
                    </strong>

                </div>


                <div class="info-list">

                    <div>
                        <span>Loan Amount</span>
                        <strong id="modalAmount">
                            ₱3,000
                        </strong>
                    </div>


                    <div>
                        <span>Repayment Term</span>
                        <strong id="modalTerm">
                            3 Months
                        </strong>
                    </div>


                    <div>
                        <span>Interest Rate</span>
                        <strong id="modalInterest">
                            5%
                        </strong>
                    </div>


                    <div>
                        <span>Monthly Amortization</span>
                        <strong id="modalMonthly">
                            ₱550
                        </strong>
                    </div>


                    <div>
                        <span>Start Date</span>
                        <strong id="modalStart">
                            Jan 15, 2026
                        </strong>
                    </div>


                    <div>
                        <span>Original Due Date</span>
                        <strong id="modalOriginalDue">
                            Apr 15, 2026
                        </strong>
                    </div>


                    <div>
                        <span>Next Due Date</span>
                        <strong id="modalNextDue">
                            Mar 15, 2026
                        </strong>
                    </div>

                </div>

            </section>


            <!-- BALANCE -->

            <section class="modal-section">

                <div class="section-header gold-header">

                    <span class="material-symbols-outlined">
                        bar_chart
                    </span>

                    <strong>
                        Balance Overview
                    </strong>

                </div>


                <div class="balance-content">

                    <div class="progress-circle">

                        <div class="progress-inner">

                            <strong id="modalPercent">
                                18%
                            </strong>

                            <span>Paid</span>

                        </div>

                    </div>


                    <div class="balance-list">

                        <div>
                            <span>Total Amount</span>

                            <strong id="modalTotal">
                                ₱3,000
                            </strong>
                        </div>


                        <div>
                            <span>Amount Paid</span>

                            <strong
                                class="paid-text"
                                id="modalPaid"
                            >
                                ₱550
                            </strong>
                        </div>


                        <div>
                            <span>Outstanding Balance</span>

                            <strong
                                class="outstanding-text"
                                id="modalBalance"
                            >
                                ₱2,450
                            </strong>
                        </div>

                    </div>

                </div>


                <div class="next-payment-card">

                    <div class="next-icon">

                        <span class="material-symbols-outlined">
                            calendar_month
                        </span>

                    </div>


                    <div class="next-date">

                        <span>Next Payment</span>

                        <strong id="modalNextPayment">
                            Mar 15, 2026
                        </strong>

                    </div>


                    <div class="next-amount">

                        <span>Amount</span>

                        <strong id="modalNextAmount">
                            ₱550
                        </strong>

                        <small>Upcoming</small>

                    </div>

                </div>

            </section>

        </div>


        <!-- ==================================================
             PAYMENT SCHEDULE
        =================================================== -->

        <section class="schedule-section">

            <div class="schedule-header">

                <div>

                    <span class="material-symbols-outlined">
                        calendar_month
                    </span>

                    <strong>
                        Payment Schedule
                    </strong>

                </div>

            </div>


            <div class="schedule-table-wrapper">

                <table class="schedule-table">

                    <thead>

                        <tr>
                            <th>#</th>
                            <th>Due Date</th>
                            <th>Amount</th>
                            <th>Principal</th>
                            <th>Interest</th>
                            <th>Status</th>
                        </tr>

                    </thead>


                    <tbody id="paymentScheduleBody">

                        <tr>
                            <td>1</td>
                            <td>Feb 15, 2026</td>
                            <td>₱550</td>
                            <td>₱523</td>
                            <td>₱27</td>
                            <td>
                                <span class="payment-status paid">
                                    Paid
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <td>2</td>
                            <td>Mar 15, 2026</td>
                            <td>₱550</td>
                            <td>₱523</td>
                            <td>₱27</td>
                            <td>
                                <span class="payment-status upcoming">
                                    Upcoming
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <td>3</td>
                            <td>Apr 15, 2026</td>
                            <td>₱550</td>
                            <td>₱523</td>
                            <td>₱27</td>
                            <td>
                                <span class="payment-status pending">
                                    Pending
                                </span>
                            </td>
                        </tr>

                    </tbody>

                </table>

            </div>

        </section>


        <!-- ==================================================
             AGREEMENT
        =================================================== -->

        <section class="agreement-section">

            <div class="agreement-left">

                <div class="agreement-icon">

                    <span class="material-symbols-outlined">
                        description
                    </span>

                </div>


                <div>
                    <strong>
                        Loan Agreement
                    </strong>

                    <span>
                        View the signed loan agreement.
                    </span>
                </div>

            </div>


            <div class="agreement-file">

                <div class="pdf-icon">
                    PDF
                </div>


                <div class="file-info">

                    <strong id="modalAgreementName">
                        Loan Agreement.pdf
                    </strong>

                    <span id="modalAgreementDate">
                        Uploaded on Jan 15, 2026
                    </span>

                </div>


                <button
                    type="button"
                    class="view-agreement-btn"
                    id="viewAgreement"
                >
                    View
                </button>

            </div>

        </section>


        <!-- ==================================================
             FOOTER

             ONLY CLOSE.
             Payments and extensions have separate modules.
        =================================================== -->

        <div class="modal-footer">

            <button
                type="button"
                class="close-btn"
                id="modalCloseButton"
            >
                Close
            </button>

        </div>

    </div>

</div>


<!-- DataTables -->
<script src="../js/datatables.min.js"></script>

<!-- Page JS -->
<script src="../js/debts-loans.js"></script>

</body>
</html>
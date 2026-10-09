<?php require_once __DIR__.'/../ajax/borrower.php'; $borrowerAccount = borrower_user(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Client Dashboard | Utang Wise</title>

    <link rel="stylesheet" href="css/client-dashboard.css">
    <link rel="stylesheet" href="css/datatables.min.css">

    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600&family=Playfair+Display:wght@600;700&display=swap"
        rel="stylesheet"
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"
        rel="stylesheet"
    >
<link rel="stylesheet" href="../assets/css/borrower-flow.css"></head>

<body>

<div class="dashboard-layout">

    <!-- =============================
         LEFT SIDEBAR
    ============================== -->
<aside class="sidebar" id="sidebar">

    <div class="brand">

        <div class="brand-icon">
            <img src="./logo/utangwiselogo.png" alt="Utang Wise Logo">
        </div>

        <div class="brand-text">
            <h2>UTANG WISE</h2>
            <span>LENDING MADE SIMPLE</span>
        </div>

    </div>

    <nav class="sidebar-menu">

        <a href="client-dashboard.php" class="menu-item active">
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

        <?php borrower_logout_button(); ?>

    </div>

</aside>


    <!-- MOBILE SIDEBAR OVERLAY -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>


    <!-- =============================
         MAIN
    ============================== -->
    <main class="main-area">

        <!-- TOPBAR -->
        <header class="topbar">

            <div class="topbar-left">

                <button
                    class="mobile-menu-btn"
                    id="mobileMenuBtn"
                    type="button"
                    aria-label="Open menu"
                >
                    <span class="material-symbols-outlined">menu</span>
                </button>

                <span>Good day,</span>

            </div>

            <div class="top-user">

                <span class="material-symbols-outlined notification-icon">
                    notifications
                </span>

                <div class="top-avatar">
                    <span class="material-symbols-outlined">
                        person
                    </span>
                </div>

                <div class="top-user-text">
                    <strong>Juan Dela Cruz</strong>
                    <span>Client</span>
                </div>

                <span class="material-symbols-outlined">
                    keyboard_arrow_down
                </span>

            </div>

        </header>


        <div class="dashboard-body">

            <!-- =============================
                 CENTER CONTENT
            ============================== -->
            <section class="dashboard-content">

                <div class="welcome-section">

                  
                    <h1>
                        Juan Dela Cruz!
                    </h1>

                    <p>
                        Here's an overview of your loan and payments.
                    </p>

                </div>



                <!-- =============================
                     LOAN + UPCOMING
                ============================== -->
                <div class="top-cards">

                    <!-- CURRENT LOAN -->
                    <section class="current-loan-card">

                        <div class="card-heading">

                            <div class="heading-icon">
                                <span class="material-symbols-outlined">
                                    savings
                                </span>
                            </div>

                            <h2>
                                Current Loan
                            </h2>

                            <span class="status ongoing">
                                On-going
                            </span>

                        </div>


                        <div class="loan-main">

                            <div class="loan-amount-area">

                                <div class="money-row">

                                    <span class="material-symbols-outlined">
                                        payments
                                    </span>

                                    <div>

                                        <h3>
                                            ₱5,000
                                        </h3>

                                        <p>
                                            Loan Amount
                                        </p>

                                    </div>

                                </div>


                                <div class="loan-details">

                                    <div>

                                        <strong>
                                            2.5%
                                        </strong>

                                        <span>
                                            Interest Rate
                                            <br>
                                            (per month)
                                        </span>

                                    </div>


                                    <div>

                                        <strong>
                                            6 Months
                                        </strong>

                                        <span>
                                            Repayment Term
                                        </span>

                                    </div>


                                    <div>

                                        <strong>
                                            ₱958.33
                                        </strong>

                                        <span>
                                            Monthly Due
                                        </span>

                                    </div>

                                </div>

                            </div>


                            <div class="due-area">

                                <div class="due-circle">

                                    <span>
                                        Next Due
                                    </span>

                                    <strong>
                                        Sept 12, 2025
                                    </strong>

                                    <small>
                                        3 days left
                                    </small>

                                </div>

                                <a href="payments.php" class="pay-now-button">
                                    Pay Now
                                </a>

                            </div>

                        </div>

                    </section>



                    <!-- UPCOMING PAYMENT -->
                    <section class="upcoming-card">

                        <div class="card-heading">

                            <div class="heading-icon">

                                <span class="material-symbols-outlined">
                                    calendar_month
                                </span>

                            </div>

                            <h2>
                                Upcoming Payment
                            </h2>

                        </div>


                        <h3 class="upcoming-amount">
                            ₱958.33
                        </h3>

                        <p class="due-date">
                            Due on September 12, 2025
                        </p>


                        <div class="payment-alert">

                            <span class="material-symbols-outlined">
                                notifications_active
                            </span>

                            <div>

                                <strong>
                                    3 days before due date
                                </strong>

                                <p>
                                    Don't forget to make your
                                    payment to avoid additional charges.
                                </p>

                            </div>

                        </div>

                    </section>

                </div>




                <!-- =============================
                     TABLES
                ============================== -->
                <div class="table-grid">


                    <!-- PENDING DUES -->
                    <section class="table-card">

                        <div class="table-title">
                            

                            <div class="table-title-left">

                                <span class="material-symbols-outlined">
                                    list
                                </span>

                                <h2>
                                    Pending Dues
                                </h2>

                            </div>

                            <a href="#">
                                View All
                            </a>

                        </div>


                        <div class="table-wrapper">
                            <table id="pendingDuesTable">


                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Due Date</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                                </thead>

                                <tbody>

                                <tr>
                                    <td>1</td>
                                    <td>Sept 12, 2025</td>
                                    <td>₱958.33</td>

                                    <td>
                                        <span class="table-status due-soon">
                                            Due Soon
                                        </span>
                                    </td>
                                </tr>


                                <tr>
                                    <td>2</td>
                                    <td>Oct 12, 2025</td>
                                    <td>₱958.33</td>

                                    <td>
                                        <span class="table-status upcoming">
                                            Upcoming
                                        </span>
                                    </td>
                                </tr>


                                <tr>
                                    <td>3</td>
                                    <td>Nov 12, 2025</td>
                                    <td>₱958.33</td>

                                    <td>
                                        <span class="table-status upcoming">
                                            Upcoming
                                        </span>
                                    </td>
                                </tr>


                                <tr>
                                    <td>4</td>
                                    <td>Dec 12, 2025</td>
                                    <td>₱958.33</td>

                                    <td>
                                        <span class="table-status upcoming">
                                            Upcoming
                                        </span>
                                    </td>
                                </tr>

                                </tbody>

                            </table>

                        </div>

                    </section>



                    <!-- PAYMENT HISTORY -->
                    <section class="table-card">

                        <div class="table-title">

                            <div class="table-title-left">

                                <span class="material-symbols-outlined">
                                    history
                                </span>

                                <h2>
                                    Payment History
                                </h2>

                            </div>

                            <a href="#">
                                View All
                            </a>

                        </div>


                        <div class="table-wrapper">

                            <table id="paymentHistoryTable">

                                <thead>

                                <tr>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Method</th>
                                    <th>Status</th>
                                </tr>

                                </thead>


                                <tbody>

                                <tr>
                                    <td>Aug 12, 2025</td>
                                    <td>₱958.33</td>
                                    <td>GCash</td>

                                    <td>
                                        <span class="table-status paid">
                                            Paid
                                        </span>
                                    </td>
                                </tr>


                                <tr>
                                    <td>Jul 12, 2025</td>
                                    <td>₱958.33</td>
                                    <td>Cash</td>

                                    <td>
                                        <span class="table-status paid">
                                            Paid
                                        </span>
                                    </td>
                                </tr>


                                <tr>
                                    <td>Jun 12, 2025</td>
                                    <td>₱958.33</td>
                                    <td>GCash</td>

                                    <td>
                                        <span class="table-status paid">
                                            Paid
                                        </span>
                                    </td>
                                </tr>

                                </tbody>

                            </table>

                        </div>

                    </section>

                </div>



                <!-- =============================
                     PAYMENT METHODS
                ============================== -->
                <section class="payment-methods-card">

                    <div class="payment-title">

                        <div class="payment-title-icon">

                            <span class="material-symbols-outlined">
                                account_balance_wallet
                            </span>

                        </div>

                        <h2>
                            Payment Methods
                        </h2>

                    </div>


                    <div class="payment-options">


                        <!-- GCASH -->
                        <div class="payment-option gcash-option">

                            <div class="payment-brand">

                                <div class="gcash-circle">
                                    G
                                </div>

                                <div>

                                    <h3>
                                        GCash
                                    </h3>

                                    <p>
                                        Scan the QR code or send to:
                                    </p>

                                    <strong>
                                        0917 123 4567
                                    </strong>

                                    <span>
                                        Juan Dela Cruz
                                    </span>

                                </div>

                            </div>


                            <div class="qr-box">

                                <span class="material-symbols-outlined">
                                    qr_code_2
                                </span>

                            </div>

                        </div>



                        <!-- CASH -->
                        <div class="payment-option cash-option">

                            <div class="cash-icon">

                                <span class="material-symbols-outlined">
                                    payments
                                </span>

                            </div>


                            <div>

                                <h3>
                                    Cash
                                </h3>

                                <p>
                                    You can also pay in cash directly
                                    to your assigned loan officer.
                                </p>

                            </div>

                        </div>

                    </div>

                </section>

            </section>



            <!-- =============================
                 RIGHT PANEL
            ============================== -->
            <aside class="right-panel">


                <!-- PROFILE CARD -->
                <section class="profile-card">

                    <div class="profile-top">

                        <div class="profile-avatar">

                            <span class="material-symbols-outlined">
                                person
                            </span>

                            <small>

                                <span class="material-symbols-outlined">
                                    edit
                                </span>

                            </small>

                        </div>


                        <div class="profile-heading">

                            <h3>
                                Juan Dela Cruz
                            </h3>

                            <p>
                                Client
                            </p>


                            <a
                                href="#"
                                class="edit-profile-button"
                            >
                                Edit Profile
                            </a>

                        </div>

                    </div>


                    <div class="profile-information">

                        <p>

                            <span class="material-symbols-outlined">
                                mail
                            </span>

                            juan@email.com

                        </p>


                        <p>

                            <span class="material-symbols-outlined">
                                call
                            </span>

                            +63 912 345 6789

                        </p>


                        <p>

                            <span class="material-symbols-outlined">
                                location_on
                            </span>

                            123 Mabini St., Manila

                        </p>

                    </div>



                
                </section>



                <!-- =============================
                     NOTIFICATIONS
                ============================== -->
                <section class="notification-card">

                    <div class="notification-heading">

                        <div>

                            <span class="material-symbols-outlined">
                                notifications
                            </span>

                            <h3>
                                Notifications
                            </h3>

                        </div>


                        <a href="#">
                            View All
                        </a>

                    </div>



                    <div class="notification-list">


                        <div class="notification-item">

                            <span class="notification-dot"></span>

                            <div class="notification-message">

                                <strong>
                                    Payment Reminder
                                </strong>

                                <p>
                                    3 days before due date.
                                </p>

                            </div>

                            <div class="notification-date">
                                Sep 9, 2025
                                <span>9:00 AM</span>
                            </div>

                        </div>



                        <div class="notification-item">

                            <span class="notification-dot"></span>

                            <div class="notification-message">

                                <strong>
                                    Payment Due
                                </strong>

                                <p>
                                    Your payment is due today.
                                </p>

                            </div>

                            <div class="notification-date">
                                Sep 12, 2025
                                <span>8:00 AM</span>
                            </div>

                        </div>



                        <div class="notification-item">

                            <span class="notification-dot"></span>

                            <div class="notification-message">

                                <strong>
                                    Overdue Notice
                                </strong>

                                <p>
                                    1-3 days overdue. Please
                                    settle your payment.
                                </p>

                            </div>

                            <div class="notification-date">
                                Sep 13, 2025
                                <span>8:00 AM</span>
                            </div>

                        </div>



                        <div class="notification-item">

                            <span class="notification-dot"></span>

                            <div class="notification-message">

                                <strong>
                                    Call Notice
                                </strong>

                                <p>
                                    5 days no compliance.
                                    We may contact you.
                                </p>

                            </div>

                            <div class="notification-date">
                                Sep 17, 2025
                                <span>8:00 AM</span>
                            </div>

                        </div>



                        <div class="notification-item">

                            <span class="notification-dot"></span>

                            <div class="notification-message">

                                <strong>
                                    Escalation Notice
                                </strong>

                                <p>
                                    Account overdue for 2-3 months.
                                    Further settlement may be required.
                                </p>

                            </div>

                            <div class="notification-date">
                                Nov 12, 2025
                                <span>8:00 AM</span>
                            </div>

                        </div>

                    </div>

                </section>



        

            </aside>

        </div>

    </main>

</div>

<script src="js/datatables.min.js"></script>
<script src="js/client-dashboard.js"></script>

</body>
</html>
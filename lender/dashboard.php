<?php require_once __DIR__.'/../helpers/lending.php'; $lenderAccount=lender_user(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Dashboard | Utang Wise</title>

    <link rel="stylesheet" href="../assets/css/dashboard.css">

    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap"
        rel="stylesheet"
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"
        rel="stylesheet"
    >
</head>

<body>

<div class="admin-layout">

    <!-- SIDEBAR -->
    <aside class="sidebar">

        <div class="brand">

            <div class="brand-icon"></div>

            <div class="brand-text">
                <h2>UTANG WISE</h2>
                <span>LENDING MADE SIMPLE</span>
            </div>

        </div>


        <nav class="sidebar-menu"><a href="applications.php" class="menu-item"><span class="material-symbols-outlined">description</span>Applications</a>

            <a href="dashboard.php" class="menu-item active">
                <span class="material-symbols-outlined">home</span>
                Dashboard
            </a>

            <a href="loaners.php" class="menu-item">
                <span class="material-symbols-outlined">groups</span>
                Loaners
            </a>

            <a href="request-list.php" class="menu-item">

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

                

            </a>

            <a href="loans.php" class="menu-item">
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

            <form method="post" action="../ajax/logout.php"><?php csrf(); ?><button type="submit" class="menu-item">Log out</button></form>

        </nav>


        <div class="security-box">

            <div class="security-icon">
                <span class="material-symbols-outlined">
                    verified_user
                </span>
            </div>

            <div>
                <strong>
                    Secure & Trusted
                </strong>

                <p>
                    Client information is protected
                    and handled securely.
                </p>
            </div>

        </div>

    </aside>


    <!-- MAIN -->
    <main class="main-content">

        <!-- TOPBAR -->
        <header class="topbar">

            <div class="top-search">

                <span class="material-symbols-outlined">
                    search
                </span>

                <input
                    type="text"
                    placeholder="Search client name, phone number, or ID..."
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
                    <span class="material-symbols-outlined">
                        person
                    </span>
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


        <!-- PAGE CONTENT -->
        <div class="page-content">


            <!-- HERO -->
            <section class="dashboard-hero">

                <div class="hero-left">

                    <span>
                        Welcome back,
                    </span>

                    <h1>
                        Admin!
                    </h1>

                    <p>
                        Here's an overview of your lending operations.
                    </p>

                </div>


                <div class="quote-card">

                    <div class="quote-icon">
                        “
                    </div>

                    <div>

                        <p>
                            “Good lending builds opportunities.
                            Responsible lending builds better tomorrows.”
                        </p>

                        <span>
                            — UTANG WISE
                        </span>

                    </div>

                </div>


                <div class="dashboard-date">

                    <strong>
                        July 10, 2025
                    </strong>

                    <span>
                        Thursday, 10:42 AM
                    </span>

                </div>

            </section>


            <!-- KPI CARDS -->
            <section class="stats-grid">


                <div class="stat-card">

                    <div class="stat-icon blue">

                        <span class="material-symbols-outlined">
                            savings
                        </span>

                    </div>

                    <div>

                        <span>
                            Total Amount Lent
                            <br>
                            (Overall)
                        </span>

                        <strong>
                            ₱1,250,000
                        </strong>

                        <small class="positive">
                            ↑ +12%
                        </small>

                        <small>
                            vs. last month
                        </small>

                    </div>

                </div>


                <div class="stat-card">

                    <div class="stat-icon green">

                        <span class="material-symbols-outlined">
                            paid
                        </span>

                    </div>

                    <div>

                        <span>
                            Total Paid
                            <br>
                            (Overall)
                        </span>

                        <strong>
                            ₱780,000
                        </strong>

                        <small class="positive">
                            ↑ +8%
                        </small>

                        <small>
                            vs. last month
                        </small>

                    </div>

                </div>


                <div class="stat-card">

                    <div class="stat-icon orange">

                        <span class="material-symbols-outlined">
                            account_balance_wallet
                        </span>

                    </div>

                    <div>

                        <span>
                            Total Ovedue
                        </span>

                        <strong>
                            ₱470,000
                        </strong>

                

                    </div>

                </div>

                   <div class="stat-card">

                    <div class="stat-icon purple">

                        <span class="material-symbols-outlined">
                            groups
                        </span>

                    </div>

                    <div>

                        <span>
                            Interest Collection
                        </span>

                        <strong>
                            124
                        </strong>

                        <small class="positive">
                            ↑ +6%
                        </small>

                        <small>
                            vs. last month
                        </small>

                    </div>

                </div>


                <div class="stat-card">

                    <div class="stat-icon purple">

                        <span class="material-symbols-outlined">
                            groups
                        </span>

                    </div>

                    <div>

                        <span>
                            Total of Loaners
                        </span>

                        <strong>
                            124
                        </strong>

                        <small class="positive">
                            ↑ +6%
                        </small>

                        <small>
                            vs. last month
                        </small>

                    </div>

                </div>

            </section>


            <!-- MAIN GRID -->
            <section class="dashboard-grid">


                <!-- LEFT -->
                <div class="dashboard-left">


                    <!-- BORROWERS SUMMARY -->
                    <div class="dashboard-card">

                        <div class="card-header">

                            <div class="card-title">

                                <span class="material-symbols-outlined">
                                    groups
                                </span>

                                <h2>
                                    Summary of Borrowers
                                </h2>

                            </div>

                            <a href="loaners.php">
                                View All
                            </a>

                        </div>


                        <div class="table-wrapper">

                            <table>

                                <thead>

                                    <tr>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Due Date</th>
                                        <th>Status</th>
                                        <th>Purpose</th>
                                    </tr>

                                </thead>


                                <tbody>

                                    <tr>

                                        <td>

                                            <div class="borrower">

                                                <span class="borrower-avatar">
                                                    JD
                                                </span>

                                                Juan Dela Cruz

                                            </div>

                                        </td>

                                        <td>
                                            Money
                                        </td>

                                        <td>
                                            Jul 15, 2025
                                        </td>

                                        <td>
                                            <span class="status ongoing">
                                                On Going
                                            </span>
                                        </td>

                                        <td>
                                            Business Capital
                                        </td>

                                    </tr>


                                    <tr>

                                        <td>

                                            <div class="borrower">

                                                <span class="borrower-avatar orange-avatar">
                                                    MS
                                                </span>

                                                Maria Santos

                                            </div>

                                        </td>

                                        <td>
                                            Item
                                        </td>

                                        <td>
                                            Jul 18, 2025
                                        </td>

                                        <td>
                                            <span class="status due-soon">
                                                Due Soon
                                            </span>
                                        </td>

                                        <td>
                                            Laptop
                                        </td>

                                    </tr>


                                    <tr>

                                        <td>

                                            <div class="borrower">

                                                <span class="borrower-avatar gray-avatar">
                                                    PR
                                                </span>

                                                Pedro Reyes

                                            </div>

                                        </td>

                                        <td>
                                            Money
                                        </td>

                                        <td>
                                            Jul 10, 2025
                                        </td>

                                        <td>
                                            <span class="status overdue">
                                                Overdue
                                            </span>
                                        </td>

                                        <td>
                                            Tuition Fee
                                        </td>

                                    </tr>


                                    <tr>

                                        <td>

                                            <div class="borrower">

                                                <span class="borrower-avatar green-avatar">
                                                    AC
                                                </span>

                                                Ana Cruz

                                            </div>

                                        </td>

                                        <td>
                                            Money
                                        </td>

                                        <td>
                                            Jul 25, 2025
                                        </td>

                                        <td>
                                            <span class="status ongoing">
                                                On Going
                                            </span>
                                        </td>

                                        <td>
                                            Medical Expense
                                        </td>

                                    </tr>


                                    <tr>

                                        <td>

                                            <div class="borrower">

                                                <span class="borrower-avatar blue-avatar">
                                                    MR
                                                </span>

                                                Mark Rivera

                                            </div>

                                        </td>

                                        <td>
                                            Item
                                        </td>

                                        <td>
                                            Jul 12, 2025
                                        </td>

                                        <td>
                                            <span class="status due-soon">
                                                Due Soon
                                            </span>
                                        </td>

                                        <td>
                                            Motorcycle Parts
                                        </td>

                                    </tr>


                                    <tr>

                                        <td>

                                            <div class="borrower">

                                                <span class="borrower-avatar purple-avatar">
                                                    LM
                                                </span>

                                                Liza Mendoza

                                            </div>

                                        </td>

                                        <td>
                                            Money
                                        </td>

                                        <td>
                                            Jul 30, 2025
                                        </td>

                                        <td>
                                            <span class="status ongoing">
                                                On Going
                                            </span>
                                        </td>

                                        <td>
                                            House Renovation
                                        </td>

                                    </tr>

                                </tbody>

                            </table>

                        </div>

                    </div>


                    <!-- MONTHLY CHART -->
                    <div class="dashboard-card chart-card">

                        <div class="card-header">

                            <div class="card-title">

                                <span class="material-symbols-outlined">
                                    finance
                                </span>

                                <h2>
                                    Monthly Lending vs. Payments
                                </h2>

                            </div>


                            <div class="chart-legend">

                                <span>
                                    <i class="legend-dot lent-dot"></i>
                                    Amount Lent
                                </span>

                                <span>
                                    <i class="legend-dot paid-dot"></i>
                                    Amount Paid
                                </span>

                            </div>

                        </div>


                        <div class="chart-area">

                            <!-- Y AXIS -->
                            <div class="y-axis">
                                <span>₱300,000</span>
                                <span>₱200,000</span>
                                <span>₱100,000</span>
                                <span>₱0</span>
                            </div>


                            <!-- CHART -->
                            <div class="bar-chart">

                                <div class="month-group">

                                    <div class="bars">

                                        <div
                                            class="bar lent"
                                            style="height: 120px;"
                                        ></div>

                                        <div
                                            class="bar paid-bar"
                                            style="height: 95px;"
                                        ></div>

                                    </div>

                                    <span>Jan</span>

                                </div>


                                <div class="month-group">

                                    <div class="bars">

                                        <div
                                            class="bar lent"
                                            style="height: 135px;"
                                        ></div>

                                        <div
                                            class="bar paid-bar"
                                            style="height: 105px;"
                                        ></div>

                                    </div>

                                    <span>Feb</span>

                                </div>


                                <div class="month-group">

                                    <div class="bars">

                                        <div
                                            class="bar lent"
                                            style="height: 175px;"
                                        ></div>

                                        <div
                                            class="bar paid-bar"
                                            style="height: 145px;"
                                        ></div>

                                    </div>

                                    <span>Mar</span>

                                </div>


                                <div class="month-group">

                                    <div class="bars">

                                        <div
                                            class="bar lent"
                                            style="height: 200px;"
                                        ></div>

                                        <div
                                            class="bar paid-bar"
                                            style="height: 145px;"
                                        ></div>

                                    </div>

                                    <span>Apr</span>

                                </div>


                                <div class="month-group">

                                    <div class="bars">

                                        <div
                                            class="bar lent"
                                            style="height: 130px;"
                                        ></div>

                                        <div
                                            class="bar paid-bar"
                                            style="height: 115px;"
                                        ></div>

                                    </div>

                                    <span>May</span>

                                </div>


                                <div class="month-group">

                                    <div class="bars">

                                        <div
                                            class="bar lent"
                                            style="height: 130px;"
                                        ></div>

                                        <div
                                            class="bar paid-bar"
                                            style="height: 125px;"
                                        ></div>

                                    </div>

                                    <span>Jun</span>

                                </div>


                                <div class="month-group">

                                    <div class="bars">

                                        <div
                                            class="bar lent"
                                            style="height: 145px;"
                                        ></div>

                                        <div
                                            class="bar paid-bar"
                                            style="height: 110px;"
                                        ></div>

                                    </div>

                                    <span>Jul</span>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- RIGHT -->
                <div class="dashboard-right">


                    <!-- REMINDERS -->
                    <div class="dashboard-card">

                        <div class="card-header">

                            <div class="card-title">

                                <span class="material-symbols-outlined">
                                    notifications
                                </span>

                                <h2>
                                    Reminders
                                </h2>

                            </div>

                            <a href="#">
                                View All
                            </a>

                        </div>


                        <div class="reminder-list">


                            <div class="reminder danger">

                                <div class="reminder-icon">

                                    <span class="material-symbols-outlined">
                                        priority_high
                                    </span>

                                </div>

                                <div>

                                    <strong>
                                        3 clients are overdue on their payments.
                                    </strong>

                                    <span>
                                        Action needed.
                                    </span>

                                </div>

                                <span class="material-symbols-outlined arrow">
                                    chevron_right
                                </span>

                            </div>


                            <div class="reminder warning">

                                <div class="reminder-icon">

                                    <span class="material-symbols-outlined">
                                        event
                                    </span>

                                </div>

                                <div>

                                    <strong>
                                        5 clients have payments due within 7 days.
                                    </strong>

                                    <span>
                                        Kindly follow up.
                                    </span>

                                </div>

                                <span class="material-symbols-outlined arrow">
                                    chevron_right
                                </span>

                            </div>


                            <div class="reminder info">

                                <div class="reminder-icon">

                                    <span class="material-symbols-outlined">
                                        assignment
                                    </span>

                                </div>

                                <div>

                                    <strong>
                                        2 loan applications are pending review.
                                    </strong>

                                    <span>
                                        Check and update the status.
                                    </span>

                                </div>

                                <span class="material-symbols-outlined arrow">
                                    chevron_right
                                </span>

                            </div>


                            <div class="reminder success">

                                <div class="reminder-icon">

                                    <span class="material-symbols-outlined">
                                        edit_calendar
                                    </span>

                                </div>

                                <div>

                                    <strong>
                                        1 extension request is awaiting approval.
                                    </strong>

                                    <span>
                                        Review the request.
                                    </span>

                                </div>

                                <span class="material-symbols-outlined arrow">
                                    chevron_right
                                </span>

                            </div>

                        </div>

                    </div>


                    <!-- UPCOMING PAYMENTS -->
                    <div class="dashboard-card">

                        <div class="card-header">

                            <div class="card-title">

                                <span class="material-symbols-outlined">
                                    calendar_month
                                </span>

                                <h2>
                                    Upcoming Payments
                                </h2>

                            </div>

                            <a href="#">
                                View All
                            </a>

                        </div>


                        <div class="payment-list">


                            <div class="payment-item">

                                <div class="payment-date danger-date">

                                    <span>JUL</span>
                                    <strong>10</strong>

                                </div>


                                <div class="payment-info">

                                    <strong>
                                        Pedro Reyes
                                    </strong>

                                    <span>
                                        Money Loan - Tuition Fee
                                    </span>

                                </div>


                                <div class="payment-amount">

                                    <strong>
                                        ₱12,000
                                    </strong>

                                    <span class="overdue-text">
                                        Overdue
                                    </span>

                                </div>

                            </div>


                            <div class="payment-item">

                                <div class="payment-date warning-date">

                                    <span>JUL</span>
                                    <strong>12</strong>

                                </div>


                                <div class="payment-info">

                                    <strong>
                                        Mark Rivera
                                    </strong>

                                    <span>
                                        Item Loan - Motorcycle Parts
                                    </span>

                                </div>


                                <div class="payment-amount">

                                    <strong>
                                        ₱10,000
                                    </strong>

                                    <span class="due-text">
                                        Due Soon
                                    </span>

                                </div>

                            </div>


                            <div class="payment-item">

                                <div class="payment-date">

                                    <span>JUL</span>
                                    <strong>15</strong>

                                </div>


                                <div class="payment-info">

                                    <strong>
                                        Juan Dela Cruz
                                    </strong>

                                    <span>
                                        Money Loan - Business Capital
                                    </span>

                                </div>


                                <div class="payment-amount">

                                    <strong>
                                        ₱8,500
                                    </strong>

                                    <span class="upcoming-text">
                                        Upcoming
                                    </span>

                                </div>

                            </div>


                            <div class="payment-item">

                                <div class="payment-date">

                                    <span>JUL</span>
                                    <strong>18</strong>

                                </div>


                                <div class="payment-info">

                                    <strong>
                                        Maria Santos
                                    </strong>

                                    <span>
                                        Item Loan - Laptop
                                    </span>

                                </div>


                                <div class="payment-amount">

                                    <strong>
                                        ₱6,000
                                    </strong>

                                    <span class="upcoming-text">
                                        Upcoming
                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </section>

        </div>

    </main>

</div>

</body>
</html>
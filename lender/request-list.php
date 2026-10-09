<?php require_once __DIR__.'/../helpers/lending.php'; $lenderAccount=lender_user(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Loan Applications | Utang Wise</title>

    <link rel="stylesheet" href="../css/request-list.css">

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

            <div class="brand-icon">
                ₱
            </div>

            <div class="brand-text">
                <h2>UTANG WISE</h2>
                <span>LENDING MADE SIMPLE</span>
            </div>

        </div>


        <nav class="sidebar-menu">

            <a href="dashboard.php" class="menu-item">
                <span class="material-symbols-outlined">home</span>
                Dashboard
            </a>

            <a href="loaners.php" class="menu-item">
                <span class="material-symbols-outlined">groups</span>
                Loaners
            </a>

            <a href="request-list.php" class="menu-item active">

                <span class="material-symbols-outlined">
                    description
                </span>

                Applications

                <span class="menu-badge">
                    3
                </span>

            </a>

            <a href="#" class="menu-item">

                <span class="material-symbols-outlined">
                    schedule
                </span>

                Extension Requests

                <span class="menu-badge">
                    1
                </span>

            </a>

            <a href="#" class="menu-item">
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


    <!-- MAIN CONTENT -->
    <main class="main-content">

        <!-- TOPBAR -->
        <header class="topbar">

            <div class="search-box">

                <span class="material-symbols-outlined">
                    search
                </span>

                <input
                    type="text"
                    placeholder="Search applicant name, application ID, or phone number..."
                >

            </div>


            <div class="admin-area">

                <div class="notification">

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


        <!-- PAGE -->
        <div class="page-content">


            <!-- HEADING -->
            <section class="page-heading">

                <div>

                    <h1>
                        Loan Applications
                    </h1>

                    <p>
                        Manage and review loan applications submitted by clients.
                    </p>

                </div>


                <button class="add-application-btn">

                    <span class="material-symbols-outlined">
                        add
                    </span>

                    Add New Application

                </button>

            </section>


            <!-- SUMMARY -->
            <section class="summary-grid">


                <div class="summary-card pending-summary">

                    <div class="summary-icon">

                        <span class="material-symbols-outlined">
                            description
                        </span>

                    </div>


                    <div>
                        <strong>5</strong>
                        <span>Pending Review</span>
                    </div>

                </div>


                <div class="summary-card approved-summary">

                    <div class="summary-icon">

                        <span class="material-symbols-outlined">
                            check_circle
                        </span>

                    </div>


                    <div>
                        <strong>12</strong>
                        <span>Approved</span>
                    </div>

                </div>


                <div class="summary-card denied-summary">

                    <div class="summary-icon">

                        <span class="material-symbols-outlined">
                            cancel
                        </span>

                    </div>


                    <div>
                        <strong>4</strong>
                        <span>Denied</span>
                    </div>

                </div>


                <div class="summary-card total-summary">

                    <div class="summary-icon">

                        <span class="material-symbols-outlined">
                            groups
                        </span>

                    </div>


                    <div>
                        <strong>21</strong>
                        <span>Total Applications</span>
                    </div>

                </div>

            </section>


            <!-- APPLICATIONS CARD -->
            <section class="applications-card">


                <!-- TABS + FILTERS -->
                <div class="applications-toolbar">

                    <div class="status-tabs">

                        <button class="status-tab active">
                            All (21)
                        </button>

                        <button class="status-tab">
                            Pending (5)
                        </button>

                        <button class="status-tab">
                            Approved (12)
                        </button>

                        <button class="status-tab">
                            Denied (4)
                        </button>

                    </div>


                    <div class="filters">


                        <div class="small-search">

                            <span class="material-symbols-outlined">
                                search
                            </span>

                            <input
                                type="text"
                                placeholder="Search applications..."
                            >

                        </div>


                        <button class="filter-btn">

                            <span class="material-symbols-outlined">
                                filter_alt
                            </span>

                            Filter

                        </button>


                        <select class="time-filter">

                            <option>All Time</option>
                            <option>This Week</option>
                            <option>This Month</option>
                            <option>This Year</option>

                        </select>

                    </div>

                </div>


                <!-- TABLE -->
                <div class="table-wrapper">

                    <table>

                        <thead>

                            <tr>

                                <th>
                                    <input type="checkbox">
                                </th>

                                <th>
                                    Application ID
                                </th>

                                <th>
                                    Applicant
                                </th>

                                <th>
                                    Type of Loan
                                </th>

                                <th>
                                    Requested Amount
                                </th>

                                <th>
                                    Date Submitted
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


                            <!-- 1 -->
                            <tr>

                                <td>
                                    <input type="checkbox">
                                </td>


                                <td class="application-id">
                                    LA-2025-0001
                                </td>


                                <td>

                                    <div class="applicant">

                                        <div class="applicant-avatar blue">
                                            JD
                                        </div>

                                        <div>

                                            <strong>
                                                Juan Dela Cruz
                                            </strong>

                                            <span>
                                                +63 912 345 6789
                                            </span>

                                        </div>

                                    </div>

                                </td>


                                <td>
                                    <span class="loan-type money">
                                        Money
                                    </span>
                                </td>


                                <td class="amount">
                                    ₱3,000
                                </td>


                                <td>

                                    <div class="date-cell">

                                        <strong>
                                            Jul 10, 2025
                                        </strong>

                                        <span>
                                            10:24 AM
                                        </span>

                                    </div>

                                </td>


                                <td>

                                    <span class="status pending">
                                        Pending Review
                                    </span>

                                </td>


                                <td>

                                    <div class="action-cell">

                                        <a
                                            href="applications.php"
                                            class="view-btn"
                                        >
                                            View
                                        </a>

                                        <button class="more-btn">

                                            <span class="material-symbols-outlined">
                                                more_vert
                                            </span>

                                        </button>

                                    </div>

                                </td>

                            </tr>


                            <!-- 2 -->
                            <tr>

                                <td>
                                    <input type="checkbox">
                                </td>


                                <td class="application-id">
                                    LA-2025-0002
                                </td>


                                <td>

                                    <div class="applicant">

                                        <div class="applicant-avatar orange">
                                            MS
                                        </div>

                                        <div>

                                            <strong>
                                                Maria Santos
                                            </strong>

                                            <span>
                                                +63 915 123 4567
                                            </span>

                                        </div>

                                    </div>

                                </td>


                                <td>
                                    <span class="loan-type item">
                                        Item
                                    </span>
                                </td>


                                <td class="amount">
                                    ₱2,500
                                </td>


                                <td>

                                    <div class="date-cell">

                                        <strong>
                                            Jul 9, 2025
                                        </strong>

                                        <span>
                                            02:15 PM
                                        </span>

                                    </div>

                                </td>


                                <td>
                                    <span class="status pending">
                                        Pending Review
                                    </span>
                                </td>


                                <td>

                                    <div class="action-cell">

                                        <a
                                            href="applications.php"
                                            class="view-btn"
                                        >
                                            View
                                        </a>

                                        <button class="more-btn">

                                            <span class="material-symbols-outlined">
                                                more_vert
                                            </span>

                                        </button>

                                    </div>

                                </td>

                            </tr>


                            <!-- 3 -->
                            <tr>

                                <td>
                                    <input type="checkbox">
                                </td>


                                <td class="application-id">
                                    LA-2025-0003
                                </td>


                                <td>

                                    <div class="applicant">

                                        <div class="applicant-avatar green">
                                            PR
                                        </div>

                                        <div>

                                            <strong>
                                                Pedro Reyes
                                            </strong>

                                            <span>
                                                +63 918 987 6543
                                            </span>

                                        </div>

                                    </div>

                                </td>


                                <td>
                                    <span class="loan-type money">
                                        Money
                                    </span>
                                </td>


                                <td class="amount">
                                    ₱3,000
                                </td>


                                <td>

                                    <div class="date-cell">

                                        <strong>
                                            Jul 9, 2025
                                        </strong>

                                        <span>
                                            11:30 AM
                                        </span>

                                    </div>

                                </td>


                                <td>
                                    <span class="status pending">
                                        Pending Review
                                    </span>
                                </td>


                                <td>

                                    <div class="action-cell">

                                        <a
                                            href="applications.php"
                                            class="view-btn"
                                        >
                                            View
                                        </a>

                                        <button class="more-btn">

                                            <span class="material-symbols-outlined">
                                                more_vert
                                            </span>

                                        </button>

                                    </div>

                                </td>

                            </tr>


                            <!-- 4 -->
                            <tr>

                                <td>
                                    <input type="checkbox">
                                </td>


                                <td class="application-id">
                                    LA-2025-0004
                                </td>


                                <td>

                                    <div class="applicant">

                                        <div class="applicant-avatar green">
                                            AC
                                        </div>

                                        <div>

                                            <strong>
                                                Ana Cruz
                                            </strong>

                                            <span>
                                                +63 917 456 7890
                                            </span>

                                        </div>

                                    </div>

                                </td>


                                <td>
                                    <span class="loan-type item">
                                        Item
                                    </span>
                                </td>


                                <td class="amount">
                                    ₱1,800
                                </td>


                                <td>

                                    <div class="date-cell">

                                        <strong>
                                            Jul 8, 2025
                                        </strong>

                                        <span>
                                            03:20 PM
                                        </span>

                                    </div>

                                </td>


                                <td>
                                    <span class="status pending">
                                        Pending Review
                                    </span>
                                </td>


                                <td>

                                    <div class="action-cell">

                                        <a
                                            href="applications.php"
                                            class="view-btn"
                                        >
                                            View
                                        </a>

                                        <button class="more-btn">

                                            <span class="material-symbols-outlined">
                                                more_vert
                                            </span>

                                        </button>

                                    </div>

                                </td>

                            </tr>


                            <!-- 5 -->
                            <tr>

                                <td>
                                    <input type="checkbox">
                                </td>


                                <td class="application-id">
                                    LA-2025-0005
                                </td>


                                <td>

                                    <div class="applicant">

                                        <div class="applicant-avatar purple">
                                            RL
                                        </div>

                                        <div>

                                            <strong>
                                                Ramon Lopez
                                            </strong>

                                            <span>
                                                +63 939 111 2222
                                            </span>

                                        </div>

                                    </div>

                                </td>


                                <td>
                                    <span class="loan-type money">
                                        Money
                                    </span>
                                </td>


                                <td class="amount">
                                    ₱3,000
                                </td>


                                <td>

                                    <div class="date-cell">

                                        <strong>
                                            Jul 8, 2025
                                        </strong>

                                        <span>
                                            09:45 AM
                                        </span>

                                    </div>

                                </td>


                                <td>
                                    <span class="status pending">
                                        Pending Review
                                    </span>
                                </td>


                                <td>

                                    <div class="action-cell">

                                        <a
                                            href="applications.php"
                                            class="view-btn"
                                        >
                                            View
                                        </a>

                                        <button class="more-btn">

                                            <span class="material-symbols-outlined">
                                                more_vert
                                            </span>

                                        </button>

                                    </div>

                                </td>

                            </tr>


                            <!-- 6 -->
                            <tr>

                                <td>
                                    <input type="checkbox">
                                </td>


                                <td class="application-id">
                                    LA-2025-0006
                                </td>


                                <td>

                                    <div class="applicant">

                                        <div class="applicant-avatar orange">
                                            KT
                                        </div>

                                        <div>

                                            <strong>
                                                Kim Tan
                                            </strong>

                                            <span>
                                                +63 905 222 3344
                                            </span>

                                        </div>

                                    </div>

                                </td>


                                <td>
                                    <span class="loan-type money">
                                        Money
                                    </span>
                                </td>


                                <td class="amount">
                                    ₱2,000
                                </td>


                                <td>

                                    <div class="date-cell">

                                        <strong>
                                            Jul 7, 2025
                                        </strong>

                                        <span>
                                            01:12 PM
                                        </span>

                                    </div>

                                </td>


                                <td>
                                    <span class="status approved">
                                        Approved
                                    </span>
                                </td>


                                <td>

                                    <div class="action-cell">

                                        <a
                                            href="applications.php"
                                            class="view-btn"
                                        >
                                            View
                                        </a>

                                        <button class="more-btn">

                                            <span class="material-symbols-outlined">
                                                more_vert
                                            </span>

                                        </button>

                                    </div>

                                </td>

                            </tr>


                            <!-- 7 -->
                            <tr>

                                <td>
                                    <input type="checkbox">
                                </td>


                                <td class="application-id">
                                    LA-2025-0007
                                </td>


                                <td>

                                    <div class="applicant">

                                        <div class="applicant-avatar blue">
                                            DL
                                        </div>

                                        <div>

                                            <strong>
                                                Daniel Lim
                                            </strong>

                                            <span>
                                                +63 927 333 4455
                                            </span>

                                        </div>

                                    </div>

                                </td>


                                <td>
                                    <span class="loan-type item">
                                        Item
                                    </span>
                                </td>


                                <td class="amount">
                                    ₱2,800
                                </td>


                                <td>

                                    <div class="date-cell">

                                        <strong>
                                            Jul 6, 2025
                                        </strong>

                                        <span>
                                            11:08 AM
                                        </span>

                                    </div>

                                </td>


                                <td>
                                    <span class="status approved">
                                        Approved
                                    </span>
                                </td>


                                <td>

                                    <div class="action-cell">

                                        <a
                                            href="applications.php"
                                            class="view-btn"
                                        >
                                            View
                                        </a>

                                        <button class="more-btn">

                                            <span class="material-symbols-outlined">
                                                more_vert
                                            </span>

                                        </button>

                                    </div>

                                </td>

                            </tr>


                            <!-- 8 -->
                            <tr>

                                <td>
                                    <input type="checkbox">
                                </td>


                                <td class="application-id">
                                    LA-2025-0008
                                </td>


                                <td>

                                    <div class="applicant">

                                        <div class="applicant-avatar purple">
                                            SC
                                        </div>

                                        <div>

                                            <strong>
                                                Sofia Cortez
                                            </strong>

                                            <span>
                                                +63 916 444 5566
                                            </span>

                                        </div>

                                    </div>

                                </td>


                                <td>
                                    <span class="loan-type money">
                                        Money
                                    </span>
                                </td>


                                <td class="amount">
                                    ₱3,000
                                </td>


                                <td>

                                    <div class="date-cell">

                                        <strong>
                                            Jul 5, 2025
                                        </strong>

                                        <span>
                                            04:30 PM
                                        </span>

                                    </div>

                                </td>


                                <td>
                                    <span class="status denied">
                                        Denied
                                    </span>
                                </td>


                                <td>

                                    <div class="action-cell">

                                        <a
                                            href="applications.php"
                                            class="view-btn"
                                        >
                                            View
                                        </a>

                                        <button class="more-btn">

                                            <span class="material-symbols-outlined">
                                                more_vert
                                            </span>

                                        </button>

                                    </div>

                                </td>

                            </tr>


                            <!-- 9 -->
                            <tr>

                                <td>
                                    <input type="checkbox">
                                </td>


                                <td class="application-id">
                                    LA-2025-0009
                                </td>


                                <td>

                                    <div class="applicant">

                                        <div class="applicant-avatar blue">
                                            JM
                                        </div>

                                        <div>

                                            <strong>
                                                Joseph Mendoza
                                            </strong>

                                            <span>
                                                +63 917 555 6677
                                            </span>

                                        </div>

                                    </div>

                                </td>


                                <td>
                                    <span class="loan-type money">
                                        Money
                                    </span>
                                </td>


                                <td class="amount">
                                    ₱2,000
                                </td>


                                <td>

                                    <div class="date-cell">

                                        <strong>
                                            Jul 4, 2025
                                        </strong>

                                        <span>
                                            09:20 AM
                                        </span>

                                    </div>

                                </td>


                                <td>
                                    <span class="status approved">
                                        Approved
                                    </span>
                                </td>


                                <td>

                                    <div class="action-cell">

                                        <a
                                            href="applications.php"
                                            class="view-btn"
                                        >
                                            View
                                        </a>

                                        <button class="more-btn">

                                            <span class="material-symbols-outlined">
                                                more_vert
                                            </span>

                                        </button>

                                    </div>

                                </td>

                            </tr>


                            <!-- 10 -->
                            <tr>

                                <td>
                                    <input type="checkbox">
                                </td>


                                <td class="application-id">
                                    LA-2025-0010
                                </td>


                                <td>

                                    <div class="applicant">

                                        <div class="applicant-avatar purple">
                                            EB
                                        </div>

                                        <div>

                                            <strong>
                                                Ella Bautista
                                            </strong>

                                            <span>
                                                +63 906 777 8899
                                            </span>

                                        </div>

                                    </div>

                                </td>


                                <td>
                                    <span class="loan-type item">
                                        Item
                                    </span>
                                </td>


                                <td class="amount">
                                    ₱2,500
                                </td>


                                <td>

                                    <div class="date-cell">

                                        <strong>
                                            Jul 3, 2025
                                        </strong>

                                        <span>
                                            02:18 PM
                                        </span>

                                    </div>

                                </td>


                                <td>
                                    <span class="status denied">
                                        Denied
                                    </span>
                                </td>


                                <td>

                                    <div class="action-cell">

                                        <a
                                            href="applications.php"
                                            class="view-btn"
                                        >
                                            View
                                        </a>

                                        <button class="more-btn">

                                            <span class="material-symbols-outlined">
                                                more_vert
                                            </span>

                                        </button>

                                    </div>

                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>


                <!-- TABLE FOOTER -->
                <div class="table-footer">

                    <span>
                        Showing 1 to 10 of 21 applications
                    </span>


                    <div class="pagination">

                        <button>
                            ‹
                        </button>

                        <button class="active">
                            1
                        </button>

                        <button>
                            2
                        </button>

                        <button>
                            3
                        </button>

                        <button>
                            ›
                        </button>

                    </div>

                </div>

            </section>

        </div>

    </main>

</div>

</body>
</html>
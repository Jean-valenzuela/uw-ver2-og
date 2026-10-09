<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Loaners | Utang Wise</title>

    <link rel="stylesheet" href="../css/loaners-list.css">

    <!-- GOOGLE FONTS -->
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap"
        rel="stylesheet"
    >

    <!-- MATERIAL ICONS -->
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

            <a href="loaners.php" class="menu-item active">
                <span class="material-symbols-outlined">groups</span>
                Loaners
            </a>

            <a href="#" class="menu-item">

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


    <!-- ==================================================
         MAIN CONTENT
    =================================================== -->
    <main class="main-content">


        <!-- TOP BAR -->
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

                    <strong>
                        Admin
                    </strong>

                    <span>
                        Loan Officer
                    </span>

                </div>


                <span class="material-symbols-outlined">
                    keyboard_arrow_down
                </span>

            </div>

        </header>


        <!-- ==================================================
             PAGE
        =================================================== -->
        <div class="page-content">


            <!-- PAGE HEADING -->
            <div class="page-heading">

                <div>

                    <div class="breadcrumb">

                        Dashboard

                        <span>›</span>

                        Loaners

                    </div>


                    <h1>
                        Loaners
                    </h1>


                    <p>
                        Manage and view all clients in the lending system.
                    </p>

                </div>


                <button class="add-client-btn">

                    <span class="material-symbols-outlined">
                        add
                    </span>

                    Add New Client

                </button>

            </div>


            <!-- ==================================================
                 SUMMARY CARDS
            =================================================== -->
            <section class="summary-grid">


                <!-- TOTAL CLIENTS -->
                <div class="summary-card">

                    <div class="summary-icon blue">

                        <span class="material-symbols-outlined">
                            groups
                        </span>

                    </div>


                    <div>

                        <span class="summary-label">
                            Total Clients
                        </span>

                        <strong>
                            124
                        </strong>

                        <small>
                            All registered clients
                        </small>

                    </div>

                </div>


                <!-- ACTIVE CLIENTS -->
                <div class="summary-card">

                    <div class="summary-icon green">

                        <span class="material-symbols-outlined">
                            person
                        </span>

                    </div>


                    <div>

                        <span class="summary-label">
                            Active Clients
                        </span>

                        <strong>
                            98
                        </strong>

                        <small>
                            With ongoing loans
                        </small>

                    </div>

                </div>


                <!-- PENDING -->
                <div class="summary-card">

                    <div class="summary-icon orange">

                        <span class="material-symbols-outlined">
                            schedule
                        </span>

                    </div>


                    <div>

                        <span class="summary-label">
                            Pending Applications
                        </span>

                        <strong>
                            12
                        </strong>

                        <small>
                            For review
                        </small>

                    </div>

                </div>


                <!-- OVERDUE -->
                <div class="summary-card">

                    <div class="summary-icon red">

                        <span class="material-symbols-outlined">
                            person_cancel
                        </span>

                    </div>


                    <div>

                        <span class="summary-label">
                            Overdue Clients
                        </span>

                        <strong>
                            14
                        </strong>

                        <small>
                            With past due payments
                        </small>

                    </div>

                </div>

            </section>


            <!-- ==================================================
                 CLIENT TABLE CARD
            =================================================== -->
            <section class="loaners-table-card">


                <!-- FILTERS -->
                <div class="filter-bar">


                    <div class="client-search">

                        <span class="material-symbols-outlined">
                            search
                        </span>

                        <input
                            type="text"
                            placeholder="Search client name, phone number, or email..."
                        >

                    </div>


                    <select>
                        <option>All Status</option>
                        <option>Active</option>
                        <option>Paid</option>
                        <option>Overdue</option>
                    </select>


                    <select>
                        <option>All Loan Type</option>
                        <option>Money</option>
                        <option>Item</option>
                    </select>


                    <select>
                        <option>All Labels</option>
                        <option>Good Payer</option>
                        <option>Regular</option>
                        <option>Late Payer</option>
                    </select>


                    <button class="reset-btn">

                        <span class="material-symbols-outlined">
                            refresh
                        </span>

                        Reset

                    </button>

                </div>


                <!-- ==================================================
                     TABLE
                =================================================== -->
                <div class="table-wrapper">

                    <table>

                        <thead>

                            <tr>

                                <th>#</th>
                                <th>Client Name</th>
                                <th>Phone Number</th>
                                <th>Loan Type</th>
                                <th>Total Loan</th>
                                <th>Total Due</th>
                                <th>Status</th>
                                <th>Client Label</th>
                                <th>Date Registered</th>
                                <th>Action</th>

                            </tr>

                        </thead>


                        <tbody>


                            <!-- CLIENT 1 -->
                            <tr>

                                <td>1</td>

                                <td>

                                    <div class="client-name">

                                        <div class="small-avatar blue-avatar">
                                            JD
                                        </div>

                                        <strong>
                                            Juan Dela Cruz
                                        </strong>

                                    </div>

                                </td>

                                <td>
                                    +63 912 345 6789
                                </td>

                                <td>
                                    Money
                                </td>

                                <td class="money">
                                    ₱35,000
                                </td>

                                <td class="money">
                                    ₱8,500
                                </td>

                                <td>

                                    <span class="status active-status">
                                        Active
                                    </span>

                                </td>

                                <td>

                                    <span class="label good-label">
                                        Good Payer
                                    </span>

                                </td>

                                <td>
                                    Jan 15, 2024
                                </td>

                                <td>

                                    <a
                                        href="loaners-priv.php"
                                        class="view-profile-btn"
                                    >

                                        <span class="material-symbols-outlined">
                                            visibility
                                        </span>

                                        View Profile

                                    </a>

                                </td>

                            </tr>


                            <!-- CLIENT 2 -->
                            <tr>

                                <td>2</td>

                                <td>

                                    <div class="client-name">

                                        <div class="small-avatar orange-avatar">
                                            MS
                                        </div>

                                        <strong>
                                            Maria Santos
                                        </strong>

                                    </div>

                                </td>

                                <td>
                                    +63 915 123 4567
                                </td>

                                <td>
                                    Item
                                </td>

                                <td class="money">
                                    ₱18,000
                                </td>

                                <td class="money">
                                    ₱6,000
                                </td>

                                <td>
                                    <span class="status active-status">
                                        Active
                                    </span>
                                </td>

                                <td>
                                    <span class="label regular-label">
                                        Regular
                                    </span>
                                </td>

                                <td>
                                    Feb 10, 2024
                                </td>

                                <td>

                                    <a
                                        href="loaners-priv.php"
                                        class="view-profile-btn"
                                    >

                                        <span class="material-symbols-outlined">
                                            visibility
                                        </span>

                                        View Profile

                                    </a>

                                </td>

                            </tr>


                            <!-- CLIENT 3 -->
                            <tr>

                                <td>3</td>

                                <td>

                                    <div class="client-name">

                                        <div class="small-avatar gray-avatar">
                                            PR
                                        </div>

                                        <strong>
                                            Pedro Reyes
                                        </strong>

                                    </div>

                                </td>

                                <td>
                                    +63 917 456 7890
                                </td>

                                <td>
                                    Money
                                </td>

                                <td class="money">
                                    ₱12,000
                                </td>

                                <td class="money">
                                    ₱12,000
                                </td>

                                <td>
                                    <span class="status overdue-status">
                                        Overdue
                                    </span>
                                </td>

                                <td>
                                    <span class="label late-label">
                                        Late Payer
                                    </span>
                                </td>

                                <td>
                                    Mar 05, 2024
                                </td>

                                <td>

                                    <a
                                        href="loaners-priv.php"
                                        class="view-profile-btn"
                                    >

                                        <span class="material-symbols-outlined">
                                            visibility
                                        </span>

                                        View Profile

                                    </a>

                                </td>

                            </tr>


                            <!-- CLIENT 4 -->
                            <tr>

                                <td>4</td>

                                <td>

                                    <div class="client-name">

                                        <div class="small-avatar green-avatar">
                                            AC
                                        </div>

                                        <strong>
                                            Ana Cruz
                                        </strong>

                                    </div>

                                </td>

                                <td>
                                    +63 918 567 8901
                                </td>

                                <td>
                                    Money
                                </td>

                                <td class="money">
                                    ₱20,000
                                </td>

                                <td class="money">
                                    ₱0
                                </td>

                                <td>
                                    <span class="status paid-status">
                                        Paid
                                    </span>
                                </td>

                                <td>
                                    <span class="label good-label">
                                        Good Payer
                                    </span>
                                </td>

                                <td>
                                    Mar 18, 2024
                                </td>

                                <td>

                                    <a
                                        href="loaners-priv.php"
                                        class="view-profile-btn"
                                    >

                                        <span class="material-symbols-outlined">
                                            visibility
                                        </span>

                                        View Profile

                                    </a>

                                </td>

                            </tr>


                            <!-- CLIENT 5 -->
                            <tr>

                                <td>5</td>

                                <td>

                                    <div class="client-name">

                                        <div class="small-avatar blue-avatar">
                                            MR
                                        </div>

                                        <strong>
                                            Mark Rivera
                                        </strong>

                                    </div>

                                </td>

                                <td>
                                    +63 915 222 3456
                                </td>

                                <td>
                                    Item
                                </td>

                                <td class="money">
                                    ₱25,000
                                </td>

                                <td class="money">
                                    ₱10,000
                                </td>

                                <td>
                                    <span class="status active-status">
                                        Active
                                    </span>
                                </td>

                                <td>
                                    <span class="label regular-label">
                                        Regular
                                    </span>
                                </td>

                                <td>
                                    Apr 02, 2024
                                </td>

                                <td>

                                    <a
                                        href="loaners-priv.php"
                                        class="view-profile-btn"
                                    >

                                        <span class="material-symbols-outlined">
                                            visibility
                                        </span>

                                        View Profile

                                    </a>

                                </td>

                            </tr>


                            <!-- CLIENT 6 -->
                            <tr>

                                <td>6</td>

                                <td>

                                    <div class="client-name">

                                        <div class="small-avatar purple-avatar">
                                            LM
                                        </div>

                                        <strong>
                                            Liza Mendoza
                                        </strong>

                                    </div>

                                </td>

                                <td>
                                    +63 917 888 1234
                                </td>

                                <td>
                                    Money
                                </td>

                                <td class="money">
                                    ₱8,000
                                </td>

                                <td class="money">
                                    ₱0
                                </td>

                                <td>
                                    <span class="status paid-status">
                                        Paid
                                    </span>
                                </td>

                                <td>
                                    <span class="label good-label">
                                        Good Payer
                                    </span>
                                </td>

                                <td>
                                    Apr 15, 2024
                                </td>

                                <td>

                                    <a
                                        href="loaners-priv.php"
                                        class="view-profile-btn"
                                    >

                                        <span class="material-symbols-outlined">
                                            visibility
                                        </span>

                                        View Profile

                                    </a>

                                </td>

                            </tr>


                            <!-- CLIENT 7 -->
                            <tr>

                                <td>7</td>

                                <td>

                                    <div class="client-name">

                                        <div class="small-avatar blue-avatar">
                                            CR
                                        </div>

                                        <strong>
                                            Carlo Ramirez
                                        </strong>

                                    </div>

                                </td>

                                <td>
                                    +63 919 333 4455
                                </td>

                                <td>
                                    Money
                                </td>

                                <td class="money">
                                    ₱15,000
                                </td>

                                <td class="money">
                                    ₱5,000
                                </td>

                                <td>
                                    <span class="status active-status">
                                        Active
                                    </span>
                                </td>

                                <td>
                                    <span class="label regular-label">
                                        Regular
                                    </span>
                                </td>

                                <td>
                                    May 01, 2024
                                </td>

                                <td>

                                    <a
                                        href="loaners-priv.php"
                                        class="view-profile-btn"
                                    >

                                        <span class="material-symbols-outlined">
                                            visibility
                                        </span>

                                        View Profile

                                    </a>

                                </td>

                            </tr>


                            <!-- CLIENT 8 -->
                            <tr>

                                <td>8</td>

                                <td>

                                    <div class="client-name">

                                        <div class="small-avatar orange-avatar">
                                            RF
                                        </div>

                                        <strong>
                                            Rhea Flores
                                        </strong>

                                    </div>

                                </td>

                                <td>
                                    +63 920 111 2233
                                </td>

                                <td>
                                    Item
                                </td>

                                <td class="money">
                                    ₱10,000
                                </td>

                                <td class="money">
                                    ₱10,000
                                </td>

                                <td>
                                    <span class="status overdue-status">
                                        Overdue
                                    </span>
                                </td>

                                <td>
                                    <span class="label late-label">
                                        Late Payer
                                    </span>
                                </td>

                                <td>
                                    May 20, 2024
                                </td>

                                <td>

                                    <a
                                        href="loaners-priv.php"
                                        class="view-profile-btn"
                                    >

                                        <span class="material-symbols-outlined">
                                            visibility
                                        </span>

                                        View Profile

                                    </a>

                                </td>

                            </tr>


                            <!-- CLIENT 9 -->
                            <tr>

                                <td>9</td>

                                <td>

                                    <div class="client-name">

                                        <div class="small-avatar green-avatar">
                                            DG
                                        </div>

                                        <strong>
                                            Daniel Garcia
                                        </strong>

                                    </div>

                                </td>

                                <td>
                                    +63 918 444 6677
                                </td>

                                <td>
                                    Money
                                </td>

                                <td class="money">
                                    ₱5,000
                                </td>

                                <td class="money">
                                    ₱0
                                </td>

                                <td>
                                    <span class="status paid-status">
                                        Paid
                                    </span>
                                </td>

                                <td>
                                    <span class="label good-label">
                                        Good Payer
                                    </span>
                                </td>

                                <td>
                                    Jun 10, 2024
                                </td>

                                <td>

                                    <a
                                        href="loaners-priv.php"
                                        class="view-profile-btn"
                                    >

                                        <span class="material-symbols-outlined">
                                            visibility
                                        </span>

                                        View Profile

                                    </a>

                                </td>

                            </tr>


                            <!-- CLIENT 10 -->
                            <tr>

                                <td>10</td>

                                <td>

                                    <div class="client-name">

                                        <div class="small-avatar orange-avatar">
                                            KV
                                        </div>

                                        <strong>
                                            Katrina Villanueva
                                        </strong>

                                    </div>

                                </td>

                                <td>
                                    +63 927 555 8899
                                </td>

                                <td>
                                    Item
                                </td>

                                <td class="money">
                                    ₱30,000
                                </td>

                                <td class="money">
                                    ₱15,000
                                </td>

                                <td>
                                    <span class="status active-status">
                                        Active
                                    </span>
                                </td>

                                <td>
                                    <span class="label regular-label">
                                        Regular
                                    </span>
                                </td>

                                <td>
                                    Jun 25, 2024
                                </td>

                                <td>

                                    <a
                                        href="loaners-priv.php"
                                        class="view-profile-btn"
                                    >

                                        <span class="material-symbols-outlined">
                                            visibility
                                        </span>

                                        View Profile

                                    </a>

                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>


                <!-- ==================================================
                     TABLE FOOTER
                =================================================== -->
                <div class="table-footer">

                    <span>
                        Showing 1 to 10 of 124 clients
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
                            4
                        </button>

                        <button>
                            5
                        </button>

                        <button>
                            ...
                        </button>

                        <button>
                            13
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
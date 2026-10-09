<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Loaners | Utang Wise</title>

    <link rel="stylesheet" href="../assets/css/loaners-list.css">

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

            <a href="applications.php" class="menu-item">

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

                                <?php

                                    /*$viewloaners = $con->viewloaners();
                                    foreach($viewloaners as $vl){

                                    echo '<tr>';
                                    echo '<td>'.$vl['user_id']. '</td>';
                                    echo '<td>'.$vl['user_fn']. '' .$vl['user_ln']'</td>';
                                    echo '<td>'.$vl['phone']. '</td>';
                                    echo '<td>'.$vw['book_publication_year']. '</td>';
                                    echo '<td>'.$vw['book_publisher']. '</td>';
                                    echo '<td>'.$vw['Copies']. '</td>';
                                    echo '<td>'.$vw['Available_copies']. '</td>';
                                                    

                                

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
                        */?>
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
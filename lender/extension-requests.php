<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Extension Requests | Utang Wise</title>

    <link rel="stylesheet" href="../css/datatables.min.css">
    <link rel="stylesheet" href="../css/extension-requests.css">

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

            <!-- ACTIVE -->
            <a href="extension-requests.php" class="menu-item active">

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
                    placeholder="Search borrower name or request ID..."
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


        <!-- ==================================================
             PAGE
        =================================================== -->
        <div class="page-content">

            <div class="page-heading">

                <div class="breadcrumb">
                    Dashboard
                    <span>›</span>
                    Extension Requests
                </div>

                <h1>Extension Requests</h1>

                <p>
                    Review and take action on borrowers'
                    loan extension requests.
                </p>

            </div>


            <!-- ==================================================
                 SUMMARY
            =================================================== -->
            <section class="summary-grid">

                <div class="summary-card">

                    <div class="summary-icon orange">
                        <span class="material-symbols-outlined">
                            schedule
                        </span>
                    </div>

                    <div>
                        <span>Pending Requests</span>
                        <strong>3</strong>
                        <small>Awaiting review</small>
                    </div>

                </div>


                <div class="summary-card">

                    <div class="summary-icon green">
                        <span class="material-symbols-outlined">
                            check_circle
                        </span>
                    </div>

                    <div>
                        <span>Approved Requests</span>
                        <strong>5</strong>
                        <small>Extension approved</small>
                    </div>

                </div>


                <div class="summary-card">

                    <div class="summary-icon red">
                        <span class="material-symbols-outlined">
                            cancel
                        </span>
                    </div>

                    <div>
                        <span>Denied Requests</span>
                        <strong>2</strong>
                        <small>Extension denied</small>
                    </div>

                </div>


                <div class="summary-card">

                    <div class="summary-icon blue">
                        <span class="material-symbols-outlined">
                            list_alt
                        </span>
                    </div>

                    <div>
                        <span>Total Requests</span>
                        <strong>10</strong>
                        <small>All extension requests</small>
                    </div>

                </div>

            </section>


            <!-- ==================================================
                 WORKSPACE
            =================================================== -->
            <div
                class="extension-workspace"
                id="extensionWorkspace"
            >

                <!-- TABLE -->
                <section class="extension-table-card">

                    <!-- FILTERS -->
                    <div class="filter-bar">

                        <div class="custom-search">

                            <span class="material-symbols-outlined">
                                search
                            </span>

                            <input
                                type="text"
                                id="extensionSearch"
                                placeholder="Search borrower or request..."
                            >

                        </div>


                        <select id="statusFilter">

                            <option value="">
                                All Status
                            </option>

                            <option value="Pending">
                                Pending
                            </option>

                            <option value="Approved">
                                Approved
                            </option>

                            <option value="Denied">
                                Denied
                            </option>

                        </select>


                        <select id="termFilter">

                            <option value="">
                                All Requested Terms
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
                            Reset
                        </button>

                    </div>


                    <div class="table-wrapper">

                        <table id="extensionTable">

                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Borrower</th>
                                    <th>Request ID</th>
                                    <th>Current Term</th>
                                    <th>Requested Term</th>
                                    <th>Request Date</th>
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
                                                <strong>
                                                    Maria Santos
                                                </strong>
                                                <span>
                                                    +63 915 123 4567
                                                </span>
                                            </div>

                                        </div>
                                    </td>

                                    <td>EXT-2026-001</td>

                                    <td>3 Months</td>

                                    <td>6 Months</td>

                                    <td data-order="2026-09-28">
                                        Sep 28, 2026
                                    </td>

                                    <td>
                                        <span class="status pending">
                                            Pending
                                        </span>
                                    </td>

                                    <td>

                                        <button
                                            type="button"
                                            class="view-request-btn"
                                            data-request="maria"
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
                                                <strong>
                                                    Juan Dela Cruz
                                                </strong>
                                                <span>
                                                    +63 912 345 6789
                                                </span>
                                            </div>

                                        </div>
                                    </td>

                                    <td>EXT-2026-002</td>

                                    <td>3 Months</td>

                                    <td>6 Months</td>

                                    <td data-order="2026-09-27">
                                        Sep 27, 2026
                                    </td>

                                    <td>
                                        <span class="status approved">
                                            Approved
                                        </span>
                                    </td>

                                    <td>
                                        <button
                                            type="button"
                                            class="view-request-btn"
                                            data-request="juan"
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
                                                <strong>
                                                    Ana Cruz
                                                </strong>
                                                <span>
                                                    +63 918 567 8901
                                                </span>
                                            </div>

                                        </div>
                                    </td>

                                    <td>EXT-2026-003</td>

                                    <td>6 Months</td>

                                    <td>9 Months</td>

                                    <td data-order="2026-09-26">
                                        Sep 26, 2026
                                    </td>

                                    <td>
                                        <span class="status pending">
                                            Pending
                                        </span>
                                    </td>

                                    <td>
                                        <button
                                            type="button"
                                            class="view-request-btn"
                                            data-request="ana"
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
                                                <strong>
                                                    Pedro Reyes
                                                </strong>
                                                <span>
                                                    +63 917 456 7890
                                                </span>
                                            </div>

                                        </div>
                                    </td>

                                    <td>EXT-2026-004</td>

                                    <td>1 Month</td>

                                    <td>3 Months</td>

                                    <td data-order="2026-09-25">
                                        Sep 25, 2026
                                    </td>

                                    <td>
                                        <span class="status denied">
                                            Denied
                                        </span>
                                    </td>

                                    <td>
                                        <button
                                            type="button"
                                            class="view-request-btn"
                                            data-request="pedro"
                                        >
                                            <span class="material-symbols-outlined">
                                                visibility
                                            </span>

                                            View
                                        </button>
                                    </td>

                                </tr>


                                <tr>

                                    <td>5</td>

                                    <td>
                                        <div class="borrower-cell">

                                            <div class="small-avatar">
                                                MR
                                            </div>

                                            <div>
                                                <strong>
                                                    Mark Rivera
                                                </strong>
                                                <span>
                                                    +63 915 222 3456
                                                </span>
                                            </div>

                                        </div>
                                    </td>

                                    <td>EXT-2026-005</td>

                                    <td>6 Months</td>

                                    <td>9 Months</td>

                                    <td data-order="2026-09-24">
                                        Sep 24, 2026
                                    </td>

                                    <td>
                                        <span class="status approved">
                                            Approved
                                        </span>
                                    </td>

                                    <td>
                                        <button
                                            type="button"
                                            class="view-request-btn"
                                            data-request="mark"
                                        >
                                            <span class="material-symbols-outlined">
                                                visibility
                                            </span>

                                            View
                                        </button>
                                    </td>

                                </tr>


                                <tr>

                                    <td>6</td>

                                    <td>
                                        <div class="borrower-cell">

                                            <div class="small-avatar">
                                                LM
                                            </div>

                                            <div>
                                                <strong>
                                                    Liza Mendoza
                                                </strong>
                                                <span>
                                                    +63 917 888 1234
                                                </span>
                                            </div>

                                        </div>
                                    </td>

                                    <td>EXT-2026-006</td>

                                    <td>3 Months</td>

                                    <td>6 Months</td>

                                    <td data-order="2026-09-23">
                                        Sep 23, 2026
                                    </td>

                                    <td>
                                        <span class="status pending">
                                            Pending
                                        </span>
                                    </td>

                                    <td>
                                        <button
                                            type="button"
                                            class="view-request-btn"
                                            data-request="liza"
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


                <!-- ==================================================
                     DETAILS DRAWER
                     HIDDEN UNTIL VIEW IS CLICKED
                =================================================== -->
                <aside
                    class="request-drawer"
                    id="requestDrawer"
                    aria-hidden="true"
                >

                    <div class="drawer-header">

                        <div>
                            <span class="drawer-eyebrow">
                                Extension Request
                            </span>

                            <h2>
                                Request Details
                            </h2>
                        </div>


                        <button
                            type="button"
                            id="closeDrawer"
                            class="drawer-close"
                        >
                            <span class="material-symbols-outlined">
                                close
                            </span>
                        </button>

                    </div>


                    <!-- BORROWER -->
                    <div class="drawer-borrower">

                        <div
                            class="drawer-avatar"
                            id="drawerAvatar"
                        >
                            MS
                        </div>


                        <div class="drawer-borrower-info">

                            <strong id="drawerName">
                                Maria Santos
                            </strong>

                            <span id="drawerRequestId">
                                EXT-2026-001
                            </span>

                        </div>


                        <span
                            class="status pending"
                            id="drawerStatus"
                        >
                            Pending
                        </span>

                    </div>


                    <div class="drawer-body">

                        <!-- LOAN INFORMATION -->
                        <section class="detail-section">

                            <div class="section-title">

                                <span class="material-symbols-outlined">
                                    account_balance_wallet
                                </span>

                                <div>
                                    <strong>Loan Information</strong>
                                    <span>Current loan details</span>
                                </div>

                            </div>


                            <div class="details-grid">

                                <div class="detail-box">
                                    <span>Current Term</span>
                                    <strong id="drawerCurrentTerm">
                                        3 Months
                                    </strong>
                                </div>


                                <div class="detail-box">
                                    <span>Outstanding Balance</span>
                                    <strong id="drawerBalance">
                                        ₱2,450
                                    </strong>
                                </div>


                                <div class="detail-box full">
                                    <span>Current Due Date</span>
                                    <strong id="drawerDueDate">
                                        Oct 15, 2026
                                    </strong>
                                </div>

                            </div>

                        </section>


                        <!-- EXTENSION REQUEST -->
                        <section class="detail-section">

                            <div class="section-title red-title">

                                <span class="material-symbols-outlined">
                                    update
                                </span>

                                <div>
                                    <strong>Extension Request</strong>
                                    <span>Borrower's requested changes</span>
                                </div>

                            </div>


                            <div class="details-grid">

                                <div class="detail-box full">
                                    <span>Requested New Term</span>

                                    <strong
                                        class="gold-text"
                                        id="drawerRequestedTerm"
                                    >
                                        6 Months
                                    </strong>
                                </div>


                                <div class="detail-box full">

                                    <span>Reason for Extension</span>

                                    <strong id="drawerReason">
                                        I'm currently experiencing
                                        financial difficulties due to
                                        unexpected medical expenses.
                                    </strong>

                                </div>


                                <div class="detail-box full">

                                    <span>Requested On</span>

                                    <strong id="drawerRequestDate">
                                        Sep 28, 2026 10:24 AM
                                    </strong>

                                </div>

                            </div>

                        </section>


                        <!-- SUPPORTING DOCUMENT -->
                        <section class="detail-section">

                            <div class="section-title">

                                <span class="material-symbols-outlined">
                                    attach_file
                                </span>

                                <div>
                                    <strong>Supporting Document</strong>
                                    <span>Uploaded by borrower</span>
                                </div>

                            </div>


                            <div class="document-row">

                                <div class="document-icon">

                                    <span class="material-symbols-outlined">
                                        picture_as_pdf
                                    </span>

                                </div>


                                <div class="document-info">

                                    <strong id="drawerDocument">
                                        Medical Receipt.pdf
                                    </strong>

                                    <span>
                                        Supporting document
                                    </span>

                                </div>


                                <button
                                    type="button"
                                    class="document-view-btn"
                                >
                                    View
                                </button>

                            </div>

                        </section>


                        <!-- ADMIN NOTES -->
                        <div class="admin-notes">

                            <label for="adminNotes">
                                Admin Notes
                            </label>

                            <textarea
                                id="adminNotes"
                                placeholder="Add notes about this extension request..."
                            ></textarea>

                        </div>

                    </div>


                    <!-- ACTIONS -->
                    <div class="drawer-actions">

                        <button
                            type="button"
                            class="deny-btn"
                            id="denyRequest"
                        >
                            <span class="material-symbols-outlined">
                                close
                            </span>

                            Deny
                        </button>


                        <button
                            type="button"
                            class="approve-btn"
                            id="approveRequest"
                        >
                            <span class="material-symbols-outlined">
                                check
                            </span>

                            Approve
                        </button>

                    </div>

                </aside>

            </div>

        </div>

    </main>

</div>


<!-- DATATABLES -->
<script src="../js/datatables.min.js"></script>

<!-- SWEETALERT -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- EXTENSION REQUESTS -->
<script src="../js/extension-requests.js"></script>

</body>
</html>
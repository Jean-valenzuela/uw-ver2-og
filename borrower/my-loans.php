<?php
session_start();

/*
|--------------------------------------------------------------------------
| TEMPORARY DATA
|--------------------------------------------------------------------------
| Replace these with database values later using $_SESSION['user_id'].
*/

$user = [
    'name' => 'Juan Dela Cruz',
    'role' => 'Client'
];

$loans = [
    [
        'id' => 'LN-2025-001',
        'amount' => '₱5,000.00',
        'date_granted' => 'Jul 10, 2025',
        'due_date' => 'Sep 12, 2025',
        'status' => 'On-going',
        'status_class' => 'ongoing'
    ],
    [
        'id' => 'LN-2025-002',
        'amount' => '₱3,000.00',
        'date_granted' => 'Mar 15, 2025',
        'due_date' => 'May 15, 2025',
        'status' => 'Completed',
        'status_class' => 'completed'
    ]
];

function initials($name) {
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

    <title>My Loans | Utang Wise</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">

    <link rel="stylesheet" href="css/datatables.min.css">

    <!-- Page CSS -->
    <link rel="stylesheet" href="css/my-loans.css">
</head>

<body>

<div class="client-layout">

    <!-- =====================================================
         SIDEBAR
    ====================================================== -->
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

            <a href="client-dashboard.php" class="menu-item">
                <span class="material-symbols-outlined">home</span>
                <span>Dashboard</span>
            </a>

            <a href="profile.php" class="menu-item">
                <span class="material-symbols-outlined">person</span>
                <span>Profile</span>
            </a>

            <a href="my-loans.php" class="menu-item active">
                <span class="material-symbols-outlined">description</span>
                <span>My Loans</span>
            </a>

            <a href="request-loan.php" class="menu-item">
                <span class="material-symbols-outlined">add_circle</span>
                <span>Request Loan</span>
            </a>

             <a href="Payments.php" class="menu-item">
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

            <a href="logout.php" class="menu-item">
                <span class="material-symbols-outlined">logout</span>
                <span>Log Out</span>
            </a>

        </div>

    </aside>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>


    <!-- =====================================================
         MAIN CONTENT
    ====================================================== -->
    <main class="main-content">

        <!-- TOPBAR -->
        <header class="topbar">

            <button type="button" class="mobile-menu-btn" id="mobileMenuBtn">
                <span class="material-symbols-outlined">menu</span>
            </button>

            <div class="search-box">
                <span class="material-symbols-outlined">search</span>
                <input type="text" placeholder="Search here...">
            </div>

            <div class="user-area">

                <div class="notification">
                    <span class="material-symbols-outlined">notifications</span>
                    <span class="notification-dot"></span>
                </div>

                <div class="user-avatar">
                    <?= htmlspecialchars(initials($user['name'])) ?>
                </div>

                <div class="user-text">
                    <strong><?= htmlspecialchars($user['name']) ?></strong>
                    <span><?= htmlspecialchars($user['role']) ?></span>
                </div>

                <span class="material-symbols-outlined dropdown-icon">
                    keyboard_arrow_down
                </span>

            </div>

        </header>


        <!-- =================================================
             PAGE
        ================================================== -->
        <section class="page-content">

            <div class="breadcrumb">
                <span>Home</span>
                <span>›</span>
                <strong>My Loans</strong>
            </div>

            <div class="page-heading">
                <h1>My Loans</h1>
                <p>View and manage all your loan accounts.</p>
            </div>


            <!-- =================================================
                 SUMMARY CARDS
            ================================================== -->
            <div class="summary-grid">

                <article class="summary-card">

                    <div class="summary-icon gold-icon">
                        <span class="material-symbols-outlined">description</span>
                    </div>

                    <div>
                        <span>Total Loans</span>
                        <strong>2</strong>
                        <p>Active and completed loans</p>
                    </div>

                </article>

                <article class="summary-card">

                    <div class="summary-icon green-icon">
                        <span class="material-symbols-outlined">autorenew</span>
                    </div>

                    <div>
                        <span>Active Loans</span>
                        <strong>1</strong>
                        <p>Currently ongoing</p>
                    </div>

                </article>

                <article class="summary-card">

                    <div class="summary-icon purple-icon">
                        <span class="material-symbols-outlined">check_circle</span>
                    </div>

                    <div>
                        <span>Completed Loans</span>
                        <strong>1</strong>
                        <p>Successfully paid</p>
                    </div>

                </article>

                <article class="summary-card">

                    <div class="summary-icon red-icon">
                        <span class="material-symbols-outlined">error</span>
                    </div>

                    <div>
                        <span>Overdue Loans</span>
                        <strong>0</strong>
                        <p>No overdue payments</p>
                    </div>

                </article>

            </div>


            <!-- =================================================
                 LOANS + RIGHT COLUMN
            ================================================== -->
            <div class="content-grid">

                <!-- LOAN TABLE -->
                <section class="loans-card">

                    <div class="card-header">

                        <div class="card-title">

                            <div class="card-title-icon">
                                <span class="material-symbols-outlined">description</span>
                            </div>

                            <div>
                                <h2>Your Loans</h2>
                                <p>Here are all your loan accounts.</p>
                            </div>

                        </div>

                      <select class="loan-filter" id="loanStatusFilter">
    <option value="">All Loans</option>
    <option value="On-going">On-going</option>
    <option value="Completed">Completed</option>
    <option value="Overdue">Overdue</option>
</select>

                    </div>

                    <div class="table-wrapper">

                        <table id="loansTable" class="display">

                            <thead>
                                <tr>
                                    <th>Loan ID</th>
                                    <th>Loan Amount</th>
                                    <th>Date Granted</th>
                                    <th>Due Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php foreach ($loans as $loan): ?>

                                    <tr>
                                        <td><?= htmlspecialchars($loan['id']) ?></td>

                                        <td class="amount">
                                            <?= htmlspecialchars($loan['amount']) ?>
                                        </td>

                                        <td><?= htmlspecialchars($loan['date_granted']) ?></td>

                                        <td><?= htmlspecialchars($loan['due_date']) ?></td>

                                        <td>
                                            <span class="loan-status <?= htmlspecialchars($loan['status_class']) ?>">
                                                <?= htmlspecialchars($loan['status']) ?>
                                            </span>
                                        </td>

                                        <td>
                                            <button
                                                type="button"
                                                class="view-btn loan-details-trigger"
                                                data-loan-id="<?= htmlspecialchars($loan['id']) ?>"
                                                data-status="<?= htmlspecialchars($loan['status']) ?>"
                                            >
                                                View Details
                                            </button>
                                        </td>
                                    </tr>

                                <?php endforeach; ?>

                            </tbody>

                        </table>

                    </div>

                </section>


                <!-- RIGHT SIDE -->
                <aside class="right-column">

                    <section class="side-card">

                        <div class="side-heading">

                            <div class="side-icon">
                                <span class="material-symbols-outlined">bar_chart</span>
                            </div>

                            <div>
                                <h3>Loan Summary</h3>
                                <p>A quick overview of your loans.</p>
                            </div>

                        </div>

                        <div class="summary-list">

                            <div>
                                <span>Total Loan Amount</span>
                                <strong>₱8,000.00</strong>
                            </div>

                            <div>
                                <span>Total Amount Paid</span>
                                <strong>₱3,000.00</strong>
                            </div>

                            <div>
                                <span>Outstanding Balance</span>
                                <strong>₱5,000.00</strong>
                            </div>

                        </div>

                    </section>


                    <section class="side-card new-loan-card">

                        <div class="side-heading">

                            <div class="side-icon">
                                <span class="material-symbols-outlined">add_circle</span>
                            </div>

                            <div>
                                <h3>Need a New Loan?</h3>
                                <p>You can apply for a new loan anytime.</p>
                            </div>

                        </div>

                        <a href="request-loan.php" class="request-loan-btn">
                            Request a Loan
                        </a>

                    </section>

                </aside>

            </div>


            <!-- =================================================
                 REMINDERS
            ================================================== -->
            <section class="reminders-card">

                <div class="reminders-heading">

                    <div class="reminders-icon">
                        <span class="material-symbols-outlined">notifications</span>
                    </div>

                    <h2>Important Reminders</h2>

                </div>

                <div class="reminder-box">

                    <span class="material-symbols-outlined info-icon">
                        info
                    </span>

                    <ul>
                        <li>Make sure to pay on or before your due date to avoid additional charges.</li>
                        <li>You can request a payment extension if you need more time.</li>
                        <li>Keep your contact information updated to receive important notifications.</li>
                    </ul>

                </div>

            </section>

        </section>

    </main>

</div>


<!-- =====================================================
     LOAN DETAILS MODAL
====================================================== -->
<div class="loan-modal" id="loanDetailsModal" aria-hidden="true">
    <div class="loan-modal-backdrop" data-close-loan-modal></div>

    <section class="loan-modal-dialog" role="dialog" aria-modal="true" aria-labelledby="loanModalTitle">
        <button type="button" class="loan-modal-x" data-close-loan-modal aria-label="Close loan details">
            <span class="material-symbols-outlined">close</span>
        </button>

        <div class="loan-modal-header">
            <div class="loan-modal-icon">
                <span class="material-symbols-outlined">description</span>
            </div>
            <div>
                <h2 id="loanModalTitle">Loan Details</h2>
                <p>Here are the complete details of your loan.</p>
            </div>
        </div>

        <div class="loan-modal-grid">
            <div class="loan-modal-left">
                <section class="loan-overview">
                    <div>
                        <span class="loan-label">Loan ID</span>
                        <strong id="modalLoanId">LN-2025-001</strong>
                        <p id="modalGrantedText">Granted on July 10, 2025</p>
                    </div>
                    <div class="loan-overview-status">
                        <span class="modal-status ongoing" id="modalStatus">
                            <span class="material-symbols-outlined">schedule</span>
                            On-going
                        </span>
                        <p id="modalStatusText">You are currently paying this loan.</p>
                    </div>
                </section>

                <section class="modal-card">
                    <div class="modal-section-title">
                        <span class="modal-title-icon material-symbols-outlined">description</span>
                        <h3>Loan Information</h3>
                    </div>

                    <div class="loan-info-grid">
                        <div><span>Loan Amount</span><strong id="modalAmount">₱5,000.00</strong></div>
                        <div><span>Interest Rate</span><strong>2.5%</strong><small>(per month)</small></div>
                        <div><span>Repayment Term</span><strong>6 Months</strong></div>
                        <div><span>Monthly Due</span><strong>₱958.33</strong></div>
                        <div><span>Date Granted</span><strong id="modalGranted">Jul 10, 2025</strong></div>
                        <div><span>Due Date</span><strong id="modalDue">Sep 12, 2025</strong></div>
                    </div>

                    <div class="loan-purpose">
                        <span>Loan Purpose</span>
                        <strong>School expenses</strong>
                    </div>
                </section>

                <div class="modal-bottom-grid">
                    <section class="modal-card payment-progress-card">
                        <div class="modal-section-title">
                            <span class="modal-title-icon material-symbols-outlined">donut_large</span>
                            <h3>Payment Progress</h3>
                        </div>

                        <div class="progress-content">
                            <div class="progress-ring">
                                <span id="progressPercent">50%</span>
                            </div>
                            <div class="progress-details">
                                <strong id="progressTitle">3 of 6 payments</strong>
                                <p id="progressRemaining">3 payments remaining</p>
                                <div class="progress-bar"><span id="progressBar"></span></div>
                                <div class="progress-note">
                                    <span class="material-symbols-outlined">info</span>
                                    <div>
                                        <strong id="progressNoteTitle">Keep up the good work!</strong>
                                        <p id="progressNoteText">You're halfway there.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="modal-card next-payment-card" id="nextPaymentCard">
                        <div class="modal-section-title">
                            <span class="modal-title-icon material-symbols-outlined">calendar_month</span>
                            <h3>Next Payment</h3>
                        </div>
                        <strong class="next-amount">₱958.33</strong>
                        <p>Due on September 12, 2025</p>
                        <span class="days-left">5 days left</span>
                        <a href="payments.php" class="modal-pay-btn">Pay Now</a>
                    </section>
                </div>
            </div>

            <div class="loan-modal-right">
                <section class="modal-card schedule-card">
                    <div class="modal-section-title">
                        <span class="modal-title-icon material-symbols-outlined">calendar_month</span>
                        <div>
                            <h3>Payment Schedule</h3>
                            <p>Your complete payment schedule.</p>
                        </div>
                    </div>

                    <div class="payment-timeline" id="paymentTimeline">
                        <div class="timeline-item paid-item">
                            <span class="timeline-dot"><span class="material-symbols-outlined">check</span></span>
                            <div><strong>1st Payment</strong><p>Aug 12, 2025</p></div>
                            <div class="timeline-amount"><strong>₱958.33</strong><span class="paid-tag">Paid</span></div>
                        </div>
                        <div class="timeline-item paid-item">
                            <span class="timeline-dot"><span class="material-symbols-outlined">check</span></span>
                            <div><strong>2nd Payment</strong><p>Sep 12, 2025</p></div>
                            <div class="timeline-amount"><strong>₱958.33</strong><span class="paid-tag">Paid</span></div>
                        </div>
                        <div class="timeline-item paid-item">
                            <span class="timeline-dot"><span class="material-symbols-outlined">check</span></span>
                            <div><strong>3rd Payment</strong><p>Oct 12, 2025</p></div>
                            <div class="timeline-amount"><strong>₱958.33</strong><span class="paid-tag">Paid</span></div>
                        </div>
                        <div class="timeline-item upcoming-item">
                            <span class="timeline-dot"><span class="material-symbols-outlined">schedule</span></span>
                            <div><strong>4th Payment</strong><p>Nov 12, 2025</p></div>
                            <div class="timeline-amount"><strong>₱958.33</strong><span class="upcoming-tag">Upcoming</span></div>
                        </div>
                        <div class="timeline-item pending-item">
                            <span class="timeline-dot"></span>
                            <div><strong>5th Payment</strong><p>Dec 12, 2025</p></div>
                            <div class="timeline-amount"><strong>₱958.33</strong><span class="pending-tag">Pending</span></div>
                        </div>
                        <div class="timeline-item pending-item">
                            <span class="timeline-dot"></span>
                            <div><strong>6th Payment</strong><p>Jan 12, 2026</p></div>
                            <div class="timeline-amount"><strong>₱958.33</strong><span class="pending-tag">Pending</span></div>
                        </div>
                    </div>
                </section>

                <section class="modal-card agreement-card">
                    <div class="modal-section-title agreement-heading">
                        <span class="modal-title-icon material-symbols-outlined">description</span>
                        <div>
                            <h3>Loan Agreement</h3>
                            <p>You can view your signed agreement in the Agreements section.</p>
                        </div>
                        <a href="agreements.php" class="view-agreement-btn">
                            View Agreement
                            <span class="material-symbols-outlined">open_in_new</span>
                        </a>
                    </div>
                </section>

                <button type="button" class="modal-close-btn" data-close-loan-modal>Close</button>
            </div>
        </div>
    </section>
</div>



<!-- DataTables JS -->
<script src="js/datatables.min.js"></script>

<!-- My Loans JS -->
<script src="js/my-loans.js"></script>



</body>
</html>

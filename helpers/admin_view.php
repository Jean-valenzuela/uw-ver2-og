<?php
require __DIR__ . '/admin.php';
$admin = admin_user();
$title = ['dashboard' => 'Admin Dashboard', 'lender-applications' => 'Lender Applications', 'approved-lenders' => 'Approved Lenders'][$adminPage];
$rows = admin_list($adminPage === 'approved-lenders', $adminPage === 'dashboard');
$counts = db("SELECT COUNT(*) AS total,COALESCE(SUM(u.account_status='approved'),0) AS approved,COALESCE(SUM(u.account_status='rejected'),0) AS rejected FROM users u LEFT JOIN lender_submissions s ON s.user_id=u.user_id WHERE u.user_type_id=1 AND u.account_status<>'incomplete' AND s.deleted_at IS NULL")->get_result()->fetch_assoc();
?><!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?= e($title) ?> | Utang Wise</title>
    <link rel="stylesheet" href="../assets/css/admin-flow.css">
    <?php uw_role_design_assets('admin', $adminPage); ?>
</head>

<body>
    <div class="dashboard-layout">
        <aside class="sidebar" id="sidebar"><button type="button" class="view-btn" id="sidebarClose">Close menu</button>
            <div class="brand">
                <div class="brand-icon"><img src="../assets/logo/utangwiselogo.png" alt="Utang Wise"></div>
                <div class="brand-text">
                    <h2>UTANG WISE</h2><span>LENDING MADE SIMPLE</span>
                </div>
            </div>
            <nav class="sidebar-menu">
                <?php foreach (['dashboard' => 'Dashboard', 'lender-applications' => 'Lender Applications', 'approved-lenders' => 'Approved Lenders'] as $key => $name): ?><a
                        class="menu-item <?= $adminPage === $key ? 'active' : '' ?>"
                        href="<?= e($key) ?>.php"><?= e($name) ?></a><?php endforeach; ?></nav>
            <div class="sidebar-divider"></div>
            <form method="post" action="logout.php"><?php csrf(); ?><button class="menu-item admin-logout"
                    type="submit">Log out</button></form>
        </aside>
        <main class="main-area">
            <header class="topbar"><button class="view-btn" id="menuToggle" type="button" aria-expanded="false"
                    aria-controls="sidebar">Menu</button>
                <div class="top-user">
                    <div class="admin-notifications"><button id="notificationsToggle" type="button" class="view-btn"
                            aria-expanded="false">Notifications <span id="notificationCount">0</span></button>
                        <section id="notificationsPanel" hidden aria-label="New applications">
                            <h3>New lender applications</h3>
                            <div id="notificationsList"></div>
                            <p id="notificationError" role="status"></p>
                        </section>
                    </div>
                    <div class="top-user-text">
                        <strong><?= e($admin['user_fn'] . ' ' . $admin['user_ln']) ?></strong><span>Super Admin</span></div>
                </div>
            </header>
            <div class="dashboard-body">
                <section class="page-heading">
                    <h1><?= e($title) ?></h1>
                    <p><?= $adminPage === 'dashboard' ? 'Overview of submitted lender applications.' : ($adminPage === 'approved-lenders' ? 'Search and manage approved lender profiles.' : 'Review submitted requirements and send application decisions.') ?>
                    </p>
                </section>
                <p id="adminFeedback" role="status" aria-live="polite"></p>
                <?php if ($adminPage === 'dashboard'): ?>
                    <section class="stats-grid">
                        <?php foreach (['total' => 'Total Applicants', 'approved' => 'Approved Applicants', 'rejected' => 'Rejected Applicants'] as $key => $label): ?>
                            <article class="stat-card stat-<?= e($key) ?>"><div class="stat-icon"><span class="material-symbols-outlined" aria-hidden="true"><?= ['total'=>'groups','approved'=>'check_circle','rejected'=>'cancel'][$key] ?></span></div>
                                <div class="stat-content">
                                    <h2><?= e($label) ?></h2><strong
                                        data-count="<?= e($key) ?>"><?= number_format($counts[$key]) ?></strong>
                                </div>
                            </article><?php endforeach; ?>
                    </section><?php endif; ?>
                <section class="applications-panel <?= $adminPage === 'approved-lenders' ? 'approved-lenders-panel' : '' ?>">
                    <header class="panel-heading">
                        <div class="panel-heading-text">
                            <h2><?= $adminPage === 'dashboard' ? 'Recent Lender Applicants' : ($adminPage === 'approved-lenders' ? 'List of Approved Lenders' : 'List of Pending Lender Applications') ?>
                            </h2>
                        </div>
                    </header>
                    <?php if ($adminPage !== 'dashboard'): ?>
                        <div class="admin-filters"><label>Search lenders<input type="search" id="lenderSearch"
                                    placeholder="Name, email or phone"></label><?php if ($adminPage === 'lender-applications'): ?><label>Status<select
                                        id="statusFilter">
                                        <option value="">All</option>
                                        <option>Pending</option>
                                        <option>Rejected</option>
                                    </select></label><?php endif; ?></div><?php endif; ?>
                    <div class="table-container">
                        <table id="adminTable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Date Applied</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($rows as $row): ?>
                                    <tr>
                                        <td><?= e($row['user_fn'] . ' ' . $row['user_ln']) ?></td>
                                        <td><?= e($row['email']) ?></td>
                                        <td><?= e($row['phone']) ?></td>
                                        <td><?= $row['submitted_at'] ? e(date('M j, Y', strtotime($row['submitted_at']))) : 'Not recorded' ?>
                                        </td>
                                        <td><span
                                                class="status-badge status-<?= e($row['account_status']) ?>"><?= e(ucfirst($row['account_status'])) ?></span>
                                        </td>
                                        <td><button class="view-btn" type="button"
                                                data-view="<?= (int) $row['user_id'] ?>">View</button></td>
                                    </tr><?php endforeach; ?>
                            </tbody>
                        </table><?php if (!$rows && $adminPage === 'dashboard'): ?>
                            <p class="admin-empty">No lender applications yet.</p><?php endif; ?>
                    </div>
                </section>
            </div>
        </main>
    </div>
    <dialog id="adminModal" aria-labelledby="modalTitle">
        <header class="modal-heading">
            <h2 id="modalTitle">Application Details</h2><button id="closeAdminModal" type="button"
                class="view-btn">Close</button>
        </header>
        <div id="adminModalBody"></div>
    </dialog>
    <script type="application/json"
        id="adminConfig"><?= json_encode(['csrf' => $_SESSION['csrf'], 'page' => $adminPage], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?></script>
    <script src="../assets/js/datatables.min.js"></script>
    <script src="../assets/js/admin-flow.js?v=20261010"></script>
    <?php if (function_exists('uw_success_assets'))
        uw_success_assets(); ?>
</body>

</html>

<?php
session_start();

/*
|--------------------------------------------------------------------------
| TEMPORARY PROFILE DATA
|--------------------------------------------------------------------------
| Later, replace this array with database data using $_SESSION['user_id'].
*/

$user = [
    'name' => 'Juan Dela Cruz',
    'role' => 'Client',
    'email' => 'juan@email.com',
    'phone' => '+63 912 345 6789',
    'address' => '123 Mabini St., Manila',
    'member_since' => 'July 10, 2025',

    'dob' => 'April 15, 2000',
    'age' => '25 years old',
    'gender' => 'Male',
    'civil_status' => 'Single',
    'nationality' => 'Filipino',
    'street' => '123 Mabini St.',
    'barangay' => 'Barangay 5',
    'city' => 'Manila',
    'province' => 'Metro Manila',
    'zip' => '1000',

    'employment_status' => 'Employed',
    'occupation' => 'Marketing Staff',
    'company' => 'ABC Corporation',
    'monthly_income' => '₱25,000',
    'other_income' => '₱0',

    'reference_name' => 'Maria Santos',
    'reference_relationship' => 'Sister',
    'reference_phone' => '+63 918 765 4321',

    'personal_status' => 'Completed',
    'financial_status' => 'Completed',
    'reference_status' => 'Completed',
    'id_status' => 'Completed',
    'account_status' => 'Verified',

    'account_type' => 'Client',
    'account_id' => 'C-20250710-001',
    'email_verified' => 'Yes',
    'profile_updated' => 'September 10, 2025'
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

    <title>My Profile | Utang Wise</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">

    <link rel="stylesheet" href="css/profile.css">
</head>

<body>

<div class="client-layout">

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

            <a href="profile.php" class="menu-item active">
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
            <a href="logout.php" class="menu-item">
                <span class="material-symbols-outlined">logout</span>
                <span>Log Out</span>
            </a>
        </div>

    </aside>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <main class="main-content">

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

                <span class="material-symbols-outlined dropdown-icon">keyboard_arrow_down</span>

            </div>

        </header>

        <section class="page-content">

            <div class="breadcrumb">
                <span>Home</span>
                <span>›</span>
                <strong>Profile</strong>
            </div>

            <div class="page-heading">

                <div>
                    <h1>My Profile</h1>
                    <p>View and manage your personal information.</p>
                </div>

                <a href="edit-profile.php" class="edit-profile-btn">
                    <span class="material-symbols-outlined">edit</span>
                    Edit Profile
                </a>

            </div>

            <section class="profile-summary-card">

                <div class="profile-identity">

                    <div class="profile-avatar-large">
                        <?= htmlspecialchars(initials($user['name'])) ?>

                        <span class="avatar-edit">
                            <span class="material-symbols-outlined">photo_camera</span>
                        </span>
                    </div>

                    <div class="identity-text">

                        <div class="name-row">
                            <h2><?= htmlspecialchars($user['name']) ?></h2>

                            <span class="verified-badge">
                                <span class="material-symbols-outlined">verified</span>
                                Verified Account
                            </span>
                        </div>

                        <p><?= htmlspecialchars($user['role']) ?></p>

                        <span>
                            Member since <?= htmlspecialchars($user['member_since']) ?>
                        </span>

                    </div>

                </div>

                <div class="summary-divider"></div>

                <div class="profile-contact">

                    <p>
                        <span class="material-symbols-outlined">mail</span>
                        <?= htmlspecialchars($user['email']) ?>
                    </p>

                    <p>
                        <span class="material-symbols-outlined">call</span>
                        <?= htmlspecialchars($user['phone']) ?>
                    </p>

                    <p>
                        <span class="material-symbols-outlined">location_on</span>
                        <?= htmlspecialchars($user['address']) ?>
                    </p>

                </div>

                <div class="member-card">

                    <div class="member-icon">
                        <span class="material-symbols-outlined">calendar_month</span>
                    </div>

                    <div>
                        <span>Member since</span>
                        <strong><?= htmlspecialchars($user['member_since']) ?></strong>
                        <p>Thank you for being part of Utang Wise!</p>
                    </div>

                </div>

            </section>

            <div class="profile-columns">

                <!-- COLUMN 1 -->
                <section class="info-card personal-card">

                    <div class="card-heading">

                        <div class="card-title">
                            <div class="title-icon gold-icon">
                                <span class="material-symbols-outlined">person</span>
                            </div>

                            <h2>Personal Details</h2>
                        </div>

                        <a href="edit-profile.php" class="mini-edit">
                            <span class="material-symbols-outlined">edit</span>
                            Edit
                        </a>

                    </div>

                    <div class="detail-list">

                        <div class="detail-row">
                            <span>Full Name</span>
                            <strong><?= htmlspecialchars($user['name']) ?></strong>
                        </div>

                        <div class="detail-row">
                            <span>Date of Birth</span>
                            <strong><?= htmlspecialchars($user['dob']) ?></strong>
                        </div>

                        <div class="detail-row">
                            <span>Age</span>
                            <strong><?= htmlspecialchars($user['age']) ?></strong>
                        </div>

                        <div class="detail-row">
                            <span>Gender</span>
                            <strong><?= htmlspecialchars($user['gender']) ?></strong>
                        </div>

                        <div class="detail-row">
                            <span>Civil Status</span>
                            <strong><?= htmlspecialchars($user['civil_status']) ?></strong>
                        </div>

                        <div class="detail-row">
                            <span>Nationality</span>
                            <strong><?= htmlspecialchars($user['nationality']) ?></strong>
                        </div>

                        <div class="detail-row">
                            <span>Phone Number</span>
                            <strong><?= htmlspecialchars($user['phone']) ?></strong>
                        </div>

                        <div class="detail-row">
                            <span>Email Address</span>
                            <strong><?= htmlspecialchars($user['email']) ?></strong>
                        </div>

                        <div class="detail-row">
                            <span>House No. / Street</span>
                            <strong><?= htmlspecialchars($user['street']) ?></strong>
                        </div>

                        <div class="detail-row">
                            <span>Barangay</span>
                            <strong><?= htmlspecialchars($user['barangay']) ?></strong>
                        </div>

                        <div class="detail-row">
                            <span>City / Municipality</span>
                            <strong><?= htmlspecialchars($user['city']) ?></strong>
                        </div>

                        <div class="detail-row">
                            <span>Province</span>
                            <strong><?= htmlspecialchars($user['province']) ?></strong>
                        </div>

                        <div class="detail-row">
                            <span>ZIP Code</span>
                            <strong><?= htmlspecialchars($user['zip']) ?></strong>
                        </div>

                    </div>

                </section>

                <!-- COLUMN 2 -->
                <div class="stack-column">

                    <section class="info-card financial-card">

                        <div class="card-heading">

                            <div class="card-title">
                                <div class="title-icon blue-icon">
                                    <span class="material-symbols-outlined">credit_card</span>
                                </div>

                                <h2>Financial Details</h2>
                            </div>

                            <a href="edit-profile.php" class="mini-edit">
                                <span class="material-symbols-outlined">edit</span>
                                Edit
                            </a>

                        </div>

                        <div class="detail-list">

                            <div class="detail-row">
                                <span>Employment Status</span>
                                <strong><?= htmlspecialchars($user['employment_status']) ?></strong>
                            </div>

                            <div class="detail-row">
                                <span>Occupation</span>
                                <strong><?= htmlspecialchars($user['occupation']) ?></strong>
                            </div>

                            <div class="detail-row">
                                <span>Company / Business</span>
                                <strong><?= htmlspecialchars($user['company']) ?></strong>
                            </div>

                            <div class="detail-row">
                                <span>Monthly Income</span>
                                <strong><?= htmlspecialchars($user['monthly_income']) ?></strong>
                            </div>

                            <div class="detail-row">
                                <span>Other Income (Optional)</span>
                                <strong><?= htmlspecialchars($user['other_income']) ?></strong>
                            </div>

                        </div>

                    </section>

                    <section class="info-card reference-card">

                        <div class="card-heading">

                            <div class="card-title">
                                <div class="title-icon purple-icon">
                                    <span class="material-symbols-outlined">group</span>
                                </div>

                                <h2>Reference Person</h2>
                            </div>

                            <a href="edit-profile.php" class="mini-edit">
                                <span class="material-symbols-outlined">edit</span>
                                Edit
                            </a>

                        </div>

                        <div class="detail-list">

                            <div class="detail-row">
                                <span>Name</span>
                                <strong><?= htmlspecialchars($user['reference_name']) ?></strong>
                            </div>

                            <div class="detail-row">
                                <span>Relationship</span>
                                <strong><?= htmlspecialchars($user['reference_relationship']) ?></strong>
                            </div>

                            <div class="detail-row">
                                <span>Phone Number</span>
                                <strong><?= htmlspecialchars($user['reference_phone']) ?></strong>
                            </div>

                        </div>

                    </section>

                </div>

                <!-- COLUMN 3 -->
                <div class="stack-column">

                    <section class="info-card verification-card">

                        <div class="card-heading">

                            <div class="card-title">
                                <div class="title-icon green-icon">
                                    <span class="material-symbols-outlined">verified_user</span>
                                </div>

                                <h2>Verification Status</h2>
                            </div>

                        </div>

                        <div class="verification-list">

                            <div class="verification-row">
                                <span class="material-symbols-outlined">check_circle</span>
                                <strong>Personal Details</strong>
                                <em><?= htmlspecialchars($user['personal_status']) ?></em>
                            </div>

                            <div class="verification-row">
                                <span class="material-symbols-outlined">check_circle</span>
                                <strong>Financial Details</strong>
                                <em><?= htmlspecialchars($user['financial_status']) ?></em>
                            </div>

                            <div class="verification-row">
                                <span class="material-symbols-outlined">check_circle</span>
                                <strong>Reference Person</strong>
                                <em><?= htmlspecialchars($user['reference_status']) ?></em>
                            </div>

                            <div class="verification-row">
                                <span class="material-symbols-outlined">check_circle</span>
                                <strong>Valid ID & Selfie</strong>
                                <em><?= htmlspecialchars($user['id_status']) ?></em>
                            </div>

                            <div class="verification-row">
                                <span class="material-symbols-outlined">check_circle</span>
                                <strong>Account Verification</strong>
                                <em><?= htmlspecialchars($user['account_status']) ?></em>
                            </div>

                        </div>

                    </section>

                    <section class="info-card account-card">

                        <div class="card-heading">

                            <div class="card-title">
                                <div class="title-icon orange-icon">
                                    <span class="material-symbols-outlined">description</span>
                                </div>

                                <h2>Account Information</h2>
                            </div>

                        </div>

                        <div class="detail-list">

                            <div class="detail-row">
                                <span>Account Type</span>
                                <strong><?= htmlspecialchars($user['account_type']) ?></strong>
                            </div>

                            <div class="detail-row">
                                <span>Account ID</span>
                                <strong><?= htmlspecialchars($user['account_id']) ?></strong>
                            </div>

                            <div class="detail-row">
                                <span>Email Verified</span>
                                <strong><?= htmlspecialchars($user['email_verified']) ?></strong>
                            </div>

                            <div class="detail-row">
                                <span>Profile Last Updated</span>
                                <strong><?= htmlspecialchars($user['profile_updated']) ?></strong>
                            </div>

                        </div>

                    </section>

                </div>

            </div>

        </section>

    </main>

</div>

<script>
    const mobileMenuBtn = document.getElementById("mobileMenuBtn");
    const sidebar = document.getElementById("sidebar");
    const sidebarOverlay = document.getElementById("sidebarOverlay");

    if (mobileMenuBtn && sidebar && sidebarOverlay) {

        mobileMenuBtn.addEventListener("click", function () {
            sidebar.classList.toggle("open");
            sidebarOverlay.classList.toggle("show");
        });

        sidebarOverlay.addEventListener("click", function () {
            sidebar.classList.remove("open");
            sidebarOverlay.classList.remove("show");
        });

    }
</script>

</body>
</html>

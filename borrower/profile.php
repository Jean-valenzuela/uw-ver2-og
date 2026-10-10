<?php require_once __DIR__.'/../helpers/borrower_portal.php'; $borrowerAccount = borrower_user(); ?>
<?php




$p = profile($borrowerAccount['user_id']);
$personal = $p['personal-details'] ?? [];
$financial = $p['financial-details'] ?? [];
$reference = $p['reference-person'] ?? [];
$complete = borrower_complete($borrowerAccount['user_id'], $p);
$user = array_fill_keys(['name','role','email','phone','address','member_since','dob','age','gender','civil_status','nationality','street','barangay','city','province','zip','employment_status','occupation','company','monthly_income','other_income','reference_name','reference_relationship','reference_phone','personal_status','financial_status','reference_status','id_status','account_status','account_type','account_id','email_verified','profile_updated'], 'Not provided');
$user = array_merge($user, [
 'name'=>$borrowerAccount['user_fn'].' '.$borrowerAccount['user_ln'], 'role'=>'Borrower',
 'email'=>$borrowerAccount['email'], 'phone'=>'+63 '.preg_replace('/^0/','',$borrowerAccount['phone']),
 'address'=>implode(', ',array_filter(array_intersect_key($personal,array_flip(['street','barangay','city','province','region','zip_code'])))),
 'dob'=>$personal['birth_date'] ?? 'Not provided',
 'age'=>!empty($personal['birth_date']) ? (new DateTimeImmutable($personal['birth_date']))->diff(new DateTimeImmutable('today'))->y.' years old' : 'Not provided',
 'gender'=>$personal['gender'] ?? 'Not provided', 'civil_status'=>$personal['civil_status'] ?? 'Not provided',
 'nationality'=>$personal['nationality'] ?? 'Not provided', 'street'=>$personal['street'] ?? 'Not provided',
 'barangay'=>$personal['barangay'] ?? 'Not provided', 'city'=>$personal['city'] ?? 'Not provided',
 'province'=>$personal['province'] ?? 'Not provided', 'zip'=>$personal['zip_code'] ?? 'Not provided',
 'employment_status'=>$financial['employment_status'] ?? 'Not provided', 'occupation'=>$financial['job_title'] ?? 'Not provided',
 'company'=>$financial['company'] ?? 'Not provided','monthly_income'=>$financial['gross_income'] ?? 'Not provided',
 'other_income'=>$financial['other_income'] ?? '0', 'reference_name'=>$reference['reference_name'] ?? 'Not provided',
 'reference_relationship'=>$reference['relationship'] ?? 'Not provided', 'reference_phone'=>isset($reference['reference_contact']) ? '+63 '.$reference['reference_contact'] : 'Not provided',
 'personal_status'=>!empty($complete['personal-details']) ? 'Completed' : 'Not completed',
 'financial_status'=>!empty($complete['financial-details']) ? 'Completed' : 'Not completed',
 'reference_status'=>!empty($complete['reference-person']) ? 'Completed' : 'Not completed',
 'id_status'=>document_exists($borrowerAccount['user_id'],'valid_id') ? 'Uploaded' : 'Not uploaded',
 'account_status'=>ucfirst($borrowerAccount['account_status']), 'account_type'=>'Borrower',
 'account_id'=>(string)$borrowerAccount['user_id'], 'email_verified'=>'Not verified',
 'profile_updated'=>(db('SELECT MAX(changed_at) changed FROM borrower_profile_audit WHERE borrower_id=?',[$borrowerAccount['user_id']])->get_result()->fetch_assoc()['changed']??$borrowerAccount['reviewed_at']??'Not recorded'), 'member_since'=>'Not recorded'
]);

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

    <link rel="stylesheet" href="../assets/css/profile.css">
<link rel="stylesheet" href="../assets/css/borrower-flow.css"></head>

<body>

<div class="client-layout">

    <aside class="sidebar" id="sidebar">

        
    <div class="brand">

        <div class="brand-icon">
            <img src="../assets/logo/utangwiselogo.png" alt="Utang Wise Logo">
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
            <?php borrower_logout_button(); ?>
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

                <a class="notification" href="client-dashboard.php" aria-label="View payment notifications"><span class="material-symbols-outlined">notifications</span><span><?= count(borrower_notices($borrowerAccount['user_id'])) ?></span></a>

                <div class="user-avatar">
                    <?php if(document_exists($borrowerAccount['user_id'],'profile_photo')): ?><img src="../ajax/borrower_document.php?kind=profile_photo" alt="Your profile picture" style="width:100%;height:100%;object-fit:cover;border-radius:50%"><?php else: ?><?= htmlspecialchars(initials($user['name'])) ?><?php endif; ?>
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
                        <?php if(document_exists($borrowerAccount['user_id'],'profile_photo')): ?><img src="../ajax/borrower_document.php?kind=profile_photo" alt="Your profile picture" style="width:100%;height:100%;object-fit:cover;border-radius:50%"><?php else: ?><?= htmlspecialchars(initials($user['name'])) ?><?php endif; ?>

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
                                <strong>Valid ID</strong>
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

    <section class="uw-review-card"><?php notice(); ?><h2>Submitted requirements</h2><?php foreach(['idverification'=>'Identification','personal-details'=>'Personal details','financial-details'=>'Financial details','reference-person'=>'Reference person'] as $section=>$title): ?><p><a href="edit-profile.php?section=<?= e($section) ?>">Edit <?= e($title) ?></a></p><?php endforeach; foreach(['valid_id'=>'Government ID','coe'=>'Certificate of employment','profile_photo'=>'Profile picture'] as $kind=>$title)if(document_exists($borrowerAccount['user_id'],$kind)): ?><p><a href="../ajax/borrower_document.php?kind=<?= e($kind) ?>">View <?= e($title) ?></a></p><?php endif; ?><?php foreach($p as $section=>$values): if(!is_array($values)||$section==='agreements')continue; ?><details style="margin:16px 0"><summary><?= e(ucwords(str_replace('-',' ',$section))) ?> — submitted details</summary><table style="width:100%;border-collapse:collapse"><?php foreach($values as $key=>$value): if($key==='profile_photo_required'||!is_scalar($value))continue; ?><tr><th style="padding:8px;text-align:left"><?= e(ucwords(str_replace('_',' ',$key))) ?></th><td style="padding:8px"><?= e($value===''?'Not provided':$value) ?></td></tr><?php endforeach; ?></table></details><?php endforeach; ?><p>Your signed agreements and approved loan terms stay unchanged when you edit your profile.</p></section></main>

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

<?php if(function_exists('uw_success_assets'))uw_success_assets(); ?></body>
</html>

<?php $step='verifyacc'; require __DIR__.'/../../ajax/profiling_page.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Verify Account | Utang Wise</title>

    <link rel="stylesheet" href="../../assets/css/verifyacc.css">

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
<link rel="stylesheet" href="../../assets/css/borrower-flow.css"></head>

<body>

<div class="verify-layout">

    <!-- SIDEBAR -->
    <aside class="sidebar">

        <div class="brand">
            <div class="brand-icon">₱</div>

            <div>
                <h2>UTANG WISE</h2>
                <span>wala ak maisip omygod..</span>
            </div>
        </div>


        <div class="progress-list">

            <div class="progress-item completed">
                <div class="progress-dot">
                    <span class="material-symbols-outlined">
                        check
                    </span>
                </div>

                <!-- pwede idelete di ko pa kc maimagine whaaha yok -->
                <div class="progress-text">
                    <h3>Account Created</h3>
                    <p>
                        Your account has been
                        successfully created.
                    </p>
                </div>
            </div>


            <div class="progress-item active">

                <div class="progress-dot"></div>

                <div class="progress-text">
                    <h3>Verify Account</h3>
                    <p>
                        Complete the steps below
                        to verify your identity
                        and finish your profile.
                    </p>
                </div>

            </div>


            <div class="progress-item">
                <div class="progress-dot"></div>

                <div class="progress-text">
                    <h3>Personal Details</h3>
                </div>
            </div>


            <div class="progress-item">
                <div class="progress-dot"></div>

                <div class="progress-text">
                    <h3>Financial Details</h3>
                </div>
            </div>

              <!-- REFERENCE -->
            <div class="progress-item">

                <div class="progress-dot"></div>

                <div class="progress-text">
                    <h3>Reference Person</h3>
                </div>

            </div>


            <div class="progress-item">
                <div class="progress-dot"></div>

                <div class="progress-text">
                    <h3>Loan Preferences</h3>
                </div>
            </div>


            


            <div class="progress-item last">
                <div class="progress-dot"></div>

                <div class="progress-text">
                    <h3>Ready for Review</h3>
                </div>
            </div>

        </div>


        <div class="security-box">

            <div class="security-icon">
                <span class="material-symbols-outlined">
                    shield
                </span>
            </div>

            <div>
                <h4>Your data is safe and secure.</h4>

                <p>
                    We use industry-standard
                    security to protect your
                    information.
                </p>
            </div>

        </div>

    </aside>



    <!-- MAIN AREA -->
    <main class="main-content">

        <!-- TOPBAR -->
        <header class="topbar">

            <div class="topbar-space"></div>

            <?php borrower_logout_button(); ?><div class="user-area">

                <span>
                    Welcome,
                    <strong><?= e($u['user_fn']) ?></strong>
                </span>

                <span class="material-symbols-outlined">
                    keyboard_arrow_down
                </span>

             <!--   <span class="material-symbols-outlined notification-icon">
                    notifications
                </span> -->

                <div class="user-circle">
                    <span class="material-symbols-outlined">
                        person
                    </span>
                </div>

            </div>

        </header>


        <section class="page-content">

            <!-- HERO -->
            <div class="verify-hero">

                <div class="hero-copy">

                    <span class="step-label">
                        COMPLETE YOUR PROFILE
                    </span>

                    <h1>
                        Verify your account
                    </h1>

                    <p>
                        Help us keep your account secure and provide you
                        with the best lending experience. Please complete
                        the following steps.
                    </p>

                </div>

<!--
                <div class="hero-illustration">

                    <div class="cream-shape"></div>

                    <div class="person-head"></div>
                    <div class="person-hair"></div>
                    <div class="person-body"></div>

                    <div class="clipboard">
                        <span class="material-symbols-outlined">
                            checklist
                        </span>
                    </div>

                    <div class="shield">
                        <span class="material-symbols-outlined">
                            lock
                        </span>
                    </div>

                </div>
--> 
            </div>



            <!-- CARDS -->
            <div class="verify-grid">


                <!-- 1 -->
                <article class="verify-card <?= !empty($complete['idverification']) ? 'uw-completed' : '' ?>">

                    <div class="card-top">

                        <div class="card-icon">
                            <span class="material-symbols-outlined">
                                badge
                            </span>
                        </div>

                        <div class="card-copy">
                            <h2>
                                1. ID Verification
                            </h2>

                            <p>
                                Upload a clear photo of your valid
                                government-issued ID to verify your identity.
                            </p>
                        </div>

                    </div>

                    <a href="idverification.php" class="card-button">

                        <span class="material-symbols-outlined">
                            upload
                        </span>

                        Upload ID

                    </a>

                <p class="uw-step-status"><?= !empty($complete['idverification']) ? '✓ Completed' : 'Not completed' ?></p></article>



                <!-- 2 -->
                <article class="verify-card <?= !empty($complete['personal-details']) ? 'uw-completed' : '' ?>">

                    <div class="card-top">

                        <div class="card-icon">
                            <span class="material-symbols-outlined">
                                person
                            </span>
                        </div>

                        <div class="card-copy">
                            <h2>
                                2. Personal Information
                            </h2>

                            <p>
                                Provide your basic personal details
                                to complete your profile.
                            </p>
                        </div>

                    </div>

                    <a href="personal-details.php" class="card-button">

                        <span class="material-symbols-outlined">
                            person_add
                        </span>

                        Complete

                        <span class="material-symbols-outlined arrow">
                            chevron_right
                        </span>

                    </a>

                <p class="uw-step-status"><?= !empty($complete['personal-details']) ? '✓ Completed' : 'Not completed' ?></p></article>



                <!-- 3 -->
                <article class="verify-card <?= !empty($complete['financial-details']) ? 'uw-completed' : '' ?>">

                    <div class="card-top">

                        <div class="card-icon">
                            <span class="material-symbols-outlined">
                                account_balance_wallet
                            </span>
                        </div>

                        <div class="card-copy">
                            <h2>
                                3. Financial Information
                            </h2>

                            <p>
                                Tell us about your source of income,
                                occupation, and monthly income.
                            </p>
                        </div>

                    </div>

                    <a href="financial-details.php" class="card-button">

                        <span class="material-symbols-outlined">
                            description
                        </span>

                        Complete

                        <span class="material-symbols-outlined arrow">
                            chevron_right
                        </span>

                    </a>

                <p class="uw-step-status"><?= !empty($complete['financial-details']) ? '✓ Completed' : 'Not completed' ?></p></article>



                <!-- 4 -->
                <article class="verify-card <?= !empty($complete['reference-person']) ? 'uw-completed' : '' ?>">

                    <div class="card-top">

                        <div class="card-icon">
                            <span class="material-symbols-outlined">
                                group
                            </span>
                        </div>

                        <div class="card-copy">
                            <h2>
                                4. Reference Person
                            </h2>

                            <p>
                                Provide a reference person that
                                we can contact for verification.
                            </p>
                        </div>

                    </div>

                    <a href="reference-person.php" class="card-button">

                        <span class="material-symbols-outlined">
                            person_add
                        </span>

                        Add details

                        <span class="material-symbols-outlined arrow">
                            chevron_right
                        </span>

                    </a>

                <p class="uw-step-status"><?= !empty($complete['reference-person']) ? '✓ Completed' : 'Not completed' ?></p></article>



                <!-- 5 -->
                <article class="verify-card <?= !empty($complete['loan-preferences']) ? 'uw-completed' : '' ?>">

                    <div class="card-top">

                        <div class="card-icon">
                            <span class="material-symbols-outlined">
                                payments
                            </span>
                        </div>

                        <div class="card-copy">
                            <h2>
                                5. Loan Preferences
                            </h2>

                            <p>
                                Set your starting loan amount
                                up to ₱3,000 and select your loan purpose.
                            </p>
                        </div>

                    </div>

                    <a href="loan-preferences.php" class="card-button">

                        <span class="material-symbols-outlined">
                            tune
                        </span>

                        Set up

                        <span class="material-symbols-outlined arrow">
                            chevron_right
                        </span>

                    </a>

                <p class="uw-step-status"><?= !empty($complete['loan-preferences']) ? '✓ Completed' : 'Not completed' ?></p></article>



                <!-- 6 -->
                


            </div>



            <!-- BOTTOM SUPPORT -->
            <p><a href="ready-for-review.php" class="card-button">Ready for Review →</a></p><div class="support-bar">

                <div class="support-item">

                    <div class="support-icon">
                        <span class="material-symbols-outlined">
                            lock
                        </span>
                    </div>

                    <div>
                        <h3>
                            We're committed to responsible lending.
                        </h3>

                        <p>
                            All information you provide will be used
                            solely for verification and evaluation.
                        </p>
                    </div>

                </div>


        </section>

    </main>

</div>

</body>
</html>
<?php $step = 'idverification'; require __DIR__.'/../../ajax/profiling_page.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ID Verification | Utang Wise</title>

    <link rel="stylesheet" href="../../assets/css/idverification.css">

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
<link rel="stylesheet" href="../../assets/css/borrower-flow.css"></head>

<body>

<div class="verify-layout">

    <!-- SIDEBAR -->
    <aside class="sidebar">

        <div class="brand">

            <div class="brand-icon">
                ₱
            </div>

            <div>
                <h2>UTANG WISE</h2>
                <span>LENDING MADE SIMPLE</span>
            </div>

        </div>


        <div class="progress-list">

            <div class="progress-item completed">

                <div class="progress-dot">
                    <span class="material-symbols-outlined">
                        check
                    </span>
                </div>

                <div class="progress-text">
                    <h3>Account Created</h3>

                    <p>
                        Your account has been
                        successfully created.
                    </p>
                </div>

            </div>


            <div class="progress-item completed">

                <div class="progress-dot">
                    <span class="material-symbols-outlined">
                        check
                    </span>
                </div>

                <div class="progress-text">
                    <h3>Verify Account</h3>

                    <p>
                        Complete the steps below
                        to verify your identity and
                        finish your profile.
                    </p>
                </div>

            </div>

             <div class="progress-item active">
                <div class="progress-dot"></div>

                <div class="progress-text">
                    <h3>ID Verification</h3>
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

            <span class="material-symbols-outlined">
                shield
            </span>

            <div>
                <h4>Your data is safe and secure.</h4>

                <p>
                    safe like for reaal hahaha hahaahjdjwadajd
                </p>
            </div>

        </div>

    </aside>



    <!-- MAIN -->
    <main class="main-content">

        <!-- TOP BAR -->
        <header class="topbar">

            <div class="topbar-space"></div>

            <?php borrower_logout_button(); ?><div class="user-area">

                <span>
                    Welcome,
                    <strong><?= e($u['user_fn'].' '.$u['user_ln']) ?></strong>
                </span>

                <span class="material-symbols-outlined">
                    keyboard_arrow_down
                </span>

                <span class="material-symbols-outlined notification">
                    notifications
                </span>

                <div class="user-circle">
                    <span class="material-symbols-outlined">
                        person
                    </span>
                </div>

            </div>

        </header>



        <section class="page-content">

            <!-- HERO -->
            <div class="page-hero">

                <div class="hero-copy">

                    <span class="step-label">
                        STEP 1 OF 5
                    </span>

                    <a href="verifyacc.php" class="back-link">
                        <span class="material-symbols-outlined">
                            arrow_back
                        </span>

                        Back to verification
                    </a>

                    <h1>ID Verification</h1>

                    <p>
                        Upload a clear photo of your valid government-issued ID
                        to verify your identity.
                    </p>

                </div>


             

            </div>



            <!-- BODY -->
            <div class="verification-body">

                <!-- LEFT LARGE PANEL -->
                <section class="upload-panel"><form action="../../ajax/save_borrower.php" method="POST" enctype="multipart/form-data" data-borrower-form><?php csrf(); notice(); ?><input type="hidden" name="step" value="idverification">

                    <h2>
                        1. Upload Your ID
                    </h2>


                    <p class="section-label">
                        Accepted ID Types
                    </p>


                    <input type="hidden" name="id_type" required value="<?= e($values['id_type'] ?? '') ?>"><div class="id-types">

                        <button type="button" class="id-type active">

                            <span class="material-symbols-outlined">
                                passport
                            </span>

                            <span>Passport</span>

                        </button>


                        <button type="button" class="id-type">

                            <span class="material-symbols-outlined">
                                badge
                            </span>

                            <span>Driver's License</span>

                        </button>


                        <button type="button" class="id-type">

                            <span class="material-symbols-outlined">
                                id_card
                            </span>

                            <span>UMID / SSS ID</span>

                        </button>


                        <button type="button" class="id-type">

                            <span class="material-symbols-outlined">
                                id_card
                            </span>

                            <span>National ID</span>

                        </button>


                        <button type="button" class="id-type">

                            <span class="material-symbols-outlined">
                                id_card
                            </span>

                            <span>Voter's ID</span>

                        </button>

                    </div>



                    <p class="section-label upload-label">
                        Upload ID
                    </p>


                    <!-- FILE PREVIEW STATE -->
                    <div class="upload-box"><label for="valid_id">Select your ID file</label><input type="file" id="valid_id" name="valid_id" accept=".png,.jpg,.jpeg,.pdf"><p class="uw-file-status"><?php if(document_exists($u['user_id'],'valid_id')): ?>Your ID is saved. Choose a file only to replace it.<?php else: ?>No ID uploaded yet.<?php endif; ?></p></div><div class="file-note">

                        <p>
                            Make sure the ID is clear, not blurry,
                            and all details are visible.
                        </p>

                        <span>
                            File format: JPG, PNG, PDF
                        </span>

                        <span class="dot">•</span>

                        <span>
                            Max file size: 5MB
                        </span>

                    </div>



                    <!-- TIPS -->
                    <div class="tips-box">

                        <div class="tips-icon">

                            <span class="material-symbols-outlined">
                                lightbulb
                            </span>

                        </div>

                        <div class="tips-content">

                            <h3>
                                Tips for a successful upload
                            </h3>

                            <div class="tips-grid">

                                <p>✓ Use a well-lit area</p>
                                <p>✓ Avoid glare or shadows</p>
                                <p>✓ Ensure all corners of the ID are visible</p>
                                <p>✓ Make sure text is clear and readable</p>

                            </div>

                        </div>

                    </div>



                    <!-- ACTION BUTTONS -->
                    <div class="panel-actions">

                        <a href="verifyacc.php" class="back-button">

                            <span class="material-symbols-outlined">
                                arrow_back
                            </span>

                            Back

                        </a>


                        <button type="submit" class="continue-button">

                            Continue

                            <span class="material-symbols-outlined">
                                arrow_forward
                            </span>

                        </button>

                    </div>

                </form></section>



                <!-- RIGHT INFO PANEL -->
                <aside class="why-panel">

                    <div class="why-icon">

                        <span class="material-symbols-outlined">
                            shield_lock
                        </span>

                    </div>

                    <h2>
                        Why do we need your ID?
                    </h2>

                    <p class="why-description">
                        We use your ID to verify your identity
                        and help prevent fraud. Your information
                        is secure with us.
                    </p>


                    <div class="info-list">

                        <div class="info-item">

                            <div class="info-icon">

                                <span class="material-symbols-outlined">
                                    description
                                </span>

                            </div>

                            <div>
                                <h3>Secure Verification</h3>

                                <p>
                                    Your ID is encrypted and
                                    stored securely.
                                </p>
                            </div>

                        </div>


                        <div class="info-item">

                            <div class="info-icon">

                                <span class="material-symbols-outlined">
                                    visibility_off
                                </span>

                            </div>

                            <div>
                                <h3>Private & Confidential</h3>

                                <p>
                                    Your information is handled
                                    only for verification purposes.
                                </p>
                            </div>

                        </div>


                        <div class="info-item">

                            <div class="info-icon">

                                <span class="material-symbols-outlined">
                                    shield
                                </span>

                            </div>

                            <div>
                                <h3>Fraud Protection</h3>

                                <p>
                                    Helps us protect you and our
                                    community from fraud.
                                </p>
                            </div>

                        </div>

                    </div>

                </aside>

            </div>

        </section>

    </main>

</div>

<script type="application/json" id="uw-profile-data"><?= json_encode($values, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?></script><script src="../../assets/js/borrower-profiling.js" defer></script></body>
</html>
<?php require __DIR__."/ajax/app.php"; 
$approved=db("SELECT user_id,user_fn,user_ln FROM users WHERE user_type_id=1 AND account_status='approved' ORDER BY user_id DESC")->get_result(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Our Lenders | Utang Wise</title>

    <!-- GOOGLE FONTS -->
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap"
        rel="stylesheet"
    >

    <!-- MATERIAL SYMBOLS -->
    <link
        rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"
    >

    <!-- CSS -->
    <link
        rel="stylesheet"
        href="<?= e(base_url()) ?>/assets/css/lender.css?v=<?= filemtime(__DIR__.'/assets/css/lender.css') ?>"
    >
<style>.lender-symbol{font-family:Arial,sans-serif;display:inline-flex;align-items:center;justify-content:center;min-width:16px;font-size:16px;color:inherit}.verified-badge .lender-symbol{color:#cb8f22}.lender-photo-placeholder{height:100%;display:grid;place-items:center;font:700 64px Georgia,serif;color:#062347;background:linear-gradient(145deg,#f8e5c4,#e0e8f0)}.lender-description{min-height:45px}</style></head>

<body>


<!-- =====================================================
     NAVBAR
====================================================== -->

<header class="main-header">

    <nav class="navbar">

        <!-- BRAND -->
        <a
            href="index.php"
            class="nav-brand"
        >
            <img
                src="assets/logo/utangwiselogo.png"
                alt="Utang Wise Logo"
            >

            <div class="brand-text">
                <strong>UTANG WISE</strong>
                <span>SMART LENDING. BRIGHTER FUTURES.</span>
            </div>
        </a>


        <!-- NAVIGATION -->
        <div class="nav-links">

            <a href="index.php">
                Home
            </a>

            <a href="index.php#about">
                About Us
            </a>

            <a href="index.php#how-it-works">
                How it Works
            </a>

            <a
                href="lenders.php"
                class="active"
            >
                Lenders
            </a>

        </div>


        <!-- ACTIONS -->
        <div class="nav-actions">

            <a
                href="login.php"
                class="login-btn"
            >
                Login
            </a>

            <a
                href="register.php"
                class="register-btn"
            >
                Register
            </a>

        </div>


        <!-- MOBILE MENU BUTTON -->
        <button
            type="button"
            class="mobile-menu-btn"
            id="mobileMenuBtn"
            aria-label="Open navigation"
        >
            <span class="lender-symbol" aria-hidden="true">☰</span>
        </button>

    </nav>


    <!-- MOBILE NAVIGATION -->
    <div
        class="mobile-nav"
        id="mobileNav"
    >

        <a href="index.php">
            Home
        </a>

        <a href="index.php#about">
            About Us
        </a>

        <a href="index.php#how-it-works">
            How it Works
        </a>

        <a
            href="lenders.php"
            class="active"
        >
            Lenders
        </a>

        <div class="mobile-actions">

            <a href="login.php">
                Login
            </a>

            <a
                href="register.php"
                class="mobile-register"
            >
                Register
            </a>

        </div>

    </div>

</header>


<!-- =====================================================
     OUR LENDERS
====================================================== -->

<main>

<section
    class="lenders-section"
    id="lenders"
>

    <div class="lenders-container">


        <!-- SECTION HEADER -->
        <div class="lenders-heading">

            <span class="section-tag">
                OUR LENDERS
            </span>

            <h1>
                Meet Our <span>Lenders</span>
            </h1>

            <div class="heading-line"></div>

            <p>
                Trusted and verified lenders who are ready to
                support your financial needs.
                <br>
                Find a lender that matches your goals.
            </p>

        </div>


        <!-- =================================================
             LENDERS GRID
        ================================================== -->

        <div class="lenders-grid">


            <!-- LENDER 1 -->
            <?php if (!$approved->num_rows): ?><p>No approved lenders are available yet. Please check back soon.</p><?php endif; $cardIndex=0; while ($lender=$approved->fetch_assoc()): $details=profile($lender["user_id"]); ?><article class="lender-card">

                <div class="lender-image">

                    <?php if (!empty($details['requirements']['photo_public']) && document_exists($lender['user_id'],'lender_photo')): ?><img src="controllers/lender-photo.php?id=<?= (int)$lender['user_id'] ?>" alt="<?= e($lender['user_fn'].' '.$lender['user_ln']) ?>" loading="lazy"><?php else: ?><div class="lender-photo-placeholder" aria-label="No public profile photo"><?= e(strtoupper(substr($lender['user_fn'],0,1).substr($lender['user_ln'],0,1))) ?></div><?php endif; ?>

                    <span class="verified-badge">
                        <span class="lender-symbol" aria-hidden="true">✓</span>

                        Verified Lender
                    </span>

                </div>


                <div class="lender-content">

                    <h2><?= e($lender["user_fn"]." ".$lender["user_ln"]) ?></h2>

                    <div class="lender-details">

                        <p>
                            <span class="lender-symbol" aria-hidden="true">▣</span>

                            Approved lender
                        </p>

                        <p>
                            <span class="lender-symbol" aria-hidden="true">₱</span>

                            <?= !empty($details["requirements"]["lending_limit"]) ? "PHP ".e(number_format((float)$details["requirements"]["lending_limit"],2))." lending limit" : "Lending limit not provided" ?>
                        </p>

                        <p>
                            <span class="lender-symbol" aria-hidden="true">♙</span>

                            <?= (int)db("SELECT COUNT(*) AS n FROM users WHERE user_type_id=2 AND selected_lender_id=? AND account_status='approved'",[$lender['user_id']])->get_result()->fetch_assoc()['n'] ?> approved borrowers
                        </p>

                    </div>


                    <div class="lender-divider"></div>


                    <p class="lender-description">Choose this lender to begin your application.</p>


                    <a
                        href="register.php?lender_id=<?= (int)$lender["user_id"] ?>"
                        class="apply-lender-btn <?= $cardIndex++%2 ? 'gold-btn' : 'navy-btn' ?>"
                    >
                        Apply Now

                        <span class="lender-symbol" aria-hidden="true">→</span>
                    </a>

                </div>

            </article><?php endwhile; ?>


            <!-- LENDER 2 -->
            


            <!-- LENDER 3 -->
            


            <!-- LENDER 4 -->
            


            <!-- LENDER 5 -->
            


            <!-- LENDER 6 -->
            


            <!-- LENDER 7 -->
            


            <!-- LENDER 8 -->
            

        </div>

    </div>

</section>

</main>


<!-- =====================================================
     MOBILE NAVIGATION JS
====================================================== -->

<script>
    const mobileMenuBtn = document.getElementById("mobileMenuBtn");
    const mobileNav = document.getElementById("mobileNav");

    mobileMenuBtn.addEventListener("click", function () {
        mobileNav.classList.toggle("show");
    });
</script>

<?php if(function_exists('uw_success_assets'))uw_success_assets(); ?></body>
</html>
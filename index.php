<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Utang Wise</title>

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
        href="assets/css/style.css"
    >
</head>

<body>


<!-- =========================================================
     NAVBAR
========================================================= -->
<!-- =====================================================
     NAVBAR
====================================================== -->

<header class="main-header">

    <nav class="navbar">

        <!-- BRAND -->
        <a
            href="#home"
            class="nav-brand"
        >
            <img
                src="../assets/logo/utangwiselogo.png"
                alt="Utang Wise Logo"
            >

            <div class="brand-text">
                <strong>UTANG WISE</strong>
                <span>SMART LENDING. BRIGHTER FUTURES.</span>
            </div>
        </a>


        <!-- NAVIGATION -->
        <div class="nav-links">

            <a
                href="#home"
            >
                Home
            </a>

            <a href="#about">
                About Us
            </a>

            <a href="#how-it-works">
                How it Works
            </a>

            <a href="lenders.php">
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
                Lender Registration
            </a>

        </div>




        <!-- MOBILE MENU -->
        <button
            type="button"
            class="mobile-menu-btn"
            id="mobileMenuBtn"
            aria-label="Open menu"
        >
            <span class="material-symbols-outlined">
                menu
            </span>
        </button>

    </nav>


    <!-- MOBILE NAV -->
    <div
        class="mobile-nav"
        id="mobileNav"
    >

        <a href="#home">
            Home
        </a>

        <a href="#about">
            About Us
        </a>

        <a href="#how-it-works">
            How It Works
        </a>

        <a href="lenders.php">
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


<main>


<!-- =========================================================
     SECTION 1 — HOME / HERO
========================================================= -->

<section
    class="hero-section"
    id="home"
>

    <div class="hero-container">


        <!-- LEFT -->
        <div class="hero-content">

            <span class="section-tag">
                A SMARTER WAY TO BORROW
            </span>


            <h1>
                Lending that
                <br>

                works <span>for you.</span>
            </h1>


            <p class="hero-description">
                Utang Wise connects you with trusted and verified
                lenders, making it easier to get the financial
                support you need — simple, secure, and hassle-free.
            </p>


            <div class="hero-actions">

                <a
                    href="register.php"
                    class="primary-btn"
                >
                    Get Started as Lender

                    <span class="material-symbols-outlined">
                        arrow_forward
                    </span>
                </a>


                <a
                    href="lenders.php"
                    class="secondary-btn"
                >
                    <span class="material-symbols-outlined">
                        groups
                    </span>

                    Explore Lenders
                </a>

            </div>

        </div>


        <!-- RIGHT -->
        <div class="hero-features">


            <!-- FEATURE 1 -->
            <div class="feature-card">

                <div class="feature-icon">

                    <span class="material-symbols-outlined">
                        schedule
                    </span>

                </div>


                <div>

                    <h3>
                        Flexible Terms
                    </h3>

                    <p>
                        Loan options that fit
                        your needs.
                    </p>

                </div>

            </div>


            <!-- FEATURE 2 -->
            <div class="feature-card">

                <div class="feature-icon">

                    <span class="material-symbols-outlined">
                        groups
                    </span>

                </div>


                <div>

                    <h3>
                        Verified Lenders
                    </h3>

                    <p>
                        Borrow from trusted
                        individuals.
                    </p>

                </div>

            </div>


            <!-- FEATURE 3 -->
            <div class="feature-card">

                <div class="feature-icon">

                    <span class="material-symbols-outlined">
                        forum
                    </span>

                </div>


                <div>

                    <h3>
                        Real Support
                    </h3>

                    <p>
                        People who understand
                        your goals.
                    </p>

                </div>

            </div>

        </div>

    </div>


    <!-- SCROLL INDICATOR -->
    <a
        href="#how-it-works"
        class="scroll-indicator"
        aria-label="Scroll to How It Works"
    >
        <span class="material-symbols-outlined">
            keyboard_arrow_down
        </span>
    </a>

</section>



<!-- =========================================================
     SECTION 2 — HOW IT WORKS
========================================================= -->

<section
    class="how-section"
    id="how-it-works"
>

    <div class="section-container">


        <!-- HEADER -->
        <div class="section-heading">

            <span class="section-tag">
                HOW IT WORKS
            </span>


            <h2>
                Simple steps.
                Smarter <span>borrowing.</span>
            </h2>


            <p>
                Get the financial support you need
                in just a few easy steps.
            </p>

        </div>


        <!-- STEPS -->
        <div class="steps-wrapper">


            <!-- STEP 1 -->
            <div class="step-card">

                <div class="step-icon">

                    <span class="material-symbols-outlined">
                        person_add
                    </span>

                </div>


                <div class="step-content">

                    <span class="step-number">
                        01
                    </span>

                    <h3>
                        Create an Account
                    </h3>

                    <p>
                        Sign up and complete
                        your profile.
                    </p>

                </div>

            </div>


            <div class="step-arrow">

                <span class="material-symbols-outlined">
                    arrow_forward
                </span>

            </div>


            <!-- STEP 2 -->
            <div class="step-card">

                <div class="step-icon">

                    <span class="material-symbols-outlined">
                        description
                    </span>

                </div>


                <div class="step-content">

                    <span class="step-number">
                        02
                    </span>

                    <h3>
                        Apply for a Loan
                    </h3>

                    <p>
                        Choose a lender and
                        submit your application.
                    </p>

                </div>

            </div>


            <div class="step-arrow">

                <span class="material-symbols-outlined">
                    arrow_forward
                </span>

            </div>


            <!-- STEP 3 -->
            <div class="step-card">

                <div class="step-icon">

                    <span class="material-symbols-outlined">
                        check_circle
                    </span>

                </div>


                <div class="step-content">

                    <span class="step-number">
                        03
                    </span>

                    <h3>
                        Get Approved
                    </h3>

                    <p>
                        Once approved, receive your loan
                        and start your journey with confidence.
                    </p>

                </div>

            </div>

        </div>

    </div>


    <a
        href="#about"
        class="scroll-indicator"
        aria-label="Scroll to About Us"
    >
        <span class="material-symbols-outlined">
            keyboard_arrow_down
        </span>
    </a>

</section>



<!-- =========================================================
     SECTION 3 — ABOUT US
========================================================= -->

<section
    class="about-section"
    id="about"
>

    <div class="about-container">


        <!-- ABOUT -->
        <div class="about-content">

            <span class="section-tag">
                ABOUT UTANG WISE
            </span>


            <h2>
                A smarter way to connect
                <span>borrowers and lenders.</span>
            </h2>


            <p>
                Utang Wise is a platform designed to make
                borrowing simpler, safer, and more personal.
                We connect individuals with verified lenders
                who are ready to support your financial goals.
            </p>

        </div>


        <!-- DIVIDER -->
        <div class="about-divider"></div>


        <!-- LENDERS CTA -->
        <div class="lenders-cta">

            <span class="section-tag">
                READY TO GET STARTED?
            </span>


            <h2>
                Explore Our <span>Lenders</span>
            </h2>


            <p>
                Find a verified lender that matches your
                needs and take the next step toward your
                financial goals.
            </p>


            <a
                href="lenders.php"
                class="primary-btn browse-btn"
            >
                Browse Lenders

                <span class="material-symbols-outlined">
                    arrow_forward
                </span>
            </a>

        </div>

    </div>

</section>


</main>



<!-- =========================================================
     FOOTER
========================================================= -->

<footer class="footer">

    <div class="footer-container">


        <a
            href="#home"
            class="footer-brand"
        >

            <img
                src="logo/utangwiselogo.png"
                alt="Utang Wise Logo"
            >


            <div>

                <strong>
                    UTANG <span>WISE</span>
                </strong>

                <small>
                    SMART LENDING. BRIGHTER FUTURES.
                </small>

            </div>

        </a>


        <p>
            &copy; <?php echo date("Y"); ?>
            Utang Wise. All rights reserved.
        </p>

    </div>

</footer>



<!-- =========================================================
     JS
========================================================= -->

<script>

    const mobileMenuBtn =
        document.getElementById("mobileMenuBtn");

    const mobileNav =
        document.getElementById("mobileNav");


    mobileMenuBtn.addEventListener(
        "click",
        function () {

            mobileNav.classList.toggle("show");

        }
    );


    /* CLOSE MOBILE MENU AFTER CLICKING LINK */

    const mobileLinks =
        document.querySelectorAll(".mobile-nav a");

    mobileLinks.forEach(function (link) {

        link.addEventListener(
            "click",
            function () {

                mobileNav.classList.remove("show");

            }
        );

    });

</script>


</body>
</html>
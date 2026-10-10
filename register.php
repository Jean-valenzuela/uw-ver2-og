<?php require __DIR__."/ajax/app.php"; if ($logged=current_user()) go(destination($logged)); $chosen_id=(int)($_GET["lender_id"]??0); if ($chosen_id && !selected_lender($chosen_id)) fail_form("Please choose an approved lender.","lenders.php"); ?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Register | Utang Wise</title>

    <link
        rel="stylesheet"
        href="assets/css/register.css"
    >

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap"
        rel="stylesheet"
    >

    <!-- Material Symbols -->
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"
        rel="stylesheet"
    >
</head>

<body>

    <main class="register-page">

        <section class="register-card">

            <div class="register-left">

                <!-- BRAND -->
                <div class="brand">

                    <img
                        src="assets/logo/utangwiselogo.png"
                        alt="Utang Wise Logo"
                        class="brand-logo"
                    >

                    <div class="brand-text">

                        <h2>
                            UTANG WISE
                        </h2>

                        <span>
                            LENDING MADE SIMPLE
                        </span>

                    </div>

                </div>


                <!-- MESSAGE -->
                <div class="left-message">

                    <h1>
                        A smarter way<br>
                        to move forward.
                    </h1>

                    <p>
                        Create your account today and
                        experience simple, secure, and
                        reliable financial support.
                    </p>

                    <div class="gold-line"></div>

                </div>


                <!-- ILLUSTRATION -->
                <div class="illustration-area">

                    <div class="cream-shape"></div>

                    <div class="shield-icon">

                        <span class="material-symbols-outlined">
                            lock
                        </span>

                    </div>


                    <div class="woman-placeholder">

                        <div class="hair"></div>

                        <div class="face"></div>

                        <div class="body"></div>

                        <div class="laptop">
                            <span>UW</span>
                        </div>

                    </div>


                    <div class="decor-line decor-line-one"></div>
                    <div class="decor-line decor-line-two"></div>

                </div>

            </div>


            <!-- =====================================================
                 RIGHT PANEL
            ====================================================== -->

            <div class="register-right">

                <div class="form-container">

                    <!-- HEADING -->
                    <div class="form-heading">

                        <h1>
                            Create an Account
                        </h1>

                        <p>
                            <?php if ($chosen_id): $chosen=selected_lender($chosen_id); ?>Apply as a loaner with <?= e($chosen["user_fn"]." ".$chosen["user_ln"]) ?>.<?php else: ?>Join Utang Wise and get started today.<?php endif; ?>
                        </p>

                    </div>


                    <!-- =================================================
                         REGISTER FORM
                    ================================================== -->

                    <form action="ajax/register_borrower.php"method="POST" id="registerForm">
                        <?php csrf(); notice(); ?><input type="hidden" name="lender_id" value="<?= (int)$chosen_id ?>">


                        <div class="account-type-group">

                            <label class="account-type-label">
                                Applying as?
                            </label>


                            <div class="account-type-options">

                                <!-- LENDER -->
                                <label class="account-type-card">

                                    <input
                                        type="radio"
                                        name="account_type"
                                        value="lender" <?= !$chosen_id ? "checked" : "disabled" ?>
                                       
                                    >

                                    <div class="account-card-content">

                                        <div class="account-icon">

                                            <span class="material-symbols-outlined">
                                                volunteer_activism
                                            </span>

                                        </div>

                                        <div class="account-info">

                                            <strong>
                                                Lender
                                            </strong>

                                            <span>
                                                Provide financial support
                                                to borrowers
                                            </span>

                                        </div>

                                    </div>

                                    <span class="radio-design"></span>

                                </label>


                                <!-- LOANER -->
                                <label class="account-type-card">

                                    <input
                                        type="radio"
                                        name="account_type"
                                        value="loaner" <?= $chosen_id ? "checked" : "" ?>
                                        
                                    >

                                    <div class="account-card-content">

                                        <div class="account-icon">

                                            <span class="material-symbols-outlined">
                                                person
                                            </span>

                                        </div>

                                        <div class="account-info">

                                            <strong>
                                                Loaner
                                            </strong>

                                            <span>
                                                Apply for a loan for
                                                your needs
                                            </span>

                                        </div>

                                    </div>

                                    <span class="radio-design"></span>

                                </label>

                            </div>

                        </div>


                        <!-- =============================================
                             NAME
                        ============================================== -->

                        <div class="name-row">

                            <!-- FIRST NAME -->
                            <div class="form-group">

                                <label for="user_fn">
                                    First Name
                                </label>

                                <div class="input-wrapper">

                                    <span class="material-symbols-outlined">
                                        account_circle
                                    </span>

                                    <input
                                        type="text"
                                        id="user_fn"
                                        name="user_fn"
                                        placeholder="Enter your first name"
                                    >

                                </div>

                            </div>


                            <!-- LAST NAME -->
                            <div class="form-group">

                                <label for="user_ln">
                                    Last Name
                                </label>

                                <div class="input-wrapper">

                                    <span class="material-symbols-outlined">
                                        person
                                    </span>

                                    <input
                                        type="text"
                                        id="user_ln"
                                        name="user_ln"
                                        placeholder="Enter your last name"
                                    >

                                </div>

                            </div>

                        </div>



                        <div class="form-group">

                            <label for="email">
                                Email Address
                            </label>

                            <div class="input-wrapper">

                                <span class="material-symbols-outlined">
                                    mail
                                </span>

                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    placeholder="Enter your email" 
                                >

                            </div>

                        </div>


                        <div class="form-group">

                            <label for="phone">
                                Phone Number
                            </label>

                            <div class="input-wrapper">

                                <span class="material-symbols-outlined">
                                    call
                                </span>

                                <input type="tel"
                                    id="phone"
                                    name="phone"
                                    placeholder="Enter your phone number"
                                >

                            </div>

                        </div>

                        <div class="password-row">

                            <!-- PASSWORD -->
                            <div class="form-group">

                                <label for="password">
                                    Create Password
                                </label>

                                <div class="input-wrapper">

                                    <span class="material-symbols-outlined">
                                        lock
                                    </span>

                                    <input
                                        type="password"
                                        id="password"
                                        name="password"
                                        placeholder="Create a password" 
                                    >

                                    <button
                                        type="button"
                                        class="eye-button"
                                        data-target="password"
                                        aria-label="Show password"
                                    >

                                        <span class="material-symbols-outlined">
                                            visibility
                                        </span>

                                    </button>

                                </div>

                            </div>

                            <div class="form-group">

                                <label for="confirm-password">
                                    Confirm Password
                                </label>

                                <div class="input-wrapper">

                                    <span class="material-symbols-outlined">
                                        lock
                                    </span>

                                    <input
                                        type="password"
                                        id="confirm-password"
                                        name="confirm-password"
                                        placeholder="Confirm your password" 
                                    >

                                    <button
                                        type="button"
                                        class="eye-button"
                                        data-target="confirm-password"
                                        aria-label="Show password"
                                    >

                                        <span class="material-symbols-outlined">
                                            visibility
                                        </span>

                                    </button>

                                </div>

                            </div>

                        </div>


                        <div class="terms-row">

                            <input
                                type="checkbox"
                                id="terms"
                                name="terms" 
                            >

                            <label for="terms">

                                I agree to the

                                <a href="#">
                                    Terms of Service
                                </a>

                                and

                                <a href="#">
                                    Privacy Policy
                                </a>.

                            </label>

                        </div>


                        <!-- =============================================
                             CREATE ACCOUNT
                        ============================================== -->

                        <button
                            type="submit"
                            class="create-account-button"
                        >

                            <span class="material-symbols-outlined">
                                person_add
                            </span>

                            Create Account

                        </button>

                    </form>


                    <!-- =============================================
                         OR
                    ============================================== -->

                    <div class="separator">

                        <span></span>

                        <p>OR</p>

                        <span></span>

                    </div>


                    <!-- =============================================
                         LOGIN
                    ============================================== -->

                    <p class="login-text">

                        Already have an account?

                        <a href="login.php">
                            Log in here
                        </a>

                    </p>

                </div>

            </div>

        </section>

    </main>


    <!-- =====================================================
         SMALL UI SCRIPT
    ====================================================== -->

    <script>

    
        /* PASSWORD SHOW / HIDE */

        document
            .querySelectorAll(".eye-button")
            .forEach(function (button) {

                button.addEventListener(
                    "click",
                    function () {

                        const targetId =
                            this.dataset.target;

                        const input =
                            document.getElementById(targetId);

                        const icon =
                            this.querySelector(
                                ".material-symbols-outlined"
                            );

                        const isPassword =
                            input.type === "password";

                        input.type =
                            isPassword
                                ? "text"
                                : "password";

                        icon.textContent =
                            isPassword
                                ? "visibility_off"
                                : "visibility";

                    }
                );

            });</script>

<script>document.querySelector('input[value="loaner"]').addEventListener("change",function(){if(!<?= (int)$chosen_id ?>)location.href="lenders.php";});</script><?php if(function_exists('uw_success_assets'))uw_success_assets(); ?></body>

</html>
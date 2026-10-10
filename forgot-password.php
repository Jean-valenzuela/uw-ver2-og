<?php require __DIR__.'/helpers/password_reset.php';header('Cache-Control: no-store, private');header('Referrer-Policy: no-referrer');$reset=false;$token=$_GET['token']??'';$valid=$reset?reset_token($token):null; ?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Login | Utang Wise</title>

    <!-- LOGIN CSS -->
    <link
        rel="stylesheet"
        href="assets/css/login.css"
    >

    <!-- DM SANS -->
    

    <!-- PLAYFAIR DISPLAY -->
    

    <!-- MATERIAL SYMBOLS -->
    
<link rel="stylesheet" href="<?= e(base_url()) ?>/assets/css/local-fonts.css"></head>


<body>

    <main class="login-page">

        <div class="login-card">

            <section class="login-visual">

                <div class="brand">

                    <img
                        src="assets/logo/utangwiselogo.png"
                        alt="Utang Wise Logo"
                        class="brand-logo"
                    >

                    <div class="brand-name">

                        <h2>
                            UTANG WISE
                        </h2>

                        <span>
                            LENDING MADE SIMPLE
                        </span>

                    </div>

                </div>

                <div class="visual-content">

                    <h1>
                        Your goals,<br>
                        within reach.
                    </h1>

                    <p>
                        Simple, secure, and reliable financial support
                        <br>
                        when you need it.
                    </p>

                    <div class="gold-line"></div>

                    <div class="login-illustration">

                        <div class="illustration-bg"></div>

                        <div class="person">

                            <div class="person-head"></div>
                            <div class="person-body"></div>

                        </div>


                        <!-- LAPTOP -->
                        <div class="laptop">

                            <span>
                                UW
                            </span>

                        </div>


                        <!-- DECORATION -->
                        <div class="security-icon">

                            <span class="material-symbols-outlined">
                                lock
                            </span>

                        </div>

                    </div>

                </div>

            </section>


            <!-- =====================================================
                 RIGHT SIDE
            ====================================================== -->

            <section class="login-form-side">

                <div class="login-form-wrapper">

                    <!-- HEADING -->
                    <div class="login-heading">

                        <h1>
                            <?= $reset?'Choose a new password':'Forgot your password?' ?>
                        </h1>

                        <p>
                            <?= $reset?'Your link is valid for 30 minutes and can be used once.':'Enter your registered email address to receive a reset link.' ?>
                        </p>

                    </div>


                    <!-- =================================================
                         LOGIN FORM
                    ================================================== -->

                    <?php if(!$reset||$valid): ?><form class="login-form" method="post" action="<?= e(base_url()) ?>/controllers/password-reset.php"><?php csrf();notice(); ?><input type="hidden" name="action" value="<?= $reset?'reset':'request' ?>">
<?php if($reset): ?><input type="hidden" name="token" value="<?= e($token) ?>"><div class="form-group"><label>New password</label><div class="input-box"><input name="password" type="password" minlength="8" maxlength="72" autocomplete="new-password" required></div></div><div class="form-group"><label>Confirm password</label><div class="input-box"><input name="confirm-password" type="password" minlength="8" maxlength="72" autocomplete="new-password" required></div></div>
<?php else: ?><div class="form-group"><label>Email address</label><div class="input-box"><input name="email" type="email" maxlength="255" autocomplete="email" required></div></div><?php endif; ?><button class="login-btn" type="submit"><?= $reset?'Save new password':'Send reset link' ?></button></form><?php else: ?><p role="alert">This link is invalid, expired, or already used. <a href="forgot-password.php">Request a new reset link</a>.</p><?php endif; ?><p><a href="login.php">Back to sign in</a></p>


                    <!-- DIVIDER -->
                    <div class="or-divider">

                        <span></span>

                        <p>
                            OR
                        </p>

                        <span></span>

                    </div>


                    <!-- REGISTER -->
                    <div class="register-link">

                        <span>
                            Don't have an account?
                        </span>

                        <a href="register.php">
                            Register here
                        </a>

                    </div>

                </div>

            </section>

        </div>

    </main>


    <!-- =====================================================
         PASSWORD SHOW / HIDE
    ====================================================== -->

    <script>

        const passwordInput =
            document.getElementById("password");

        const passwordToggle =
            document.getElementById("passwordToggle");

        const passwordIcon =
            document.getElementById("passwordIcon");


        if (
            passwordInput &&
            passwordToggle &&
            passwordIcon
        ) {

            passwordToggle.addEventListener(
                "click",
                function () {

                    const isPassword =
                        passwordInput.type === "password";


                    passwordInput.type =
                        isPassword
                            ? "text"
                            : "password";


                    passwordIcon.textContent =
                        isPassword
                            ? "visibility_off"
                            : "visibility";


                    passwordToggle.setAttribute(
                        "aria-label",
                        isPassword
                            ? "Hide password"
                            : "Show password"
                    );

                }
            );

        }

    </script>

<?php if(function_exists('uw_success_assets'))uw_success_assets(); ?></body>

</html>

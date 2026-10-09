<?php

require __DIR__ . '/app.php';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    go('public/login.php');
}

// Validate CSRF token
check_csrf();

// Determine the login portal
$admin = ($_POST['portal'] ?? '') === 'admin';

$back = $admin
    ? 'admin/login.php'
    : 'public/login.php';

// Get and normalize email
$email = strtolower(trim($_POST['email'] ?? ''));

// Generate a unique login attempt key
$key = hash(
    'sha256',
    ($_SERVER['REMOTE_ADDR'] ?? '') . '|' . $email
);

// Check login attempts within the last 15 minutes
$attempt = db(
    'SELECT attempts
     FROM login_attempts
     WHERE attempt_key = ?
     AND updated_at > DATE_SUB(NOW(), INTERVAL 15 MINUTE)',
    [$key]
)->get_result()->fetch_assoc();

// Block excessive login attempts
if (($attempt['attempts'] ?? 0) >= 10) {
    fail_form(
        'Too many attempts. Try again in 15 minutes.',
        $back
    );
}

// Retrieve user account
$u = db(
    'SELECT *
     FROM users
     WHERE email = ?',
    [$email]
)->get_result()->fetch_assoc();

// Validate user credentials and portal access
if (
    !$u ||
    !password_verify(
        $_POST['password'] ?? '',
        $u['password_hash']
    ) ||
    ($admin !== ((int) $u['user_type_id'] === 3))
) {

    // Record failed login attempt
    db(
        'INSERT INTO login_attempts (attempt_key, attempts)
         VALUES (?, 1)
         ON DUPLICATE KEY UPDATE
            attempts = IF(
                updated_at < DATE_SUB(NOW(), INTERVAL 15 MINUTE),
                1,
                attempts + 1
            ),
            updated_at = NOW()',
        [$key]
    );

    // Display login error
    fail_form(
        'Invalid email or password for this login page.',
        $back
    );
}

// Clear failed login attempts after successful login
db(
    'DELETE FROM login_attempts
     WHERE attempt_key = ?',
    [$key]
);

// Pending/rejected borrowers do not receive an authenticated session.
if ((int)$u['user_type_id'] === 2 && in_array($u['account_status'], ['pending', 'rejected'], true)) {
    unset($_SESSION['uid']);
    fail_form($u['account_status'] === 'pending' ? 'Your application is under lender review. You can log in after approval.' : 'Your application was rejected. Please contact your lender for details.', $back);
}
// Regenerate session ID for security
session_regenerate_id(true);

// Store authenticated user information
$_SESSION['uid'] = $u['user_id'];

// Generate a new CSRF token
$_SESSION['csrf'] = bin2hex(random_bytes(32));

// Redirect user based on account role
go(destination($u));

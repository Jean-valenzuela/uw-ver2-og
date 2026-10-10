<?php

require_once __DIR__.'/../helpers/form_validation.php';
require_once __DIR__ . '/config.php';
require_once __DIR__.'/../helpers/schema.php';
uw_ensure_update_schema($conn);
require_once __DIR__.'/../helpers/success_alerts.php';
require_once __DIR__.'/../helpers/design_assets.php';

// Set default timezone
date_default_timezone_set(
    getenv('UW_TIMEZONE') ?: 'Asia/Manila'
);

// Validate POST fields
foreach ($_POST as $value) {
    if (!is_string($value)) {
        http_response_code(400);
        if (uw_form_request()) uw_form_error('Invalid form field.', null, 400);
        exit('Invalid form field.');
    }
}

// Initialize secure session
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_set_cookie_params([
        'httponly' => true,
        'samesite' => 'Lax',
        'secure' => !empty($_SERVER['HTTPS'])
            && $_SERVER['HTTPS'] !== 'off'
    ]);

    ini_set('session.use_strict_mode', '1');
    session_start();
}

// Generate CSRF token
if (empty($_SESSION['csrf'])) {
    $_SESSION['csrf'] = bin2hex(random_bytes(32));
}


// ==================================================
// DATABASE FUNCTIONS
// ==================================================

function db($sql, $values = [])
{
    global $conn;

    $s = $conn->prepare($sql);

    if ($values) {
        $s->bind_param(
            str_repeat('s', count($values)),
            ...$values
        );
    }

    $s->execute();

    return $s;
}


// ==================================================
// SECURITY FUNCTIONS
// ==================================================

function e($s)
{
    return htmlspecialchars(
        (string) $s,
        ENT_QUOTES,
        'UTF-8'
    );
}

function csrf()
{
    echo '<input type="hidden" name="csrf" value="'
        . e($_SESSION['csrf'])
        . '">';
}

function check_csrf()
{
    if (
        !is_string($_POST['csrf'] ?? null) ||
        !hash_equals($_SESSION['csrf'], $_POST['csrf'])
    ) {
        http_response_code(403);
        if (uw_form_request()) uw_form_json(['ok'=>false,'error'=>'Your form token expired. Your details are retained; please submit again.','csrf'=>$_SESSION['csrf']],403);
        exit('Invalid form token. Reload the page.');
    }
}


// ==================================================
// URL AND REDIRECTION FUNCTIONS
// ==================================================

function base_url()
{
    $root = str_replace(
        '\\',
        '/',
        realpath(__DIR__ . '/..')
    );

    $doc = rtrim(
        str_replace(
            '\\',
            '/',
            realpath($_SERVER['DOCUMENT_ROOT'])
        ),
        '/'
    );

    $configured = getenv('UW_BASE_URL');
    return $configured !== false ? rtrim($configured, '/') : substr($root, strlen($doc));
}

function go($path)
{
    if (uw_form_request()) {
        $success=$_SESSION['uw_success'] ?? null;
        if (!$success && ($_SESSION['notice_kind'] ?? '') === 'success' && !empty($_SESSION['notice'])) $success=['title'=>'Saved successfully','text'=>$_SESSION['notice']];
        if ($success) unset($_SESSION['uw_success'],$_SESSION['notice'],$_SESSION['notice_kind']);
        uw_form_json(['ok'=>true,'redirect'=>base_url().'/'.$path,'success'=>$success]);
    }
    header(
        'Location: ' . base_url() . '/' . $path
    );

    exit;
}


// ==================================================
// USER AUTHENTICATION AND ACCESS CONTROL
// ==================================================

function current_user()
{
    return isset($_SESSION['uid'])
        ? db(
            'SELECT *
             FROM users
             WHERE user_id = ?',
            [$_SESSION['uid']]
        )->get_result()->fetch_assoc()
        : null;
}

function require_user($role = null)
{
    $u = current_user();

    // Redirect unauthenticated users
    if (!$u) {
        if (uw_form_request()) uw_form_error('Your session expired. Sign in again in another tab, then retry this form. Your entered details are still here.', null, 401);
        go(
            $role === 3
                ? 'admin/login.php'
                : 'login.php'
        );
    }

    // Check user role permissions
    if (
        $role !== null &&
        (int) $u['user_type_id'] !== $role
    ) {
        http_response_code(403);
        exit('Access denied.');
    }

    return $u;
}

function destination($u)
{
    // Admin dashboard
    if ((int) $u['user_type_id'] === 3) {
        return 'admin/dashboard.php';
    }

    // Approved accounts
    if ($u['account_status'] === 'approved') {
        return (int) $u['user_type_id'] === 1
            ? 'lender/dashboard.php'
            : (borrower_needs_agreement($u['user_id']) ? 'borrower/signed-agreement.php' : 'borrower/client-dashboard.php');
    }

    // Accounts awaiting approval or other status
    if ($u['account_status'] !== 'incomplete') {
        return (int)$u['user_type_id']===2 ? 'borrower/new-acc-profiling/ready-for-review.php' : 'lender/new-acc-profiling/requirements.php';
    }

    // Incomplete account profiling
    return (int) $u['user_type_id'] === 1
        ? 'lender/new-acc-profiling/requirements.php'
        : 'borrower/new-acc-profiling/verifyacc.php';
}


// ==================================================
// NOTIFICATION AND FORM ERROR FUNCTIONS
// ==================================================

function notice()
{
    if (isset($_SESSION['notice'])) {
        echo '<p role="alert"
                 data-uw-notice
                 data-uw-kind="'
            . e($_SESSION['notice_kind'] ?? 'success')
            . '">'
            . e($_SESSION['notice'])
            . '</p>';

        unset($_SESSION['notice_kind']);
        unset($_SESSION['notice']);
    }
}

function fail_form($message, $path, $field = null)
{
    if (uw_form_request()) {
        unset($_SESSION['borrower_old']);
        uw_form_error($message, $field);
    }
    $_SESSION['notice'] = $message;
    $_SESSION['notice_kind'] = 'error';

    go($path);
}


// ==================================================
// LENDER AND APPLICATION PROFILE FUNCTIONS
// ==================================================

function selected_lender($id)
{
    return db(
        "SELECT user_id, user_fn, user_ln
         FROM users
         WHERE user_id = ?
         AND user_type_id = 1
         AND account_status = 'approved'",
        [$id]
    )->get_result()->fetch_assoc();
}

function profile($id)
{
    $r = db(
        'SELECT details
         FROM application_profiles
         WHERE user_id = ?',
        [$id]
    )->get_result()->fetch_assoc();

    return $r
        ? json_decode($r['details'], true)
        : [];
}

function document_exists($id, $kind)
{
    return db(
        'SELECT document_id
         FROM application_documents
         WHERE user_id = ?
         AND kind = ?',
        [$id, $kind]
    )->get_result()->num_rows > 0;
}


// ==================================================
// DATABASE TRANSACTION FUNCTIONS
// ==================================================

function rollback_safely()
{
    global $conn;

    try {
        $conn->rollback();
    } catch (mysqli_sql_exception $rollbackError) {
        error_log(
            'Rollback unavailable: '
            . $rollbackError->getMessage()
        );
    }
}


// ==================================================
// DOCUMENT UPLOAD FUNCTIONS
// ==================================================

function upload_document($id, $kind, $required = true)
{
    // Retrieve uploaded file
    $f = $_FILES[$kind] ?? null;

    // Check if a document was provided
    if (!$f || $f['error'] === UPLOAD_ERR_NO_FILE) {
        if (
            $required &&
            !document_exists($id, $kind)
        ) {
            throw new RuntimeException(uw_field_message($kind, 'Please upload '
                . str_replace('_', ' ', $kind)
                . '.'));
        }

        return;
    }

    // Validate upload status and file size
    if (
        $f['error'] !== UPLOAD_ERR_OK ||
        $f['size'] > 5 * 1024 * 1024 ||
        !is_uploaded_file($f['tmp_name'])
    ) {
        throw new RuntimeException(uw_field_message($kind, 'Upload failed. Files must be at most 5 MB.'));
    }

    // Detect file MIME type
    $mime = (new finfo(FILEINFO_MIME_TYPE))
        ->file($f['tmp_name']);

    // Validate allowed file formats
    if (
        !in_array(
            $mime,
            [
                'image/jpeg',
                'image/png',
                'application/pdf'
            ],
            true
        )
    ) {
        throw new RuntimeException(uw_field_message($kind, 'Only JPG, PNG and PDF documents are accepted.'));
    }

    // Retrieve database packet size limit
    $packetLimit = (int) db(
        'SELECT @@session.max_allowed_packet AS packet_limit'
    )->get_result()->fetch_assoc()['packet_limit'];

    // Check if the document exceeds database capacity
    if (
        filesize($f['tmp_name']) + 65536 > $packetLimit
    ) {
        throw new RuntimeException(uw_field_message($kind, 'This document exceeds the server’s current upload capacity. '
            . 'Please choose a smaller file or ask the administrator '
            . 'to increase the document upload capacity.'));
    }

    // Insert or update application document
    db(
        'INSERT INTO application_documents (
            user_id,
            kind,
            mime_type,
            contents
        )
        VALUES (?, ?, ?, ?)
        ON DUPLICATE KEY UPDATE
            mime_type = VALUES(mime_type),
            contents = VALUES(contents)',
        [
            $id,
            $kind,
            $mime,
            file_get_contents($f['tmp_name'])
        ]
    );
}


// ==================================================
// PAGE LAYOUT FUNCTIONS
// ==================================================

function page_start($title)
{
    echo '<!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport"
              content="width=device-width, initial-scale=1">

        <title>'
            . e($title)
            . ' | Utang Wise</title>

        <link rel="stylesheet" href="'
            . e(base_url())
            . '/assets/css/register.css">
    </head>

    <body>
        <main class="register-page">
            <section class="form-container">

                <div class="form-heading">
                    <h1>'
                        . e($title)
                        . '</h1>

                    <p>
                        UTANG WISE · Lending made simple
                    </p>
                </div>';

    notice();
}

function page_end()
{
    echo '<form action="'
        . e(base_url())
        . '/ajax/logout.php"
        method="post">';

    csrf();

    echo '<button class="create-account-button">
            Log out
          </button>
          </form>

          </section>
        </main>
    <script src="../assets/js/form-validation.js" defer></script></body>
    </html>';
}

function borrower_needs_agreement($id) {
 $r=db("SELECT a.agreement_id,c.signed_pdf IS NOT NULL AS signed FROM loan_agreements a LEFT JOIN lender_contracts c ON c.agreement_id=a.agreement_id WHERE a.borrower_id=? ORDER BY a.agreement_id DESC LIMIT 1",[$id])->get_result()->fetch_assoc();
 return !$r || !$r['signed'];
}

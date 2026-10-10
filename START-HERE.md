# Utang Wise — integrated project

This package combines the supplied frontend with the database-backed borrower, lender and administrator flows. Start with this guide; older README files describe earlier updates.

## Update the existing XAMPP project

1. Back up the existing project folder and export its database in phpMyAdmin.
2. Copy the contents of the included `uw-ver2-og` folder into `C:\xampp\htdocs\uw-ver2-og`, replacing matching application files. Do not create a second nested `uw-ver2-og` folder. Keep your private database, mail and payment settings outside the public folder.
3. Start Apache and MySQL. Select your existing `uw-ver2` database in phpMyAdmin and import `sql/all-updates.sql`. It adds the missing tables and supports repeated imports without deleting existing users, documents, loans or payments. The application also detects missing update tables.
4. Database defaults are in `ajax/config.php`. To use different credentials, supply a private configuration through `UW_DB_CONFIG`, or use `UW_DB_HOST`, `UW_DB_USER`, `UW_DB_PASSWORD` and `UW_DB_NAME` in the Apache environment. Never use the test-database names from the verification report for the real site.
5. Restart Apache and refresh the browser with Ctrl+F5. Open `http://localhost/uw-ver2-og/`. Administrator sign-in is `http://localhost/uw-ver2-og/admin/login.php`.

The package includes PHP upload settings for 5 MB files and 20 MB total POST requests. If your host ignores `.htaccess` or `.user.ini`, set `upload_max_filesize=5M` and `post_max_size=20M` in the PHP configuration and restart Apache. Required PHP extensions: mysqli, mbstring, fileinfo, OpenSSL and cURL. PDF and email libraries are included.

## New, empty installation

Create and select a new empty database, then import `sql/fresh-install.sql`. This creates the tables and three account roles, without sample accounts or personal records. Do not import this file over your existing database.

Create the first administrator locally through PowerShell. The command refuses to replace an existing email:

```powershell
$env:UW_INITIAL_ADMIN_EMAIL = Read-Host 'Administrator email'
$env:UW_INITIAL_ADMIN_NAME = Read-Host 'Administrator name'
$env:UW_INITIAL_ADMIN_PASSWORD = [System.Net.NetworkCredential]::new('', (Read-Host 'Password, at least 12 characters' -AsSecureString)).Password
try {
    & C:\xampp\php\php.exe C:\xampp\htdocs\uw-ver2-og\tools\create-admin.php
} finally {
    Remove-Item Env:UW_INITIAL_ADMIN_PASSWORD
}
```

Set the database environment variables first if your database is different from the defaults. This command is available only in a terminal; public administrator registration remains disabled.

## Gmail delivery

The sender defaults to `ayettacore@gmail.com`. Copy `config/mail.example.php` to a private location outside `htdocs`, fill in the Gmail App Password, and set `UW_MAIL_CONFIG` to that file's absolute path in Apache's environment. Use the sender's App Password, not the normal Gmail password. Set `public_url` in the private file, or `UW_PUBLIC_URL`, to the full site URL, such as `https://your-domain/uw-ver2-og`. Local development can use `http://localhost/uw-ver2-og`.

Approval and rejection emails go to the applicant's registered email. Borrower approval includes the generated agreement PDF. The decision screen reports sent, queued, failed or uncertain delivery and offers retry where appropriate. A saved decision is retained if email delivery fails. Check the sender's Sent folder before retrying an uncertain delivery.

Forgot Password sends a link valid for 30 minutes. Links are single-use, requests are rate-limited, and a password reset revokes existing authenticated sessions without changing account approval status. Configure Gmail and the public URL before relying on email recovery. If a reset email failed while mail was unconfigured, request a new link after configuring it.

Verification captured emails locally; it did not send mail to real Gmail inboxes. Do not set `UW_MAIL_TRANSPORT=capture` on the live installation.

## Separate PayMongo account for every lender

Keep the per-lender setup described in `README-BORROWER-PORTAL.md`. Copy `config/paymongo.example.php` outside `htdocs`, provide each lender's own server secret key and webhook signing secret, then set `UW_PAYMONGO_CONFIG` to its absolute path.

Configure a public HTTPS application URL and each lender's webhook:

`https://your-domain/uw-ver2-og/controllers/paymongo-webhook.php?lender=LENDER_USER_ID`

The webhook event is `checkout_session.payment.paid`. Start with PayMongo test credentials and dedicated synthetic borrower IDs. Complete a real provider sandbox checkout and verify the callback before enabling live mode. No provider credentials are included. Local verification used simulated signed provider events, not actual GCash or card transactions.

Borrowers can pay the full installment or monthly interest only. Interest-only payments move unpaid principal to the next installment. On the final installment, one month with the usual interest on the original principal is added. Balances change only after verified payment confirmation. Manual lender entry records money already received; it does not transfer funds. Loan release also requires the lender to confirm funds were actually provided.

## Included flows

- Borrower registration, lender selection, profiling, address dropdowns, ID/selfie/COE uploads and final submission.
- Lender requirements, public profile photo after administrator approval, account settings and logout.
- Administrator review, approval/rejection emails, approved-lender search and controlled profile removal.
- Borrower application review, PDF agreements, signed-agreement upload, lender release, live dashboards and notifications.
- Loan lists and details, repeated requests after dues are cleared, payments, interest-only carry, history PDF and payment-status recovery.
- Validation that keeps text, passwords, choices and selected files on the current page after errors; field-specific messages and SweetAlert confirmations.
- Mobile navigation, locally bundled fonts/icons, and working destinations for the old prototype routes.

The original monthly contract rules are retained: 3, 6 or 12 months with flat monthly interest. Prototype-only sample records and unsupported controls are not used as saved financial data. Unsaved uploads remain in the current browser page; closing or refreshing the page clears them.

See `INTEGRITY-CHECK.md` for verification scope and remaining live-connection checks. Your original ZIPs and installed XAMPP project were not modified during preparation.

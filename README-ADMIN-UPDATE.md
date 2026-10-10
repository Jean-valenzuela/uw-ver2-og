> For the latest installation and payment setup, start with [README-BORROWER-PORTAL.md](README-BORROWER-PORTAL.md). This older guide describes an earlier update.

# Super admin update

For this release, follow README-DASHBOARD-UPDATE.md first. It supersedes earlier notes about manual migrations, lender photos, payment entry and final-installment interest-only charges.
Built from uw-ver2-og (4).zip. Includes the existing borrower and lender features, plus the functioning super admin workflow. Original files, archive and live database were not overwritten.

## Install

1. Back up your existing application folder and database.
2. Extract the included uw-ver2-og folder into C:/xampp/htdocs and merge it with your existing folder. Avoid creating uw-ver2-og/uw-ver2-og. Preserve any private local configuration you maintain.
3. In phpMyAdmin, select your existing uw-ver2 database and import sql/admin-update.sql. It is repeatable and adds tables without replacing existing users, documents, profiles or loan records. Do not import the old full database backup over current data.
4. Keep the borrower and lender migrations installed from the earlier update. For a fresh database only, import your original schema, then sql/borrower-update.sql, sql/lender-update.sql and sql/admin-update.sql in that order.
5. Open http://localhost/uw-ver2-og/admin/login.php and sign in with your existing approved administrator account (user_type_id = 3, account_status = approved). This package does not supply passwords or a public administrator-registration endpoint. An existing authorized database administrator must provision an admin if none exists.
6. PHP requires mysqli, fileinfo and openssl, plus the dependencies already listed in README-LENDER-UPDATE.md. For two 5 MB requirement uploads, configure upload_max_filesize=5M and post_max_size=20M or higher.

ajax/config.php keeps the supplied active database defaults: localhost, root, blank password, uw-ver2. Environment overrides UW_DB_HOST, UW_DB_USER, UW_DB_PASSWORD and UW_DB_NAME are supported. Stray output between PHP blocks was removed because it was changing downloaded document bytes.

## Features

- Dashboard has no search bar. Database queries supply total submitted, approved and rejected lender applications and the five latest applicants. Incomplete registrations and deleted profiles are excluded. Existing applications without a recorded submission timestamp show Not recorded; dates are not invented.
- Lender Applications lists real pending, approved and rejected applications, with search, pagination, sorting and status filtering. View opens saved source of funds, lending limit, reason, contact details and submitted document links. Documents open in a new tab through an administrator-only endpoint.
- Approval requires completed requirements and both valid ID and proof of funds. Rejection requires a reason. Review decisions are transactional, recorded with reviewer/time, and cannot be processed twice.
- Approved Lenders contains only approved accounts and is searchable. Requirements remain viewable. Delete requires typing DELETE. It removes the profile from the lists and public lender directory and disables current/future lender dashboard access. This is a soft deletion: linked borrowers, loans, documents and audit records remain in the database so existing financial records are not destroyed.
- Notifications show unread submitted applications, refresh every 30 seconds while the page is visible, and open the application when clicked. Viewing an application marks it read for that administrator only. Existing submitted accounts are included when the migration runs. Notifications are in-app, not desktop push alerts.
- Admin pages and actions require an approved role-3 session. Mutations and logout require POST and CSRF tokens. Logout destroys the session/cookie and returns to the admin login. Protected pages have no-store cache headers.
- The missing lender requirements page and broken lender registration handler are repaired. Register as lender, submit source of funds, lending limit, lender reason, proof of funds and valid ID. Uploads accept verified PNG/JPG/PDF files up to 5 MB each. Submission ends onboarding access and creates the admin notification. Incomplete lenders may sign in only to finish their requirements; pending and rejected lenders cannot sign in. Approved lenders reach their dashboard.
- Public registration cannot create super admin accounts. The old admin/register.php redirects to admin login.

## Decision emails

The sender remains ayettacore@gmail.com. Existing PHPMailer transport and Gmail configuration are reused. See README-LENDER-UPDATE.md and config/mail.example.php for the private Gmail App Password setup outside htdocs. Do not put the private password in a shared ZIP.

Approval emails say the applicant may now sign in. Rejection emails include the reason and say dashboard access is unavailable. The decision and email queue record are saved together; delivery runs after the decision commits. Missing credentials leave mail queued. Failures can be retried from View. Interrupted delivery is marked uncertain and requires checking Gmail Sent and acknowledging potential duplicates before retrying. Sent means SMTP accepted the message, not that the recipient has read it or that inbox placement was verified.

No real emails were sent during testing, and authentication/delivery with your Gmail account remains unverified. Development capture mode must not be enabled on your live installation.

## Files and data

- sql/admin-update.sql: lender submission/deletion metadata, per-admin notification reads, decision outbox and audit records.
- helpers/admin.php and admin_view.php: protected database reads and shared admin layout.
- helpers/admin_mail.php: admin decision delivery using the existing mail configuration.
- controllers/admin-data.php, admin-document.php, admin-actions.php: protected profile/document reads and decisions, retries, notification reads and profile removal.
- controllers/lender-submit.php and lender/new-acc-profiling/requirements.php: lender requirement submission.
- assets/js/admin-flow.js and assets/css/admin-flow.css: tables, dialogs, notifications and responsive additions using the existing admin styles.

## Verification

35 integration checks passed in the isolated uw_borrower_test_20261009 database with synthetic accounts. Six additional mail-state checks passed. Browser checks passed for dashboard counts/no search, notification-to-profile navigation, search/status filters, requirement views, approval feedback, approved-profile controls, mobile navigation and absence of JavaScript errors. Desktop and mobile views were inspected. PHP/JavaScript syntax checks passed. No synthetic accounts or captured emails are included in this package.

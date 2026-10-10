> For the latest installation and payment setup, start with [README-BORROWER-PORTAL.md](README-BORROWER-PORTAL.md). This older guide describes an earlier update.

# Lender dashboard, public design, photos and interest-only payments

Built from the current C:/xampp/htdocs/uw-ver2-og files supplied for this session. The working changes were made in a separate folder; the installed application and live database were not overwritten.

## Installation

1. Back up the application folder and database.
2. Merge the supplied uw-ver2-og folder into C:/xampp/htdocs/uw-ver2-og. Do not create a nested uw-ver2-og/uw-ver2-og folder. Preserve private Gmail configuration and any database credentials you have changed locally.
3. Open login.php. The application checks for missing update tables and applies only the necessary additive update scripts. This repairs the missing borrower_submissions table shown in the screenshot and installs the dashboard/payment support tables. It does not recreate, replace or erase existing users, loans, documents or payments.
4. If the database user cannot create tables, select the existing uw-ver2 database in phpMyAdmin and import sql/all-updates.sql, then reload. The error page provides this instruction instead of exposing a stack trace. Do not restore the old full database backup over current records.
5. Set upload_max_filesize=5M and post_max_size=20M or higher in PHP for the three lender requirement uploads. Restart Apache after changing PHP configuration.
6. Sign in through login.php for every account role; successful sign-in routes each role to its dashboard.

The original schema (users, user_type, loan_agreements, loan_installments, loan_payments and related original tables) must already exist. The automatic check adds application update tables only. Default database settings remain those from the supplied project, with environment overrides supported. Gmail settings remain unchanged and no passwords are included.

## Public lenders and photo requirements

- lenders.php uses the existing dedicated lender.css design: cream hero, navy/gold typography and four-card desktop grid. lender.php is an alias. Actual approved lenders populate the cards; personal details or borrower counts are not fabricated.
- New lender applications require proof of funds, valid ID and a selfie/profile photo. The photo must be a real JPG/PNG up to 5 MB; PDF remains supported for the other two documents.
- Admin View includes the submitted photo. Previously submitted applications are not retroactively blocked solely because they predate the photo requirement.
- Public display is a separate optional checkbox. Only approved lenders who opt in have a public photo endpoint. Existing approved lenders can upload a photo or change visibility through Lender Dashboard > Profile Photo. Others show initials.
- The registration prompt/link is removed from admin/login.php.

## Dashboard and notifications

The lender dashboard and the four working application/loaner/loan/extension pages have notifications with per-lender persistent read state. Notifications cover submitted borrower applications, recorded loan payments and extension requests. Opening a notification marks it read and opens the related profile, request or payment. They refresh every 30 seconds while the page is visible. These are in-app notifications, not external push messages.

The top search bar is removed. Table-specific filters remain available where useful.

- Total Amount Lent: original principal of released active/completed agreements; draft approvals excluded.
- Total Paid: payments applied to installments, including historical installment balances.
- Total Overdue: unpaid balances of active installments due before today; future installments are excluded.
- Interest Collection: saved payment interest allocations. Historical installment payments without a saved breakdown are estimated proportionally and disclosed beneath the totals. Incompatible historical schedules are not silently treated as exact interest: the dashboard shows their unclassified amount.
- Total Loaners: approved borrower accounts assigned to this lender.
- Borrower summary, overdue/due-soon/review/extension reminders and the next 12 unpaid upcoming installments all use real records.
- Monthly Lending vs Payments has a year selector, 12-month chart, exact-value table and downloadable CSV. Lending is grouped by actual recorded release date; payments by recorded payment date. Undated historical releases/payments are disclosed and are not assigned invented dates.

All data, downloads and notification reads are scoped to the signed-in lender. Dates use Asia/Manila and the database connection uses +08:00.

## Recording payments and the confirmed carry-forward rule

Open Lender Dashboard > Payments. This records funds already received; it does not transfer funds or connect a payment gateway. Borrowers cannot use the recording endpoint. Borrower Payments now shows their actual recorded payments and current repayment schedule instead of sample figures.

Regular payments are applied to the earliest unpaid installment first. Partial regular payments split proportionally between that installment's remaining principal and interest, rounded to centavos. The allocation is saved, and principal plus interest always equals the received amount.

For Interest only:

1. Choose the active loan and calculate the preview.
2. The amount received must equal the remaining interest on the earliest unpaid installment.
3. That installment's remaining principal, including any principal already carried into it, is moved into the next installment. No penalty or interest on the carried amount is added.
4. If there is no next installment, the system creates another month with the remaining principal plus the normal monthly flat interest on the ORIGINAL principal. The additional month increases total interest and total repayment by that monthly interest amount.
5. The form displays the payment amount, principal carried, next due date, next remaining amount and extra-month interest before saving. The lender must confirm the borrower requested this option and accepted the displayed change. A stale preview cannot be saved.
6. Payments, allocations, schedule changes and carry records commit together. Duplicate request tokens cannot record the same payment twice. Overpayments and future payment dates are rejected.

Example: PHP 3,000 principal, 2.5% flat monthly interest, three initial installments. Each starts at PHP 1,075 (PHP 1,000 principal + PHP 75 interest). An interest-only payment of PHP 75 makes the following installment PHP 2,075. If only interest is paid in all three initial months, a fourth installment is added for PHP 3,075. Total interest becomes PHP 300 and total repayment PHP 3,300. Repeated final-installment interest-only choices can add further months at the usual monthly interest.

An ordinary date-only extension request keeps its existing no-added-interest behavior. It is distinct from the final-installment interest-only option described above.

New generated agreements include the interest-only terms. Previously saved/signed PDFs are not rewritten; later changes appear in payment/carry records and the current schedule. New payments use exact saved allocations; older payments without a breakdown use the disclosed proportional starting allocation.

## Files and verification

- sql/all-updates.sql combines the prior borrower, lender and admin migrations with sql/dashboard-update.sql.
- helpers/schema.php performs the additive table check.
- helpers/lender_dashboard.php supplies totals, reports and notifications.
- helpers/payment_records.php and controllers/record-payment.php handle allocations and carry-forward transactions.
- helpers/payments_view.php provides lender payment entry/history and borrower payment/schedule views.
- controllers/lender-photo.php exposes only approved, opted-in public photos; private requirements remain protected.

45 integration checks and five additional partial-payment/date/CSRF checks passed using the isolated uw_dashboard_test_20261010 database and synthetic records. Browser checks passed for public grid layout, dashboard totals/chart, CSV download, notifications, interest-only preview/save, application deep links and mobile width, with no JavaScript errors. The updated two-page agreement was rendered and inspected.

No test accounts, captured emails or private credentials are included. No real email was sent. Existing Gmail App Password setup is still required for approval/rejection delivery. Older demonstration pages outside the working dashboard/applications/loaners/loans/payments/extensions/photo routes were not broadly rebuilt.

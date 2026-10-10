> For the latest installation and payment setup, start with [README-BORROWER-PORTAL.md](README-BORROWER-PORTAL.md). This older guide describes an earlier update.

# Lender review, loan tracking, agreements and Gmail notifications

For this release, follow README-DASHBOARD-UPDATE.md first. It supersedes earlier notes about manual migrations, lender photos, payment entry and final-installment interest-only charges.
For this combined release, also follow README-ADMIN-UPDATE.md and import sql/admin-update.sql. Its admin and lender-registration changes supersede older scope notes.
This package includes the previous borrower update plus the new lender workflow. The original ZIP, SQL backup and existing XAMPP application/database were not overwritten.

## Installation

1. Back up the existing application folder and database.
2. Copy this `uw-ver2-og` folder into your XAMPP `htdocs` folder, or merge it into your current application while retaining the directory structure.
3. For a new database only, import the supplied original `uw-ver2 (1).sql`. Do not restore that old backup over a database with newer records.
4. Select your `uw-ver2` database in phpMyAdmin and import `sql/borrower-update.sql`, then `sql/lender-update.sql`. Both are repeatable additions and preserve existing records.
5. Check `ajax/config.php`. Defaults remain localhost / root / blank database password / `uw-ver2`; environment overrides are supported. The connection uses Philippine local time (+08:00).
6. Enable PHP mysqli, mbstring, fileinfo, openssl, curl and zlib. Allow 5 MB uploads (`upload_max_filesize=5M`, `post_max_size=20M` or higher) and a database packet limit large enough for the documents. TCPDF and PHPMailer are bundled, with their licenses; Composer installation is not required.
7. Sign in with an existing approved lender account. Open Applications from the dashboard/sidebar.

## Gmail setup — one local secret still required

Sender: **ayettacore@gmail.com**. The password is intentionally not included. No real email was sent during development.

1. For this Gmail account, enable 2-Step Verification and create an App Password if the account permits it. Follow [Google's App Password instructions](https://support.google.com/accounts/answer/185833). Use an App Password, not the ordinary Google account password.
2. Copy `config/mail.example.php` to a private location **outside `htdocs`**, for example `C:/xampp/uw-mail.private.php`. Fill the `password` value locally. Keep this private file out of shared ZIPs and source control.
3. Tell Apache where to find it. For XAMPP, add the following to the application's `.htaccess` if `SetEnv` is allowed, or to its Apache virtual-host configuration, then restart Apache:

   ```apache
   SetEnv UW_MAIL_CONFIG "C:/xampp/uw-mail.private.php"
   ```

   As an alternative, set `UW_SMTP_PASSWORD` in the server environment. The other defaults already use the selected Gmail sender.
4. Configuration defaults are `smtp.gmail.com`, port 587, authenticated STARTTLS. [Google's SMTP settings](https://support.google.com/mail/answer/7104828) describe the outgoing server and TLS settings. TLS certificate verification remains enabled.
5. After configuring mail, open the borrower profile and use **Retry email** for a queued notification. The decision and agreement are not created again. For an uncertain send, check Gmail Sent before explicitly acknowledging a possible duplicate.

`sent` means the SMTP server accepted the message; it does not establish inbox delivery or that the borrower read it. Missing credentials leave the message `queued`. Connection failures become `failed`. Interrupted or ambiguous delivery becomes `uncertain`. The interface exposes these states instead of claiming success. Gmail authentication and inbox delivery have not been verified with your account because its App Password has not been supplied locally.

## Lender flow

- **Applications:** live applicant, pending, approved and denied counts, with a searchable/sortable/paginated DataTable using the supplied header fields. Only submitted applications assigned to the signed-in lender are visible. View profile displays saved sections and authorized ID/COE downloads.
- **Approve:** opens the agreement modal. Set principal, flat monthly interest, 3/6/12 monthly installments, planned release, first due date and purpose. The totals update immediately; the server validates and independently recalculates the submitted terms. Preview PDF downloads the exact proposed agreement without deciding the application. Approve & Send saves the approval and queues/sends the PDF email.
- **Reject:** requires a reason of 5–2,000 characters. Reject & Send records the decision and emails the reason. No agreement is attached to a rejection.
- **Loaners:** live approved-account total, active-loaner total, pending applicants and overdue loaners. Filters cover status and loan type. The current loan schema represents cash loans, so created agreements are `Money`; the `Item` filter correctly shows no rows unless item-loan support is added in a future phase. `Date Registered` uses application submission time because the supplied users table has no registration timestamp; missing historical dates remain “Not recorded.” No payment-behavior labels are invented.
- **Loans:** reads `loan_agreements` and installment records. View loan shows principal, interest, amount paid, outstanding balance and the installment schedule. Approved agreements start as `draft` / **Awaiting signature**, so account approval does not claim money was disbursed. The lender uploads the signed PDF and confirms the actual release date before the loan becomes active. Existing payment records determine balances, overdue and completed display statuses; this update does not introduce a new payment-entry workflow.
- **Extension Requests:** reads real borrower requests and provides approve/reject controls with email notifications. The associated borrower `payment-extension.php` now submits these requests. Approval moves the selected unpaid installment and all subsequent unpaid installments by the same number of days, with no additional interest or fees. Only one pending request is permitted per loan. Stale or already-paid installment requests cannot be approved. The original signed agreement is retained; the request record and email document the approved variation.
- `loan.php` and `extension-request.php` are aliases for the existing plural filenames.

The prior borrower login restrictions and logout behavior remain: incomplete users resume profiling, pending/rejected users cannot enter the borrower dashboard, and approved users can sign in. Other pre-existing dashboard/payment/demo screens remain outside this implementation except for access checks and navigation links.

## Agreement and calculation

The formal PDF identifies the parties, borrower address, principal, purpose, interest method, finance charge, total repayment, installments, due dates, signature lines and a separate receipt-of-proceeds acknowledgment. It is an unsigned document for review and signing, not proof of disbursement. The borrower replies to the approval email with the signed PDF; the lender records it when releasing the loan.

The selected model is **flat monthly interest on original principal**:

`Total interest = principal × (monthly rate / 100) × installment count`

`Total repayment = principal + total interest`

Calculations are stored to centavos. Regular installments are rounded down to centavos; the final installment absorbs the remainder so the schedule exactly equals total repayment. Monthly dates preserve the first due day, clamping to the last day of shorter months. No extra fees, compounding or penalties are added. The 0–100% input bound is a technical validation limit, not a statement that every rate in that range is legally permissible.

Review the agreement and disclosures for your actual lending operation before using it as a legal contract. This template does not claim to be a complete statutory Truth in Lending disclosure or a legal-compliance certification. The [BSP loan-calculator guidance](https://www.bsp.gov.ph/Pages/InclusiveFinance/LoanCalculator.aspx) explains the need to disclose actual borrowing costs and effective interest.

## Code organization

- `helpers/lending.php`: authorization, dates, amounts, quotations and queue insertion.
- `helpers/agreement_pdf.php`: TCPDF agreement rendering to a string for preview/storage/attachment.
- `helpers/mail.php`: PHPMailer SMTP delivery with locking and retry/uncertainty tracking.
- `helpers/lender_records.php`: scoped table data and counts.
- `controllers/lender-actions.php`: quote, preview, decision, release and email-retry requests.
- `controllers/lender-data.php` and `lender-document.php`: authorized detail/document reads.
- `controllers/borrower-extension.php`: real extension submission.
- `assets/js/lender-flow.js`: DataTables filters, review dialogs and agreement calculation preview.
- `assets/css/lender-flow.css`: additions layered over existing CSS.
- `sql/lender-update.sql`: contract metadata, email outbox and extension-request tables.

The TCPDF tutorial supplied with this session was used as a reference for library inclusion and HTML-to-PDF output. TCPDF is the implemented renderer. The supplied Dompdf source ZIP is an alternative library and is not required or bundled as a second renderer. Tutorial activity instructions and contact addresses were not executed.

## Verification

- 33 HTTP/database integration checks passed with synthetic accounts in `uw_borrower_test_20261009`.
- Eight focused mail-state checks passed: missing credentials, connection failure, retry, interrupted sending, uncertainty acknowledgment and already-sent idempotency.
- Browser checks passed for DataTable initialization, filters, profile loading, live interest totals, PDF preview download, loan installments and extension details. No JavaScript errors were reported.
- PHP and JavaScript syntax checks passed. The two-page sample agreement was rendered and visually inspected; desktop and mobile dialogs were inspected.
- Email MIME messages were captured locally, including the PDF attachment. No test notification was sent to a real inbox. External Google fonts were blocked during browser checks, so screenshots used fallback fonts.
- The existing `uw-ver2` database was not modified. The SQL migrations still need to be imported into the database where you install this update.

Development-only capture mode requires server environment `UW_MAIL_TRANSPORT=capture` plus `UW_MAIL_CAPTURE_DIR` pointing outside the web root. Do not enable capture mode in production.

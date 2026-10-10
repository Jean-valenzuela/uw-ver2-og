# Borrower portal update

## Installation

1. Back up the installed project and database.
2. Merge the ZIP's `uw-ver2-og` folder into `C:/xampp/htdocs/uw-ver2-og`, replacing matching application files. Preserve your local mail/database settings. Do not nest another `uw-ver2-og` folder inside the existing one.
3. Open the website and refresh with Ctrl+F5. The existing schema installer creates the new tables and replaces the old one-agreement-per-borrower index with a normal index so repeat loans are possible. Existing loans and records remain intact.
4. If your database account cannot update the schema, import `sql/borrower-portal.sql` followed by `sql/repeat-loans.sql` into your existing database. `sql/all-updates.sql` is the combined fallback for all previous updates. Do not reimport an old database dump over current records.
5. Ensure PHP file uploads allow 5 MB files (`upload_max_filesize=5M`, `post_max_size=20M`).

The installed XAMPP files and live database have not been overwritten by this package. Changes and tests were performed in a separate copy and isolated test database.

## Borrower flow

- An approved borrower signs in and must upload the signed PDF agreement before opening the dashboard. The upload is private and cannot overwrite an existing signed copy. Existing signed copies already held by the lender are respected. If no agreement exists, the borrower is told to contact the lender.
- Uploading unlocks the dashboard; it does not claim that funds were released. The lender confirms actual release on the existing Loans page and can reuse the uploaded signed PDF.
- The dashboard uses current principal, rate, original term, next installment balance, next due date, day count, unpaid dues and confirmed payment history. Draft loans have no payable installments until released.
- Notifications show installments due within seven days and overdue installments. Mark-as-read persists. A previously read upcoming reminder can produce a new overdue notice when its due date passes.
- Profile tables show the submitted details and protected document links. Personal, financial, reference and ID/photo details can be edited with the existing age, mobile-number and address validation. Profile edits are audited; agreement terms and signed PDFs do not change.
- My Loans lists historical loans, statuses, granted dates, final schedule dates and original agreements. Counts include total, active, completed and overdue. Overdue is a subset of active. Overall released totals exclude draft agreements.
- New-loan requests are accepted only when existing loans and dues are cleared and no request is pending. The lender can approve or reject on **Loan requests** in the lender top bar. Approval creates a new agreement and email, followed by the signed-upload gate again. Rejection leaves the approved borrower account active.
- Payments use the earliest unpaid installment. Borrowers choose the full installment balance or monthly interest only. Payment Extension uses interest-only payment and the previously agreed carry-forward rule.
- Interest-only payment carries all unpaid principal in that installment, including an earlier carry, into the next installment without a penalty or extra interest on the carried amount. At the final installment it adds another month with the usual flat interest on the original principal. The exact amounts are shown before consent and checked again before settlement.
- Payment History shows confirmed payments with date, amount, method and status, plus a separate list of pending/failed/uncertain checkouts. Confirmed history is downloadable as a PDF. Historical manual entries show “Recorded by lender” because their original schema has no payment-method field.

## Per-lender PayMongo setup

The user selected **a separate PayMongo account for each lender**. No shared merchant fallback or automatic transfer/split is used. The loan's lender ID selects the server-side credentials, so payments are created on that lender's account.

1. Each lender obtains their PayMongo test secret API key and enables the needed GCash/card methods in their PayMongo dashboard.
2. Copy `config/paymongo.example.php` outside the web document root, for example to `C:/xampp/private/utangwise-paymongo.php`. Fill in `public_url` with the actual public HTTPS application URL, including `/uw-ver2-og` if applicable.
3. Add one `lenders` entry per lender **user_id**, with that lender's own secret API key and webhook signing secret. Do not use their email as the key. The example uses ID 123 only as a placeholder. Never paste keys into chat, JavaScript, Git or a project ZIP.
4. Set the Apache environment variable `UW_PAYMONGO_CONFIG` to the private file's absolute path. For example, add `SetEnv UW_PAYMONGO_CONFIG "C:/xampp/private/utangwise-paymongo.php"` to your local Apache/vhost configuration, then restart Apache. The application refuses payment configuration stored inside its folder or the public document root.
5. In **each lender's** PayMongo dashboard, register this webhook URL (replace 123 with that lender's ID):
   `https://YOUR-DOMAIN/uw-ver2-og/controllers/paymongo-webhook.php?lender=123`
   Subscribe to `checkout_session.payment.paid` and copy that webhook's signing secret into the same lender's private entry.
6. Start with `mode => 'test'` and an `sk_test_...` secret. Put only dedicated synthetic borrower user IDs in `test_borrower_ids`. Test checkout is refused for other borrowers, and allowed test accounts show a clear TEST MODE label. Test payments change those test borrowers' ledgers, so never allow real borrower IDs in this list.
7. Complete a PayMongo sandbox checkout for both GCash and card through the public HTTPS test site. Confirm the webhook reaches the endpoint, history shows exactly one payment, duplicates do not credit again, cancellation does not mark paid, and interest-only carries match the preview.
8. After sandbox verification, configure the approved live credentials and live webhook secret for each lender and set `mode => 'live'`. Live account/payment-method activation must be completed with PayMongo. No live keys are included here.

Localhost alone cannot receive PayMongo's server-to-server webhook. Use the actual deployed HTTPS site or your own HTTPS development endpoint, and set `public_url` accordingly. The application requires PHP cURL, OpenSSL, fileinfo, mysqli and mbstring; TLS certificate verification remains enabled.

## Payment recovery

- Returning to the success URL never credits a loan. Only a signature-verified webhook or a server-to-server status check with that lender's secret key can do that.
- Amounts are calculated on the server in centavos. Confirmation checks the checkout reference, session, merchant selection, amount, PHP currency, test/live mode and provider payment ID.
- Open or uncertain checkouts block another online checkout, manual lender payment entry and lender schedule changes. A rejected provider request closes as failed; a timeout stays uncertain to avoid duplicate charges.
- Borrowers can resume a pending checkout or use **Check status** in Payment History.
- Lenders have **Online payments** in the top bar. They can check provider status and close an unpaid checkout through PayMongo. For a timeout without a stored session ID, locate the matching reference in that lender's PayMongo account and enter its session ID; the server verifies the reference before linking it.
- If a real payment arrives after an unexpected schedule change, it is shown as received and needing lender reconciliation. It is not silently applied to a changed loan. Refunds, disputes and manual reconciliation of such exceptions require the lender to verify the provider record and contact the borrower; this version does not automate refunds or dispute handling.
- Legacy pending extension requests must be resolved by the lender before a new online payment can start. New extensions complete automatically only after the agreed monthly-interest payment is confirmed.

## Validation completed

44 integration checks passed for gating, documents, profile edits, loan eligibility, approval, interest-only carries and signed payment events. Another 12 checks passed for checkout payloads, stale quotes, CSRF, duplicate checkout prevention, card settlement, mode mismatch, provider rejection/timeouts and changed-schedule reconciliation. Provider creation responses in those extra checks were simulated locally; no real provider charge was sent.

Browser checks covered agreement upload, dashboard values, persistent notifications, borrower pages, four edit forms, successful financial edits, mobile navigation and local assets with no JavaScript errors. The payment-history PDF was rendered and visually checked. Existing stylesheet files are preserved; a new borrower-portal stylesheet supplies styles for the added controls.

Real PayMongo sandbox and live checkout remain unverified until each lender's credentials and a public HTTPS endpoint are configured. Email tests used local capture, not Gmail delivery.

## Official PayMongo references

- Hosted checkout: https://docs.paymongo.com/docs/payment-channels-hosted-checkout
- Checkout quick start: https://docs.paymongo.com/docs/payment-channels-hosted-checkout-quick-start
- Create v2 session: https://docs.paymongo.com/reference/create_checkout_sessions_2
- Retrieve session: https://docs.paymongo.com/reference/get_checkout_sessions
- Expire session: https://docs.paymongo.com/reference/expire-a-checkout-session
- Webhook signatures: https://docs.paymongo.com/docs/developer-tools-webhook-setup-management

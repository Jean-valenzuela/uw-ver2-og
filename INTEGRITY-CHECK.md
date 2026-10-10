# Integrity verification — 10 October 2026

Verified in a separate project copy against isolated MySQL databases using synthetic accounts and documents. Original project ZIPs, installed application files and the real application database were not overwritten.

## Results

- 44 checks: Borrower loans, signatures, payment accounting and provider-event checks.
- 35 checks: Administrator decisions, documents, emails and access checks.
- 25 checks: Profile photos, submissions and notifications.
- 18 checks: Settings, onboarding routes and database balance checks.
- 55 checks: Browser routes, navigation, uploads, field retention and local assets.
- 20 checks: Onboarding mobile and retry behavior.
- 15 checks: Password recovery and session revocation.

**212 functional checks passed.** PHP/JavaScript syntax checks passed for 147 application and script files. The final browser pass reported zero JavaScript errors, missing requested local assets or broken tested PHP links.

The empty installation created 31 tables, zero sample users and three roles. Reapplying additive updates succeeded. The administrator bootstrap created one account and refused a duplicate email. Existing code for payment allocation, PayMongo verification, agreement PDFs and lender decisions was preserved byte-for-byte from the supplied backend.

## Page and function coverage

| Area | Pages and verified behavior |
|---|---|
| Public | Home, approved lenders, registration, login; working links and local assets; changing registration role retains details; duplicate email identifies the field. |
| Recovery | Public/admin Forgot Password links; reset form; registered-recipient email; opaque hashed token, expiry, single use, request limits, new-password login and old-session revocation. |
| Borrower profiling | Verify account, ID/selfie, personal details, finances/COE, reference person, loan preferences and Ready for Review; all seven mobile menus; validation/retry retains inputs; corrected details persist. |
| Borrower account | Signed-agreement gate, upload, dashboard, profile, photo replacement and profile audit; another borrower's documents/loan details are inaccessible. |
| Borrower loans | Loan list, individual loan detail/schedule, totals, repeat-request eligibility and new agreement after approval. |
| Borrower payments | Regular and interest-only accounting, carried principal, additional final month, completion, notification reads, history and downloadable PDF. |
| Lender | Dashboard, pending applications, loaners/profile dialog, loans, repeat requests, manual payments, online-payment recovery, extension list, photo settings, account settings, help and mobile navigation. |
| Administrator | Dashboard counts, application list/details/documents, approval/rejection, registered-recipient emails, approved-lender search/list, notification reads, deletion/access revocation and logout. |
| Data integrity | Corrected inputs save, invalid submissions roll back, duplicate decisions/payment events do not duplicate records, schedule totals match agreements and payment allocations match the ledger. |
| Frontend integration | Original frontend styles retained separately, matching role designs connected to database-backed screens, fonts/icons available locally, legacy prototype URLs resolve to working protected screens. |

## Important test conditions

Emails were captured locally for recipient/body/attachment verification. Delivery to a real Gmail inbox was not tested. Configure the sender App Password and public application URL, then verify an actual email and PDF attachment.

PayMongo checks used locally simulated provider events, including invalid signatures, wrong lender secrets, stale timestamps, amount/currency tampering and duplicate callbacks. No real charge was made. Each lender needs their own keys, signing secret and public HTTPS webhook. Complete provider sandbox GCash/card checkouts before live payments.

The browser used desktop and mobile viewports. Tables remain horizontally scrollable on narrow screens. A test profile photo is a tiny synthetic PNG; real user photos are read through protected document endpoints.

The test matrix covers the listed implemented flows and failure cases. This is not a claim that every possible production condition or third-party delivery outcome has been tested.

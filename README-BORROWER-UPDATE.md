# Borrower profiling, account review and logout update

## Install in XAMPP

1. Back up your existing application folder and database.
2. Extract this application's folder into `C:/xampp/htdocs/` (or copy the updated files into your existing application). Keep the folder structure intact.
3. If setting up a new database, import the original `uw-ver2 (1).sql` supplied with this request into `uw-ver2` first. Do not re-import that backup over an existing database with newer data.
4. Select `uw-ver2` in phpMyAdmin and import `sql/borrower-update.sql`. This adds the submission timestamp table without replacing existing users, profiles, documents, or lender records. It can be run again safely.
5. Check `ajax/config.php`. Defaults remain localhost, root, blank password, database `uw-ver2`. Optional environment variables: `UW_DB_HOST`, `UW_DB_USER`, `UW_DB_PASSWORD`, `UW_DB_NAME`, `UW_BASE_URL`.
6. In PHP configuration, enable mysqli and fileinfo; set `upload_max_filesize=5M` and `post_max_size=12M` or higher. The database packet limit also needs room for a 5 MB document. Restart Apache after configuration changes.
7. Open `public/lenders.php`, choose an approved lender, and register a borrower. An approved lender record must already exist.

The delivered files are a separate working copy. The original ZIP, original SQL backup, existing XAMPP application, and existing `uw-ver2` database were not overwritten.

## Included behavior

- Borrower registration writes to the existing users table and hashes passwords. The shared registration form routes borrowers through the new handler; the original lender registration handler is retained.
- Unfinished profiles can sign in to resume onboarding. Pending and rejected applications cannot sign in to the borrower dashboard. Approved borrowers go to the existing `client-dashboard.php`.
- Every borrower page checks authentication and approval. Logout uses a CSRF-protected POST, clears the session and cookie, and returns to login. Protected pages send no-store headers.
- Five saved profiling sections: ID, personal, financial, reference person, and loan preferences. Completed overview cards become green based on server validation, not just button clicks.
- ID and certificate uploads accept PNG, JPG/JPEG and PDF, maximum 5 MB. The server checks MIME type and upload validity. Documents are stored in the existing database table, and downloads are scoped to the signed-in borrower.
- Personal details require age 21 or above. Mobile and reference numbers use a fixed red +63 prefix followed by exactly ten digits starting with 9. The users table retains its existing 11-digit local phone format for compatibility.
- Certificate of employment is required for employed applicants and optional for other employment statuses. Other income is optional; totals are calculated on both the form and server.
- Loan amount buttons and server validation follow the existing overview's PHP 1,000–3,000 starting-loan range. Purpose and 3/6/12-month preferences are saved; these are preferences, not a loan approval or repayment quotation.
- Agreements is removed from the profiling navigation. Its old URL redirects to Ready for Review.
- Ready for Review displays saved details, selected lender, completion status, and document download links. Submission revalidates all sections in a transaction and changes the account to pending. Pending applications are locked against borrower edits.
- The approved borrower's profile page uses saved application details instead of the previous sample person.
- Both applicant and reference addresses use region → province/area → city/municipality → barangay selections. Only block/lot/house/street is typed. ZIP fills from the selected barangay. Changing a parent clears its dependent selections. The same hierarchy and ZIP mapping are checked on the server.

## Lender work still to do

No lender pages or approval endpoints were added or edited. Actual approval/rejection and Gmail delivery are **not implemented in this borrower-only update**. The existing database already contains `account_status`, `selected_lender_id`, review fields, `review_emails`, and `application_emails` for the next phase.

The future lender decision handler should authorize the selected lender, lock and check a pending borrower, write the decision and review fields, and queue its email transactionally. Configure an authenticated email transport separately and verify delivery. Never expose that status change as a borrower endpoint. There is no automatic approval, no test email sent, and no claim that a notification was delivered.

Other loan/payment screens retain their original business behavior and any existing demonstration data; this update adds their borrower access checks and logout. The original lender registration behavior is outside this update.

## Address data and attribution

The shipped directory works locally without a runtime address API. It contains 18 regions and 42,011 barangays from the downloaded geographic snapshot. Independent cities without a province have an explicit area grouping; Metro Manila is the NCR grouping.

- Geographic hierarchy: [wewillcraft/philippine-datasets, PSA data](https://github.com/wewillcraft/philippine-datasets/tree/main/psa), CC0-1.0.
- Postal mapping: [Open Admin Data, Philippines Administrative Divisions](https://github.com/open-admin-data/philippines-administrative-divisions), [CC BY 4.0](https://creativecommons.org/licenses/by/4.0/).
- Retrieved October 9–10, 2026. Transformation: joined legacy PSGC correspondence codes, normalized names where necessary, and adopted current region/province groupings. 41,975 barangays matched directly or by name/previous name. For 36 remaining entries, the matching municipality had exactly one postal code, which was used. No arbitrary choice among multiple postal codes was made.

These are third-party data snapshots, not a live government address service. Administrative boundaries and postal assignments can change; verify and refresh the directory before a production launch. All shipped entries have a ZIP mapping, but nationwide postal accuracy was not independently audited.

## Verification

- PHP syntax checks passed for the application; the new JavaScript passed syntax checking.
- 24 HTTP/database integration checks passed in an isolated database with synthetic accounts: registration, CSRF, incomplete submission, invalid/valid uploads, age/phone/address validation, COE requirement, optional income and server totals, loan limit, escaped review output, five completed cards, pending submission, approval-dependent login, and logout.
- Browser assertions passed for dependent dropdowns, automatic ZIP and clearing stale selections, the ten-digit phone cap, other-income toggling and totals, quick loan amounts, and ID selection. No browser JavaScript errors were reported.
- Desktop and mobile profiling/review captures were inspected. External Google fonts/icons were blocked during browser checks, so those captures use fallback fonts. Existing CSS and external font references are preserved.
- The test database is `uw_borrower_test_20261009`. It contains synthetic test records only; testing did not alter the supplied production database.

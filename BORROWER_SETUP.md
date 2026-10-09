# UtangWise borrower-side update

1. Back up your existing project and MariaDB database.
2. Use the original supplied uw-ver2 SQL dump. This package does not overwrite existing user records.
3. Copy the project into your PHP server document root, configure ajax/config.php, and open public/login.php.
4. Test a new borrower account: ID upload, personal details, financial details, reference person, loan preferences, ready for review, pending status, and logout.
5. This release does NOT send Gmail approval/rejection notifications; the lender approval and SMTP/email integration are intentionally deferred.
6. Region/province/city selectors depend on https://psgc.gitlab.io/api/ and require internet access. ZIP code still requires a verified city-to-postal-code dataset, and is not automatically populated.
7. Uploaded documents are stored in application_documents. Configure PHP upload_max_filesize and post_max_size for 5 MB documents.
8. The server requires PHP 8+ (str_starts_with), mysqli and fileinfo.
9. The existing application database has users.account_status, application_profiles, and application_documents.
10. Existing CSS is preserved. Existing agreements.php is retained as an unused legacy file to avoid breaking old bookmarks; it is not part of the new borrower submission path.

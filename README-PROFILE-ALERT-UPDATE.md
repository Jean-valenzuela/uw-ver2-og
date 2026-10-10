> For the latest installation and payment setup, start with [README-BORROWER-PORTAL.md](README-BORROWER-PORTAL.md). This older guide describes an earlier update.

# Profile pictures, notifications and submission alerts

## Install

Back up your current project and database. Extract this ZIP and merge the contents of its `uw-ver2-og` folder into `C:/xampp/htdocs/uw-ver2-og`, replacing matching project files. Keep your existing local database and Gmail configuration files. Refresh the browser with Ctrl+F5.

No new SQL import is required for this update. It uses the existing application document and notification-read tables; the existing additive schema installer remains included. Do not reimport an old database dump over your current records.

## Latest fixes

The public lenders page now explicitly loads the original lender.css using the application base path and a cache version. Upload Selfie is directly below the borrower ID upload and its file instructions. It uses the existing protected profile-picture upload.

## Changes

- All 35 existing CSS files are unchanged from the installed project used for this update.
- Lender notifications clear when opened, or through Mark as read / Mark all as read. Read state is saved separately for each lender.
- The Applications table lists only pending borrowers. Summary cards still count all application outcomes; Loaners remains the place to view other borrowers.
- New borrowers upload a JPG or PNG profile picture under ID submission, up to 5 MB. Their selected lender can see it in View profile. Borrower photos are not public.
- Successful borrower submission stays on Ready for Review and displays a SweetAlert. Submitted details are read-only, and refreshing does not repeat the alert or submit again.
- New lender requirements include a profile picture and explain that it appears on the public lenders list after approval. Existing private lender photos are not automatically published; approved lenders can update their photo settings.
- Locally bundled SweetAlert2 shows success messages for registration, profiling saves and existing successful submission flows. Validation errors remain errors. The bundled library includes its license.
- Older submitted borrower accounts without a picture remain usable and show a clear missing-photo message.

## Verification

25 integration checks passed against an isolated test database, including invalid photo rejection, private photo access, pending-only applications, read-state ownership, CSRF protection, duplicate submission protection and approved lender photo visibility. Browser checks verified same-page SweetAlert, one-time display, locked submitted details, loaded profile images and persistent notification clearing with no JavaScript errors. Existing CSS files were compared byte-for-byte.

The installed XAMPP project and live database were not changed. Test emails were captured locally; no Gmail delivery was attempted. Borrower loan requests, payments, extensions and history remain for the next session.

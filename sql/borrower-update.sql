-- Run after importing the supplied uw-ver2 SQL backup. Safe to run again.
-- Existing profiles, documents, users and lender records are preserved.
CREATE TABLE IF NOT EXISTS borrower_submissions (
    user_id INT NOT NULL PRIMARY KEY,
    submitted_at DATETIME NOT NULL,
    CONSTRAINT borrower_submission_user FOREIGN KEY (user_id) REFERENCES users(user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

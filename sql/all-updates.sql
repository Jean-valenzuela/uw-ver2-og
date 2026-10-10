-- Combined additive updates. Select the existing application database first.
-- Run after importing the supplied uw-ver2 SQL backup. Safe to run again.
-- Existing profiles, documents, users and lender records are preserved.
CREATE TABLE IF NOT EXISTS borrower_submissions (
    user_id INT NOT NULL PRIMARY KEY,
    submitted_at DATETIME NOT NULL,
    CONSTRAINT borrower_submission_user FOREIGN KEY (user_id) REFERENCES users(user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Import after the original backup and sql/borrower-update.sql. Non-destructive and repeatable.
CREATE TABLE IF NOT EXISTS lender_contracts (
 agreement_id INT NOT NULL PRIMARY KEY,
 purpose VARCHAR(2000) NOT NULL,
 borrower_name VARCHAR(511) NOT NULL,
 borrower_address TEXT NOT NULL,
 lender_name VARCHAR(511) NOT NULL,
 planned_release_date DATE NOT NULL,
 signed_pdf MEDIUMBLOB NULL,
 released_at DATETIME NULL,
 FOREIGN KEY (agreement_id) REFERENCES loan_agreements(agreement_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS lender_outbox (
 email_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
 event_key VARCHAR(100) NOT NULL UNIQUE,
 borrower_id INT NOT NULL,
 lender_id INT NOT NULL,
 agreement_id INT NULL,
 recipient VARCHAR(255) NOT NULL,
 subject VARCHAR(255) NOT NULL,
 body TEXT NOT NULL,
 status ENUM('queued','sending','failed','uncertain','sent') NOT NULL DEFAULT 'queued',
 attempts INT NOT NULL DEFAULT 0,
 message_id VARCHAR(255) NOT NULL,
 last_error VARCHAR(500) NULL,
 created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
 attempted_at DATETIME NULL,
 sent_at DATETIME NULL,
 FOREIGN KEY (borrower_id) REFERENCES users(user_id),
 FOREIGN KEY (lender_id) REFERENCES users(user_id),
 FOREIGN KEY (agreement_id) REFERENCES loan_agreements(agreement_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS extension_requests (
 request_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
 agreement_id INT NOT NULL,
 borrower_id INT NOT NULL,
 lender_id INT NOT NULL,
 installment_id INT NOT NULL,
 original_due_date DATE NOT NULL,
 requested_due_date DATE NOT NULL,
 reason TEXT NOT NULL,
 status ENUM('pending','approved','rejected') NOT NULL DEFAULT 'pending',
 review_reason TEXT NULL,
 requested_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
 reviewed_at DATETIME NULL,
 reviewed_by INT NULL,
 INDEX lender_status (lender_id,status),
 FOREIGN KEY (agreement_id) REFERENCES loan_agreements(agreement_id),
 FOREIGN KEY (installment_id) REFERENCES loan_installments(installment_id),
 FOREIGN KEY (borrower_id) REFERENCES users(user_id),
 FOREIGN KEY (lender_id) REFERENCES users(user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Import into the existing application database. Repeatable; does not replace records.
CREATE TABLE IF NOT EXISTS lender_submissions (
 user_id INT PRIMARY KEY, submitted_at DATETIME NULL, deleted_at DATETIME NULL, deleted_by INT NULL,
 FOREIGN KEY (user_id) REFERENCES users(user_id), FOREIGN KEY (deleted_by) REFERENCES users(user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
-- Existing submitted accounts remain visible. Their original dates are unknown.
INSERT IGNORE INTO lender_submissions (user_id) SELECT user_id FROM users WHERE user_type_id=1 AND account_status<>'incomplete';
CREATE TABLE IF NOT EXISTS admin_notification_reads (
 admin_id INT NOT NULL, lender_id INT NOT NULL, read_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
 PRIMARY KEY(admin_id,lender_id), FOREIGN KEY(admin_id) REFERENCES users(user_id), FOREIGN KEY(lender_id) REFERENCES users(user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
CREATE TABLE IF NOT EXISTS admin_outbox (
 email_id INT AUTO_INCREMENT PRIMARY KEY, event_key VARCHAR(100) NOT NULL UNIQUE,
 applicant_id INT NOT NULL, admin_id INT NOT NULL, recipient VARCHAR(255) NOT NULL,
 subject VARCHAR(255) NOT NULL, body TEXT NOT NULL,
 status ENUM('queued','sending','failed','uncertain','sent') NOT NULL DEFAULT 'queued',
 attempts INT NOT NULL DEFAULT 0, message_id VARCHAR(255) NOT NULL, last_error VARCHAR(500) NULL,
 created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, attempted_at DATETIME NULL, sent_at DATETIME NULL,
 FOREIGN KEY(applicant_id) REFERENCES users(user_id), FOREIGN KEY(admin_id) REFERENCES users(user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
CREATE TABLE IF NOT EXISTS admin_audit (
 audit_id INT AUTO_INCREMENT PRIMARY KEY, admin_id INT NOT NULL, lender_id INT NOT NULL,
 action VARCHAR(30) NOT NULL, note TEXT NOT NULL, created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
 FOREIGN KEY(admin_id) REFERENCES users(user_id), FOREIGN KEY(lender_id) REFERENCES users(user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS lender_notification_reads (
 lender_id INT NOT NULL, event_type VARCHAR(20) NOT NULL, event_id INT NOT NULL,
 read_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
 PRIMARY KEY(lender_id,event_type,event_id), FOREIGN KEY(lender_id) REFERENCES users(user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS loan_schedule_components (
 installment_id INT PRIMARY KEY, principal_due DECIMAL(12,2) NOT NULL, interest_due DECIMAL(12,2) NOT NULL,
 legacy_principal_paid DECIMAL(12,2) NOT NULL DEFAULT 0, legacy_interest_paid DECIMAL(12,2) NOT NULL DEFAULT 0,
 FOREIGN KEY(installment_id) REFERENCES loan_installments(installment_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
CREATE TABLE IF NOT EXISTS lender_payment_allocations (
 payment_id INT NOT NULL, installment_id INT NOT NULL, principal_amount DECIMAL(12,2) NOT NULL, interest_amount DECIMAL(12,2) NOT NULL,
 PRIMARY KEY(payment_id,installment_id), FOREIGN KEY(payment_id) REFERENCES loan_payments(payment_id), FOREIGN KEY(installment_id) REFERENCES loan_installments(installment_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
CREATE TABLE IF NOT EXISTS loan_principal_carries (
 carry_id INT AUTO_INCREMENT PRIMARY KEY, payment_id INT NOT NULL UNIQUE, from_installment_id INT NOT NULL,
 to_installment_id INT NOT NULL, principal_amount DECIMAL(12,2) NOT NULL, added_interest DECIMAL(12,2) NOT NULL DEFAULT 0,
 created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
 FOREIGN KEY(payment_id) REFERENCES loan_payments(payment_id), FOREIGN KEY(from_installment_id) REFERENCES loan_installments(installment_id), FOREIGN KEY(to_installment_id) REFERENCES loan_installments(installment_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS borrower_agreement_uploads (
 agreement_id INT PRIMARY KEY, borrower_id INT NOT NULL, submitted_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
 FOREIGN KEY(agreement_id) REFERENCES loan_agreements(agreement_id), FOREIGN KEY(borrower_id) REFERENCES users(user_id)
) ENGINE=InnoDB;
CREATE TABLE IF NOT EXISTS borrower_loan_requests (
 request_id INT AUTO_INCREMENT PRIMARY KEY, borrower_id INT NOT NULL, lender_id INT NOT NULL,
 amount DECIMAL(12,2) NOT NULL, term_months INT NOT NULL, purpose VARCHAR(1000) NOT NULL,
 status VARCHAR(20) NOT NULL DEFAULT 'pending', reason VARCHAR(2000) NULL, agreement_id INT NULL,
 created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, reviewed_at DATETIME NULL,
 FOREIGN KEY(borrower_id) REFERENCES users(user_id), FOREIGN KEY(lender_id) REFERENCES users(user_id),
 FOREIGN KEY(agreement_id) REFERENCES loan_agreements(agreement_id), INDEX(borrower_id,status)
) ENGINE=InnoDB;
CREATE TABLE IF NOT EXISTS borrower_profile_audit (
 audit_id INT AUTO_INCREMENT PRIMARY KEY, borrower_id INT NOT NULL, section VARCHAR(50) NOT NULL,
 previous_details MEDIUMTEXT NOT NULL, changed_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
 FOREIGN KEY(borrower_id) REFERENCES users(user_id)
) ENGINE=InnoDB;
CREATE TABLE IF NOT EXISTS borrower_notification_reads (
 borrower_id INT NOT NULL, event_key VARCHAR(100) NOT NULL, read_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
 PRIMARY KEY(borrower_id,event_key), FOREIGN KEY(borrower_id) REFERENCES users(user_id)
) ENGINE=InnoDB;
CREATE TABLE IF NOT EXISTS paymongo_orders (
 order_id CHAR(32) PRIMARY KEY, agreement_id INT NOT NULL, borrower_id INT NOT NULL, lender_id INT NOT NULL,
 installment_id INT NOT NULL, mode VARCHAR(20) NOT NULL, amount_cents INT NOT NULL, quote_json TEXT NOT NULL,
 state VARCHAR(20) NOT NULL DEFAULT 'creating', session_id VARCHAR(100) NULL UNIQUE, checkout_url TEXT NULL,
 provider_payment_id VARCHAR(100) NULL, payment_id INT NULL UNIQUE, method VARCHAR(30) NULL,
 livemode TINYINT NOT NULL DEFAULT 0, created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
 paid_at DATETIME NULL, error_note VARCHAR(500) NULL,
 FOREIGN KEY(agreement_id) REFERENCES loan_agreements(agreement_id), FOREIGN KEY(borrower_id) REFERENCES users(user_id),
 FOREIGN KEY(lender_id) REFERENCES users(user_id), FOREIGN KEY(installment_id) REFERENCES loan_installments(installment_id),
 FOREIGN KEY(payment_id) REFERENCES loan_payments(payment_id), UNIQUE(lender_id,provider_payment_id), INDEX(agreement_id,state)
) ENGINE=InnoDB;

-- Preserve the borrower foreign-key index while allowing repeat loans.
SET @uw_has_index=(SELECT COUNT(*) FROM information_schema.STATISTICS WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME='loan_agreements' AND INDEX_NAME='borrower_agreements');
SET @uw_sql=IF(@uw_has_index=0,'ALTER TABLE loan_agreements ADD INDEX borrower_agreements (borrower_id)','SELECT 1');
PREPARE uw_stmt FROM @uw_sql; EXECUTE uw_stmt; DEALLOCATE PREPARE uw_stmt;
SET @uw_has_unique=(SELECT COUNT(*) FROM information_schema.STATISTICS WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME='loan_agreements' AND INDEX_NAME='one_initial_agreement');
SET @uw_sql=IF(@uw_has_unique>0,'ALTER TABLE loan_agreements DROP INDEX one_initial_agreement','SELECT 1');
PREPARE uw_stmt FROM @uw_sql; EXECUTE uw_stmt; DEALLOCATE PREPARE uw_stmt;

-- Add login throttling without changing existing accounts.
CREATE TABLE IF NOT EXISTS login_attempts (
    attempt_key CHAR(64) NOT NULL PRIMARY KEY,
    attempts INT UNSIGNED NOT NULL DEFAULT 0,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

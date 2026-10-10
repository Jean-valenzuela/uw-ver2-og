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

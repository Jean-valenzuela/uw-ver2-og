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

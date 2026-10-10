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

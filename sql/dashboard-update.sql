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

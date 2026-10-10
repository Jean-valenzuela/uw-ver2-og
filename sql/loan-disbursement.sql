CREATE TABLE IF NOT EXISTS loan_disbursement_details (
 agreement_id INT NOT NULL PRIMARY KEY,
 receiving_method VARCHAR(10) NOT NULL,
 account_holder_name VARCHAR(150) NOT NULL,
 bank_name VARCHAR(100) NULL,
 bank_account_number VARCHAR(40) NULL,
 gcash_mobile_number VARCHAR(11) NULL,
 qr_mime VARCHAR(20) NULL,
 qr_contents MEDIUMBLOB NULL,
 submitted_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
 FOREIGN KEY (agreement_id) REFERENCES loan_agreements(agreement_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- FRESH INSTALL ONLY: select a new, empty database before importing.
-- For an existing installation, use all-updates.sql instead.

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_audit` (
  `audit_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL,
  `lender_id` int(11) NOT NULL,
  `action` varchar(30) NOT NULL,
  `note` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`audit_id`),
  KEY `admin_id` (`admin_id`),
  KEY `lender_id` (`lender_id`),
  CONSTRAINT `admin_audit_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `users` (`user_id`),
  CONSTRAINT `admin_audit_ibfk_2` FOREIGN KEY (`lender_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_notification_reads` (
  `admin_id` int(11) NOT NULL,
  `lender_id` int(11) NOT NULL,
  `read_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`admin_id`,`lender_id`),
  KEY `lender_id` (`lender_id`),
  CONSTRAINT `admin_notification_reads_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `users` (`user_id`),
  CONSTRAINT `admin_notification_reads_ibfk_2` FOREIGN KEY (`lender_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_outbox` (
  `email_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_key` varchar(100) NOT NULL,
  `applicant_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `recipient` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `status` enum('queued','sending','failed','uncertain','sent') NOT NULL DEFAULT 'queued',
  `attempts` int(11) NOT NULL DEFAULT 0,
  `message_id` varchar(255) NOT NULL,
  `last_error` varchar(500) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `attempted_at` datetime DEFAULT NULL,
  `sent_at` datetime DEFAULT NULL,
  PRIMARY KEY (`email_id`),
  UNIQUE KEY `event_key` (`event_key`),
  KEY `applicant_id` (`applicant_id`),
  KEY `admin_id` (`admin_id`),
  CONSTRAINT `admin_outbox_ibfk_1` FOREIGN KEY (`applicant_id`) REFERENCES `users` (`user_id`),
  CONSTRAINT `admin_outbox_ibfk_2` FOREIGN KEY (`admin_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `application_documents` (
  `document_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `kind` varchar(40) NOT NULL,
  `mime_type` varchar(80) NOT NULL,
  `contents` mediumblob NOT NULL,
  PRIMARY KEY (`document_id`),
  UNIQUE KEY `unique_user_document` (`user_id`,`kind`),
  CONSTRAINT `fk_document_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `application_emails` (
  `email_id` int(11) NOT NULL AUTO_INCREMENT,
  `borrower_id` int(11) NOT NULL,
  `lender_id` int(11) NOT NULL,
  `agreement_id` int(11) DEFAULT NULL,
  `decision` enum('approved','rejected') NOT NULL,
  `rejection_reason` text NOT NULL,
  `recipient_email` varchar(255) NOT NULL,
  `recipient_name` varchar(511) NOT NULL,
  `status` enum('sending','failed','uncertain','sent') NOT NULL,
  `message_id` varchar(255) NOT NULL,
  `last_error` varchar(1000) DEFAULT NULL,
  `attempts` int(11) NOT NULL DEFAULT 1,
  `sent_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`email_id`),
  UNIQUE KEY `one_application_decision` (`borrower_id`),
  KEY `fk_email_lender` (`lender_id`),
  KEY `fk_email_agreement` (`agreement_id`),
  CONSTRAINT `fk_email_agreement` FOREIGN KEY (`agreement_id`) REFERENCES `loan_agreements` (`agreement_id`),
  CONSTRAINT `fk_email_borrower` FOREIGN KEY (`borrower_id`) REFERENCES `users` (`user_id`),
  CONSTRAINT `fk_email_lender` FOREIGN KEY (`lender_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `application_profiles` (
  `user_id` int(11) NOT NULL,
  `details` longtext NOT NULL,
  PRIMARY KEY (`user_id`),
  CONSTRAINT `fk_profile_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `borrower_agreement_uploads` (
  `agreement_id` int(11) NOT NULL,
  `borrower_id` int(11) NOT NULL,
  `submitted_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`agreement_id`),
  KEY `borrower_id` (`borrower_id`),
  CONSTRAINT `borrower_agreement_uploads_ibfk_1` FOREIGN KEY (`agreement_id`) REFERENCES `loan_agreements` (`agreement_id`),
  CONSTRAINT `borrower_agreement_uploads_ibfk_2` FOREIGN KEY (`borrower_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `borrower_loan_requests` (
  `request_id` int(11) NOT NULL AUTO_INCREMENT,
  `borrower_id` int(11) NOT NULL,
  `lender_id` int(11) NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `term_months` int(11) NOT NULL,
  `purpose` varchar(1000) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `reason` varchar(2000) DEFAULT NULL,
  `agreement_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `reviewed_at` datetime DEFAULT NULL,
  PRIMARY KEY (`request_id`),
  KEY `lender_id` (`lender_id`),
  KEY `agreement_id` (`agreement_id`),
  KEY `borrower_id` (`borrower_id`,`status`),
  CONSTRAINT `borrower_loan_requests_ibfk_1` FOREIGN KEY (`borrower_id`) REFERENCES `users` (`user_id`),
  CONSTRAINT `borrower_loan_requests_ibfk_2` FOREIGN KEY (`lender_id`) REFERENCES `users` (`user_id`),
  CONSTRAINT `borrower_loan_requests_ibfk_3` FOREIGN KEY (`agreement_id`) REFERENCES `loan_agreements` (`agreement_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `borrower_notification_reads` (
  `borrower_id` int(11) NOT NULL,
  `event_key` varchar(100) NOT NULL,
  `read_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`borrower_id`,`event_key`),
  CONSTRAINT `borrower_notification_reads_ibfk_1` FOREIGN KEY (`borrower_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `borrower_profile_audit` (
  `audit_id` int(11) NOT NULL AUTO_INCREMENT,
  `borrower_id` int(11) NOT NULL,
  `section` varchar(50) NOT NULL,
  `previous_details` mediumtext NOT NULL,
  `changed_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`audit_id`),
  KEY `borrower_id` (`borrower_id`),
  CONSTRAINT `borrower_profile_audit_ibfk_1` FOREIGN KEY (`borrower_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `borrower_submissions` (
  `user_id` int(11) NOT NULL,
  `submitted_at` datetime NOT NULL,
  PRIMARY KEY (`user_id`),
  CONSTRAINT `borrower_submission_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `extension_requests` (
  `request_id` int(11) NOT NULL AUTO_INCREMENT,
  `agreement_id` int(11) NOT NULL,
  `borrower_id` int(11) NOT NULL,
  `lender_id` int(11) NOT NULL,
  `installment_id` int(11) NOT NULL,
  `original_due_date` date NOT NULL,
  `requested_due_date` date NOT NULL,
  `reason` text NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `review_reason` text DEFAULT NULL,
  `requested_at` datetime NOT NULL DEFAULT current_timestamp(),
  `reviewed_at` datetime DEFAULT NULL,
  `reviewed_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`request_id`),
  KEY `lender_status` (`lender_id`,`status`),
  KEY `agreement_id` (`agreement_id`),
  KEY `installment_id` (`installment_id`),
  KEY `borrower_id` (`borrower_id`),
  CONSTRAINT `extension_requests_ibfk_1` FOREIGN KEY (`agreement_id`) REFERENCES `loan_agreements` (`agreement_id`),
  CONSTRAINT `extension_requests_ibfk_2` FOREIGN KEY (`installment_id`) REFERENCES `loan_installments` (`installment_id`),
  CONSTRAINT `extension_requests_ibfk_3` FOREIGN KEY (`borrower_id`) REFERENCES `users` (`user_id`),
  CONSTRAINT `extension_requests_ibfk_4` FOREIGN KEY (`lender_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lender_contracts` (
  `agreement_id` int(11) NOT NULL,
  `purpose` varchar(2000) NOT NULL,
  `borrower_name` varchar(511) NOT NULL,
  `borrower_address` text NOT NULL,
  `lender_name` varchar(511) NOT NULL,
  `planned_release_date` date NOT NULL,
  `signed_pdf` mediumblob DEFAULT NULL,
  `released_at` datetime DEFAULT NULL,
  PRIMARY KEY (`agreement_id`),
  CONSTRAINT `lender_contracts_ibfk_1` FOREIGN KEY (`agreement_id`) REFERENCES `loan_agreements` (`agreement_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lender_notification_reads` (
  `lender_id` int(11) NOT NULL,
  `event_type` varchar(20) NOT NULL,
  `event_id` int(11) NOT NULL,
  `read_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`lender_id`,`event_type`,`event_id`),
  CONSTRAINT `lender_notification_reads_ibfk_1` FOREIGN KEY (`lender_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lender_outbox` (
  `email_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_key` varchar(100) NOT NULL,
  `borrower_id` int(11) NOT NULL,
  `lender_id` int(11) NOT NULL,
  `agreement_id` int(11) DEFAULT NULL,
  `recipient` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `status` enum('queued','sending','failed','uncertain','sent') NOT NULL DEFAULT 'queued',
  `attempts` int(11) NOT NULL DEFAULT 0,
  `message_id` varchar(255) NOT NULL,
  `last_error` varchar(500) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `attempted_at` datetime DEFAULT NULL,
  `sent_at` datetime DEFAULT NULL,
  PRIMARY KEY (`email_id`),
  UNIQUE KEY `event_key` (`event_key`),
  KEY `borrower_id` (`borrower_id`),
  KEY `lender_id` (`lender_id`),
  KEY `agreement_id` (`agreement_id`),
  CONSTRAINT `lender_outbox_ibfk_1` FOREIGN KEY (`borrower_id`) REFERENCES `users` (`user_id`),
  CONSTRAINT `lender_outbox_ibfk_2` FOREIGN KEY (`lender_id`) REFERENCES `users` (`user_id`),
  CONSTRAINT `lender_outbox_ibfk_3` FOREIGN KEY (`agreement_id`) REFERENCES `loan_agreements` (`agreement_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lender_payment_allocations` (
  `payment_id` int(11) NOT NULL,
  `installment_id` int(11) NOT NULL,
  `principal_amount` decimal(12,2) NOT NULL,
  `interest_amount` decimal(12,2) NOT NULL,
  PRIMARY KEY (`payment_id`,`installment_id`),
  KEY `installment_id` (`installment_id`),
  CONSTRAINT `lender_payment_allocations_ibfk_1` FOREIGN KEY (`payment_id`) REFERENCES `loan_payments` (`payment_id`),
  CONSTRAINT `lender_payment_allocations_ibfk_2` FOREIGN KEY (`installment_id`) REFERENCES `loan_installments` (`installment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lender_submissions` (
  `user_id` int(11) NOT NULL,
  `submitted_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `deleted_by` (`deleted_by`),
  CONSTRAINT `lender_submissions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  CONSTRAINT `lender_submissions_ibfk_2` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `loan_agreements` (
  `agreement_id` int(11) NOT NULL AUTO_INCREMENT,
  `borrower_id` int(11) NOT NULL,
  `lender_id` int(11) NOT NULL,
  `approval_date` date NOT NULL,
  `first_due_date` date NOT NULL,
  `principal` decimal(12,2) NOT NULL,
  `monthly_interest_percent` decimal(7,4) NOT NULL,
  `term_months` smallint(6) NOT NULL,
  `total_interest` decimal(12,2) NOT NULL,
  `total_due` decimal(12,2) NOT NULL,
  `monthly_payment` decimal(12,2) NOT NULL,
  `status` enum('draft','active','completed') NOT NULL DEFAULT 'draft',
  `pdf_contents` mediumblob NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`agreement_id`),
  KEY `lender_agreements` (`lender_id`,`status`),
  KEY `borrower_agreements` (`borrower_id`),
  CONSTRAINT `fk_agreement_borrower` FOREIGN KEY (`borrower_id`) REFERENCES `users` (`user_id`),
  CONSTRAINT `fk_agreement_lender` FOREIGN KEY (`lender_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `loan_installments` (
  `installment_id` int(11) NOT NULL AUTO_INCREMENT,
  `agreement_id` int(11) NOT NULL,
  `installment_number` smallint(6) NOT NULL,
  `due_date` date NOT NULL,
  `amount_due` decimal(12,2) NOT NULL,
  `amount_paid` decimal(12,2) NOT NULL DEFAULT 0.00,
  `settled_at` datetime DEFAULT NULL,
  PRIMARY KEY (`installment_id`),
  UNIQUE KEY `agreement_installment` (`agreement_id`,`installment_number`),
  KEY `unpaid_due` (`due_date`),
  CONSTRAINT `fk_installment_agreement` FOREIGN KEY (`agreement_id`) REFERENCES `loan_agreements` (`agreement_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `loan_payments` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `agreement_id` int(11) NOT NULL,
  `recorded_by` int(11) NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `payment_date` date NOT NULL,
  `reference_note` varchar(255) NOT NULL,
  `request_token` char(64) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`payment_id`),
  UNIQUE KEY `payment_request` (`request_token`),
  KEY `fk_payment_agreement` (`agreement_id`),
  KEY `fk_payment_recorder` (`recorded_by`),
  CONSTRAINT `fk_payment_agreement` FOREIGN KEY (`agreement_id`) REFERENCES `loan_agreements` (`agreement_id`),
  CONSTRAINT `fk_payment_recorder` FOREIGN KEY (`recorded_by`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `loan_principal_carries` (
  `carry_id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_id` int(11) NOT NULL,
  `from_installment_id` int(11) NOT NULL,
  `to_installment_id` int(11) NOT NULL,
  `principal_amount` decimal(12,2) NOT NULL,
  `added_interest` decimal(12,2) NOT NULL DEFAULT 0.00,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`carry_id`),
  UNIQUE KEY `payment_id` (`payment_id`),
  KEY `from_installment_id` (`from_installment_id`),
  KEY `to_installment_id` (`to_installment_id`),
  CONSTRAINT `loan_principal_carries_ibfk_1` FOREIGN KEY (`payment_id`) REFERENCES `loan_payments` (`payment_id`),
  CONSTRAINT `loan_principal_carries_ibfk_2` FOREIGN KEY (`from_installment_id`) REFERENCES `loan_installments` (`installment_id`),
  CONSTRAINT `loan_principal_carries_ibfk_3` FOREIGN KEY (`to_installment_id`) REFERENCES `loan_installments` (`installment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `loan_schedule_components` (
  `installment_id` int(11) NOT NULL,
  `principal_due` decimal(12,2) NOT NULL,
  `interest_due` decimal(12,2) NOT NULL,
  `legacy_principal_paid` decimal(12,2) NOT NULL DEFAULT 0.00,
  `legacy_interest_paid` decimal(12,2) NOT NULL DEFAULT 0.00,
  PRIMARY KEY (`installment_id`),
  CONSTRAINT `loan_schedule_components_ibfk_1` FOREIGN KEY (`installment_id`) REFERENCES `loan_installments` (`installment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `loans` (
  `loan_id` int(11) NOT NULL AUTO_INCREMENT,
  `borrower_id` int(11) NOT NULL,
  `lender_id` int(11) NOT NULL,
  `principal` decimal(12,2) NOT NULL,
  `monthly_interest` decimal(7,4) NOT NULL,
  `term_months` int(11) NOT NULL,
  `approval_date` date NOT NULL,
  `total_due` decimal(14,2) NOT NULL,
  `status` enum('draft','active','settled') NOT NULL DEFAULT 'draft',
  `agreement_pdf` mediumblob NOT NULL,
  PRIMARY KEY (`loan_id`),
  UNIQUE KEY `borrower_id` (`borrower_id`),
  KEY `lender_id` (`lender_id`),
  CONSTRAINT `loans_ibfk_1` FOREIGN KEY (`borrower_id`) REFERENCES `users` (`user_id`),
  CONSTRAINT `loans_ibfk_2` FOREIGN KEY (`lender_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login_attempts` (
  `attempt_key` char(64) NOT NULL,
  `attempts` int(11) NOT NULL DEFAULT 1,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`attempt_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `paymongo_orders` (
  `order_id` char(32) NOT NULL,
  `agreement_id` int(11) NOT NULL,
  `borrower_id` int(11) NOT NULL,
  `lender_id` int(11) NOT NULL,
  `installment_id` int(11) NOT NULL,
  `mode` varchar(20) NOT NULL,
  `amount_cents` int(11) NOT NULL,
  `quote_json` text NOT NULL,
  `state` varchar(20) NOT NULL DEFAULT 'creating',
  `session_id` varchar(100) DEFAULT NULL,
  `checkout_url` text DEFAULT NULL,
  `provider_payment_id` varchar(100) DEFAULT NULL,
  `payment_id` int(11) DEFAULT NULL,
  `method` varchar(30) DEFAULT NULL,
  `livemode` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `paid_at` datetime DEFAULT NULL,
  `error_note` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`order_id`),
  UNIQUE KEY `session_id` (`session_id`),
  UNIQUE KEY `payment_id` (`payment_id`),
  UNIQUE KEY `lender_id` (`lender_id`,`provider_payment_id`),
  KEY `borrower_id` (`borrower_id`),
  KEY `installment_id` (`installment_id`),
  KEY `agreement_id` (`agreement_id`,`state`),
  CONSTRAINT `paymongo_orders_ibfk_1` FOREIGN KEY (`agreement_id`) REFERENCES `loan_agreements` (`agreement_id`),
  CONSTRAINT `paymongo_orders_ibfk_2` FOREIGN KEY (`borrower_id`) REFERENCES `users` (`user_id`),
  CONSTRAINT `paymongo_orders_ibfk_3` FOREIGN KEY (`lender_id`) REFERENCES `users` (`user_id`),
  CONSTRAINT `paymongo_orders_ibfk_4` FOREIGN KEY (`installment_id`) REFERENCES `loan_installments` (`installment_id`),
  CONSTRAINT `paymongo_orders_ibfk_5` FOREIGN KEY (`payment_id`) REFERENCES `loan_payments` (`payment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `review_emails` (
  `email_id` int(11) NOT NULL AUTO_INCREMENT,
  `borrower_id` int(11) NOT NULL,
  `lender_id` int(11) NOT NULL,
  `decision` enum('approved','rejected') NOT NULL,
  `reason` text NOT NULL,
  `recipient` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `status` enum('queued','sending','failed','sent') NOT NULL DEFAULT 'queued',
  `attempts` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `sent_at` datetime DEFAULT NULL,
  PRIMARY KEY (`email_id`),
  UNIQUE KEY `borrower_id` (`borrower_id`),
  KEY `lender_id` (`lender_id`),
  CONSTRAINT `review_emails_ibfk_1` FOREIGN KEY (`borrower_id`) REFERENCES `users` (`user_id`),
  CONSTRAINT `review_emails_ibfk_2` FOREIGN KEY (`lender_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_type` (
  `user_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(10) NOT NULL,
  PRIMARY KEY (`user_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type_id` int(11) NOT NULL,
  `user_fn` varchar(255) NOT NULL,
  `user_ln` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `account_status` enum('incomplete','pending','approved','rejected') NOT NULL DEFAULT 'incomplete',
  `selected_lender_id` int(11) DEFAULT NULL,
  `review_note` text DEFAULT NULL,
  `reviewed_by` int(11) DEFAULT NULL,
  `reviewed_at` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `unique_user_email` (`email`),
  KEY `FOREIGN KEY` (`user_type_id`),
  KEY `fk_selected_lender` (`selected_lender_id`),
  KEY `fk_reviewer` (`reviewed_by`),
  CONSTRAINT `FOREIGN KEY` FOREIGN KEY (`user_type_id`) REFERENCES `user_type` (`user_type_id`),
  CONSTRAINT `fk_reviewer` FOREIGN KEY (`reviewed_by`) REFERENCES `users` (`user_id`),
  CONSTRAINT `fk_selected_lender` FOREIGN KEY (`selected_lender_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;


INSERT INTO user_type(user_type_id,type_name) VALUES (1,'lender'),(2,'loaner'),(3,'admin');


CREATE TABLE IF NOT EXISTS account_security (
 user_id INT NOT NULL PRIMARY KEY,
 auth_version INT NOT NULL DEFAULT 0,
 CONSTRAINT account_security_user FOREIGN KEY(user_id) REFERENCES users(user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
CREATE TABLE IF NOT EXISTS password_reset_tokens (
 token_hash CHAR(64) NOT NULL PRIMARY KEY,
 user_id INT NOT NULL,
 expires_at DATETIME NOT NULL,
 used_at DATETIME NULL,
 created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
 delivery_status VARCHAR(20) NOT NULL DEFAULT 'pending',
 INDEX reset_user(user_id),
 CONSTRAINT password_reset_user FOREIGN KEY(user_id) REFERENCES users(user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
CREATE TABLE IF NOT EXISTS password_reset_limits (
 rate_key CHAR(64) NOT NULL PRIMARY KEY,
 attempts INT NOT NULL,
 window_start DATETIME NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

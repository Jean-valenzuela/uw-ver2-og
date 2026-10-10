
-- Preserve the borrower foreign-key index while allowing repeat loans.
SET @uw_has_index=(SELECT COUNT(*) FROM information_schema.STATISTICS WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME='loan_agreements' AND INDEX_NAME='borrower_agreements');
SET @uw_sql=IF(@uw_has_index=0,'ALTER TABLE loan_agreements ADD INDEX borrower_agreements (borrower_id)','SELECT 1');
PREPARE uw_stmt FROM @uw_sql; EXECUTE uw_stmt; DEALLOCATE PREPARE uw_stmt;
SET @uw_has_unique=(SELECT COUNT(*) FROM information_schema.STATISTICS WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME='loan_agreements' AND INDEX_NAME='one_initial_agreement');
SET @uw_sql=IF(@uw_has_unique>0,'ALTER TABLE loan_agreements DROP INDEX one_initial_agreement','SELECT 1');
PREPARE uw_stmt FROM @uw_sql; EXECUTE uw_stmt; DEALLOCATE PREPARE uw_stmt;

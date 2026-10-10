<?php
function uw_ensure_update_schema(mysqli $conn) {
 $groups=[
  'borrower-portal.sql'=>['borrower_agreement_uploads','borrower_loan_requests','borrower_profile_audit','borrower_notification_reads','paymongo_orders'],
  'borrower-update.sql'=>['borrower_submissions'],
  'lender-update.sql'=>['lender_contracts','lender_outbox','extension_requests'],
  'admin-update.sql'=>['lender_submissions','admin_notification_reads','admin_outbox','admin_audit'],
  'dashboard-update.sql'=>['lender_notification_reads','loan_schedule_components','lender_payment_allocations','loan_principal_carries']
 ];
 try {
  $rows=$conn->query('SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_SCHEMA=DATABASE()');$exists=[];
  while($row=$rows->fetch_row())$exists[$row[0]]=true;
  $oldUnique=$conn->query("SELECT COUNT(*) n FROM information_schema.STATISTICS WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME='loan_agreements' AND INDEX_NAME='one_initial_agreement'")->fetch_assoc()['n'];
  if($oldUnique){$conn->multi_query(file_get_contents(__DIR__.'/../sql/repeat-loans.sql'));do{if($r=$conn->store_result())$r->free();if(!$conn->more_results())break;}while($conn->next_result());}
  foreach($groups as $file=>$tables){
   if(!array_diff($tables,array_keys($exists)))continue;
   $sql=file_get_contents(__DIR__.'/../sql/'.$file);
   $conn->multi_query($sql);
   do{if($result=$conn->store_result())$result->free();if(!$conn->more_results())break;}while($conn->next_result());
  }
 }catch(Throwable $e){
  error_log('Utang Wise additive schema setup: '.$e->getMessage());http_response_code(503);
  exit('Database update required. Import sql/all-updates.sql into the existing application database in phpMyAdmin, then reload. Existing records are preserved.');
 }
}

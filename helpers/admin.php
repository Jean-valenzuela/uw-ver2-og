<?php
require_once __DIR__.'/../ajax/app.php';
header('Cache-Control: no-store, private');
function admin_user() {
 $u=require_user(3);
 if($u['account_status']!=='approved'){http_response_code(403);exit('An approved administrator account is required.');}
 return $u;
}
function admin_json($data,$status=200){ if (isset($data['error']) && !isset($data['field'])) $data['field']=uw_error_field($data['error']); http_response_code($status);header('Content-Type: application/json');echo json_encode($data,JSON_INVALID_UTF8_SUBSTITUTE);exit;}
function admin_lender($id,$lock=false){
 $u=db("SELECT u.user_id,u.user_fn,u.user_ln,u.email,u.phone,u.account_status,u.review_note,u.reviewed_at,s.submitted_at,s.deleted_at FROM users u LEFT JOIN lender_submissions s ON s.user_id=u.user_id WHERE u.user_id=? AND u.user_type_id=1".($lock?' FOR UPDATE':''),[$id])->get_result()->fetch_assoc();
 if(!$u||$u['deleted_at'])throw new DomainException('Lender profile not found.');return $u;
}
function admin_requirements($id){
 $p=profile($id)?:[];$v=$p['requirements']??$p;
 return ['source_of_funds'=>$v['source_of_funds']??'', 'lending_limit'=>$v['lending_limit']??'', 'lender_reason'=>$v['lender_reason']??''];
}
function admin_requirements_complete($id){
 $raw=profile($id)?:[];if(!empty($raw['requirements']['photo_required'])&&!document_exists($id,'lender_photo'))return false;
 $v=admin_requirements($id);return trim((string)$v['source_of_funds'])!=='' && is_numeric($v['lending_limit']) && (float)$v['lending_limit']>0 && trim((string)$v['lender_reason'])!=='' && document_exists($id,'source_proof') && document_exists($id,'valid_id');
}
function admin_list($approved=false,$recent=false){
 return db("SELECT u.user_id,u.user_fn,u.user_ln,u.email,u.phone,u.account_status,s.submitted_at FROM users u LEFT JOIN lender_submissions s ON s.user_id=u.user_id WHERE u.user_type_id=1 AND s.deleted_at IS NULL AND ".($approved?"u.account_status='approved'":"u.account_status<>'incomplete'")." ORDER BY s.submitted_at DESC,u.user_id DESC".($recent?' LIMIT 5':''))->get_result()->fetch_all(MYSQLI_ASSOC);
}
function admin_notifications($adminId){
 $where=" FROM users u JOIN lender_submissions s ON s.user_id=u.user_id LEFT JOIN admin_notification_reads n ON n.lender_id=u.user_id AND n.admin_id=? WHERE u.user_type_id=1 AND u.account_status<>'incomplete' AND s.deleted_at IS NULL AND n.lender_id IS NULL";
 return ['count'=>(int)db('SELECT COUNT(*) AS total'.$where,[$adminId])->get_result()->fetch_assoc()['total'],'items'=>db('SELECT u.user_id,u.user_fn,u.user_ln,s.submitted_at'.$where.' ORDER BY s.submitted_at DESC,u.user_id DESC LIMIT 20',[$adminId])->get_result()->fetch_all(MYSQLI_ASSOC)];
}

<?php
require_once __DIR__.'/../ajax/app.php';
function upload_borrower_photo($id){
 $f=$_FILES['profile_photo']??null;
 if(!$f||$f['error']===UPLOAD_ERR_NO_FILE){if(!document_exists($id,'profile_photo'))throw new RuntimeException(uw_field_message('profile_photo','Upload your profile picture as JPG or PNG.'));return;}
 if($f['error']!==UPLOAD_ERR_OK||$f['size']>5*1024*1024||!is_uploaded_file($f['tmp_name']))throw new RuntimeException(uw_field_message('profile_photo','Profile photo must be a JPG or PNG up to 5 MB.'));
 $image=@getimagesize($f['tmp_name']);$mime=(new finfo(FILEINFO_MIME_TYPE))->file($f['tmp_name']);
 if(!$image||!in_array($mime,['image/jpeg','image/png'],true)||$image[0]>10000||$image[1]>10000)throw new RuntimeException(uw_field_message('profile_photo','Use a valid JPG or PNG profile photo, no larger than 10,000 pixels per side.'));
 upload_document($id,'profile_photo');
}

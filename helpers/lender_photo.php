<?php
require_once __DIR__.'/../ajax/app.php';
function upload_lender_photo($id,$required=true){
 $f=$_FILES['lender_photo']??null;
 if(!$f||$f['error']===UPLOAD_ERR_NO_FILE){if($required&&!document_exists($id,'lender_photo'))throw new RuntimeException('Upload a selfie or profile photo.');return;}
 if($f['error']!==UPLOAD_ERR_OK||$f['size']>5*1024*1024||!is_uploaded_file($f['tmp_name']))throw new RuntimeException('Upload a JPG or PNG photo up to 5 MB.');
 $image=@getimagesize($f['tmp_name']);$mime=(new finfo(FILEINFO_MIME_TYPE))->file($f['tmp_name']);
 if(!$image||!in_array($mime,['image/jpeg','image/png'],true)||$image[0]>10000||$image[1]>10000)throw new RuntimeException('Use a valid JPG or PNG photo, no larger than 10,000 pixels per side.');
 upload_document($id,'lender_photo');
}

<?php
function uw_success_assets(){
 static $done=false;if($done)return;$done=true;
 if(isset($_SESSION['uw_success'])){echo '<script type="application/json" id="uwSuccessData">'.json_encode($_SESSION['uw_success'],JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS|JSON_HEX_QUOT|JSON_INVALID_UTF8_SUBSTITUTE).'</script>';unset($_SESSION['uw_success']);}
 echo '<script src="'.e(base_url()).'/assets/vendor/sweetalert2/sweetalert2.all.min.js"></script><script src="'.e(base_url()).'/assets/js/success-alerts.js?v=20261010" defer></script><script src="'.e(base_url()).'/assets/js/form-validation.js?v=20261010" defer></script>';
}

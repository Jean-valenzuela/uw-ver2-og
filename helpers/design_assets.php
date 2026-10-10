<?php
function uw_role_design_assets($role, $page) {
    $root=e(base_url());
    echo '<link rel="stylesheet" href="'.$root.'/assets/css/local-fonts.css">';
    if ($role === 'admin') {
        $file=['dashboard'=>'superadmin','lender-applications'=>'lender-applications','approved-lenders'=>'approved-lenders'][$page] ?? 'superadmin';
        echo '<link rel="stylesheet" href="'.$root.'/assets/css/integ-lender/datatables.min.css?v=20261010">';
        echo '<link rel="stylesheet" href="'.$root.'/assets/css/integ-admin/'.$file.'.css?v=20261010">';
        echo '<link rel="stylesheet" href="'.$root.'/assets/css/integ-admin/functional.css?v=20261010">';
    } else {
        $file=['dashboard'=>'dashboard','applications'=>'applications','loaners'=>'loaners-list','loans'=>'debts-loans','extension-requests'=>'extension-requests','loaners-priv'=>'loaners-priv','personal-details-view'=>'loaners-priv','financial-details-view'=>'loaners-priv','reference-person-view'=>'loaners-priv','supporting-documents'=>'loaners-priv','application-details'=>'application-details','request'=>'request','request-list'=>'request-list','payments'=>'dashboard'][$page] ?? 'dashboard';
        echo '<link rel="stylesheet" href="'.$root.'/assets/css/integ-lender/datatables.min.css?v=20261010">';
        echo '<link rel="stylesheet" href="'.$root.'/assets/css/integ-lender/'.$file.'.css?v=20261010">';
        echo '<link rel="stylesheet" href="'.$root.'/assets/css/integ-lender/functional.css?v=20261010">';
        echo '<script src="'.$root.'/assets/js/lender-design.js?v=20261010" defer></script>';
    }
}

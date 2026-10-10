<?php
require __DIR__.'/../helpers/lending.php';
lender_user();
$id=(int)($_GET['borrower_id'] ?? $_GET['id'] ?? $_GET['view_id'] ?? 0);
go('lender/loaners.php'.($id>0?'?view_id='.$id:'' ));

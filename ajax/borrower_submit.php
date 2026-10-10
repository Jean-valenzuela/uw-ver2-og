<?php
// Legacy route shares the validated transactional submission handler.
$_POST['step']='submit';require __DIR__.'/save_borrower.php';

<?php
// Copy OUTSIDE htdocs. Set UW_PAYMONGO_CONFIG to its absolute path in Apache's environment.
// Lender keys are server-only. Never commit or send the real file in a project ZIP.
return [
 'public_url'=>'https://YOUR-DOMAIN/uw-ver2-og',
 'lenders'=>[
  // Replace 123 with the lender user_id. Add a separate entry for each lender.
  123=>['mode'=>'test','secret_key'=>'','webhook_secret'=>'','test_borrower_ids'=>[]],
 ],
];

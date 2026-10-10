<?php
// Copy OUTSIDE the web root as uw-mail.private.php, or set UW_MAIL_CONFIG to its absolute path.
// Never commit or share the completed private configuration.
return [
 'public_url'=>'', // Full application URL, e.g. https://your-domain/uw-ver2-og. Required for reset emails.
 'host'=>'smtp.gmail.com', 'port'=>587, 'encryption'=>'tls',
 'username'=>'ayettacore@gmail.com',
 'password'=>'ptvbcbxcuymqknnc', // Put the Gmail App Password in mail.local.php or a private config outside the web root.
 'from'=>'ayettacore@gmail.com', 'from_name'=>'Utang Wise',
];

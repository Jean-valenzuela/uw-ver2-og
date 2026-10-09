<?php
// Copy OUTSIDE the web root. Set UW_MAIL_CONFIG to the absolute file path.
// Never commit or share the completed private configuration.
return [
 'host'=>'smtp.gmail.com', 'port'=>587, 'encryption'=>'tls',
 'username'=>'ayettacore@gmail.com',
 'password'=>'', // Gmail App Password; do not use the normal account password.
 'from'=>'ayettacore@gmail.com', 'from_name'=>'Utang Wise',
];

<?php
require __DIR__ . '/../ajax/app.php';
header('Cache-Control: no-store, private');
$u = require_user(2);
if (in_array($u['account_status'], ['approved','incomplete'], true)) go(destination($u));
page_start($u['account_status'] === 'pending' ? 'Application under review' : 'Application not approved');
?>
<p><?= e($u['user_fn']) ?>, <?= $u['account_status'] === 'pending' ? 'your application has been submitted to your selected lender. Dashboard access becomes available after approval.' : 'your lender has rejected your account application.' ?></p>
<?php if ($u['account_status'] === 'rejected' && $u['review_note']): ?><p><?= e($u['review_note']) ?></p><?php endif; ?>
<p>Your account email is <?= e($u['email']) ?>.</p>
<p><a href="status.php">Refresh account status</a></p>
<?php page_end(); ?>

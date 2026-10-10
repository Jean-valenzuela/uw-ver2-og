<?php require __DIR__ . '/../helpers/borrower_portal.php';
$borrowerAccount = borrower_user();
$step = $_GET['section'] ?? 'personal-details';
if (!in_array($step, ['idverification', 'personal-details', 'financial-details', 'reference-person'], true)) {
    http_response_code(404);
    exit;
}
$values = profile($borrowerAccount['user_id'])[$step] ?? [];
portal_start('Edit profile', 'profile'); ?>
<section class="portal-card">
    <nav><?php foreach (['idverification', 'personal-details', 'financial-details', 'reference-person'] as $s): ?><a
                href="?section=<?= $s ?>"><?= e(ucwords(str_replace('-', ' ', $s))) ?></a> · <?php endforeach; ?></nav>
    <form class="portal-form" data-borrower-form method="post" enctype="multipart/form-data"
        action="../controllers/borrower-profile.php"><?php csrf(); ?><input type="hidden" name="step"
            value="<?= e($step) ?>"><?php foreach (borrower_schema()[$step] as $key => $rule):
                  if (preg_match('/^(reference_)?(region|province|city|barangay|zip|zip_code)$/', $key))
                      continue; ?><label><?= e(ucwords(str_replace('_', ' ', $key))) ?><?= in_array($key, ['mobile', 'reference_contact']) ? ' (+63)' : '' ?><?php if (isset($rule['options'])): ?><select
                        name="<?= e($key) ?>" <?= $rule['required'] ? 'required' : '' ?>><?php if (!$rule['required']): ?>
                            <option value="">Not specified</option><?php endif;
                            foreach ($rule['options'] as $o): ?>
                            <option value="<?= e($o) ?>" <?= ($values[$key] ?? '') === $o ? 'selected' : '' ?>><?= e(ucfirst($o)) ?></option>
                        <?php endforeach; ?>
                    </select><?php else: ?><input name="<?= e($key) ?>" value="<?= e($values[$key] ?? '') ?>"
                        type="<?= $key === 'birth_date' ? 'date' : (strpos($key, 'email') !== false ? 'email' : 'text') ?>"
                        <?= $rule['required'] ? 'required' : '' ?>         <?= in_array($key, ['mobile', 'reference_contact']) ? 'maxlength="10" pattern="9[0-9]{9}"' : '' ?>         <?= in_array($key, ['email', 'total_income']) ? 'readonly' : '' ?>><?php endif; ?></label><?php endforeach;
              if (in_array($step, ['personal-details', 'reference-person']))
                  borrower_address_fields($step === 'reference-person' ? 'reference_' : '', $values);
              if ($step === 'idverification'): ?><label>Replace
                ID (JPG, PNG or PDF)<input type="file" name="valid_id" accept=".jpg,.jpeg,.png,.pdf"></label><label>Replace
                selfie / profile picture (JPG or PNG)<input type="file" name="profile_photo"
                    accept=".jpg,.jpeg,.png"></label><?php endif;
              if ($step === 'financial-details'): ?><label>Replace
                certificate of employment<input type="file" name="coe"
                    accept=".jpg,.jpeg,.png,.pdf"></label><?php endif; ?><button>Save profile details</button><a
            href="profile.php">Back to profile</a></form>
</section>
<script type="application/json"
    id="uw-profile-data"><?= json_encode($values, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?></script>
<script src="../assets/js/borrower-profiling.js" defer></script><?php portal_end(); ?>
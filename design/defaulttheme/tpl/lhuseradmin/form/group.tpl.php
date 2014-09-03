<?php include(erLhcoreClassDesign::designtpl('lhkernel/csfr_token.tpl.php'));?>

<label><?=__t('user/newgroup','Name')?></label>
<input type="text" name="Name" value="<?=htmlspecialchars($groupData->name)?>" />
<?php include(erLhcoreClassDesign::designtpl('lhkernel/csfr_token.tpl.php'));?>
<div class="form-group">
	<label><?=__t('user/newgroup','Name')?></label>
	<input type="text" name="Name" class="form-control"  value="<?=htmlspecialchars($groupData->name)?>" />
</div>
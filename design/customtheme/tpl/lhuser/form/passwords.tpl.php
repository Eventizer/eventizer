<?php include(erLhcoreClassDesign::designtpl('lhkernel/csfr_token.tpl.php'));?>

<div class="form-group">
	<label><?=__t('user/form/user','Password')?></label>
	<input class="form-control" type="password" name="Password" placeholder="<?=__t('user/form/user','Enter a new password')?>" value="" />
</div>

<div class="form-group">
	<label><?=__t('user/form/user','Confirm password')?></label>
	<input class="form-control" type="password" name="Password1" placeholder="<?=__t('user/form/user','Repeat the new password')?>" value="" />
</div>
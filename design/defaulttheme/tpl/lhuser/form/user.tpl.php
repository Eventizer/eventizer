<?php include(erLhcoreClassDesign::designtpl('lhkernel/csfr_token.tpl.php'));?>

<label><?=__t('user/form/user','First name')?>*</label>
<input type="text" name="Name" value="<?=htmlspecialchars($userData->name)?>" />

<label><?=__t('user/form/user','Surname')?>*</label>
<input type="text" name="Surname" value="<?=htmlspecialchars($userData->surname)?>" />

<label><?=__t('user/form/user','Email')?>*</label>
<input type="text" name="Email" value="<?=htmlspecialchars($userData->email)?>" placeholder="<?=__t('user/form/user','Your email address')?>" />

<label><?=__t('user/form/user','Password')?></label>
<input type="password" name="Password" placeholder="<?=__t('user/form/user','Enter a new password')?>" value="" />

<label><?=__t('user/form/user','Confirm password')?></label>
<input type="password" name="Password1" placeholder="<?=__t('user/form/user','Repeat the new password')?>" value="" />
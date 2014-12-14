<?php include(erLhcoreClassDesign::designtpl('lhkernel/csfr_token.tpl.php'));?>

<div class="form-group">
    <input type="text" class="form-control" placeholder="<?=__t('user/form/user','First name')?>" required name="Name" value="<?=htmlspecialchars($userData->name)?>" />
</div>

<div class="form-group">
    <input type="text" class="form-control" name="Surname" placeholder="<?=__t('user/form/user','Surname')?>" required value="<?=htmlspecialchars($userData->surname)?>" />
</div>

<div class="form-group">
    <input  type="text" class="form-control" name="Email" value="<?=htmlspecialchars($userData->email)?>" placeholder="<?=__t('user/form/user','Your email address')?>" required />
</div>

<div class="form-group">
    <input type="password"  class="form-control" name="Password" placeholder="<?=__t('user/form/user','Enter a new password')?>" value="" required />
</div>

<div class="form-group">
    <input type="password" class="form-control" name="Password1" placeholder="<?=__t('user/form/user','Repeat the new password')?>" value=""  required />
</div>
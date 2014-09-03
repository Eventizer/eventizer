<?php include(erLhcoreClassDesign::designtpl('lhkernel/csfr_token.tpl.php'));?>
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label><?=__t('user/form/user','First name')?>*</label>
			<input type="text" class="form-control" name="Name" value="<?=htmlspecialchars($userData->name)?>" />
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label><?=__t('user/form/user','Surname')?>*</label>
			<input class="form-control" type="text" name="Surname" value="<?=htmlspecialchars($userData->surname)?>" />
		</div>
	</div>
</div>


<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label><?=__t('user/form/user','Email')?>*</label>
			<input class="form-control" type="text" name="Email" value="<?=htmlspecialchars($userData->email)?>" placeholder="<?=__t('user/form/user','Your email address')?>" />
		</div>
	</div>
	<div class="col-md-6">
		
	</div>
</div>



<div class="form-group">
     <label for="exampleInputFile"><?=__t('user/form/user','Photo')?></label>
     <input type="file" name="UserPhoto" id="exampleInputFile">
     <br />
     <img width="60" src="<?php if ($userData->has_photo) : ?><?php echo $userData->photow_150;?><?php else : ?><?php echo erLhcoreClassDesign::design('images/avatar3.png');?><?php endif;?>" class="text-left" alt="<?=htmlspecialchars($userData)?>" />
</div>

<div class="explain">
	<?=__t('user/account','Do not enter a password unless you want to change it')?>
</div>

<div class="form-group">
	<label><?=__t('user/form/user','Password')?></label>
	<input class="form-control" type="password" name="Password" placeholder="<?=__t('user/form/user','Enter a new password')?>" value="" />
</div>

<div class="form-group">
	<label><?=__t('user/form/user','Confirm password')?></label>
	<input class="form-control" type="password" name="Password1" placeholder="<?=__t('user/form/user','Repeat the new password')?>" value="" />
</div>
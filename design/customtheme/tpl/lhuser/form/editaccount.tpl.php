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
		<div class="form-group">
			<label><?=__t('user/form/user','Organizer name')?>*</label>
			<input class="form-control" type="text" name="orgName" value="<?=htmlspecialchars($userData->org_name)?>" placeholder="<?=__t('user/form/user','Your organizer name')?>" />
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label><?=__t('user/form/user','Organizer website address')?></label>
			<input class="form-control" type="text" name="orgWWW" value="<?=htmlspecialchars($userData->org_www)?>" placeholder="<?=__t('user/form/user','http://eventizer.org')?>" />
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label><?=__t('user/form/user','Organizer facebook address')?></label>
			<input class="form-control" type="text" name="orgFB" value="<?=htmlspecialchars($userData->org_fb)?>" placeholder="<?=__t('user/form/user','http://facebook.com/eventizer.org')?>" />
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label><?=__t('user/form/user','Organizer twitter address')?></label>
			<input class="form-control" type="text" name="orgTW" value="<?=htmlspecialchars($userData->org_tw)?>" placeholder="<?=__t('user/form/user','http://twitter.com/eventizer')?>" />
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
		</div>
	</div>
</div>

<div class="row">
   <div class="col-md-12">     
        <div class="form-group">
        	<label><?=__t('eventadmin/new','Organizer description')?></label>
        	<?php
				$oFCKeditor = new CKEditor() ;        
				$oFCKeditor->basePath = erLhcoreClassDesign::design('js/ckeditor').'/' ;
				CKFinder::SetupCKEditor($oFCKeditor, erLhcoreClassDesign::design('js/ckfinder/'));   
				$oFCKeditor->config['height'] = 300;
				$oFCKeditor->config['width'] = '100%';        
				$oFCKeditor->editor('orgDescription',$userData->org_description) ;    
			?> 
        </div>
    </div>
</div>



<div class="form-group">
     <label for="exampleInputFile"><?=__t('user/form/user','Photo')?></label>
     <input type="file" name="UserPhoto" id="exampleInputFile">
     <br />
     <img width="60" src="<?php if ($userData->has_photo) : ?><?php echo $userData->photow_150;?><?php else : ?><?php echo erLhcoreClassDesign::design('images/avatar3.png');?><?php endif;?>" class="text-left" alt="<?=htmlspecialchars($userData)?>" />
</div>
<hr /> 

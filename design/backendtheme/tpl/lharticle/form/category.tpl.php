<?php include(erLhcoreClassDesign::designtpl('lhkernel/csfr_token.tpl.php'));?>

<div class="row">
   <div class="col-md-12">     
        <div class="form-group">
			<label><?=__t('article/formcategory','Name')?> *</label>
			<input class="form-control" type="text" name="CategoryName" value="<?=htmlspecialchars($categoryData->{'name'});?>" />
		</div>
	</div>
</div>

<div class="row">
   <div class="col-md-12">     
        <div class="form-group">
			<label><?=__t('article/formcategory','Alternative URL (remote)')?></label>
			<input class="form-control" type="text" name="URLAlternative" value="<?=htmlspecialchars($categoryData->{'url_alternative'});?>" />
		</div>
	</div>
</div>

<div class="row">
   <div class="col-md-12">     
        <div class="form-group">
		<label><?=__t('article/formcategory','Intro')?></label>
		<?    	
			$oFCKeditor = new CKEditor() ;        
		    $oFCKeditor->basePath = erLhcoreClassDesign::design('js/ckeditor').'/' ;  
		    CKFinder::SetupCKEditor($oFCKeditor, erLhcoreClassDesign::design('js/ckfinder/'));        
		    $oFCKeditor->config['height'] = 300;
			$oFCKeditor->config['width'] = '100%';        
		    $oFCKeditor->editor('Intro',$categoryData->{'intro'}) ;
		?>     
	
		</div>
	</div>
</div>

<div class="row">
   <div class="col-xs-2">     
        <div class="form-group">
			<label><?=__t('article/formcategory','Position')?></label>
			<input class="form-control" type="text" name="CategoryPos" value="<?=htmlspecialchars($categoryData->pos)?>" />
		</div>
	</div>
</div>

 <?php if($categoryData->parent_id == 0):?>
<div class="row">
   <div class="col-xs-2">     
        <div class="form-group">
			<label><?=__t('article/formcategory','Categry type')?></label>
			<select name="Type" class="form-control">
		      <option value="" ><?=__t('article/formcategory','Select menu type')?></option>	
		      <option value="1" <?php if(htmlspecialchars($categoryData->type)==1):?>selected<?php endif;?>><?=__t('article/formcategory','In top menu')?></option>	
		      <option value="2" <?php if(htmlspecialchars($categoryData->type)==2):?>selected<?php endif;?>><?=__t('article/formcategory','In bottom menu')?></option>	
			</select>
		</div>
	</div>
</div>
<?php endif;?>
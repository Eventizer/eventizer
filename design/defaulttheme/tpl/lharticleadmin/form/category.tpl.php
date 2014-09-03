<?php include(erLhcoreClassDesign::designtpl('lhkernel/csfr_token.tpl.php'));?>

<?php $languages = erConfigClassLhConfig::getInstance()->getSetting( 'site', 'site_languages' );?>

<dl class="tabs" data-tab>
	<?php foreach ($languages as $key=>$language) : ?>
	<?php $locale = strtolower($language['locale']); ?>
	<dd <?php if($key=='eng'):?>class="active"<?php endif;?>><a href="#panel_<?=$locale?>"><?=$language['title']?></a></dd>
<?php endforeach; ?>
</dl>	

<div class="tabs-content">
	<?php foreach ($languages as $key=>$language) : ?>
		<?php $locale = strtolower($language['locale']); ?>
	 	<div class="content <?php if($key=='eng'):?>active<?php endif;?>" id="panel_<?=$locale?>">
			<label><?=__t('articleadmin/formcategory','Name')?> *</label>
			<input type="text" name="CategoryName_<?=$locale?>" value="<?=htmlspecialchars($categoryData->{'name_'.$locale});?>" />

			<label><?=__t('articleadmin/formcategory','Alternative URL (remote)')?></label>
			<input type="text" name="URLAlternative_<?=$locale?>" value="<?=htmlspecialchars($categoryData->{'url_alternative_'.$locale});?>" />
	
			<label><?=__t('articleadmin/formcategory','Intro')?></label>
			<?    	
				$oFCKeditor = new CKEditor() ;        
			    $oFCKeditor->basePath = erLhcoreClassDesign::design('js/ckeditor').'/' ;  
			    CKFinder::SetupCKEditor($oFCKeditor, erLhcoreClassDesign::design('js/ckfinder/'));        
			    $oFCKeditor->config['height'] = 300;
				$oFCKeditor->config['width'] = '100%';        
			    $oFCKeditor->editor('Intro_'.$locale,$categoryData->{'intro_'.$locale}) ;
			?>     
	 </div>
	 <?php endforeach; ?>
</div>

<label><?=__t('articleadmin/formcategory','Position')?></label>
<input type="text" name="CategoryPos" value="<?=htmlspecialchars($categoryData->pos)?>" />

<br />
<br />
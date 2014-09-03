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
			<label><?=__t('articleadmin/formarticle','Name')?> *</label>
			<input type="text" name="ArticleName_<?=strtolower($locale)?>" value="<?=htmlspecialchars($articleData->{'name_'.strtolower($locale)});?>" />

			<div class="row">
			    <div class="columns large-6">
			    	<label><?=__t('articleadmin/formarticle','Alternative URL')?></label>
					<input type="text" name="AlternativeURL_<?=strtolower($locale)?>" value="<?=htmlspecialchars($articleData->{'alternative_url_'.strtolower($locale)});?>" />
			    </div>
			    <div class="columns large-6">
			    	<label><?=__t('articleadmin/formarticle','Alias URL')?></label>
					<input type="text" name="AliasURL_<?=strtolower($locale)?>" value="<?=htmlspecialchars($articleData->{'alias_url_'.strtolower($locale)});?>" />
			    </div>
			</div>
		      	
		    <label><?=__t('articleadmin/editstatic','Intro')?> *</label>
			<?
				$oFCKeditor = new CKEditor() ;        
				$oFCKeditor->basePath = erLhcoreClassDesign::design('js/ckeditor').'/' ;
				CKFinder::SetupCKEditor($oFCKeditor, erLhcoreClassDesign::design('js/ckfinder/'));   
				$oFCKeditor->config['height'] = 300;
				$oFCKeditor->config['width'] = '100%';        
				$oFCKeditor->editor('ArticleIntro_'.strtolower($locale),$articleData->{'intro_'.strtolower($locale)}) ;    
			?>       
			<br />
				
			<label><?=__t('articleadmin/editstatic','Content')?></label>
			<?
				$oFCKeditor = new CKEditor() ;        
				$oFCKeditor->basePath = erLhcoreClassDesign::design('js/ckeditor').'/' ;  
				CKFinder::SetupCKEditor($oFCKeditor, erLhcoreClassDesign::design('js/ckfinder/')); 
				$oFCKeditor->config['height'] = 300;
				$oFCKeditor->config['width'] = '100%'; 
				$oFCKeditor->editor('ArticleBody_'.strtolower($locale),$articleData->{'body_'.strtolower($locale)}) ;
			?>
			<br />
	 </div>
	 <?php endforeach; ?>
</div>

<label><?=__t('articleadmin/formarticle','Thumbnail')?></label>   
<input type="file" name="ArticleThumb" value="" > (*.jpg;*.png;*)<br />
<?php if (is_numeric($articleData->id)) : ?>
	<?php if ($articleData->has_photo == 1) : ?>
	<br /><img width="60" src="<?=$articleData->thumb_article?>?time=<?=time()?>" alt=""/><br /><br />
	<label><input type="checkbox" name="DeletePhoto" value="1" /> Delete</label>
	<?php endif;?> 
<?php endif;?> 

<br />

<label><?=__t('articleadmin/formarticle','Position')?></label>
<input type="text" name="ArticlePos" value="<?=htmlspecialchars($articleData->pos)?>" />

<label><?=__t('articleadmin/formarticle','Open in new page')?></label>
<input type="checkbox" name="OpenNewPage" value="on" <?php echo $articleData->open_new_page == 1 ? 'checked="checked"' : ''?> />

<br />

<label><?=__t('articleadmin/formarticle','Hide article')?></label>
<input type="checkbox" name="HideArticle" value="on" <?php echo $articleData->hide == 1 ? 'checked="checked"' : ''?> />
 
<br />
<br />
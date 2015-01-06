<?php include(erLhcoreClassDesign::designtpl('lhkernel/csfr_token.tpl.php'));?>

<div class="row">
   <div class="col-md-12">     
        <div class="form-group">
			<label><?=__t('articleadmin/formarticle','Name')?> *</label>
			<input type="text" class="form-control" name="ArticleName" value="<?=htmlspecialchars($articleData->{'name'});?>" />
		</div>
	</div>
</div>

<div class="row">
   <div class="col-md-6">     
        <div class="form-group">
	    	<label><?=__t('articleadmin/formarticle','Alternative URL')?></label>
			<input type="text" class="form-control" name="AlternativeURL" value="<?=htmlspecialchars($articleData->{'alternative_url'});?>" />
	    </div>
	</div>
    <div class="col-md-6">   
    	<div class="form-group">  
    		<label><?=__t('articleadmin/formarticle','Alias URL')?></label>
			<input type="text" class="form-control" name="AliasURL" value="<?=htmlspecialchars($articleData->{'alias_url'});?>" />
    	</div>
	</div>
 </div>
<div class="row">
   <div class="col-md-12">     
        <div class="form-group">    	
		    <label><?=__t('articleadmin/editstatic','Intro')?> *</label>
			<?php
				$oFCKeditor = new CKEditor() ;        
				$oFCKeditor->basePath = erLhcoreClassDesign::design('js/ckeditor').'/' ;
				CKFinder::SetupCKEditor($oFCKeditor, erLhcoreClassDesign::design('js/ckfinder/'));   
				$oFCKeditor->config['height'] = 300;
				$oFCKeditor->config['width'] = '100%';        
				$oFCKeditor->editor('ArticleIntro',$articleData->{'intro'}) ;    
			?>       
		</div>
	</div>
</div>

<div class="row">
   <div class="col-md-12">     
        <div class="form-group"> 				
			<label><?=__t('articleadmin/editstatic','Content')?></label>
			<?
				$oFCKeditor = new CKEditor() ;        
				$oFCKeditor->basePath = erLhcoreClassDesign::design('js/ckeditor').'/' ;  
				CKFinder::SetupCKEditor($oFCKeditor, erLhcoreClassDesign::design('js/ckfinder/')); 
				$oFCKeditor->config['height'] = 300;
				$oFCKeditor->config['width'] = '100%'; 
				$oFCKeditor->editor('ArticleBody',$articleData->{'body'}) ;
			?>
		</div>
	</div>	
</div>

<div class="row">
   <div class="col-md-12">     
        <div class="form-group"> 	
			<label><?=__t('articleadmin/formarticle','Thumbnail')?></label>   
			<input type="file"  name="ArticleThumb" value="" > (*.jpg;*.png;*)<br />
			<?php if (is_numeric($articleData->id)) : ?>
				<?php if ($articleData->has_photo == 1) : ?>
				<br /><img width="60" src="<?=$articleData->thumb_article?>?time=<?=time()?>" alt=""/><br /><br />
				<label><input type="checkbox" name="DeletePhoto" value="1" /> Delete</label>
				<?php endif;?> 
			<?php endif;?> 
		</div>
	</div>
</div>

<div class="row">
   <div class="col-md-2">     
        <div class="form-group"> 	
			<label><?=__t('articleadmin/formarticle','Position')?></label>
			<input type="text" class="form-control" name="ArticlePos" value="<?=htmlspecialchars($articleData->pos)?>" />
		</div>
	</div>
</div>

<div class="row">
   <div class="col-md-12">     
        <div class="form-group"> 	
			<label><?=__t('articleadmin/formarticle','Open in new page')?></label>
			<input type="checkbox"  name="OpenNewPage" value="on" <?php echo $articleData->open_new_page == 1 ? 'checked="checked"' : ''?> />
		</div>
	</div>
</div>

<div class="row">
   <div class="col-md-12">     
        <div class="form-group"> 	
			<label><?=__t('articleadmin/formarticle','Hide article')?></label>
			<input type="checkbox" name="HideArticle" value="on" <?php echo $articleData->hide == 1 ? 'checked="checked"' : ''?> />
		</div>
	</div>
</div>	 

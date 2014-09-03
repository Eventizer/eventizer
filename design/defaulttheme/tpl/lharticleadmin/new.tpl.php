<h1><?=__t('articleadmin/newarticle','New article')?></h1>

<form action="<?=__url('articleadmin/new')?>/<?=$categoryData->id?>" method="post" enctype="multipart/form-data">
    
	<?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>

	<?php include(erLhcoreClassDesign::designtpl('lharticleadmin/form/article.tpl.php'));?>
	
	<ul class="button-group radius">
    	<li><input type="submit" class="small button" name="saveArticleAction" value="<?=__t('system/button','Save')?>" /></li>
    	<li><input type="submit" class="small button" name="cancelArticleAction" value="<?=__t('system/button','Cancel')?>" /></li>
	</ul>
		
</form>
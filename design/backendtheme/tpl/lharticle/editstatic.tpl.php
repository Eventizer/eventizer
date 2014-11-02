<h1><?=__t('articleadmin/editstatic','Edit static article')?></h1>

<form action="<?=__url('articleadmin/editstatic')?>/<?=$articleStaticData->id?>" method="post" enctype="multipart/form-data">

	<?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>
	
	<?php include(erLhcoreClassDesign::designtpl('lhkernel/alert_success_action.tpl.php'));?>
	
	<?php include(erLhcoreClassDesign::designtpl('lharticleadmin/form/articlestatic.tpl.php'));?>

	<ul class="button-group radius">
    	<li><input type="submit" class="small button" name="saveArticleStaticAction" value="<?=__t('system/button','Save')?>" /></li>
    	<li><input type="submit" class="small button" name="updateArticleStaticAction" value="<?=__t('system/button','Update')?>" /></li>
    	<li><input type="submit" class="small button" name="cancelArticleStaticAction" value="<?=__t('system/button','Cancel')?>" /></li>
	</ul>
	 
</form>
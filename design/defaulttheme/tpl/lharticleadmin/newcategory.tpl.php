<h1><?=__t('articleadmin/newcategory','New category')?></h1>

<form action="<?=__url('articleadmin/newcategory')?>/<?=$categoryParentData->id?>" method="post">

	<?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>
	
	<?php include(erLhcoreClassDesign::designtpl('lharticleadmin/form/category.tpl.php'));?>

	<ul class="button-group radius">
    	<li><input type="submit" class="small button" name="saveCategoryAction" value="<?=__t('system/button','Save')?>" /></li>
    	<li><input type="submit" class="small button" name="cancelCategoryAction" value="<?=__t('system/button','Cancel')?>" /></li>
	</ul>
	 
</form>
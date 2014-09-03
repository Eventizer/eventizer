<h1><?=__t('articleadmin/editcategory','Category edit')?></h1>

<form action="<?=__url('articleadmin/editcategory')?>/<?=$categoryData->id?>" method="post">

	<?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>

	<?php include(erLhcoreClassDesign::designtpl('lhkernel/alert_success_action.tpl.php'));?>

	<?php include(erLhcoreClassDesign::designtpl('lharticleadmin/form/category.tpl.php'));?>

	<ul class="button-group radius">
	    <li><input type="submit" class="small button" name="saveCategoryAction" value="<?=__t('system/button','Save')?>" /></li>
	    <li><input type="submit" class="small button" name="updateCategoryAction" value="<?=__t('system/button','Update')?>" /></li>
	    <li><input type="submit" class="small button" name="cancelCategoryAction" value="<?=__t('system/button','Cancel')?>" /></li>
	</ul>

</form>
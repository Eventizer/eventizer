<div class="col-md-12">
	<div class="box box-primary">
		 <div class="box-body table-responsive">
			<form action="<?=__url('article/editcategory')?>/<?=$categoryData->id?>" method="post">
				<div class="box-body">
					<?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>
					<?php include(erLhcoreClassDesign::designtpl('lhkernel/alert_success_action.tpl.php'));?>
					<?php include(erLhcoreClassDesign::designtpl('lharticle/form/category.tpl.php'));?>
				</div>
				<div class="box-footer">
				    <input type="submit" class="btn btn-primary" name="saveCategoryAction" value="<?=__t('system/button','Save')?>" />
				    <input type="submit" class="btn btn-primary" name="updateCategoryAction" value="<?=__t('system/button','Update')?>" />
				    <input type="submit" class="btn btn-default" name="cancelCategoryAction" value="<?=__t('system/button','Cancel')?>" />
				</div>
			
			</form>
	 </div><!-- /.box-body -->
     </div>
</div>
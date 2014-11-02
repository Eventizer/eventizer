<div class="col-md-12">
	<div class="box box-primary">
		 <div class="box-body table-responsive">
			<form action="<?=__url('article/edit')?>/<?=$articleData->id?>" method="post" enctype="multipart/form-data">
			     <div class="box-body">
					<?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>
					<?php include(erLhcoreClassDesign::designtpl('lhkernel/alert_success_action.tpl.php'));?>
					<?php include(erLhcoreClassDesign::designtpl('lharticle/form/article.tpl.php'));?>
				</div>
				<div class="box-footer">
			    	<input type="submit" class="btn btn-primary" name="saveArticleAction" value="<?=__t('system/button','Save')?>" />
			    	<input type="submit" class="btn btn-primary" name="updateArticleAction" value="<?=__t('system/button','Update')?>" />
			    	<input type="submit" class="btn btn-default" name="cancelArticleAction" value="<?=__t('system/button','Cancel')?>" />
				</div>
					
			</form>
		</div>
	</div>
</div>
<div class="title-bar single mb-0 clearfix">
	<h1><?=__t('user/account','Account Information')?></h1>
	<hr />
</div>

<div class="row">
	<div class="columns large-12">
		<div class="box box-primary">
			<div class="box-body">
			    <?php include(erLhcoreClassDesign::designtpl('lhkernel/alert_success_action.tpl.php'));?>
                <?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>
				<form action="<?=__url('user/editaccount')?>" method="post" autocomplete="off" enctype="multipart/form-data">
        	    	<?php include_once(erLhcoreClassDesign::designtpl('lhuser/form/editaccount.tpl.php'));?>
	                <input type="submit" name="updateAction" class="btn btn-flat-success" value="<?=__t('system/button','Update')?>">
		      	</form>
			</div>
		</div>
	</div>
</div>

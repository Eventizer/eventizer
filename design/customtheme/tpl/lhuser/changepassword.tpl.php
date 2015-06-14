<div class="title-bar single mb-0  clearfix">
	<h1><?=__t('user/changepassword','Change password')?></h1>
	<hr />
</div>

<div class="row">
	<div class="columns large-12">
		<div class="box box-primary">
			<div class="box-body">
			    <?php include(erLhcoreClassDesign::designtpl('lhkernel/alert_success_action.tpl.php'));?>
                <?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>
				<form action="<?=__url('user/changepassword')?>" method="post" autocomplete="off">
					<div class="row">
						<div class="columns large-12">
							<div class="p20 pt-0">
	    	                  <?php include_once(erLhcoreClassDesign::designtpl('lhuser/form/passwords.tpl.php'));?>
	    	                  </div>
						</div>
					</div>
					<input type="submit" name="updateAction" class="btn btn-flat-success" value="<?=__t('system/button','Change')?>">
				</form>
			</div>
		</div>
	</div>
</div>
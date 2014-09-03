<div class="form-box" id="login-box">
	<div class="header">
		<?=__t('user/forgotpassword','Password reminder')?>
	</div>

	<form method="post" action="<?=__url('user/forgotpassword')?>">
		<div class="body bg-gray">
			<?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>

			<div class="form-group">
				<input type="text" name="Email" class="form-control" value="" placeholder="<?=__t('user/forgotpassword','Email')?>" />
			</div>
		</div>
		<div class="footer">
			<input type="submit" name="Forgotpassword" class="btn bg-olive btn-block" value="<?=__t('system/button','Restore password')?>" />
		</div>
	</form>
</div>

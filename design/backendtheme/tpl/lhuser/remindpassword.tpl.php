<div class="form-box" id="login-box">
	<div class="header">
		<?=__t('user/remindpassword','New password')?>
	</div>
	<div class="body bg-gray">
		<p><?=htmlspecialchars($msg)?></p>
	</div>
	<div class="footer">
			  <p><a class="btn bg-olive btn-block" href="<?=__url('user/login')?>"><?=__t('user/login','Login')?></a></p>
		</div>
</div>

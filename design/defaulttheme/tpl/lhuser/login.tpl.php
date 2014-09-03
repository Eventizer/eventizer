<h1><?=__t('user/login','Please login')?></h1>

<hr />

<?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>

<form method="post" action="<?=__url('user/login')?>">

	<label><?=__t('user/login','Username')?></label>
	<input type="text" name="Username" value="" />
	
	<label><?=__t('user/login','Password')?></label>
	<input type="password" name="Password" value="" />
	
	<label><input class="checkbox-midle" type="checkbox" name="rememberMe" value="1"> <span><?=__t('user/login','Remember me')?></span></label>
	
	<div class="row pt10">
		<div class="large-6 columns">
			<input type="submit" name="Login" class="button small radius" value="<?=__t('system/button','Login')?>" />
		</div>
		<div class="large-6 columns text-right">
			<a class="button small radius" href="<?=__url('user/forgotpassword')?>"><?=__t('user/login','Forgot password')?></a>
		</div>
	</div>
	
</form>
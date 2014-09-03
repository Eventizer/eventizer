<h1><?=__t('system/smtp','SMTP settings')?></h1>

<?php include(erLhcoreClassDesign::designtpl('lhkernel/alert_success_action.tpl.php'));?>

<?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>

<form action="" method="post" autocomplete="off">

	<?php include(erLhcoreClassDesign::designtpl('lhkernel/csfr_token.tpl.php'));?>

	<label><input type="checkbox" name="use_smtp" value="1" <?php isset($smtp_data['use_smtp']) && ($smtp_data['use_smtp'] == '1') ? print 'checked="checked"' : '' ?> /> <?=__t('system/smtp','SMTP enabled')?></label>
	
	<label><?=__t('system/smtp','Login')?></label>
	<input type="text" name="username" value="<?php (isset($smtp_data['username']) && $smtp_data['username'] != '') ? print $smtp_data['username'] : print '' ?>" />
	
	<label><?=__t('system/smtp','Password')?></label>
	<input type="password" name="password" value="<?php (isset($smtp_data['password']) && $smtp_data['password'] != '') ? print $smtp_data['password'] : print '' ?>" />
	
	<label><?=__t('system/smtp','Host')?></label>
	<input type="text" name="host" value="<?php (isset($smtp_data['host']) && $smtp_data['host'] != '') ? print $smtp_data['host'] : print '' ?>" />
	
	<label><?=__t('system/smtp','Port')?></label>
	<input type="text" name="port" value="<?php (isset($smtp_data['port']) && $smtp_data['port'] != '') ? print $smtp_data['port'] : print '25' ?>" />
	
	<input type="submit" class="button small radius" name="StoreSMTPSettings" value="<?=__t('system/button','Save')?>" />

</form>
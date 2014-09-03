
<div class="col-md-12">
	<div class="box box-primary">
		<form action="" method="post" autocomplete="off">
			<div class="box-body">
				<?php include(erLhcoreClassDesign::designtpl('lhkernel/alert_success_action.tpl.php'));?>
				<?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>
				<?php include(erLhcoreClassDesign::designtpl('lhkernel/csfr_token.tpl.php'));?>
			
				<div class="form-group">
				<label><input type="checkbox" name="use_smtp" value="1" <?php isset($smtp_data['use_smtp']) && ($smtp_data['use_smtp'] == '1') ? print 'checked="checked"' : '' ?> /> <?=__t('system/smtp','SMTP enabled')?></label>
				</div>
				
				<div class="form-group">
				<label><?=__t('system/smtp','Login')?></label>
				<input class="form-control" type="text" name="username" value="<?php (isset($smtp_data['username']) && $smtp_data['username'] != '') ? print $smtp_data['username'] : print '' ?>" />
				</div>
				
				<div class="form-group">
				<label><?=__t('system/smtp','Password')?></label>
				<input class="form-control" type="password" name="password" value="<?php (isset($smtp_data['password']) && $smtp_data['password'] != '') ? print $smtp_data['password'] : print '' ?>" />
				</div>
				
				<div class="form-group">
				<label><?=__t('system/smtp','Host')?></label>
				<input class="form-control" type="text" name="host" value="<?php (isset($smtp_data['host']) && $smtp_data['host'] != '') ? print $smtp_data['host'] : print '' ?>" />
				</div>
				
				<div class="form-group">
				<label><?=__t('system/smtp','Port')?></label>
				<input class="form-control" type="text" name="port" value="<?php (isset($smtp_data['port']) && $smtp_data['port'] != '') ? print $smtp_data['port'] : print '25' ?>" />
				</div>
				
			</div>
			<div class="box-footer">
				<input type="submit" class="btn btn-primary" name="StoreSMTPSettings" value="<?=__t('system/button','Save')?>" />
				<input type="submit" class="btn btn-primary" name="StoreSMTPSettingsTest" value="<?=__t('system/button','Test')?>" />
			</div>
		</form>
	</div>
</div>
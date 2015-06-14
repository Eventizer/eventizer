<div class="col-md-12">
	<div class="box box-primary">
		<form action="" method="post" autocomplete="off">
			<div class="box-body">
				<?php include(erLhcoreClassDesign::designtpl('lhkernel/alert_success_action.tpl.php'));?>
				<?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>
				<?php include(erLhcoreClassDesign::designtpl('lhkernel/csfr_token.tpl.php'));?>
			
				
				
				<div class="form-group">
				    <label><?=__t('system/smtp','You facebook or disques comments code')?></label>
				    <textarea class="form-control" rows="20" name="code" ><?=(isset($code) && $code != '') ? $code : '' ?></textarea>
				    <small><?=__t('socialcomments/settings','For some plugins you need to add page url. For example facebook comments require page url. To add this url please add tag {{siteurl}} in code. For example if you use facebook comments HTML5 code you need to add attribute data-href="{{siteurl}}" ')?></small>
				</div>
				
			
				
			</div>
			<div class="box-footer">
				<input type="submit" class="btn btn-primary" name="UpdateSettings" value="<?=__t('system/button','Save')?>" />
			</div>
		</form>
	</div>
</div>
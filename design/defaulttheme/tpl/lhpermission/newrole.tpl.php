<h1><?=__t('permission/newrole','New role')?></h1>

<?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>

<form action="<?=__url('permission/newrole')?>" method="post">
	<?php include(erLhcoreClassDesign::designtpl('lhkernel/csfr_token.tpl.php'));?>
    <label><?=__t('permission/newrole','Name')?></label>
    <input class="inputfield" type="text" name="Name"  value="" />

	<fieldset>
		<legend><?=__t('permission/newrole','Policy list')?></legend> 		
		
		<table cellpadding="0" cellspacing="0">
			<thead>
				<tr>
				     <th>&nbsp;</th>
				     <th><?=__t('permission/newrole','Module')?></th>
				     <th><?=__t('permission/newrole','Function')?></th>	
				</tr>	
			</thead>		     
		</table>
		
		<input type="submit" class="small button" name="New_policy" value="<?=__t('system/button','New')?>"/>
		
		<br /><br />
	
	</fieldset>
	
	<ul class="button-group radius">
		<li><input type="submit" class="small button" name="Save_role" value="<?=__t('system/button','Save')?>"/></li>
		<li><input type="submit" class="small button" name="Cancel_role" value="<?=__t('system/button','Cancel')?>"/></li>
	</ul>
		
</form>
<h1><?=__t('permission/newpolicy','New policy')?> - <?php echo htmlspecialchars($role->name)?></h1>

<?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>

<form action="<?=__url('permission/editrole')?>/<?php echo $role->id?>" method="post">
	<?php include(erLhcoreClassDesign::designtpl('lhkernel/csfr_token.tpl.php'));?>
	<h5><?=__t('permission/newpolicy','Assigned functions')?></h5> 
				
	<table cellpadding="0" cellspacing="0">
		<tr>
			<td><?=__t('permission/newpolicy','Choose a module')?></td>
	     	<td>			    
			    <select id="ModuleSelectedID" name="Module">			     
			    	<option value="*">---<?=__t('permission/newpolicy','All modules')?>---</option>
				    <?php foreach (erLhcoreClassModules::getModuleList() as $key => $Module) : ?>
				    <option value="<?php echo $key?>"><?php echo htmlspecialchars($Module['name']);?></option>
				    <?php endforeach; ?>
				</select>			     
	     	</td>			  
	 	</tr>
		<tr>
	     	<td><?=__t('permission/newpolicy','Choose a module function')?></td>
	     	<td id="ModuleFunctionsID">
	        	<select name="ModuleFunction" >
	         		<option value="*"><?=__t('permission/newpolicy','All functions')?></option>
	        	</select>
	     	</td>
		</tr>
	</table>			

	<ul class="button-group radius">
		<li><input type="submit" class="small button" name="Store_policy" value="<?=__t('system/button','Save')?>"/></li>
	 	<li><input type="submit" class="small button" name="Cancel_policy" value="<?=__t('system/button','Cancel')?>"/></li>	
	</ul>

</form>

<script type="text/javascript">
	var _lactq = _lactq || [];
	_lactq.push({'f':'init_modulePolicySelection','a':[]});
</script>
<div class="col-xs-12">
	<div class="box box-primary">
		<form action="<?=__url('permission/editrole')?>/<?php echo $role->id?>" method="post">
			<div class="box-header">
	    		<h3 class="box-title"><?=__t('permission/newpolicy','Assigned functions')?></h3>
	    	</div>
		
			<div class="box-body">
			<?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>
			<?php include(erLhcoreClassDesign::designtpl('lhkernel/csfr_token.tpl.php'));?>
			 
						
				<div class="form-group">
					<label><?=__t('permission/newpolicy','Choose a module')?></label>
					    <select class="form-control"   id="ModuleSelectedID" name="Module">			     
					    	<option value="*">---<?=__t('permission/newpolicy','All modules')?>---</option>
						    <?php foreach (erLhcoreClassModules::getModuleList() as $key => $Module) : ?>
						    <option value="<?php echo $key?>"><?php echo htmlspecialchars($Module['name']);?></option>
						    <?php endforeach; ?>
						</select>			     
				</div>
				<div class="form-group">	
			     	<label><?=__t('permission/newpolicy','Choose a module function')?></label>
			     	<div id="ModuleFunctionsID">
			        	<select class="form-control"   name="ModuleFunction" >
			         		<option value="*"><?=__t('permission/newpolicy','All functions')?></option>
			        	</select>
			     	</div>
			     </div>
			</div>
			
			<div class="box-footer">
				<input type="submit" class="btn btn-primary" name="Store_policy" value="<?=__t('system/button','Save')?>"/>
			 	<input type="submit" class="btn btn-default" name="Cancel_policy" value="<?=__t('system/button','Cancel')?>"/>	
			</div>
		
		</form>
	</div>
</div>
<script type="text/javascript">
	var _lactq = _lactq || [];
	_lactq.push({'f':'init_modulePolicySelection','a':[]});
</script>
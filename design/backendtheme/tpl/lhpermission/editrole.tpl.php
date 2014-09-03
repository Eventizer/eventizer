<div class="col-xs-12">
	<div class="box box-primary">
			<?php include(erLhcoreClassDesign::designtpl('lhkernel/alert_success_action.tpl.php'));?>
			
			<?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>
			
			<form action="<?=__url('permission/editrole')?>/<?php echo $role->id?>" method="post">
				<div class="box-body">
					<?php include(erLhcoreClassDesign::designtpl('lhkernel/csfr_token.tpl.php'));?>
					<div class="form-group">
				        <label><?=__t('permission/editrole','Title')?></label>
				        <input required class="form-control"   type="text" name="Name" value="<?php echo htmlspecialchars($role->name);?>" />
				    </div>
				</div>     
				<div class="box-footer"> 
					<input type="submit" class="btn btn-primary" name="Update_role" value="<?=__t('permission/editrole','Update')?>"/>
					<input type="submit" class="btn btn-default" name="Cancel_role" value="<?=__t('permission/editrole','Cancel')?>"/>
						
				</div>
			</form>
	</div>
</div>
<div class="col-xs-6">
	<div class="box box-primary">
			<div class="box-header">
	    		<h3 class="box-title"><?=__t('permission/editrole','Assigned functions')?></h3>
	    	</div>
	    		<?php if(isset($errorsAssignFunctions) && count($errorsAssignFunctions)):?>
					<div class="box-body"> 
					<?php $errors = $errorsAssignFunctions; ?>
				    <?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>
				    <?php unset($errors); ?>
				    </div>
				<?php endif;?>
				    
				<?php if(isset($successAssignFunctions)):?>
					<div class="box-body"> 
					<?php $alertSuccessAction = $successAssignFunctions; ?>
				    <?php include(erLhcoreClassDesign::designtpl('lhkernel/alert_success_action.tpl.php'));?>
				    <?php unset($alertSuccessAction); ?>
				    </div>
				<?php endif;?>
						
				<form action="<?=__url('permission/editrole')?>/<?php echo $role->id?>" method="post">
				<?php include(erLhcoreClassDesign::designtpl('lhkernel/csfr_token.tpl.php'));?>
					
						
					
					<div class="box-body">				
						<div class="dataTables_wrapper form-inline">
							<table cellpadding="0" cellspacing="0" class="table table-bordered table-hover dataTable" width="100%">
							<thead>
								<tr>
								     <th>&nbsp;</th>
								     <th><?=__t('permission/editrole','Module')?></th>
								     <th><?=__t('permission/editrole','Function')?></th>
								</tr>
							</thead>
							<?php $assignedFunctions = erLhcoreClassRoleFunction::getRoleFunctions($role->id);?>
							<?php foreach ( $assignedFunctions as $Function) : ?>
								<tr>
									<td><input type="checkbox" class="m0" name="PolicyID[]" value="<?php echo $Function['id']?>" /></td>
									<td><?php echo htmlspecialchars(erLhcoreClassModules::getModuleName($Function['module']))?>&nbsp;(<b><?php echo htmlspecialchars($Function['module'])?></b>)</td>
									<td><?php echo htmlspecialchars(erLhcoreClassModules::getFunctionName($Function['module'],$Function['function']))?>&nbsp;(<b><?php echo htmlspecialchars($Function['function'])?></b>)</td>
								</tr>
							<?php endforeach; ?>
						</table>
					</div>
				</div>
					
				<div class="box-footer">
					<?php if(count($assignedFunctions) > 0):?>
					<input type="submit" class="btn btn-primary" name="Delete_policy" value="<?=__t('system/button','Remove selected policy')?>"/>
					<?php endif;?>
					<input type="submit" class="btn btn-primary" name="New_policy" value="<?=__t('system/button','Assign function')?>"/>
				</div>
			</form>
		</div>
	</div>


<div class="col-xs-6">
	<div class="box box-primary">
			<div class="box-header">
	    		<h3 class="box-title"><?=__t('permission/editrole','Role assigned groups')?></h3>
	    	</div>
					<form action="<?=__url('permission/editrole')?>/<?php echo $role->id?>" method="post">
						 
							<?php if(isset($errorsAssignUsers) && count($errorsAssignUsers)):?>
								<div class="box-body">
									<?php $errors = $errorsAssignUsers;?>
								    <?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>
								    <?php unset($errors); ?>
							    </div>
							<?php endif;?>
							    
							<?php if(isset($successAssignUsers)):?>
								<div class="box-body">
								<?php $alertSuccessAction = $successAssignUsers; ?>
							    <?php include(erLhcoreClassDesign::designtpl('lhkernel/alert_success_action.tpl.php'));?>
							    <?php unset($alertSuccessAction); ?>
							    </div>
							<?php endif;?>
							<?php include(erLhcoreClassDesign::designtpl('lhkernel/csfr_token.tpl.php'));?>
							<div class="box-body">
							<div class="dataTables_wrapper form-inline">
								<table cellpadding="0" cellspacing="0" class="table table-bordered table-hover dataTable" width="100%">
									<thead>
										<tr>
									    	<th width="1%">&nbsp;</th>
									     	<th><?=__t('permission/editrole','Title')?></th>
										</tr>
									</thead>
									<?php $assignedGroups = erLhcoreClassGroupRole::getRoleGroups($role->id);?>
									<?php foreach ( $assignedGroups as $Group) : ?>
									    <tr>
							    			<td><input type="checkbox" class="m0" name="AssignedID[]" value="<?php echo $Group['assigned_id']?>" /></td>
							    		    <td><?php echo htmlspecialchars($Group['name'])?></td>
										</tr>
									<?php endforeach; ?>
								</table>
							</div>
						</div>
						<div class="box-footer">
							<?php if(count($assignedGroups) > 0):?>
					    		<input type="submit" class="btn btn-primary" name="Remove_group_from_role" value="<?=__t('permission/editrole','Remove selected role')?>"/>
					    	<?php endif;?>
							<a type="submit" data-toggle="modal" data-target="#assigngroup" class="btn btn-primary" href="<?=__url('permission/roleassigngroup')?>/<?=$role->id?>"><?=__t('permission/editrole','Assign a group')?></a
						</div>
						
					</form>
			</div>
</div>
<div class="modal fade modal_reload" id="assigngroup" tabindex="-1" role="dialog" aria-labelledby="<?=__t('permission/editrole','Assign a group')?>" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content"></div>
	</div>
</div>
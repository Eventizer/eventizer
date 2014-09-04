<div class="col-xs-12">
	<div class="box box-primary">
		<?php include(erLhcoreClassDesign::designtpl('lhkernel/alert_success_action.tpl.php'));?>
		
		<?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>

		<form action="<?=__url('useradmin/editgroup')?>/<?=$groupData->id?>" method="post">
			<div class="box-body">
				<?php include_once(erLhcoreClassDesign::designtpl('lhuseradmin/form/group.tpl.php'));?>
			</div>
						
			<div class="box-footer">
				<input type="submit" class="btn btn-primary" name="saveAction" value="<?=__t('system/button','Save')?>"/>
				<input type="submit" class="btn btn-info" name="updateAction" value="<?=__t('system/button','Update')?>"/>
				<input type="submit" class="btn btn-default" name="cancelAction" value="<?=__t('system/button','Cancel')?>"/>
			</div>
			
		</form>
	</div>
</div>

<div class="col-xs-6">
	<div class="box box-primary">
						
			<div class="box-header">
	    		<h3 class="box-title"><?=__t('user/editgroup','Assigned users')?> - <?=htmlspecialchars($groupData->name)?></h3>
	    	</div>
	    		<?php if(isset($errorsAssignUsers) && count($errorsAssignUsers)):?>
	    			<div class="box-body"> 
		    		<?php $errors = $errorsAssignUsers; ?>
		    		<?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>
		    		<?php unset($errors); ?>
		    		</div>
		    	<?php endif;?>
		    	
		    	<?php if(isset($assignUsersAlertSuccessAction)):?>
		    		<div class="box-body"> 
		    		<?php $alertSuccessAction = $assignUsersAlertSuccessAction; ?>
		    		<?php include(erLhcoreClassDesign::designtpl('lhkernel/alert_success_action.tpl.php'));?>
		    		<?php unset($alertSuccessAction); ?>
		    		</div>
		    	<?php endif;?>
	    	<form action="<?=__url('useradmin/editgroup')?>/<?=$groupData->id?>" method="post">	 
	    		<div class="box-body">   	
					<?php include(erLhcoreClassDesign::designtpl('lhkernel/csfr_token.tpl.php'));?>				
					<?php $assignedUersCount = count($assignedUers); ?>
				
					<?php if($assignedUersCount):?>
				
						<div class="dataTables_wrapper form-inline">
							<table cellpadding="0" cellspacing="0" class="table table-bordered table-hover dataTable" width="100%">
			
							<thead>
								<tr>
								    <th width="1%">&nbsp;</th>
								    <th><?=__t('user/editgroup','Username')?></th>
								</tr>
							</thead>
							<?php foreach($assignedUers as $item): ?>
								<tr>
								    <td><input type="checkbox" class="m0" name="AssignedID[]" value="<?=$item->id?>" /></td>
								    <td><?=$item->user?></td>
								</tr>
							<?php endforeach; ?>
						</table>
						</div>
						<?php if(isset($pages)) : ?>
	    					<?php include(erLhcoreClassDesign::designtpl('lhkernel/paginator.tpl.php')); ?>
						<?php endif;?>
				
					<?php endif;?>
				</div>
				<div class="box-footer">
					<?php if($assignedUersCount):?>
						<input type="submit" class="btn btn-primary" name="removeUserFromGroupAction" value="<?=__t('system/button','Remove user from the group')?>" />
					<?php endif; ?>
					<a class="btn btn-primary" data-toggle="modal" data-target="#modal" href="<?=__url('useradmin/groupassignuser')?>/<?=$groupData->id?>"><?=__t('system/button','Assign user')?></a>					
				</div>
			
			</form>		
		
	</div>
</div>

<div class="col-xs-6">
	<div class="box box-primary">
		<div class="box-header">
	    	<h3 class="box-title"><?=__t('user/editgroup','Assigned roles')?> - <?=htmlspecialchars($groupData->name)?></h3>
		</div>
		 
			<?php if(isset($errorsAssignRoles) && count($errorsAssignRoles)):?>
				<div class="box-body"> 
	    		<?php $errors = $errorsAssignRoles; ?>
	    		<?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>
	    		<?php unset($errors); ?>
	    		</div>
	    	<?php endif;?>
			
			<?php if(isset($assignRolesAlertSuccessAction)):?>
				<div class="box-body"> 
	    		<?php $alertSuccessAction = $assignRolesAlertSuccessAction; ?>
	    		<?php include(erLhcoreClassDesign::designtpl('lhkernel/alert_success_action.tpl.php'));?>
	    		<?php unset($alertSuccessAction); ?>
	    		 </div>
	    	<?php endif;?>
	   
			<form action="<?=__url('useradmin/editgroup')?>/<?=$groupData->id?>" method="post">
				<div class="box-body">   
					<?php include(erLhcoreClassDesign::designtpl('lhkernel/csfr_token.tpl.php'));?>
					<?php $groupRolesCount = count($groupRoles); ?>
					
					<?php if($groupRolesCount):?>
					
						<div class="dataTables_wrapper form-inline">
							<table cellpadding="0" cellspacing="0" class="table table-bordered table-hover dataTable" width="100%">
			
							<thead>
								<tr>
							    	<th width="1%">&nbsp;</th>
							    	<th><?=__t('user/editgroup','Name')?></th>
								</tr>
							</thead>
							<?php foreach($groupRoles as $item) : ?>
							<tr>
							    <td><input type="checkbox" class="m0" name="AssignedID[]" value="<?=$item['assigned_id']?>" /></td>
							    <td><?=htmlspecialchars($item['name'])?></td>
							</tr>
							<?php endforeach; ?>
						</table>
					</div>
					<?php endif; ?>
				</div>
				<div class="box-footer">
					<?php if($groupRolesCount):?>
						<input type="submit" class="btn btn-primary" name="removeRoleFomGroupAction" value="<?=__t('user/editgroup','Remove role from group')?>" />
					<?php endif; ?>	
					<a class="btn btn-primary"  data-toggle="modal" data-target="#modalRole"  href="<?=__url('useradmin/groupassignrole')?>/<?=$groupData->id?>"><?=__t('user/editgroup','Assign role')?></a>
				</div>
				
			</form>	
		
	</div>
</div>

<div id="modal" class="modal fade modal_reload" tabindex="-1" role="dialog" aria-labelledby="<?=__t('system/button','Assign user')?>" aria-hidden="true" ></div>
<div id="modalRole" class="modal fade modal_reload" tabindex="-1" role="dialog" aria-labelledby="<?=__t('system/button','Assign Role')?>" aria-hidden="true" ></div>
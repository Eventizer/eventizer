<h1><?=__t('user/editgroup','Group edit')?> - <?=htmlspecialchars($groupData->name)?></h1>

<?php include(erLhcoreClassDesign::designtpl('lhkernel/alert_success_action.tpl.php'));?>

<?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>

<div class="row">
	<div class="large-12 columns">
		<form action="<?=__url('useradmin/editgroup')?>/<?=$groupData->id?>" method="post">
		
			<?php include_once(erLhcoreClassDesign::designtpl('lhuseradmin/form/group.tpl.php'));?>
						
			<ul class="button-group radius">
				<li><input type="submit" class="button small" name="saveAction" value="<?=__t('system/button','Save')?>"/></li>
				<li><input type="submit" class="button small" name="updateAction" value="<?=__t('system/button','Update')?>"/></li>
				<li><input type="submit" class="button small" name="cancelAction" value="<?=__t('system/button','Cancel')?>"/></li>
			</ul>
			
		</form>
	</div>
</div>

<div class="row">
	<div class="large-12 columns">
						
		<fieldset>
    		<legend><?=__t('user/editgroup','Assigned users')?> - <?=htmlspecialchars($groupData->name)?></legend>
	    	
	    	<?php if(isset($errorsAssignUsers) && count($errorsAssignUsers)):?>
	    		<?php $errors = $errorsAssignUsers; ?>
	    		<?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>
	    		<?php unset($errors); ?>
	    	<?php endif;?>
	    	
	    	<?php if(isset($assignUsersAlertSuccessAction)):?>
	    		<?php $alertSuccessAction = $assignUsersAlertSuccessAction; ?>
	    		<?php include(erLhcoreClassDesign::designtpl('lhkernel/alert_success_action.tpl.php'));?>
	    		<?php unset($alertSuccessAction); ?>
	    	<?php endif;?>
	    	
	    	<form action="<?=__url('useradmin/editgroup')?>/<?=$groupData->id?>" method="post">	    	
				<?php include(erLhcoreClassDesign::designtpl('lhkernel/csfr_token.tpl.php'));?>				
				<?php $assignedUersCount = count($assignedUers); ?>
			
				<?php if($assignedUersCount):?>
			
					<table cellpadding="0" cellspacing="0">
						<thead>
							<tr>
							    <th>&nbsp;</th>
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
			
					<?php if(isset($pages)) : ?>
    					<?php include(erLhcoreClassDesign::designtpl('lhkernel/paginator.tpl.php')); ?>
					<?php endif;?>
			
				<?php endif;?>
			
				<ul class="button-group radius">
					<?php if($assignedUersCount):?>
						<li><input type="submit" class="button small alert" name="removeUserFromGroupAction" value="<?=__t('system/button','Remove user from the group')?>" /></li>
					<?php endif; ?>
					<li><button class="button small" data-reveal-id="ajaxContentModal" data-reveal-ajax="<?=__url('useradmin/groupassignuser')?>/<?=$groupData->id?>"><?=__t('system/button','Assign user')?></button></li>					
				</ul>
			
			</form>		
		</fieldset> 
	</div>
</div>

<div class="row">
	<div class="large-12 columns">

		<fieldset>
			<legend><?=__t('user/editgroup','Assigned roles')?> - <?=htmlspecialchars($groupData->name)?></legend>
			
			<?php if(isset($errorsAssignRoles) && count($errorsAssignRoles)):?>
	    		<?php $errors = $errorsAssignRoles; ?>
	    		<?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>
	    		<?php unset($errors); ?>
	    	<?php endif;?>
			
			<?php if(isset($assignRolesAlertSuccessAction)):?>
	    		<?php $alertSuccessAction = $assignRolesAlertSuccessAction; ?>
	    		<?php include(erLhcoreClassDesign::designtpl('lhkernel/alert_success_action.tpl.php'));?>
	    		<?php unset($alertSuccessAction); ?>
	    	<?php endif;?>
			
			<form action="<?=__url('useradmin/editgroup')?>/<?=$groupData->id?>" method="post">
				<?php include(erLhcoreClassDesign::designtpl('lhkernel/csfr_token.tpl.php'));?>
				<?php $groupRolesCount = count($groupRoles); ?>
				
				<?php if($groupRolesCount):?>
				
					<table cellpadding="0" cellspacing="0">
						<thead>
							<tr>
						    	<th>&nbsp;</th>
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
				
				<?php endif; ?>
				
				<ul class="button-group radius">
					<?php if($groupRolesCount):?>
						<li><input type="submit" class="small alert button" name="removeRoleFomGroupAction" value="<?=__t('user/editgroup','Remove role from group')?>" /></li>
					<?php endif; ?>	
					<li><button class="button small" data-reveal-id="ajaxContentModal" data-reveal-ajax="<?=__url('useradmin/groupassignrole')?>/<?=$groupData->id?>"><?=__t('user/editgroup','Assign role')?></button></li>
				</ul>
				
			</form>	
		</fieldset> 	
	</div>
</div>

<div id="ajaxContentModal" class="reveal-modal small" data-reveal></div>
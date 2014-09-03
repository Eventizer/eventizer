<h1><?=__t('permission/editrole','Role edit')?> - <?=htmlspecialchars($role->name)?></h1>

<?php include(erLhcoreClassDesign::designtpl('lhkernel/alert_success_action.tpl.php'));?>

<?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>

<form action="<?=__url('permission/editrole')?>/<?php echo $role->id?>" method="post">
	<?php include(erLhcoreClassDesign::designtpl('lhkernel/csfr_token.tpl.php'));?>
	<div class="row">
    	<div class="columns large-12">
        	<label><?=__t('permission/editrole','Title')?></label>
		</div>
	</div>
	<div class="row">
        <div class="columns large-12">
        	<label><input class="inputfield" type="text" name="Name" value="<?php echo htmlspecialchars($role->name);?>" /></label>
        </div>
	</div>
		      
	<ul class="button-group radius">
		<li><input type="submit" class="small button" name="Update_role" value="<?=__t('permission/editrole','Update')?>"/></li>
		<li><input type="submit" class="small button" name="Cancel_role" value="<?=__t('permission/editrole','Cancel')?>"/></li>
	</ul>
			
	<hr>
	
	<?php if(isset($errorsAssignFunctions) && count($errorsAssignFunctions)):?>
		<?php $errors = $errorsAssignFunctions; ?>
	    <?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>
	    <?php unset($errors); ?>
	<?php endif;?>
	    
	<?php if(isset($successAssignFunctions)):?>
		<?php $alertSuccessAction = $successAssignFunctions; ?>
	    <?php include(erLhcoreClassDesign::designtpl('lhkernel/alert_success_action.tpl.php'));?>
	    <?php unset($alertSuccessAction); ?>
	<?php endif;?>

	<h2><?=__t('permission/editrole','Assigned functions')?></h2>
	
	<table cellpadding="0" cellspacing="0">
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
			
	<ul class="button-group radius">
		<?php if(count($assignedFunctions) > 0):?>
		<li><input type="submit" class="alert small button" name="Delete_policy" value="<?=__t('system/button','Remove selected policy')?>"/></li>
		<?php endif;?>
		<li><input type="submit" class="small button" name="New_policy" value="<?=__t('system/button','Assign function')?>"/></li>
	</ul>
            
</form>
		
<hr>

<?php if(isset($errorsAssignUsers) && count($errorsAssignUsers)):?>
	<?php $errors = $errorsAssignFunctions; ?>
    <?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>
    <?php unset($errors); ?>
<?php endif;?>
    
<?php if(isset($successAssignUsers)):?>
	<?php $alertSuccessAction = $successAssignUsers; ?>
    <?php include(erLhcoreClassDesign::designtpl('lhkernel/alert_success_action.tpl.php'));?>
    <?php unset($alertSuccessAction); ?>
<?php endif;?>

<h2><?=__t('permission/editrole','Role assigned groups')?></h2>
<form action="<?=__url('permission/editrole')?>/<?php echo $role->id?>" method="post">
	<?php include(erLhcoreClassDesign::designtpl('lhkernel/csfr_token.tpl.php'));?>
	<table cellpadding="0" cellspacing="0">
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
	
	<ul class="button-group radius">
		<?php if(count($assignedGroups) > 0):?>
    	<li><input type="submit" class="alert small button" name="Remove_group_from_role" value="<?=__t('permission/editrole','Remove selected role')?>"/></li>
    	<?php endif;?>
		<li><button class="button small" data-reveal-id="ajaxModal" data-reveal-ajax="<?=__url('permission/roleassigngroup')?>/<?=$role->id?>"><?=__t('permission/editrole','Assign a group')?></button></li>
	</ul>
	
</form>
<div id="ajaxModal" class="reveal-modal small" data-reveal></div>
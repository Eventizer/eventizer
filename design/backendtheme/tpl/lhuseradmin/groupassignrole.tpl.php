<form action="<?=__url('useradmin/editgroup')?>/<?=$groupData->id?>" method="post">

	<?php include(erLhcoreClassDesign::designtpl('lhkernel/csfr_token.tpl.php'));?>

	<table cellpadding="0" cellspacing="0" width="100%">
		<thead>
			<tr>
			    <th width="1%">ID</th>
			    <th><?=__t('useradmin/groupassignrole','Name')?></th>
			</tr>
		</thead>
		<?php foreach (erLhcoreClassGroupRole::getGroupNotAssignedRoles($groupData->id) as $role) : ?>
		    <tr>
		        <td><input type="checkbox" class="m0" name="RoleID[]" value="<?=$role['id']?>"></td>
		        <td><?=htmlspecialchars($role['name'])?></td> 
		    </tr>
		<?php endforeach; ?>
	</table>

	<div class="row">
		<div class="large-6 columns">
			<input type="submit" class="small button radius" name="assignRolesAction" value="<?=__t('system/button','Assign')?>" />
		</div>
		<div class="large-6 columns text-right">
			<input type="button" class="small button radius" onclick="$('#ajaxContentModal').foundation('reveal', 'close');" value="<?=__t('system/button','Close')?>" />
		</div>
	</div>
	
</form>
<form action="<?=__url('permission/editrole')?>/<?php echo $role_id ?>" method="post">
	<?php include(erLhcoreClassDesign::designtpl('lhkernel/csfr_token.tpl.php'));?>
	<table cellpadding="0" cellspacing="0" width="100%">
		<thead>
			<tr>
			    <th width="1%">ID</th>
			    <th><?=__t('permission/roleassigngroup','Title')?></th>
			</tr>
		</thead>
		<?php foreach (erLhcoreClassGroupRole::getRoleNotAssignedGroups($role_id) as $group) : ?>
		    <tr>
		        <td><input type="checkbox" class="m0" name="GroupID[]" value="<?php echo $group['id']?>"></td>
		        <td><?php echo htmlspecialchars($group['name'])?></td> 
		    </tr>
		<?php endforeach; ?>
	</table>
	
	<br />
	<div class="row">
		<div class="large-6 columns">
			<input type="submit" class="small button radius" name="AssignGroups" value="<?=__t('system/button','Assign')?>" />
		</div>
		<div class="large-6 columns text-right">
			<input type="button" class="small button radius" onclick="$('#ajaxModal').foundation('reveal', 'close');" value="<?=__t('system/button','Close')?>" />
		</div>
	</div>
</form>
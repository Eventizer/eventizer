<form action="<?=__url('useradmin/editgroup')?>/<?=$groupData->id?>" method="post">

	<?php include(erLhcoreClassDesign::designtpl('lhkernel/csfr_token.tpl.php'));?>
	
	<table cellpadding="0" cellspacing="0" width="100%">
		<thead>
		    <tr>
		        <th width="1%">ID</th>
		        <th><?=__t('useradmin/groupassignuser','Email')?></th>
		        <th><?=__t('useradmin/groupassignuser','Name')?></th>
		        <th><?=__t('useradmin/groupassignuser','Surname')?></th>
		    </tr>
		</thead>
		<?php foreach (erLhcoreClassModelGroupUser::getGroupNotAssignedUsers($groupData->id) as $user) : ?>
	    <tr>
	        <td><input type="checkbox" class="m0" name="UserID[]" value="<?=$user['id']?>"></td>
	        <td><?=htmlspecialchars($user['email'])?></td>
	        <td><?=htmlspecialchars($user['name'])?></td>
	        <td><?=htmlspecialchars($user['surname'])?></td>        
	    </tr>
		<?php endforeach; ?>
	</table>

	<div class="row">
		<div class="large-6 columns">
			<input type="submit" class="button small radius" name="assignUsersAction" value="<?=__t('system/button','Assign')?>" />
		</div>
		<div class="large-6 columns text-right">
			<input type="button" class="small button radius" onclick="$('#ajaxContentModal').foundation('reveal', 'close');" value="<?=__t('system/button','Close')?>" />
		</div>
	</div>

</form>
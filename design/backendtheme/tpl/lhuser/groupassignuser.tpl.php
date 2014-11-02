<div class="modal-dialog">
    <div class="modal-content">
     <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title"><?=__t('user/groupassignuser','Assign a user')?></h4>
     </div>
<form action="<?=__url('user/editgroup')?>/<?=$groupData->id?>" method="post">
	 <div class="modal-body ">
		<?php include(erLhcoreClassDesign::designtpl('lhkernel/csfr_token.tpl.php'));?>
		
		<table class="table">
			<thead>
			    <tr>
			        <th width="1%">ID</th>
			        <th><?=__t('user/groupassignuser','Email')?></th>
			        <th><?=__t('user/groupassignuser','Name')?></th>
			        <th><?=__t('user/groupassignuser','Surname')?></th>
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
	</div>
	 <div class="modal-footer">
			<input type="submit" class="btn btn-primary" name="assignUsersAction" value="<?=__t('system/button','Assign')?>" />
			<input type="button" class="btn btn-default" data-dismiss="modal" value="<?=__t('system/button','Close')?>" />
	</div>

</form>
</div>
</div>
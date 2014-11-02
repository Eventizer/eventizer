<div class="modal-dialog">
    <div class="modal-content">
     <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title"><?=__t('user/groupassignrole','Assign group role')?></h4>
     </div>
   
	<form action="<?=__url('user/editgroup')?>/<?=$groupData->id?>" method="post">
	  <div class="modal-body ">
			<?php include(erLhcoreClassDesign::designtpl('lhkernel/csfr_token.tpl.php'));?>
		
			<table class="table">
				<thead>
					<tr>
					    <th width="1%">ID</th>
					    <th><?=__t('user/groupassignrole','Name')?></th>
					</tr>
				</thead>
				<?php foreach (erLhcoreClassGroupRole::getGroupNotAssignedRoles($groupData->id) as $role) : ?>
				    <tr>
				        <td><input type="checkbox" class="m0" name="RoleID[]" value="<?=$role['id']?>"></td>
				        <td><?=htmlspecialchars($role['name'])?></td> 
				    </tr>
				<?php endforeach; ?>
			</table>
		</div>
		<div class="modal-footer">
			<input type="submit" class="btn btn-primary" name="assignRolesAction" value="<?=__t('system/button','Assign')?>" />
			<input type="button" class="btn btn-default" data-dismiss="modal" value="<?=__t('system/button','Close')?>" />
		</div>
			
	</form>
	</div>
</div>
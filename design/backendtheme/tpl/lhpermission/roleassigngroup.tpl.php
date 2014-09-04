<div class="modal-dialog">
    <div class="modal-content">
     <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title"><?=__t('permission/editrole','Assign a group')?></h4>
     </div>
   
		<form action="<?=__url('permission/editrole')?>/<?php echo $role_id ?>" method="post">
		   <div class="modal-body ">
			<?php include(erLhcoreClassDesign::designtpl('lhkernel/csfr_token.tpl.php'));?>
			<table class="table table-hover">
				<thead>
					<tr>
					    <th width="1%">ID</th>
					    <th><?=__t('permission/roleassigngroup','Title')?></th>
					</tr>
				</thead>
				<?php foreach (erLhcoreClassGroupRole::getRoleNotAssignedGroups($role_id) as $group) : ?>
				    <tr>
				        <td><input type="checkbox" name="GroupID[]" value="<?php echo $group['id']?>"></td>
				        <td><?php echo htmlspecialchars($group['name'])?></td> 
				    </tr>
				<?php endforeach; ?>
			</table>
			
			</div>
			 <div class="modal-footer">
		 		<input type="submit" class="btn btn-primary" name="AssignGroups" value="<?=__t('system/button','Assign')?>" />
				<button type="button" class="btn btn-default" data-dismiss="modal"><?=__t('system/button','Close')?></button>
		 	</div>
				
		</form>
		
		
	</div>
</div>
 <!-- Small boxes (Stat box) -->
<div class="col-xs-12">
	<div class="box">
		<div class="box-header"></div>
	
		<div class="box-body table-responsive">
			<div class="dataTables_wrapper form-inline">
				<table cellpadding="0" cellspacing="0" class="table table-bordered table-hover dataTable" width="100%">
				<thead>
					<tr>
					    <th width="1%">ID</th>
					    <th><?=__t('permission/roles','Name')?></th>
					    <th width="1%">&nbsp;</th>
					    <th width="1%">&nbsp;</th>
					</tr>
				</thead>
				<?php foreach (erLhcoreClassRole::getRoleList() as $role) : ?>
				    <tr>
				        <td><?=$role['id']?></td>
				        <td><?=htmlspecialchars($role['name'])?></td>
				        <td><a class="button tiny radius" href="<?=__url('permission/editrole')?>/<?=$role['id']?>" title="<?=__t('system/button','Edit')?>"><i class="fa fa-edit"></i></a></td>
				        <td>
				        <?php if($role['system'] == 0):?>
				        	<a class="button tiny radius csfr-required" onclick="return confirm('<?=__t('system/message','Are you sure?')?>')" href="<?=__url('permission/deleterole')?>/<?=$role['id']?>" title="<?=__t('system/button','Delete')?>"><i class="fa fa-fw fa-trash-o"></i></a>
				        <?php endif;?>
				       	</td>
				    </tr>
				<?php endforeach; ?>
			</table>
			
			<br />
			<?php include(erLhcoreClassDesign::designtpl('lhkernel/secure_links.tpl.php')); ?> 
			<a class="btn btn-primary" href="<?=__url('permission/newrole')?>"><?=__t('system/button','New')?></a>
			</div>
	</div>
</div>
</div>
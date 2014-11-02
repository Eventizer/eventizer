 <!-- Small boxes (Stat box) -->
<div class="col-xs-12">
	<div class="box">
		<div class="box-header"></div>
	
		<div class="box-body table-responsive">
			<div class="dataTables_wrapper form-inline">
				<table cellpadding="0" cellspacing="0" class="table table-bordered table-hover dataTable" width="100%">
			
				<thead>
					<tr>
					    <th>ID</th>
					    <th><?=__t('user/grouplist','Name')?></th>
					    <th width="1%">&nbsp;</th>
					    <th width="1%">&nbsp;</th>
					</tr>
				</thead>
				<?php foreach ($groups as $group) : ?>
				    <tr>
				        <td width="1%"><?=$group->id?></td>
				        <td><?=htmlspecialchars($group->name)?></td>
				        <td><a class="button tiny radius" href="<?=__url('user/editgroup')?>/<?=$group->id?>" title="<?=__t('system/button','Edit')?>"><i class="fa fa-edit"></i></a></td>
				        <td>
							<?php if($group->system):?>
			        			&nbsp;
			        		<?php else:?>
			        			<a class="button tiny radius csfr-required" onclick="return confirm('<?=__t('system/message','Are you sure?')?>')" href="<?=__url('user/deletegroup')?>/<?=$group->id?>" title="<?=__t('system/button','Delete')?>"><i class="fa fa-fw fa-trash-o"></i></a>
			        		<?php endif; ?>
				        </td>
				    </tr>
				<?php endforeach; ?>
			</table>
			
			
			<?php include(erLhcoreClassDesign::designtpl('lhkernel/secure_links.tpl.php')); ?>
		</div>
		<div class="box-footer clearfix">
			<?php if (isset($pages)) : ?>
			    <?php include(erLhcoreClassDesign::designtpl('lhkernel/paginator.tpl.php')); ?>
			<?php endif;?>
			
			<a class="btn btn-primary" href="<?=__url('user/newgroup')?>"><?=__t('user/grouplist','New group')?></a>
			</div>
	</div>
</div>
</div>
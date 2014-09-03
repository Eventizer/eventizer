 <!-- Small boxes (Stat box) -->
<div class="col-xs-12">
	<div class="box">
 		<div class="box-header"></div>
<?php 
	$currentUserId = erLhcoreClassUser::instance()->getUserID();
 ?>
	<div class="box-body table-responsive">
			<div class="dataTables_wrapper form-inline">
				<div class="row">
					<div class="col-xs-12">
						<div class="dataTables_filter text-right">
						<form action="<?=__url('useradmin/list')?>" method="post">
							<label><input type="submit" class="btn btn-default" value="<?=__t('useradmin/list','Export all user')?>" name="exportCSV" /></label>
						</form>
						</div>
					</div>
				</div>
			</div>
			<div class="dataTables_wrapper form-inline">
				<table cellpadding="0" cellspacing="0" class="table table-bordered table-hover dataTable" width="100%">
				<thead>
					<tr>
					    <th width="1%">ID</th>
					    <th><?=__t('useradmin/list','Username')?></th>
					    <th><?=__t('useradmin/list','Email')?></th>
					    <th><?=__t('useradmin/list','Last activity')?></th>
					    <th width="1%">&nbsp;</th>
					    <th width="1%">&nbsp;</th>
					</tr>
				</thead>
				<?php foreach ($userlist as $user) : ?>
			    <tr>
			        <td><?=$user->id?></td>
			        <td><?=htmlspecialchars($user)?></td>
			        <td><?=htmlspecialchars($user->email)?></td>
			        <td><?=$user->lastactivity_ago?> <?=__t('useradmin/list','ago')?></td>
			      
			        <td><a class="button tiny radius" href="<?=__url('useradmin/edit')?>/<?=$user->id?>" title='<?=__t('system/button','Edit')?>'><i class="fa fa-edit"></i></a></td>       
			        <td>
			        	<?php if($user->system):?>
			        		&nbsp;
			        	<?php else:?>
							<a class="csfr-required" onclick="return confirm('<?=__t('system/message','Are you sure?')?>')" href="<?=__url('useradmin/delete')?>/<?php echo $user->id?>" title="<?=__t('system/button','Delete')?>"><i class="fa fa-fw fa-trash-o"></i></a>
			        	<?php endif; ?>
			       </td>
			    </tr>
				<?php endforeach; ?>
			</table>

			<?php if (isset($pages)) : ?>
			    <?php include(erLhcoreClassDesign::designtpl('lhkernel/paginator.tpl.php')); ?>
			<?php endif;?>
			
			<br />
		
			<?php include(erLhcoreClassDesign::designtpl('lhkernel/secure_links.tpl.php')); ?> 
		</div>
	</div>
</div>
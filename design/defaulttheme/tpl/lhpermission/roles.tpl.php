<div class="header-list">
	<h1><?=__t('permission/roles','Roles')?></h1>
</div>

<table cellpadding="0" cellspacing="0">
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
	        <td><a class="button tiny radius" href="<?=__url('permission/editrole')?>/<?=$role['id']?>"><?=__t('system/button','Edit')?></a></td>
	        <td>
	        <?php if($role['system'] == 0):?>
	        	<a class="button tiny radius alert csfr-required" onclick="return confirm('<?=__t('system/message','Are you sure?')?>')" href="<?=__url('permission/deleterole')?>/<?=$role['id']?>"><?=__t('system/button','Delete')?></a>
	        <?php endif;?>
	       	</td>
	    </tr>
	<?php endforeach; ?>
</table>

<br />
<?php include(erLhcoreClassDesign::designtpl('lhkernel/secure_links.tpl.php')); ?> 
<a class="button small radius" href="<?=__url('permission/newrole')?>"><?=__t('system/button','New')?></a>
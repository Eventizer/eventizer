<h1><?=__t('user/grouplist','Groups')?></h1>

<table cellpadding="0" cellspacing="0" width="100%">
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
	        <td><a class="button tiny radius" href="<?=__url('useradmin/editgroup')?>/<?=$group->id?>"><?=__t('system/button','Edit')?></a></td>
	        <td>
				<?php if($group->system):?>
        			&nbsp;
        		<?php else:?>
        			<a class="button tiny radius alert csfr-required" onclick="return confirm('<?=__t('system/message','Are you sure?')?>')" href="<?=__url('useradmin/deletegroup')?>/<?=$group->id?>"><?=__t('system/button','Delete')?></a>
        		<?php endif; ?>
	        </td>
	    </tr>
	<?php endforeach; ?>
</table>
<br />
<?php if (isset($pages)) : ?>
    <?php include(erLhcoreClassDesign::designtpl('lhkernel/paginator.tpl.php')); ?>
<?php endif;?>

<a class="small button radius" href="<?=__url('useradmin/newgroup')?>"><?=__t('user/grouplist','New group')?></a>

<?php include(erLhcoreClassDesign::designtpl('lhkernel/secure_links.tpl.php')); ?>
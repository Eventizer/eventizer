<div class="row">
	<div class="large-6 columns">
		<h1><?=__t('useradmin/list','Users')?></h1>
	</div>
	<div class="large-6 columns text-right">
		<form action="<?=__url('useradmin/list')?>" method="post">
			<input type="submit" class="small button radius" value="<?=__t('useradmin/list','Export all user')?>" name="exportCSV" />
		</form>
	</div>
</div>

<?php 
	$anonymousUserId = erConfigClassLhConfig::getInstance()->getSetting( 'user_settings', 'anonymous_user_id' );
	$currentUserId = erLhcoreClassUser::instance()->getUserID();
 ?>

<table cellpadding="0" cellspacing="0" width="100%">
	<thead>
		<tr>
		    <th width="1%">ID</th>
		    <th><?=__t('useradmin/list','Username')?></th>
		    <th><?=__t('useradmin/list','Email')?></th>
		    <th><?=__t('useradmin/list','Last activity')?></th>
		    <th width="1%">&nbsp;</th>
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
        <td nowrap>
        	<?php if($user->id != $anonymousUserId && $user->id != $currentUserId):?>
        		<a class="button tiny radius" href="<?=__url('useradmin/loginas')?>/<?=$user->id?>" target="_blank"><?=__t('system/button','Login as')?></a>
        	<?php else:?>
        		&nbsp;
        	<?php endif; ?>	
        </td>
        <td><a class="button tiny radius" href="<?=__url('useradmin/edit')?>/<?=$user->id?>"><?=__t('system/button','Edit')?></a></td>       
        <td>
        	<?php if($user->system):?>
        		&nbsp;
        	<?php else:?>
				<a class="button tiny radius alert csfr-required" onclick="return confirm('<?=__t('system/message','Are you sure?')?>')" href="<?=__url('useradmin/delete')?>/<?php echo $user->id?>"><?=__t('system/button','Delete')?></a>
        	<?php endif; ?>
       </td>
    </tr>
	<?php endforeach; ?>
</table>

<?php if (isset($pages)) : ?>
    <?php include(erLhcoreClassDesign::designtpl('lhkernel/paginator.tpl.php')); ?>
<?php endif;?>

<br />

<div>
	<a class="button small radius" href="<?=__url('useradmin/new')?>"><?=__t('system/button','New')?></a>
</div>

<?php include(erLhcoreClassDesign::designtpl('lhkernel/secure_links.tpl.php')); ?> 
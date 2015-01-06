<div class="left-infobox">
	<h3><?=__t('user/sidemeniu','User meniu')?></h3>
	<ul class="circle">
		<li><a href="<?=__url('user/edit')?>/<?=$Result['sidemenu_data']['user']->id?>"><?=__t('user/sidemeniu','Edit')?></a></li>
	</ul>
</div>

<?php 
	$anonymousUserId = erConfigClassLhConfig::getInstance()->getSetting( 'user_settings', 'anonymous_user_id' );
	$currentUserId = erLhcoreClassUser::instance()->getUserID();
 ?>

<?php if($Result['sidemenu_data']['user']->id != $anonymousUserId && $Result['sidemenu_data']['user']->id != $currentUserId):?>
	<a class="small button radius" href="<?=__url('user/loginas')?>/<?=$Result['sidemenu_data']['user']->id?>" target="_blank"><?=__t('user/userlist','Login as')?></a>
<?php endif; ?>
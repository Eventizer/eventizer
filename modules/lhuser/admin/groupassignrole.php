<?php

$tpl = erLhcoreClassTemplate::getInstance( 'lhuser/groupassignrole.tpl.php');

try {
	$groupData = erLhcoreClassModelGroup::fetch((int)$Params['user_parameters']['group_id']);
} catch (Exception $e) {
	exit;
}

$tpl->set('groupData',$groupData);

echo $tpl->fetch();
exit;

?>
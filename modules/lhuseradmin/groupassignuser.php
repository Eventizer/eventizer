<?php

$tpl = erLhcoreClassTemplate::getInstance('lhuseradmin/groupassignuser.tpl.php');

try {
	$groupData = erLhcoreClassModelGroup::fetch((int)$Params['user_parameters']['group_id']);
} catch (Exception $e) {
	exit;
}

$tpl->set('groupData',$groupData);
	
$session = erLhcoreClassUser::getSession();
$q = $session->database->createSelectQuery();  
    
$q2 = $session->database->createSelectQuery();  
$q2->select( "user_id" )->from( "lh_groupuser" );
$q2->where($q2->expr->eq( 'group_id', $groupData->id ));
    
$q->select( "COUNT(lh_users.id)" )->from( "lh_users" );
$q->where('lh_users.id NOT IN ('. (string)$q2.')');      
    
$stmt = $q->prepare();       
$stmt->execute();  
$result = $stmt->fetchColumn();
          
$pages = new lhPaginator();
$pages->items_total = $result;
$pages->setItemsPerPage(10);
$pages->serverURL = erLhcoreClassDesign::baseurl('useradmin/groupassignuser').'/'.$groupData->id;
$pages->paginate();
    
$tpl->set('pages',$pages);
    
if ($pages->items_total > 0) {
        
	$session = erLhcoreClassUser::getSession();
	$q = $session->createFindQuery( 'erLhcoreClassModelUser' ); 
	        
	$q2 = $session->database->createSelectQuery();  
	$q2->select( "user_id" )->from( "lh_groupuser" );
	$q2->where($q2->expr->eq( 'group_id', $groupData->id )); 
	$q->where('lh_users.id NOT IN ('. (string)$q2.')');    
	$q->limit($pages->items_per_page,$pages->low);
	$q->orderBy('id DESC');
	                  
	$users = $session->find( $q );
	$tpl->set('users',$users);
        
} else {
	$tpl->set('users',array());
}

echo $tpl->fetch();
exit;

?>
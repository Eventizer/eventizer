<?php

class erLhcoreClassModelGroupUser {

	public function getState() {
		return array(
        	'id'          => $this->id,
            'group_id'    => $this->group_id,
            'user_id'     => $this->user_id
       	);
	}

	public function setState( array $properties ) {
		foreach ( $properties as $key => $val ) {
			$this->$key = $val;
       	}
   	}

	public static function fetch($id) {
		return erLhcoreClassUser::getSession()->load( 'erLhcoreClassModelGroupUser', $id );
	}
		
	public function saveThis() {
		erLhcoreClassUser::getSession()->saveOrUpdate($this);
	}
	
	public function updateThis() {
		erLhcoreClassUser::getSession()->update($this);
	}
	
	public function removeThis() {
		erLhcoreClassUser::getSession()->delete($this);
	}
	
	public static function removeUserFromGroups ( $user_id ) {
		
   		$session = erLhcoreClassUser::getSession();
   		$q = $session->database->createDeleteQuery();
   		$q->deleteFrom( 'lh_groupuser' )->where( $q->expr->eq( 'user_id', $q->bindValue( $user_id ) ) );
   		$stmt = $q->prepare();
		$stmt->execute();
		
	}

	public function __get($var){
		switch ($var) {
       		case 'user':
       	    	try {
           			$this->user = erLhcoreClassModelUser::fetch($this->user_id);
       	        } catch (Exception $e){
       	            $this->user = 'Not exist';
       	        }
           		return $this->user;
       			break;

       		default:
       			break;
		}
	}

	public static function getCount($params = array(), $operation = "COUNT(lh_groupuser.id)") {
		
		$session = erLhcoreClassUser::getSession('slave');
		
		$q = $session->database->createSelectQuery();
		
		$q->select( $operation )->from( "lh_groupuser" );
		
		$conditions = erLhcoreClassModuleFunctions::getConditions($params, $q);
		
		if (count($conditions) > 0) {
			$q->where( $conditions );
		}
			
		$stmt = $q->prepare();
		
		$stmt->execute();
		
		$result = $stmt->fetchColumn();
	
		return $result;
	}
		
	public static function getList($paramsSearch = array()) {
		
       $paramsDefault = array('limit' => 32, 'offset' => 0);

       $params = array_merge($paramsDefault,$paramsSearch);

       $session = erLhcoreClassUser::getSession();
       
       $q = $session->createFindQuery( 'erLhcoreClassModelGroupUser' );

		$conditions = erLhcoreClassModuleFunctions::getConditions($params, $q);
		
		if (count($conditions) > 0) {
			$q->where($conditions);
		}

		if ($params['limit'] !== false) {
			$q->limit($params['limit'],$params['offset']);
		}

      	$q->orderBy(isset($params['sort']) ? $params['sort'] : 'id DESC' );

       	$objects = $session->find( $q );

      	return $objects;
 	}

	public static function getGroupNotAssignedUsers($group_id) {
		
 		$db = ezcDbInstance::get();
 		$stmt = $db->prepare('SELECT lh_users.* FROM lh_users WHERE lh_users.id NOT IN ( SELECT user_id FROM lh_groupuser WHERE group_id = :group_id)  ORDER BY id ASC');
 		$stmt->bindValue( ':group_id',$group_id);
 		$stmt->execute();
 		$rows = $stmt->fetchAll();
 	
 		return $rows;
 		
 	}
 	
	public $id = null;
	public $group_id = '';
	public $user_id = '';

}

?>
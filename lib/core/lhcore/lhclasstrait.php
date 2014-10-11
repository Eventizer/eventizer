<?php
/**
 * 
 * @author Eventizer
 * helper trait class
 *
 */
trait erLhcoreClassTrait {
	
	public static function findOne($paramsSearch = array()) {
	
		$list = self::getList($paramsSearch);
		if (!empty($list))
			return current($list);
			
		return false;
	}
	
	public function setState( array $properties ) {
		foreach ( $properties as $key => $val ) {
			$this->$key = $val;
		}
	}
	
	public function removeThis() {
		self::getSession()->delete($this);
	}
	
	public function updateThis() {
		self::getSession()->update($this);
	}
	
	public function saveThis() {
		self::getSession()->saveOrUpdate($this);
	}
	
	public function saveOrUpdate() {
		self::getSession()->saveOrUpdate($this);
	}
	
	public function getFields() {
		 return include 'lib/core/lhabstract/fields/'.strtolower(__CLASS__).'.php';
	}
	
	public static function getSession()
	{
		static $dbHandler = false;
		
		if ($dbHandler === false) {
			$dbHandler = call_user_func(self::$dbSessionHandler);
		}
		
		return $dbHandler;
	}
	
	public static function fetch($id, $useCache = true) {
	
		if (isset($GLOBALS[__CLASS__.$id]) && $useCache == true) return $GLOBALS[__CLASS__.$id];

		try {			
			$GLOBALS[__CLASS__.$id] = self::getSession()->load( __CLASS__, (int)$id );
		} catch (Exception $e) {
			$GLOBALS[__CLASS__.$id] = false;
		}
	
		return $GLOBALS[__CLASS__.$id];
	}
	
	public static function getCount($params = array()) {
	
		$session = self::getSession();
	
		$q = $session->database->createSelectQuery();
			
		$q->select( "COUNT(" . self::$dbTable . "." . self::$dbTableId . ")" )->from( self::$dbTable );
	
		$conditions = erLhcoreClassModuleFunctions::getConditions($params, $q);
	
		if (count($conditions) > 0) {
			$q->where( $conditions );
		}
	
		$stmt = $q->prepare();
	
		$stmt->execute();
	
		$result = $stmt->fetchColumn();
		 
		return $result;
	}
	
	public static function isOwner($id, $skipChecking = false) {
		$obj = self::fetch($id);
	
		if ($skipChecking == true)
			return $obj;
	
		$currentUser = erLhcoreClassUser::instance();
		if ($obj->user_id == $currentUser->getUserID())
			return $obj;
	
		return false;
	}
	
		
	public static function getList($paramsSearch = array()) {
	
		$paramsDefault = array('limit' => 500, 'offset' => 0);
			
		$params = array_merge($paramsDefault,$paramsSearch);
			
		$session = self::getSession();
				
		$q = $session->createFindQuery( __CLASS__ );
			
		$conditions = erLhcoreClassModuleFunctions::getConditions($params, $q);
	
		if (count($conditions) > 0) {
			$q->where( $conditions );
		}
	
		if ($params['limit'] !== false) {
			$q->limit($params['limit'],$params['offset']);
		}
	
		if (isset(self::$dbDefaultSort)){
			$q->orderBy(isset($params['sort']) ? $params['sort'] : self::$dbDefaultSort );
		} else {
			$q->orderBy(isset($params['sort']) ? $params['sort'] : self::$dbTable. "." . self::$dbTableId . " " . self::$dbSortOrder );
		}
		
		$objects = $session->find( $q );
			
		if (isset($params['prefill_attributes'])) {
			foreach ($params['prefill_attributes'] as $attr => $prefillOptions)
			{
				$teamsId = array();
				foreach ($objects as $object) {
					$teamsId[] = $object->$prefillOptions['attr_id'];
				}
				
				if (!empty($teamsId)) {
					$teams = call_user_func($object->$prefillOptions['function'],array('filterin' => array('id' =>$teamsId)));
					foreach ($objects as & $object) {
						if (isset($teams[$object->$prefillOptions['attr_id']])){
							$object->$prefillOptions['attr_name'] = $teams[$object->$prefillOptions['attr_id']];
						}
						
					}
				}
				
			}
		}
		
		return $objects;
	}
	
}




?>
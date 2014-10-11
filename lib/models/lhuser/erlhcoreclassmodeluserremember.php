<?php
/**
 * 
 * @author Eventizer
 *
 */
class erLhcoreClassModelUserRemember {
   use erLhcoreClassTrait;
    
   public static $dbTable = 'lh_users_remember';
   public static $dbTableId = 'id';
   public static $dbSessionHandler = 'erLhcoreClassUser::getSession';
   public static $dbSortOrder = 'DESC';
   
   public function getState()
   {
       return array (
               'id'           => $this->id,
               'user_id'      => $this->user_id,
               'mtime'        => $this->mtime,
       );
   }


   public static function getUserCount($params = array())
   {
       $session = erLhcoreClassUser::getSession('slave');
       $q = $session->database->createSelectQuery();
       $q->select( "COUNT(id)" )->from( "lh_users_remember" );

       $conditions = erLhcoreClassModuleFunctions::getConditions($params, $q);
	
	   if (count($conditions) > 0) {
			$q->where( $conditions );
	   }


      return $q->execute()->count();
   }

   public static function getUserList($paramsSearch = array())
   {
       $paramsDefault = array('limit' => 32, 'offset' => 0);

       $params = array_merge($paramsDefault,$paramsSearch);

       $session = erLhcoreClassUser::getSession('slave');
       $q = $session->createFindQuery( 'erLhcoreClassModelUserRemember' );

       $conditions = erLhcoreClassModuleFunctions::getConditions($params, $q);
	
		if (count($conditions) > 0) {
			$q->where( $conditions );
		}

      $q->limit($params['limit'],$params['offset']);

      $q->orderBy(isset($params['sort']) ? $params['sort'] : 'id DESC' );

      $objects = $session->find( $q );

      return $objects;
   }

   public $id = null;
   public $user_id = null;
   public $mtime = null;
}

?>
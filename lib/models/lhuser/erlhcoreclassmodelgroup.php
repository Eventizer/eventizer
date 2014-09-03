<?php

class erLhcoreClassModelGroup {
        
	public function getState() {
		return array(
        	'id'          => $this->id,
            'name'        => $this->name,             
            'system'      => $this->system             
		);
	}
   
	public function setState( array $properties ) {
    	foreach ( $properties as $key => $val ) {
        	$this->$key = $val;
       	}
   	}
   	
   	public function __toString(){
   		return $this->name;
   	}
   	   
 	public static function fetch($id) {
		return erLhcoreClassUser::getSession()->load( 'erLhcoreClassModelGroup', $id );
	}
	
	public function saveThis() {		 
		erLhcoreClassUser::getSession()->save($this);		 
	}
	 
	public function updateThis() {		 
		erLhcoreClassUser::getSession()->update($this);		 
	}
	
	public function removeThis() {   
   				
       $q = ezcDbInstance::get()->createDeleteQuery();
       
       $q->deleteFrom( 'lh_groupuser' )->where( $q->expr->eq( 'group_id', $this->id ) );
       $stmt = $q->prepare();
       $stmt->execute();
       
       $q->deleteFrom( 'lh_grouprole' )->where( $q->expr->eq( 'group_id', $this->id ) );
       $stmt = $q->prepare();
       $stmt->execute(); 
              
       erLhcoreClassUser::getSession()->delete($this);
       
	}
   
	public static function getCount($params = array(), $operation = "COUNT(lh_group.id)") {
		
		$session = erLhcoreClassUser::getSession('slave');
       
 		$q = $session->database->createSelectQuery();
       
		$q->select( $operation )->from( "lh_group" );
		
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
				
		$q = $session->createFindQuery( 'erLhcoreClassModelGroup' );
		 
		$conditions = erLhcoreClassModuleFunctions::getConditions($params, $q);
		
		if (count($conditions) > 0) {
			$q->where($conditions);
		}
	
		if ($params['limit'] !== false) {
			$q->limit($params['limit'],$params['offset']);
		}
	
		$q->orderBy(isset($params['sort']) ? $params['sort'] : 'id  ASC' );
		
		$objects = $session->find( $q );
		 
		return $objects;
		
	}
	
	public static function validateInput(& $objectData) {
   
   		if (!isset($_POST['csfr_token']) || !erLhcoreClassUser::instance()->validateCSFRToken($_POST['csfr_token'])) {
   			erLhcoreClassModule::redirect('kernel/csrf-missing');
   		}
   		
   		$definition = array(
   			'Name' => new ezcInputFormDefinitionElement(
   				ezcInputFormDefinitionElement::REQUIRED, 'unsafe_raw'
   			)
   		);
   		
   		$form = new ezcInputForm( INPUT_POST, $definition );
   			
   		$Errors = array();
   		
   		if ( !$form->hasValidData( 'Name' ) || $form->Name == '' ) {
   			$Errors[] = __t('user/form','Please enter name');
   		} else {
   			$objectData->name = $form->Name;
   		}
   		
   		return $Errors;
   		   	   	
	}
	
	public $id = null;
   	public $name = '';
   	public $system = 0;

}

?>
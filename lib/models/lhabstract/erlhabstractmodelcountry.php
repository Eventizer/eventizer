<?php 

class erLhAbstractModelCountry {
        
	public function getState() {
		
		return array(
           'id'         => $this->id,
           'name'       => $this->name,
           'iso_code'   => $this->iso_code,
		   'position' 	=> $this->position,
       	);
	}

	public function setState( array $properties ) {		
		foreach ( $properties as $key => $val ) {
			$this->$key = $val;
		}
	}

	public function __toString() {
		return $this->name;
	}   

   	public function getFields() {
   		
       	 return array(
	       'name' => array(
	           'type' => 'text',
	           'trans' => 'Name',
	           'required' => true,       
	           'validation_definition' => new ezcInputFormDefinitionElement(
	                ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw'
	            )        
	       ),
	       'iso_code' => array (
	           'type' => 'text',
	           'trans' => 'Iso code',
	           'required' => true,       
	           'validation_definition' => new ezcInputFormDefinitionElement(
	                ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw'
	            )        
	       ),
       	 		
       	   'position' => array(
       	 		'type' => 'text',
       	 		'trans' => 'Position',
       	 		'required' => true,
       	 		'validation_definition' => new ezcInputFormDefinitionElement(
       	 			ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw'))
       	 );
	}
   
	public function getModuleTranslations() {
		return array('name' => 'Countrys');
	}
   
	public static function getCount($params = array()) {
		
		$session = erLhcoreClassAbstract::getSession();
		
		$q = $session->database->createSelectQuery(); 
		 
		$q->select( "COUNT(lh_abstract_country.id)" )->from( "lh_abstract_country" );   
	 
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
	
		$paramsDefault = array('limit' => 500, 'offset' => 0);
		 
		$params = array_merge($paramsDefault,$paramsSearch);
		 
		$session = erLhcoreClassAbstract::getSession();
		 
		$q = $session->createFindQuery( 'erLhAbstractModelCountry' );
		 
		$conditions = erLhcoreClassModuleFunctions::getConditions($params, $q);
		
		if (count($conditions) > 0) {
		    $q->where( $conditions );
		}
		
		if ($params['limit'] !== false) {
			$q->limit($params['limit'],$params['offset']);
		}
	
		$q->orderBy(isset($params['sort']) ? $params['sort'] : 'lh_abstract_country.position DESC, lh_abstract_country.name ASC' );
	
		$objects = $session->find( $q );
		 
		return $objects;
	}
	
	public function __get($var) {
		
	   switch ($var) {
			case 'left_menu':
	   	       $this->left_menu = '';
	   		   return $this->left_menu;
	   		break;
	   			
	   	default:
	   		break;
	   }
	}
	
	public static function fetch($id) {
		
		if (isset($GLOBALS['erLhAbstractModelCountry_'.$id])) return $GLOBALS['erLhAbstractModelCountry_'.$id];         
	
		try {              
			$GLOBALS['erLhAbstractModelCountry_'.$id] = erLhcoreClassAbstract::getSession()->load( 'erLhAbstractModelCountry', (int)$id );     
		} catch (Exception $e) {
			$GLOBALS['erLhAbstractModelCountry_'.$id] = false;  
		}
	
		return $GLOBALS['erLhAbstractModelCountry_'.$id];
	}
   
	public function removeThis() {
		erLhcoreClassAbstract::getSession()->delete($this);
	}
     
	public static function countryExist($id) {
		
		if ($id > 0) {
			try {
				return self::fetch($id);
			} catch (Exception $e) {
				return false;
			}
		}
	
		return false;
	}
	
	public $id = null;
   	public $name = '';
   	public $iso_code = '';
   	public $position = 0;
   	
   	public $hide_delete = true;
	
}

?>
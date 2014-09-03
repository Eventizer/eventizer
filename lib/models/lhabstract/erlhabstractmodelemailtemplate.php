<?

class erLhAbstractModelEmailTemplate {
        
	public function getState() {
		
		$stateArray = array (
			'id'         => $this->id,		
			'from_name'  => $this->from_name,
			'from_email' => $this->from_email,			
			'name'       => $this->name		
		);
		
		foreach (erConfigClassLhConfig::getInstance()->getSetting( 'site', 'site_languages' ) as $language) {	
			$locale = strtolower($language['locale']);		
			$stateArray['subject_'.$locale] = $this->{'subject_'.$locale};
			$stateArray['content_'.$locale] = $this->{'content_'.$locale};
		}
		
		return $stateArray;
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
		)),         
		'from_name' => array(
		'type' => 'text',
		'trans' => 'From name',
		'required' => true,       
		'validation_definition' => new ezcInputFormDefinitionElement(
		    ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw'
		)),         
		'from_email' => array(
		'type' => 'text',
		'trans' => 'From email',
		'required' => true,       
		'validation_definition' => new ezcInputFormDefinitionElement(
		    ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw'
		)),         
		'subject' => array(
		'type' => 'text',
		'multilanguage' => true,
		'trans' => 'Subject',
		'required' => true,       
		'validation_definition' => new ezcInputFormDefinitionElement(
		    ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw'
		)),         
		'content' => array(
		'type' => 'textarea',
		'trans' => 'Content',
		'required' => true,     
		'multilanguage' => true,
		'validation_definition' => new ezcInputFormDefinitionElement(
		    ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw'
		)));
	}
   
	public function getModuleTranslations() {
		return array('name' => 'Email templates');
	}
   
	public static function getCount($params = array())
	{
		$session = erLhcoreClassAbstract::getSession();
		$q = $session->database->createSelectQuery();  
		$q->select( "COUNT(id)" )->from( "lh_abstract_email_templates" );   
	 
		$conditions = erLhcoreClassModuleFunctions::getConditions($params, $q);  
	     
		if (count($conditions) > 0) {
			$q->where( $conditions );
		}
	     
		$stmt = $q->prepare();       
		$stmt->execute();  
		$result = $stmt->fetchColumn(); 
	    
		return $result; 
	}
   
	public function __get($var)
	{
	   switch ($var) {
	   	case 'left_menu':
	   	       $this->left_menu = '';
	   		   return $this->left_menu;
	   		break;
	   		
	   	case 'subject':
	   			$value = $this->{'subject_'.strtolower(erLhcoreClassSystem::instance()->Language)};
	   			if ($value != '') return $value;
	   			return $this->subject_en_en;
	   		
	   	case 'content':
	   			$value = $this->{'content_'.strtolower(erLhcoreClassSystem::instance()->Language)};
	   			if ($value != '') return $value;
	   			return $this->content_en_en;
	   			break;
	   			
	   	default:
	   		break;
	   }
	}
	
	public static function fetch($id) {
		
		if (isset($GLOBALS['erLhAbstractModelEmailTemplate_'.$id])) return $GLOBALS['erLhAbstractModelEmailTemplate_'.$id];         
	
		try {              
			$GLOBALS['erLhAbstractModelEmailTemplate_'.$id] = erLhcoreClassAbstract::getSession()->load( 'erLhAbstractModelEmailTemplate', (int)$id );     
		} catch (Exception $e) {
			$GLOBALS['erLhAbstractModelEmailTemplate_'.$id] = false;  
		}
	
		return $GLOBALS['erLhAbstractModelEmailTemplate_'.$id];
	}
   
	public function removeThis() {
		erLhcoreClassAbstract::getSession()->delete($this);
	}
   
	public static function getList($paramsSearch = array()) { 
		            
       	$paramsDefault = array('limit' => 500, 'offset' => 0);
       
       	$params = array_merge($paramsDefault,$paramsSearch);
       
       	$session = erLhcoreClassAbstract::getSession();
       
       	$q = $session->createFindQuery( 'erLhAbstractModelEmailTemplate' );  
       
		$conditions = erLhcoreClassModuleFunctions::getConditions($params, $q);  
	     
		if (count($conditions) > 0) {
			$q->where( $conditions );
		}
      
		if ($params['limit'] !== false) {
			$q->limit($params['limit'],$params['offset']);
		}
                
      	$q->orderBy(isset($params['sort']) ? $params['sort'] : 'id ASC' ); 
              
       	$objects = $session->find( $q );
         
    	return $objects; 
	}
   
   	public $id = null;
	public $name = '';
	public $from_name = '';
	public $from_email = '';
	public $subject_en_en = '';
	public $content_en_en = '';	
	
	public $hide_delete = true;
	
}

?>
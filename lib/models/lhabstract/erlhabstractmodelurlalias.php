<?

class erLhAbstractModelUrlAlias {
        
   public function getState()
   {
       $stateArray = array(
           'id'        		 => $this->id,          
           'url_alias'       => $this->url_alias
       );
       
      foreach (erConfigClassLhConfig::getInstance()->getSetting( 'site', 'site_languages' ) as $language) {	
			$locale = strtolower($language['locale']);
       		$stateArray['url_destination_'.$locale] = $this->{'url_destination_'.$locale};
       }
       
       return $stateArray;
   }
   
   public function setState( array $properties )
   {
       foreach ( $properties as $key => $val )
       {
           $this->$key = $val;
       }
   }
   
   public function __toString()
   {
       return $this->name;
   }   
     
   public function getFields()
   {
       return array(
	       'url_alias' => array(
	       'type' => 'text',
	       'trans' => 'URL Alias',
	       'required' => true,       
	       'validation_definition' => new ezcInputFormDefinitionElement(
	            ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw'
	        )),
	       'url_destination' => array(
	       'type' => 'text',
	       'frontend' => 'url_destination',
	       'trans' => 'URL Destination',
	       'required' => true,
	       'multilanguage' => true,
	       'validation_definition' => new ezcInputFormDefinitionElement(
	            ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw'
	        ))        
       );
   }
   
   public function getModuleTranslations()
   {
       return array('name' => 'URL Alias');
   }
   
   public static function getCount($params = array())
   {
       $session = erLhcoreClassAbstract::getSession();
       $q = $session->database->createSelectQuery();  
       $q->select( "COUNT(id)" )->from( "lh_abstract_url_alias" );   
         
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
     
       	case 'url_destination':
       				$value = $this->{'url_destination_'.strtolower(erLhcoreClassSystem::instance()->Language)};
       				if ($value != '') return $value;
       			return $this->url_destination_en_en;
       		break;

       	default:
       		break;
       }
   }
   
   public static function fetch($id)
   {          
	   	if (isset($GLOBALS['erLhAbstractModelUrlAlias_'.$id])) return $GLOBALS['erLhAbstractModelUrlAlias_'.$id];
   		
   		try {
        	$GLOBALS['erLhAbstractModelUrlAlias_'.$id] = erLhcoreClassAbstract::getSession()->load( 'erLhAbstractModelUrlAlias', (int)$id );
       	} catch (Exception $e){
       		$GLOBALS['erLhAbstractModelUrlAlias_'.$id] = new erLhAbstractModelUrlAlias(); 
       	}
        
       	return $GLOBALS['erLhAbstractModelUrlAlias_'.$id];       	
   }
   
   public function removeThis()
   {
       erLhcoreClassAbstract::getSession()->delete($this);
   }
   
   public static function getList($paramsSearch = array())
   {             
       $paramsDefault = array('limit' => 500, 'offset' => 0);
       
       $params = array_merge($paramsDefault,$paramsSearch);
       
       $session = erLhcoreClassAbstract::getSession();
       $q = $session->createFindQuery( 'erLhAbstractModelUrlAlias' );  
       
        $conditions = erLhcoreClassModuleFunctions::getConditions($params, $q);  
	     
		if (count($conditions) > 0) {
			$q->where( $conditions );
		}
		
        $objects = $session->find( $q );
         
        return $objects; 
   }
   
   public $id = null;
   public $url_alias = '';     

}



?>
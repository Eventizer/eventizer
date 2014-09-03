<?

class erLhcoreClassModelArticleCategory {

   public function getState() {
   	
       $stateArray = array (
           'id'                  => $this->id,
           'parent_id'           => $this->parent_id,
       	   'pos'                 => $this->pos,
           'system'				 => $this->system,
       );

		foreach (erConfigClassLhConfig::getInstance()->getSetting( 'site', 'site_languages' ) as $language) {
			$locale = strtolower($language['locale']);
			$stateArray['name_'.$locale] = $this->{'name_'.$locale};
			$stateArray['intro_'.$locale] = $this->{'intro_'.$locale};
			$stateArray['url_alternative_'.$locale] = $this->{'url_alternative_'.$locale};
       }
           
       return $stateArray;
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
		return erLhcoreClassArticle::getSession()->load( 'erLhcoreClassModelArticleCategory', $id);
	}
   
	public function saveThis() {
		
		erLhcoreClassArticle::getSession()->save( $this );
		$this->clearCache();
		
	}
   	 
   	public function updateThis() {
   		
		erLhcoreClassArticle::getSession()->update($this);
		$this->clearCache();
		
   	}
   	 
   	public function removeThis() {
   		
   		if($this->system == 0) {
   			
   			$articles = erLhcoreClassModelArticle::getArticlesByCategory($this->id,0,1000);
   			
	       	foreach ($articles as $article) {
	        	$article->removeThis();
	       	}
   			
   			erLhcoreClassArticle::getSession()->delete($this);
   			
   			$this->clearCache();
   			
   		}	
   	}
   	
   	public function clearCache() {
   		 
   		CSCacheAPC::getMem()->increaseCacheVersion('article_cache_version');
   		 
   	}
   
   	public static function getCategoryByID($id) {
    	return erLhcoreClassArticle::getSession()->load( 'erLhcoreClassModelArticleCategory', $id);  
	}
   
   public function __get($var) {
       switch ($var) {
       	case 'url_path':
       	    
       	       if ($this->url_alternative != '') {
       	           return $this->url_alternative;
       	       }
       	       
       		   $this->url_path = erLhcoreClassDesign::baseurl(urlencode(erLhcoreClassCharTransform::TransformToURL($this->name).'-'.$this->id.'c.html'), false);
       		   return $this->url_path;
       		break;
       		
       	case 'url_path_base':
       	    
       	       if ($this->url_alternative != '') {
       	           return $this->url_alternative;
       	       }
       	       
       		   $this->url_path_base = erLhcoreClassDesign::baseurldirect(urlencode(erLhcoreClassCharTransform::TransformToURL($this->name).'-'.$this->id.'c.html'));
       		   return $this->url_path_base;
       		break;
       		
       case 'name':
                $value = $this->{'name_'.strtolower(erLhcoreClassSystem::instance()->Language)};
                if ($value != '') return $value;
                return $this->name_en_en;
            break;
            
       case 'url_alternative':
                $value = $this->{'url_alternative_'.strtolower(erLhcoreClassSystem::instance()->Language)};
                if ($value != '') return $value;
                return $this->url_alternative_en_en;
            break;   				
   	              
   	   case 'intro':
                $value = $this->{'intro_'.strtolower(erLhcoreClassSystem::instance()->Language)};
                if ($value != '') return $value;
                return $this->intro_en_en;
            break;
            
       case 'parent':
            	$this->parent = false;
            	if ( $this->parent_id > 0 ){
            		try {
            			$this->parent = self::fetch($this->parent_id);
            		} catch (Exception $e) {
            			 
            		}
            	}
            	return $this->parent;
            	break;
            
       	default:
       		break;
       }       
   }
   
 	public static function getCount($params = array()) {
   		
   		$session = erLhcoreClassArticle::getSession();
   
   		$q = $session->database->createSelectQuery();
   
   		$q->select( "COUNT(*)" )->from( "lh_article_category" );
   		
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
       
       	$session = erLhcoreClassArticle::getSession('slave');
       
       	$q = $session->createFindQuery( 'erLhcoreClassModelArticleCategory' );  
       
       	$conditions = erLhcoreClassModuleFunctions::getConditions($params, $q);
      
       	if (count($conditions) > 0) {
        	$q->where( $conditions );
       	} 
      
       	if ($params['limit'] !== false) {
			$q->limit($params['limit'],$params['offset']);
		}
                
       	$q->orderBy(isset($params['sort']) ? $params['sort'] : 'pos ASC, id DESC' ); 
              
       	$objects = $session->find( $q );
         
    	return $objects; 
	}
   
	public function getParentCategories($parent = false) {
    	$session = erLhcoreClassArticle::getSession();
       	$q = $session->createFindQuery( 'erLhcoreClassModelArticleCategory' );  
       
       	$q->where( $q->expr->eq( 'parent', $q->bindValue($parent === false ? $this->id : $this->parent) ) );
              
      	$objects = $session->findIterator( $q, 'erLhcoreClassModelArticleCategory' );         
      	return $objects; 
   	}
   
	public static function getTopLevelCategories() {
		$session = erLhcoreClassArticle::getSession();
		$q = $session->createFindQuery( 'erLhcoreClassModelArticleCategory' );         
		$q->where( $q->expr->eq( 'parent', $q->bindValue( 0 ) ) );              
		$objects = $session->findIterator( $q, 'erLhcoreClassModelArticleCategory' );         
		return $objects; 
	}
	
	public static function validateInput(& $categoryData) {

		if (!isset($_POST['csfr_token']) || !erLhcoreClassUser::instance()->validateCSFRToken($_POST['csfr_token'])) {
			erLhcoreClassModule::redirect('kernel/csrf-missing');
		}
		
   		$languages = erConfigClassLhConfig::getInstance()->getSetting( 'site', 'site_languages' );
   	  		
   		$definition = array(   			
   			'CategoryPos' => new ezcInputFormDefinitionElement(
   				ezcInputFormDefinitionElement::OPTIONAL, 'int'
   			),   			   		    			
	   	);
   		 
   		foreach ($languages as $language) {			
			$locale = strtolower($language['locale']);   		
   			$definition['CategoryName_'.$locale] = new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw');
   			$definition['Intro_'.$locale] = new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw');
	   		$definition['URLAlternative_'.$locale] = new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw');
   		}
   		
   		$form = new ezcInputForm( INPUT_POST, $definition );
   		
   		$Errors = array();
   		
   		foreach ($languages as $language) {
   			
   			$locale = strtolower($language['locale']);
			$localeName = $language['title'];
			
			if ( !$form->hasValidData( 'CategoryName_'.$locale ) || $form->{'CategoryName_'.$locale} == '' ) {
	   			$Errors[] =  erTranslationClassLhTranslation::getInstance()->getTranslation('articleadmin/formcategory','Please enter category name').' '.$localeName;
	   		} else {
	   			$categoryData->{'name_'.$locale} = $form->{'CategoryName_'.$locale};
	   		}
			
			if ( $form->hasValidData( 'URLAlternative_'.$locale ) ) {
	   			$categoryData->{'url_alternative_'.$locale} = $form->{'URLAlternative_'.$locale};
	   		} else {
	   			$categoryData->{'url_alternative_'.$locale} = '';
	   		}
	   	
	   		if ( $form->hasValidData( 'Intro_'.$locale ) ) {
	   			$categoryData->{'intro_'.$locale} = $form->{'Intro_'.$locale};
	   		}
	   		
   		}	
   		
   		if ( !$form->hasValidData( 'CategoryPos' ) ) {
	   		$Errors[] =  erTranslationClassLhTranslation::getInstance()->getTranslation('user/new','Please enter category position');
	   	} else {
	   		$categoryData->pos = $form->CategoryPos;
	   	}
	   	  				
		return $Errors;
		
	}
	
	public $id = null;
	public $name_en_en = '';  
	public $intro_en_en = '';   
	public $url_alternative_en_en = ''; 
	public $parent_id = 0;
	public $pos = 0;
	public $system = 0;
      
}

?>
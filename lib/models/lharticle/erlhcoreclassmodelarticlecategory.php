<?php

class erLhcoreClassModelArticleCategory {
    use erLhcoreClassTrait;
    
    public static $dbTable = 'lh_article_category';
    public static $dbTableId = 'id';
    public static $dbSessionHandler = 'erLhcoreClassArticle::getSession';
    public static $dbSortOrder = 'DESC';
    
    
   public function getState() {
   	
       $stateArray = array (
           'id'                  => $this->id,
           'parent_id'           => $this->parent_id,
       	   'pos'                 => $this->pos,
           'system'				 => $this->system,
           'type'				 => $this->type,
       );
		
		$stateArray['name'] = $this->{'name'};
		$stateArray['intro'] = $this->{'intro'};
	  	$stateArray['url_alternative'] = $this->{'url_alternative'};
     
           
       return $stateArray;
	}
   
   	public function __toString(){
   		return $this->name;
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
		
   		$definition = array(   			
   			'CategoryPos' => new ezcInputFormDefinitionElement(
   				ezcInputFormDefinitionElement::OPTIONAL, 'int'
   			),   			   		    			
   			'CategoryName' => new ezcInputFormDefinitionElement(
   				ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw'
   			),   			   		    			
   			'Intro' => new ezcInputFormDefinitionElement(
   				ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw'
   			),   			   		    			
   			'URLAlternative' => new ezcInputFormDefinitionElement(
   				ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw'
   			),   			   		    			
   			'Type' => new ezcInputFormDefinitionElement(
   				ezcInputFormDefinitionElement::OPTIONAL, 'int'
   			),   			   		    			
	   	);
   		 
   	
   		
   		$form = new ezcInputForm( INPUT_POST, $definition );
   		
   		$Errors = array();
   		
   			
		if ( !$form->hasValidData( 'CategoryName' ) || $form->{'CategoryName'} == '' ) {
   			$Errors[] =  __t('articleadmin/formcategory','Please enter category name');
   		} else {
   			$categoryData->{'name'} = $form->{'CategoryName'};
   		}
		
		if ( $form->hasValidData( 'URLAlternative' ) ) {
   			$categoryData->{'url_alternative'} = $form->{'URLAlternative'};
   		} else {
   			$categoryData->{'url_alternative'} = '';
   		}
   	
   		if ( $form->hasValidData( 'Intro' ) ) {
   			$categoryData->{'intro'} = $form->{'Intro'};
   		}
   	
   		if ( $form->hasValidData( 'Type' ) ) {
   			$categoryData->{'type'} = $form->{'Type'};
   		}
   		
   		if ( !$form->hasValidData( 'CategoryPos' ) ) {
	   		$Errors[] =  __t('user/new','Please enter category position');
	   	} else {
	   		$categoryData->pos = $form->CategoryPos;
	   	}
	   	  				
		return $Errors;
		
	}
	
	public $id = null;
	public $name = '';  
	public $intro = '';   
	public $url_alternative = ''; 
	public $parent_id = 0;
	public $pos = 0;
	public $system = 0;
	public $type = 0;
      
}

?>
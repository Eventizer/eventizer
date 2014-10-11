<?php
/**
 * 
 * @author Eventizer
 *
 */
class erLhcoreClassModelArticleStatic {
   use erLhcoreClassTrait;
    
   public static $dbTable = 'lh_article_static';
   public static $dbTableId = 'id';
   public static $dbSessionHandler = 'erLhcoreClassArticle::getSession';
   public static $dbSortOrder = 'DESC';
    
   public function getState() {
   	
       $stateArray = array (
           'id'                  	=> $this->id,
           'file_name'           	=> $this->file_name,
           'system'              	=> $this->system,
           'active'              	=> $this->active,
           'mtime'              	=> $this->mtime
       );
              
		foreach (erConfigClassLhConfig::getInstance()->getSetting( 'site', 'site_languages' ) as $language) {		
			$locale = strtolower($language['locale']);		
			$stateArray['name_'.$locale] = $this->{'name_'.$locale};
			$stateArray['content_'.$locale] = $this->{'content_'.$locale};		
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
	
   	public function saveThis() {

   		$this->mtime = time();
   		erLhcoreClassArticle::getSession()->save($this);
   		$this->clearCache();
   		
	}
   	 
   	public function updateThis() {
   		
		erLhcoreClassArticle::getSession()->update($this);
		$this->clearCache();
		
   	}
   	 
   	public function removeThis() {
   		
   		erLhcoreClassArticle::getSession()->delete($this);
   		$this->clearCache();
   		
   	}
   	
   	public function clearCache() {
   		
   		CSCacheAPC::getMem()->increaseCacheVersion('article_cache_version');
   		
   	}
         
	public function __get($variable) {
		
   		switch ($variable) {

   			case 'content_front':   			    
   					$this->content_front = $this->content;   	
   					if ( empty($this->content_front) ) {
   						return '<b>[ARTICLE_ID_'.$this->id.']</b>';
   					}				   					   				   	   					   									
   					return $this->content_front;   					  					
   				break;
   		
   		   	case 'photo_path':
       		   $this->photo_path = 'var/media_static/'.$this->id.'/images/'.$this->file_name;
       		   if (file_exists($this->photo_path))
       		       return $this->photo_path;       		       
       		   return false;
       		break;
       			
   		   	case 'has_photo':
   		   	
   		   		if ($this->file_name != '' && file_exists($this->photo_path)) {
   		   			return true;
   		   		} else {
   		   			return false;
   		   		}
   		   	
       			break;
       		
       	   	case 'thumb_article':        	       	           	        
           	    if (!file_exists('var/media_static/'.$this->id.'/images/'.$this->id.'_thumb.jpg')) {  
           	        erLhcoreClassImageConverter::getInstance()->converter->transform( 'thumbarticle', $this->photo_path,'var/media_static/'.$this->id.'/images/'.$this->id.'_thumb.jpg' );
           	        $config = erConfigClassLhConfig::getInstance();
           	        chmod('var/media_static/'.$this->id.'/images/'.$this->id.'_thumb.jpg',$config->conf->getSetting( 'site', 'StorageFilePermissions' ));
           	    }
           	    $this->thumb_article = '/var/media_static/'.$this->id.'/images/'.$this->id.'_thumb.jpg';  
           	    return $this->thumb_article;	    
       	   		break;
       	    
 			case 'name':
                $value = $this->{'name_'.strtolower(erLhcoreClassSystem::instance()->Language)};
                if ($value != '') return $value;
                return $this->name_en_en;
            	break;
            
       	   	case 'content':
                $value = $this->{'content_'.strtolower(erLhcoreClassSystem::instance()->Language)};
                if ($value != '') return $value;
                return $this->content_en_en;
            	break;
             
   		   	case 'mtime_front':
   		   		$this->mtime_front = date('Y-m-d',$this->mtime);
                return $this->mtime_front;
            	break; 
            
   			default:
   				break;
   		}
	}

	
	
     
	public function removePhoto() {
	
		if (file_exists($this->photo_path)){
			unlink($this->photo_path);
		}
		
		if (file_exists('var/media_static/'.$this->id.'/images/'.$this->id.'_thumb.jpg')){
			unlink('var/media_static/'.$this->id.'/images/'.$this->id.'_thumb.jpg');
		}
	
	}
   	
	public static function validateInput(& $articleStatic) {

		if (!isset($_POST['csfr_token']) || !erLhcoreClassUser::instance()->validateCSFRToken($_POST['csfr_token'])) {
			erLhcoreClassModule::redirect('kernel/csrf-missing');
		}
		
   		$languages = erConfigClassLhConfig::getInstance()->getSetting( 'site', 'site_languages' );
   	
   		$definition = array(
			'ActiveArticle' => new ezcInputFormDefinitionElement(
				ezcInputFormDefinitionElement::OPTIONAL, 'boolean'
			),
   		);
   		 
   		foreach ($languages as $language) {			
			$locale = strtolower($language['locale']);   		
   			$definition['ArticleName_'.$locale] = new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw');
   			$definition['ArticleBody_'.$locale] = new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw');
   		}
   		
   		$form = new ezcInputForm( INPUT_POST, $definition );
   		
   		$Errors = array();
   		
   		if ( $form->hasValidData( 'ActiveArticle' ) && $form->ActiveArticle == true ) {
   			$articleStatic->active = 1;
   		} else {
   			$articleStatic->active = 0;
   		}
   		
   		foreach ($languages as $language) {
   			
   			$locale = strtolower($language['locale']);
			$localeName = $language['title'];
			
   			if ( !$form->hasValidData( 'ArticleName_'.$locale ) || $form->{'ArticleName_'.$locale} == '' ) {
   				$Errors[] =  erTranslationClassLhTranslation::getInstance()->getTranslation('articleadmin/formarticlestatic','Please enter article name').' '.$localeName;
   			} else {
   				$articleStatic->{'name_'.$locale} = $form->{'ArticleName_'.$locale};
   			}

   			if ( !$form->hasValidData( 'ArticleBody_'.$locale ) || $form->{'ArticleBody_'.$locale} == '' ) {
   				$Errors[] =  erTranslationClassLhTranslation::getInstance()->getTranslation('articleadmin/formarticlestatic','Please enter article content').' '.$localeName;
   			} else {
   				$articleStatic->{'content_'.$locale} = $form->{'ArticleBody_'.$locale};
   			}
			
   		}	
   		   		
   		
   		
		return $Errors;
   	
	}
	
	public $id = null;
	public $name_en_en  = '';     
	public $content_en_en = ''; 
	public $file_name  = '';
	public $system  = 0;
	public $active  = 1;
	public $mtime  = 0;
   
}

?>
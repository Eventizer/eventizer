<?

class erLhcoreClassModelArticle {
        
    public function getState() {
       $stateArray = array(
				'id'                     => $this->id,
				'file_name'              => $this->file_name,
				'category_id'            => $this->category_id,               
				'category_id_parent'     => $this->category_id_parent,
				'has_photo'              => $this->has_photo,
				'pos'                    => $this->pos, 
				'open_new_page'          => $this->open_new_page, 
				'hide'                   => $this->hide,
				'system'                 => $this->system,
				'mtime'                  => $this->mtime,
       );
       
       foreach (erConfigClassLhConfig::getInstance()->getSetting( 'site', 'site_languages' ) as $language) {
			$locale = strtolower($language['locale']);
           	$stateArray['name_'.$locale] = $this->{'name_'.$locale};
           	$stateArray['intro_'.$locale] = $this->{'intro_'.$locale};
           	$stateArray['body_'.$locale] = $this->{'body_'.$locale};
           	$stateArray['alias_url_'.$locale] = $this->{'alias_url_'.$locale};
           	$stateArray['alternative_url_'.$locale] = $this->{'alternative_url_'.$locale};
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
		return erLhcoreClassArticle::getSession()->load( 'erLhcoreClassModelArticle', $id);
   	}
   	
   	public function saveThis() {
   		
   		$this->mtime = time();   		
		erLhcoreClassArticle::getSession()->saveOrUpdate( $this );
   		$this->clearCache();
   		
	}
   	 
   	public function updateThis() {
   		
   		erLhcoreClassArticle::getSession()->update($this);
   		$this->clearCache();
   		
   	}
   	 
   	public function removeThis() {
   		
   		if ($this->system == 0) {
   			$this->removePhoto();
			erLhcoreClassArticle::getSession()->delete($this);
			$this->clearCache();
   		}
   	}
   	
   	public function clearCache() {
   		 
   		CSCacheAPC::getMem()->increaseCacheVersion('article_cache_version');
   		 
   	}
   
   	public static function getCount($params = array()) {
   	
		$session = erLhcoreClassArticle::getSession();
	   	
		$q = $session->database->createSelectQuery();
	   	
		$q->select( "COUNT(lh_article.id)" )->from( "lh_article" );
	   	 
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
	   	 
	   	$session = erLhcoreClassArticle::getSession();
	   	
	   	$q = $session->createFindQuery( 'erLhcoreClassModelArticle' );

	   	$conditions = erLhcoreClassModuleFunctions::getConditions($params, $q);
	   	
	   	if (count($conditions) > 0) {
	   		$q->where($conditions);
	   	}
	   	
	   	if ($params['limit'] !== false) {
			$q->limit($params['limit'],$params['offset']);
		}
	   
	   	$q->orderBy(isset($params['sort']) ? $params['sort'] : 'pos ASC, id DESC' );
	   
	   	$objects = $session->find( $q );
	   
		return $objects;
	}
          
   public static function getArticlesByCategory($categoryID = 0, $offset = 0, $limit = 50,$field = 'category_id')
   {
       if ($categoryID != 0)
       {
           $session = erLhcoreClassArticle::getSession();
           $q = $session->createFindQuery( 'erLhcoreClassModelArticle' );
           $q->where( 
            $q->expr->eq( $field, $q->bindValue( $categoryID ) )     
            ); 
          $q->limit( $limit, $offset ); 
          $q->orderBy( 'pos ASC, id DESC' ); 
       } else {
          $session = erLhcoreClassArticle::getSession();
          $q = $session->createFindQuery( 'erLhcoreClassModelArticle' );          
          $q->limit( $limit, $offset ); 
          $q->orderBy( 'pos ASC, id DESC' ); 
       }
                      
      $objects = $session->find( $q, 'erLhcoreClassModelArticle' );  
      
      return $objects; 
   }
   
   public function __get($var) {
   	
       switch ($var) {
       	
       	case 'url':
			   if ($this->alternative_url != '') {
			   		$this->url = $this->alternative_url;
			   } elseif ($this->alias_url != '') {
			   		$this->url = $this->alias_url;
			   } else {
			   		$this->url = erLhcoreClassDesign::baseurl(urlencode(erLhcoreClassCharTransform::TransformToURL($this->name).'-'.$this->id.'a.html'),false);
			   }
			   return $this->url;
			break;
            
		case 'alternative_url':
                $this->alternative_url = $this->{'alternative_url_'.strtolower(erLhcoreClassSystem::instance()->Language)};
                return $this->alternative_url;
            break;

       	case 'photo_path':
       		   $this->photo_path = 'var/media/'.$this->id.'/images/'.$this->file_name;
       		   if (file_exists($this->photo_path))
       		       return $this->photo_path;       		       
       		   return false;
       		break;
       		
       	case 'photo_path_url':
       		   $this->photo_path_url = '/var/media/'.$this->id.'/images/'.$this->file_name;       		
       		   return $this->photo_path_url;
       		break;
       
       	case 'thumb_article':   
           	    if (!file_exists('var/media/'.$this->id.'/images/'.$this->id.'_thumb.jpg') ) {  
           	        erLhcoreClassImageConverter::getInstance()->converter->transform( 'thumbarticle', $this->photo_path,'var/media/'.$this->id.'/images/'.$this->id.'_thumb.jpg' ); 
           	        $config = erConfigClassLhConfig::getInstance();
           	        chmod('var/media/'.$this->id.'/images/'.$this->id.'_thumb.jpg',$config->getSetting( 'site', 'StorageFilePermissions' ));
           	    }
           	    $this->thumb_article = '/var/media/'.$this->id.'/images/'.$this->id.'_thumb.jpg';  
           	    return $this->thumb_article;	    
       	    break;
       	    
		case 'thumbcontent_article':
       	    	if (!file_exists('var/media/'.$this->id.'/images/'.$this->id.'_thumbcontent.jpg')) {
       	    		erLhcoreClassImageConverter::getInstance()->converter->transform( 'thumbcontentarticle', $this->photo_path,'var/media/'.$this->id.'/images/'.$this->id.'_thumbcontent.jpg' );
       	    		$config = erConfigClassLhConfig::getInstance();
       	    		chmod('var/media/'.$this->id.'/images/'.$this->id.'_thumbcontent.jpg',$config->getSetting( 'site', 'StorageFilePermissions' ));
       	    	}
       	    	$this->thumbcontent_article = '/var/media/'.$this->id.'/images/'.$this->id.'_thumbcontent.jpg';
       	    	return $this->thumbcontent_article;
       		break;
       	    	
       	case 'name':
                $value = $this->{'name_'.strtolower(erLhcoreClassSystem::instance()->Language)};
                if ($value != '') return $value;
                return $this->name_en_en;
            break;
            
       	case 'intro':
                $value = $this->{'intro_'.strtolower(erLhcoreClassSystem::instance()->Language)};
                if ($value != '') return $value;
                return $this->show_language == 1 ? $this->intro_en_en : '';
            break;
            
       	case 'body':
                $value = $this->{'body_'.strtolower(erLhcoreClassSystem::instance()->Language)};
                if ($value != '') return $value;
                return $this->show_language == 1 ? $this->body_en_en : '';
            break;            
		            
		case 'date_article_front':
			
				if (strtolower(erLhcoreClassSystem::instance()->Language) == 'lt_lt') {
					$men = array("Sausio", "Vasario", "Kovo", "Balandžio", "Gegužės", "Birželio", "Liepos","Rugpjūčio", "Rugsėjo","Spalio", "Lapkričio", "Gruodžio");
					$this->date_article_front = $men[date("m",$this->mtime)-1];
				} else {
					$this->date_article_front = date("F",$this->mtime); 
				}
			
				$this->date_article_front .= date(" j, Y",$this->mtime);
            	
            	return $this->date_article_front;
            break;
            
        case 'category':
        	
                $this->category = false;
                
                if ($this->category_id) {
                	
                	try {
						$this->category = erLhcoreClassModelArticleCategory::fetch($this->category_id);        				
					} catch (Exception $e) {
						 $this->category = false;
					}                	
                }    
                          
                return $this->category;
            break;
            	
       	default:
       		break;
       }
   }
   
	public function removePhoto() {
		
		if ($this->has_photo && $this->file_name != ''){
			
			$dirBase = 'var/media/';
			$dirImg = $dirBase.$this->id.'/images/';
			
			if (file_exists($dirImg.$this->file_name)) {
				unlink($dirImg.$this->file_name);
			}
			
			if (file_exists($dirImg.$this->id.'_thumb.jpg')) { 
				unlink($dirImg.$this->id.'_thumb.jpg');
			}
			
			if (file_exists($dirImg.$this->id.'_thumbcontent.jpg')){
				unlink($dirImg.$this->id.'_thumbcontent.jpg');
			}
			
			erLhcoreClassImageConverter::removeRecursiveIfEmpty($dirBase,str_replace($dirBase,'',$dirImg));
			
			$this->has_photo = 0;
			$this->file_name = ''; 
		}
		
	}
      
	public static function getArticlesBySearchCount($field,$value) {
       $db = ezcDbInstance::get();
       $stmt = $db->prepare( "SELECT count(*) AS total FROM lh_article WHERE $field = :category_parent" );   
       $stmt->bindValue( ':category_parent',$value);       
       $stmt->execute();
       $rows = $stmt->fetchAll(); 
       return $rows[0]['total'];
  
	}
	
	public static function validateInput(& $articleData) {
	
		if (!isset($_POST['csfr_token']) || !erLhcoreClassUser::instance()->validateCSFRToken($_POST['csfr_token'])) {
			erLhcoreClassModule::redirect('kernel/csrf-missing');
		}
		
		$languages = erConfigClassLhConfig::getInstance()->getSetting( 'site', 'site_languages' );
		
		$definition = array(
			'ArticlePos' => new ezcInputFormDefinitionElement(
				ezcInputFormDefinitionElement::OPTIONAL, 'int'
			),
			'OpenNewPage' => new ezcInputFormDefinitionElement(
				ezcInputFormDefinitionElement::OPTIONAL, 'boolean'
			),
			'HideArticle' => new ezcInputFormDefinitionElement(
				ezcInputFormDefinitionElement::OPTIONAL, 'boolean'
			),
		);
	
		foreach ($languages as $language) {
			$locale = strtolower($language['locale']);
			$definition['ArticleName_'.$locale] = new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw');
			$definition['ArticleIntro_'.$locale] = new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw');
			$definition['ArticleBody_'.$locale] = new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw');
			$definition['AlternativeURL_'.$locale] = new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw');
			$definition['AliasURL_'.$locale] = new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw');
		}
		 
		$form = new ezcInputForm( INPUT_POST, $definition );
		 
		$Errors = array();
		
		foreach ($languages as $language) {
	
			$locale = strtolower($language['locale']);
			$localeName = $language['title'];

			if ( !$form->hasValidData( 'ArticleName_'.$locale ) || $form->{'ArticleName_'.$locale} == '' ) {
				$Errors[] = erTranslationClassLhTranslation::getInstance()->getTranslation('articleadmin/formarticle','Please enter article name').' '.$localeName;
			} else {
				$articleData->{'name_'.$locale} = $form->{'ArticleName_'.$locale};
			}
			
			if ( !$form->hasValidData( 'ArticleIntro_'.$locale ) || $form->{'ArticleIntro_'.$locale} == '' ) {
				$Errors[] =  erTranslationClassLhTranslation::getInstance()->getTranslation('articleadmin/formarticle','Please enter article intro').' '.$localeName;
			} else {
				$articleData->{'intro_'.$locale} = $form->{'ArticleIntro_'.$locale};
			}
			
			if ( $form->hasValidData( 'ArticleBody_'.$locale ) ) {
				$articleData->{'body_'.$locale} = $form->{'ArticleBody_'.$locale};
			} else {
				$articleData->{'body_'.$locale} = '';
			}
			
			if ( $form->hasValidData( 'AlternativeURL_'.$locale ) ) {
				$articleData->{'alternative_url_'.$locale} = $form->{'AlternativeURL_'.$locale};
			} else {
				$articleData->{'alternative_url_'.$locale} = '';
			}
			
			if ( $form->hasValidData( 'AliasURL_'.$locale ) ) {
				$articleData->{'alias_url_'.$locale} = $form->{'AliasURL_'.$locale};
			} else {
				$articleData->{'alias_url_'.$locale} = '';
			}
	
		}
		
		if ( !$form->hasValidData( 'ArticlePos' ) ) {
			$Errors[] = erTranslationClassLhTranslation::getInstance()->getTranslation('articleadmin/formarticle','Please enter article position');
		} else {
			$articleData->pos = $form->ArticlePos;
		}
			
		if ( $form->hasValidData( 'OpenNewPage' ) && $form->OpenNewPage == true ) {
			$articleData->open_new_page = 1;
		} else {
			$articleData->open_new_page = 0;
		}
		
		if ( $form->hasValidData( 'HideArticle' ) && $form->HideArticle == true ) {
			$articleData->hide = 1;
		} else {
			$articleData->hide = 0;
		}
		
		if ( empty($Errors) ) {
		
			if ($_FILES["ArticleThumb"]["error"] != 4) {
				if (isset($_FILES["ArticleThumb"]) && is_uploaded_file($_FILES["ArticleThumb"]["tmp_name"]) && $_FILES["ArticleThumb"]["error"] == 0 && erLhcoreClassImageConverter::isPhoto('ArticleThumb')) {
					
					if ($articleData->id  == null){
						$articleData->saveThis();
					}
					
					$articleData->removePhoto();
					
					$dir = 'var/media/'.$articleData->id.'/images/';
					
					erLhcoreClassImageConverter::mkdirRecursive( $dir );
					
					$articleData->has_photo = 1;
					$articleData->file_name = erLhcoreClassModuleFunctions::moveUploadedFile( 'ArticleThumb', $dir );
					
				} else {
					$Errors[] =  'Incorrect photo file!';
				}
				
			}
			
			if (isset($_POST['DeletePhoto']) && $_POST['DeletePhoto'] == 1) {
				$articleData->removePhoto();
			}
		
		}
			
		return $Errors;
	
	}
      
    public $id = null;
    public $name_en_en = '';    
    public $intro_en_en = '';
    public $body_en_en = '';
    public $alias_url_en_en = '';
    public $alternative_url_en_en = '';
	public $file_name = '';
    public $category_id = 0;    
    public $category_id_parent = 0;    
    public $has_photo = 0;    
    public $pos = 0;
    public $open_new_page = 0;
    public $hide = 0;
    public $system = 0;    
	public $mtime = '';
    
}

?>
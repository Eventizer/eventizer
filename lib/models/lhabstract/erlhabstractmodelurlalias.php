<?

class erLhAbstractModelUrlAlias {
   use erLhcoreClassTrait;
    
   public static $dbTable = 'lh_abstract_url_alias';
   public static $dbTableId = 'id';
   public static $dbSessionHandler = 'erLhcoreClassAbstract::getSession';
   public static $dbSortOrder = 'DESC';
    
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
   
  
   
   public function __toString()
   {
       return $this->name;
   }   
     
   public function getFields()
   {
      
   }
   
   public function getModuleTranslations()
   {
       return array('name' => 'URL Alias');
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
   
  
   public $id = null;
   public $url_alias = '';     

}



?>
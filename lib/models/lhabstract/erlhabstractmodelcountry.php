<?php 

class erLhAbstractModelCountry {
    use erLhcoreClassTrait;
    
    public static $dbTable = 'lh_abstract_country';
    public static $dbTableId = 'id';
    public static $dbSessionHandler = 'erLhcoreClassAbstract::getSession';
    public static $dbSortOrder = 'DESC';
        
	public function getState() {
		
		return array(
           'id'         => $this->id,
           'name'       => $this->name,
           'iso_code'   => $this->iso_code,
		   'position' 	=> $this->position,
       	);
	}

	public function __toString() {
		return $this->name;
	}   

    
	public function getModuleTranslations() {
		return array('name' => 'Countrys');
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
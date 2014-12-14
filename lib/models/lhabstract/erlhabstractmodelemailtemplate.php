<?php

/**
 * 
 * @author Eventizer
 * @link http://eventizer.org
 * @package Eventizer
 *
 */

class erLhAbstractModelEmailTemplate {
    use erLhcoreClassTrait;
    
    public static $dbTable = 'lh_abstract_email_templates';
    public static $dbTableId = 'id';
    public static $dbSessionHandler = 'erLhcoreClassAbstract::getSession';
    public static $dbSortOrder = 'DESC';
        
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

	public function __toString() {
		return $this->name;
	}   

	public function getModuleTranslations() {
		return array('name' => 'Email templates');
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
   		case 'menu':
   				return  'settings';
   				break;
	   				
	   	default:
	   		break;
	   }
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
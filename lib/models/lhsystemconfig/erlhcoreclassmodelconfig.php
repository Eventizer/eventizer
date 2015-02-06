<?php
/**
 * 
 * @author Eventizer
 *
 */
class erLhcoreClassModelSystemConfig {
    use erLhcoreClassTrait;
    
    public static $dbTable = 'lh_system_config';
    public static $dbTableId = 'identifier';
    public static $dbSessionHandler = 'erLhcoreClassSystemConfig::getSession';
    public static $dbSortOrder = 'DESC';
    
   public function getState()
   {
       return array(
               'identifier'    => $this->identifier,
               'value'         => $this->value,            
               'type'          => $this->type,            
               'hidden'        => $this->hidden,            
               'explain'       => $this->explain           
       );
   }

   public static function fetch($identifier)
   {
       $identifierObj = erLhcoreClassSystemConfig::getSession('slave')->load( 'erLhcoreClassModelSystemConfig', $identifier );
       return $identifierObj;
   }
   
   
   public function __get($variable)
   {
   		switch ($variable) {
   			case 'data':
   					$this->data = unserialize($this->value);
   					return $this->data;
   				break;
   				
   			case 'current_value':
   					switch ($this->type) {
   						case erLhcoreClassModelSystemConfig::SITE_ACCESS_PARAM_ON:
   							$this->current_value = null;
   							if ($this->value != '')
   							{
   								$this->current_value = isset($this->data[erLhcoreClassSystem::instance()->SiteAccess]) ? $this->data[erLhcoreClassSystem::instance()->SiteAccess] : null; 
   							}
   							return $this->current_value;
   							break;
   							
   						case erLhcoreClassModelSystemConfig::SITE_ACCESS_PARAM_OFF:
   								$this->current_value = $this->value;
   								return $this->current_value;
   							break;
   					
   						default:
   							break;
   					}
   					$this->data = unserialize($this->value);
   					return $this->data;
   				break;
   		
   			default:
   				break;
   		}
   }
   
   /*
    * get settings and cache results
    */
   public static function getSetting ($identifier) {
       
       $setting = CSCacheAPC::getMem()->getSession('settings_user_id_'.$identifier, true);
       
       if ($setting === false && ($setting = CSCacheAPC::getMem()->restore('settings_user_id_'.$identifier)) === false) {
            $setting = self::fetch($identifier);
       
            CSCacheAPC::getMem()->store('settings_user_id_'.$identifier, $setting);
            CSCacheAPC::getMem()->setSession('settings_user_id_'.$identifier, $setting, true);
       }
       
       return $setting;
   }
      
   
   public $identifier = null;
   public $value = null;
   public $explain = null;
   public $hidden = 0;
   
   const SITE_ACCESS_PARAM_ON = 1;
   const SITE_ACCESS_PARAM_OFF = 0;

}


?>
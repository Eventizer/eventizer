<?php

class erLhcoreClassModelSystemConfig {

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

	public function setState( array $properties ) {
    	foreach ( $properties as $key => $val )
       	{
        	$this->$key = $val;
       	}
   	}

	public function saveThis() {
   		
		erLhcoreClassSystemConfig::getSession()->saveOrUpdate( $this );
   		
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
   
   public static function getItems($paramsSearch = array())
   {
       $paramsDefault = array('limit' => 100, 'offset' => 0);
       
       $params = array_merge($paramsDefault,$paramsSearch);
       
       $session = erLhcoreClassSystemConfig::getSession('slave');
       $q = $session->createFindQuery( 'erLhcoreClassModelSystemConfig' );  
       
       $conditions = array(); 
       $conditions[] = $q->expr->eq( 'hidden', 0 );
             
       if (isset($params['filter']) && count($params['filter']) > 0)
       {                     
           foreach ($params['filter'] as $field => $fieldValue)
           {
               $conditions[] = $q->expr->eq( $field, $q->bindValue($fieldValue) );
           }
      } 
      
      if (isset($params['filterin']) && count($params['filterin']) > 0)
       {
           foreach ($params['filterin'] as $field => $fieldValue)
           {
               $conditions[] = $q->expr->in( $field, $fieldValue );
           } 
      }
      
      if (isset($params['filterlt']) && count($params['filterlt']) > 0)
       {
           foreach ($params['filterlt'] as $field => $fieldValue)
           {
               $conditions[] = $q->expr->lt( $field, $q->bindValue($fieldValue) );
           } 
      }
      
      if (isset($params['filtergt']) && count($params['filtergt']) > 0)
       {
           foreach ($params['filtergt'] as $field => $fieldValue)
           {
               $conditions[] = $q->expr->gt( $field, $q->bindValue($fieldValue) );
           } 
      }      
      
      if (count($conditions) > 0)
      {
          $q->where( 
                     $conditions   
          );
      } 
      
      $q->limit($params['limit'],$params['offset']);                
      $q->orderBy(isset($params['sort']) ? $params['sort'] : 'identifier DESC' ); 
         
      $objects = $session->find( $q );
            
      return $objects; 
   }      
   
   public $identifier = null;
   public $value = null;
   public $explain = null;
   public $hidden = 0;
   
   const SITE_ACCESS_PARAM_ON = 1;
   const SITE_ACCESS_PARAM_OFF = 0;

}


?>
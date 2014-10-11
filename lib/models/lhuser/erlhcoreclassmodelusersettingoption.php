<?php
/**
 * 
 * @author Eventizer
 *
 */
class erLhcoreClassModelUserSettingOption {
   use erLhcoreClassTrait;
    
   public static $dbTable = 'lh_users_setting_option';
   public static $dbTableId = 'id';
   public static $dbSessionHandler = 'erLhcoreClassUser::getSession';
   public static $dbSortOrder = 'DESC';

   public function getState()
   {
       return array(
               'identifier'   => $this->identifier,
               'class'        => $this->class,
               'attribute'        => $this->attribute,
       );
   }

   public function __toString()
   {
   		return $this->value;
   }

 

   public function __get($var)
   {
       switch ($var) {
       	case 'options':
       		   $options = call_user_func($this->class,array());
       		   return $options;
       		break;

       	default:
       		break;
       }
   }

    public $identifier = null;
    public $class = null;
    public $attribute = null;

}

?>
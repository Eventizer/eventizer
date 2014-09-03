<?php

class erLhcoreClassModelGroupRole {
        
	public function getState() {
    	return array(
        	'id'          => $this->id,
            'group_id'    => $this->group_id,             
            'role_id'     => $this->role_id             
       	);
   	}
   
   	public function setState( array $properties ) {
    	foreach ( $properties as $key => $val ) {
			$this->$key = $val;
       	}
   	}

   	public function saveThis() {
   		erLhcoreClassRole::getSession()->save($this);
   	}
   	
   	public function updateThis() {
   		erLhcoreClassRole::getSession()->update($this);
   	}
   	
   	public function removeThis() {
   		erLhcoreClassRole::getSession()->delete($this);
   	}
   	
   	public static function fetch($id) {
   		return erLhcoreClassRole::getSession()->load( 'erLhcoreClassModelGroupRole', $id );
   	}
   	
	public $id = null;
   	public $group_id = '';
   	public $role_id = '';

}

?>
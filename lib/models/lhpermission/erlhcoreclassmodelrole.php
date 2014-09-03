<?php
class erLhcoreClassModelRole {
	public function getState() {
		return array (
				'id' => $this->id,
				'name' => $this->name 
		);
	}
	public function setState(array $properties) {
		foreach ( $properties as $key => $val ) {
			$this->$key = $val;
		}
	}
	public function saveThis() {
		erLhcoreClassRole::getSession ()->save ( $this );
	}
	public function updateThis() {
		erLhcoreClassRole::getSession ()->update ( $this );
	}
	public function removeThis() {
		erLhcoreClassRole::getSession ()->delete ( $this );
	}
	public static function fetch($id) {
		return erLhcoreClassRole::getSession ()->load ( 'erLhcoreClassModelRole', $id );
	}
	public static function validateInput(& $objectData) {
		if (! isset ( $_POST ['csfr_token'] ) || ! erLhcoreClassUser::instance ()->validateCSFRToken ( $_POST ['csfr_token'] )) {
			erLhcoreClassModule::redirect ( 'kernel/csrf-missing' );
		}
		
		$definition = array (
				'Name' => new ezcInputFormDefinitionElement ( ezcInputFormDefinitionElement::REQUIRED, 'unsafe_raw' ) 
		);
		
		$form = new ezcInputForm ( INPUT_POST, $definition );
		
		$Errors = array ();
		
		if (! $form->hasValidData ( 'Name' ) || $form->Name == '') {
			$Errors [] = __t ( 'user/form', 'Please enter name' );
		} else {
			$objectData->name = $form->Name;
		}
		
		return $Errors;
	}
	public $id = null;
	public $name = '';
}

?>
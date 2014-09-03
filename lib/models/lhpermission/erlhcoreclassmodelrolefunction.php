<?php
class erLhcoreClassModelRoleFunction {
	public function getState() {
		return array (
				'id' => $this->id,
				'role_id' => $this->role_id,
				'module' => $this->module,
				'function' => $this->function 
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
		return erLhcoreClassRole::getSession ()->load ( 'erLhcoreClassModelRoleFunction', $id );
	}
	public static function validateInput(& $objectData) {
		
		if (! isset ( $_POST ['csfr_token'] ) || ! erLhcoreClassUser::instance ()->validateCSFRToken ( $_POST ['csfr_token'] )) {
			erLhcoreClassModule::redirect ( 'kernel/csrf-missing' );
		}
		
		$definition = array (
				'Module' => new ezcInputFormDefinitionElement ( ezcInputFormDefinitionElement::REQUIRED, 'string' ),
				'ModuleFunction' => new ezcInputFormDefinitionElement ( ezcInputFormDefinitionElement::REQUIRED, 'string' ) 
		);
		
		$form = new ezcInputForm ( INPUT_POST, $definition );
		$Errors = array ();
		
		if (! $form->hasValidData ( 'Module' ) || $form->Module == '') {
			$Errors [] = erTranslationClassLhTranslation::getInstance ()->getTranslation ( 'permission/editrole', 'Please choose module' );
		} else {
			$objectData->module = $form->Module;
		}
		
		if (! $form->hasValidData ( 'ModuleFunction' ) || $form->ModuleFunction == '') {
			$Errors [] = erTranslationClassLhTranslation::getInstance ()->getTranslation ( 'permission/editrole', 'Please choose module function' );
		} else {
			$objectData->function = $form->ModuleFunction;
		}
				
		return $Errors;
	}
	public $id = null;
	public $role_id = null;
	public $module = null;
	public $function = null;
}

?>
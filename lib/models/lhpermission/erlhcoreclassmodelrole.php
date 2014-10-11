<?php
/**
 * 
 * @author Eventizer
 *
 */
class erLhcoreClassModelRole {
    use erLhcoreClassTrait;
    
    public static $dbTable = 'lh_role';
    public static $dbTableId = 'id';
    public static $dbSessionHandler = 'erLhcoreClassRole::getSession';
    public static $dbSortOrder = 'DESC';
    
	public function getState() {
		return array (
				'id' => $this->id,
				'name' => $this->name 
		);
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
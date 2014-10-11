<?php
/**
 * 
 * @author Eventizer
 *
 */
class erLhcoreClassModelGroup {
    use erLhcoreClassTrait;
    
    public static $dbTable = 'lh_group';
    public static $dbTableId = 'id';
    public static $dbSessionHandler = 'erLhcoreClassUser::getSession';
    public static $dbSortOrder = 'DESC';
    
	public function getState() {
		return array(
        	'id'          => $this->id,
            'name'        => $this->name,             
            'system'      => $this->system             
		);
	}
   
	public function setState( array $properties ) {
    	foreach ( $properties as $key => $val ) {
        	$this->$key = $val;
       	}
   	}
   	
   	public function __toString(){
   		return $this->name;
   	}
   	   
 
	public function removeThis() {   
   				
       $q = ezcDbInstance::get()->createDeleteQuery();
       
       $q->deleteFrom( 'lh_groupuser' )->where( $q->expr->eq( 'group_id', $this->id ) );
       $stmt = $q->prepare();
       $stmt->execute();
       
       $q->deleteFrom( 'lh_grouprole' )->where( $q->expr->eq( 'group_id', $this->id ) );
       $stmt = $q->prepare();
       $stmt->execute(); 
              
       erLhcoreClassUser::getSession()->delete($this);
       
	}
   
	public static function validateInput(& $objectData) {
   
   		if (!isset($_POST['csfr_token']) || !erLhcoreClassUser::instance()->validateCSFRToken($_POST['csfr_token'])) {
   			erLhcoreClassModule::redirect('kernel/csrf-missing');
   		}
   		
   		$definition = array(
   			'Name' => new ezcInputFormDefinitionElement(
   				ezcInputFormDefinitionElement::REQUIRED, 'unsafe_raw'
   			)
   		);
   		
   		$form = new ezcInputForm( INPUT_POST, $definition );
   			
   		$Errors = array();
   		
   		if ( !$form->hasValidData( 'Name' ) || $form->Name == '' ) {
   			$Errors[] = __t('user/form','Please enter name');
   		} else {
   			$objectData->name = $form->Name;
   		}
   		
   		return $Errors;
   		   	   	
	}
	
	public $id = null;
   	public $name = '';
   	public $system = 0;

}

?>
<?php return array(
	       'name' => array(
	           'type' => 'text',
	           'trans' => 'Name',
	           'required' => true,       
	           'validation_definition' => new ezcInputFormDefinitionElement(
	                ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw'
	            )        
	       ),
	       'iso_code' => array (
	           'type' => 'text',
	           'trans' => 'Iso code',
	           'required' => true,       
	           'validation_definition' => new ezcInputFormDefinitionElement(
	                ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw'
	            )        
	       ),
       	 		
       	   'position' => array(
       	 		'type' => 'text',
       	 		'trans' => 'Position',
       	 		'required' => true,
       	 		'validation_definition' => new ezcInputFormDefinitionElement(
       	 			ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw'))
       	 );
?>
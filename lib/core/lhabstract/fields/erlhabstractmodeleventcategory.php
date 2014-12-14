<?php return array(
	       'name' => array(
	           'type' => 'text',
	           'trans' => 'Name',
	           'required' => true,       
	           'validation_definition' => new ezcInputFormDefinitionElement(
	                ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw'
	            )        
	       ),
       	 		
       	   'position' => array(
       	 		'type' => 'text',
       	 		'trans' => 'No. of events have this category',
       	 		'required' => true,
       	 		'readonly' => true,
       	 		'validation_definition' => new ezcInputFormDefinitionElement(
       	 			ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw')),

            'image' => array(
                'type' => 'imgfile',
                'trans' => 'Category Image',
                'required' => true,
                'hidden' => true,
                'frontend_html' => 'image_url_img',
                'frontend_image_edit' => 'image_url_img',
                'backend_call' => 'moveImage',
                'delete_call' => 'deleteImage',
                'validation_definition' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'callback', 'erLhcoreClassSearchHandler::isImageFile()')
            )
       	 );
?>
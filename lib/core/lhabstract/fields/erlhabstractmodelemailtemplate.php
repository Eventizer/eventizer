<?php 
return array(
    'name' => array(
        'type' => 'text',
        'trans' => 'Name',
        'required' => true,
        'validation_definition' => new ezcInputFormDefinitionElement(
            ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw'
        )),
    'from_name' => array(
        'type' => 'text',
        'trans' => 'From name',
        'required' => true,
        'validation_definition' => new ezcInputFormDefinitionElement(
            ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw'
        )),
    'from_email' => array(
        'type' => 'text',
        'trans' => 'From email',
        'required' => true,
        'validation_definition' => new ezcInputFormDefinitionElement(
            ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw'
        )),
    'subject' => array(
        'type' => 'text',
        'multilanguage' => true,
        'trans' => 'Subject',
        'required' => true,
        'validation_definition' => new ezcInputFormDefinitionElement(
            ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw'
        )),
    'content' => array(
        'type' => 'textarea',
        'trans' => 'Content',
        'required' => true,
        'multilanguage' => true,
        'validation_definition' => new ezcInputFormDefinitionElement(
            ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw'
        )));

?>
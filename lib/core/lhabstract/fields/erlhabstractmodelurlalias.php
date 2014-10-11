<?php 
return array(
    'url_alias' => array(
        'type' => 'text',
        'trans' => 'URL Alias',
        'required' => true,
        'validation_definition' => new ezcInputFormDefinitionElement(
            ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw'
        )),
    'url_destination' => array(
        'type' => 'text',
        'frontend' => 'url_destination',
        'trans' => 'URL Destination',
        'required' => true,
        'multilanguage' => true,
        'validation_definition' => new ezcInputFormDefinitionElement(
            ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw'
        ))
);
?>
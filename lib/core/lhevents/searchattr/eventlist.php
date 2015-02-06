<?php

$fieldsSearch = array();

$fieldsSearch['searchText'] = array(
		'type' => 'text',
		'trans' => 'Search',
		'required' => false,
		'valid_if_filled' => false,
		'filter_type' => 'like',
		'filter_table_field' => 'title',
		'validation_definition' => new ezcInputFormDefinitionElement(
			ezcInputFormDefinitionElement::OPTIONAL, 'string'
		)
);

$fieldsSearch['category'] = array(
		'type' => 'text',
		'trans' => 'Category',
		'required' => false,
		'valid_if_filled' => false,
		'filter_type' => 'filter',
		'filter_table_field' => 'cat_id',
		'validation_definition' => new ezcInputFormDefinitionElement(
			ezcInputFormDefinitionElement::OPTIONAL, 'int'
		)
);

$fieldsSearch['tab'] = array(
		'type' => 'text',
		'trans' => 'Tab',
		'required' => false,
		'valid_if_filled' => false,
		'filter_type' => 'filter',
		'filter_table_field' => false,
		'validation_definition' => new ezcInputFormDefinitionElement(
			ezcInputFormDefinitionElement::OPTIONAL, 'string'
		)
);

$fieldSortAttr = array (
	'disabled' 	=> false,
);

return array(
    'filterAttributes' => $fieldsSearch,
    'sortAttributes'   => $fieldSortAttr
);
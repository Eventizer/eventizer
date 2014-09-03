<?php

$def = new ezcPersistentObjectDefinition();
$def->table = "lh_abstract_url_alias";
$def->class = "erLhAbstractModelUrlAlias";

$def->idProperty = new ezcPersistentObjectIdProperty();
$def->idProperty->columnName = 'id';
$def->idProperty->propertyName = 'id';
$def->idProperty->generator = new ezcPersistentGeneratorDefinition(  'ezcPersistentNativeGenerator' );

$def->properties['url_alias'] = new ezcPersistentObjectProperty();
$def->properties['url_alias']->columnName   = 'url_alias';
$def->properties['url_alias']->propertyName = 'url_alias';
$def->properties['url_alias']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING; 

foreach (erConfigClassLhConfig::getInstance()->getSetting( 'site', 'site_languages' ) as $language) {
	
	$locale = strtolower($language['locale']);
	
	$def->properties['url_destination_'.$locale] = new ezcPersistentObjectProperty();
	$def->properties['url_destination_'.$locale]->columnName   = 'url_destination_'.strtolower($locale);
	$def->properties['url_destination_'.$locale]->propertyName = 'url_destination_'.strtolower($locale);
	$def->properties['url_destination_'.$locale]->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;
	
}

return $def;
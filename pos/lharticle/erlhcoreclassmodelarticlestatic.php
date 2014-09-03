<?php

$def = new ezcPersistentObjectDefinition();
$def->table = "lh_article_static";
$def->class = "erLhcoreClassModelArticleStatic";

$def->idProperty = new ezcPersistentObjectIdProperty();
$def->idProperty->columnName = 'id';
$def->idProperty->propertyName = 'id';
$def->idProperty->generator = new ezcPersistentGeneratorDefinition(  'ezcPersistentSequenceGenerator' );

foreach (erConfigClassLhConfig::getInstance()->getSetting( 'site', 'site_languages' ) as $language) {
	
	$locale = strtolower($language['locale']); 
	
	$def->properties['name_'.$locale] = new ezcPersistentObjectProperty();
	$def->properties['name_'.$locale]->columnName   = 'name_'.$locale;
	$def->properties['name_'.$locale]->propertyName = 'name_'.$locale;
	$def->properties['name_'.$locale]->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;
	
	$def->properties['content_'.$locale] = new ezcPersistentObjectProperty();
	$def->properties['content_'.$locale]->columnName   = 'content_'.$locale;
	$def->properties['content_'.$locale]->propertyName = 'content_'.$locale;
	$def->properties['content_'.$locale]->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;
		
}

$def->properties['file_name'] = new ezcPersistentObjectProperty();
$def->properties['file_name']->columnName   = 'file_name';
$def->properties['file_name']->propertyName = 'file_name';
$def->properties['file_name']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING; 

$def->properties['active'] = new ezcPersistentObjectProperty();
$def->properties['active']->columnName   = 'active';
$def->properties['active']->propertyName = 'active';
$def->properties['active']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

$def->properties['system'] = new ezcPersistentObjectProperty();
$def->properties['system']->columnName   = 'system';
$def->properties['system']->propertyName = 'system';
$def->properties['system']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

$def->properties['mtime'] = new ezcPersistentObjectProperty();
$def->properties['mtime']->columnName   = 'mtime';
$def->properties['mtime']->propertyName = 'mtime';
$def->properties['mtime']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

return $def; 

?>
<?php

$def = new ezcPersistentObjectDefinition();
$def->table = "lh_article";
$def->class = "erLhcoreClassModelArticle";

$def->idProperty = new ezcPersistentObjectIdProperty();
$def->idProperty->columnName = 'id';
$def->idProperty->propertyName = 'id';
$def->idProperty->generator = new ezcPersistentGeneratorDefinition(  'ezcPersistentNativeGenerator' );

foreach (erConfigClassLhConfig::getInstance()->getSetting( 'site', 'site_languages' ) as $language) {
	
	$locale = strtolower($language['locale']); 
	
	$def->properties['name_'.$locale] = new ezcPersistentObjectProperty();
	$def->properties['name_'.$locale]->columnName   = 'name_'.$locale;
	$def->properties['name_'.$locale]->propertyName = 'name_'.$locale;
	$def->properties['name_'.$locale]->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;
	
	$def->properties['intro_'.$locale] = new ezcPersistentObjectProperty();
	$def->properties['intro_'.$locale]->columnName   = 'intro_'.$locale;
	$def->properties['intro_'.$locale]->propertyName = 'intro_'.$locale;
	$def->properties['intro_'.$locale]->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;
	
	$def->properties['body_'.$locale] = new ezcPersistentObjectProperty();
	$def->properties['body_'.$locale]->columnName   = 'body_'.$locale;
	$def->properties['body_'.$locale]->propertyName = 'body_'.$locale;
	$def->properties['body_'.$locale]->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;
	
	$def->properties['alias_url_'.$locale] = new ezcPersistentObjectProperty();
	$def->properties['alias_url_'.$locale]->columnName   = 'alias_url_'.$locale;
	$def->properties['alias_url_'.$locale]->propertyName = 'alias_url_'.$locale;
	$def->properties['alias_url_'.$locale]->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;
	
	$def->properties['alternative_url_'.$locale] = new ezcPersistentObjectProperty();
	$def->properties['alternative_url_'.$locale]->columnName   = 'alternative_url_'.$locale;
	$def->properties['alternative_url_'.$locale]->propertyName = 'alternative_url_'.$locale;
	$def->properties['alternative_url_'.$locale]->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;
	     
}

$def->properties['file_name'] = new ezcPersistentObjectProperty();
$def->properties['file_name']->columnName   = 'file_name';
$def->properties['file_name']->propertyName = 'file_name';
$def->properties['file_name']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING; 

$def->properties['pos'] = new ezcPersistentObjectProperty();
$def->properties['pos']->columnName   = 'pos';
$def->properties['pos']->propertyName = 'pos';
$def->properties['pos']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT; 

$def->properties['has_photo'] = new ezcPersistentObjectProperty();
$def->properties['has_photo']->columnName   = 'has_photo';
$def->properties['has_photo']->propertyName = 'has_photo';
$def->properties['has_photo']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;  

$def->properties['category_id'] = new ezcPersistentObjectProperty();
$def->properties['category_id']->columnName   = 'category_id';
$def->properties['category_id']->propertyName = 'category_id';
$def->properties['category_id']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT; 

$def->properties['category_id_parent'] = new ezcPersistentObjectProperty();
$def->properties['category_id_parent']->columnName   = 'category_id_parent';
$def->properties['category_id_parent']->propertyName = 'category_id_parent';
$def->properties['category_id_parent']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;
 
$def->properties['open_new_page'] = new ezcPersistentObjectProperty();
$def->properties['open_new_page']->columnName   = 'open_new_page';
$def->properties['open_new_page']->propertyName = 'open_new_page';
$def->properties['open_new_page']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

$def->properties['hide'] = new ezcPersistentObjectProperty();
$def->properties['hide']->columnName   = 'hide';
$def->properties['hide']->propertyName = 'hide';
$def->properties['hide']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

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
<?php

$def = new ezcPersistentObjectDefinition();
$def->table = "lh_article_category";
$def->class = "erLhcoreClassModelArticleCategory";

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

   $def->properties['url_alternative_'.$locale] = new ezcPersistentObjectProperty();
   $def->properties['url_alternative_'.$locale]->columnName   = 'url_alternative_'.$locale;
   $def->properties['url_alternative_'.$locale]->propertyName = 'url_alternative_'.$locale;
   $def->properties['url_alternative_'.$locale]->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;
}

$def->properties['pos'] = new ezcPersistentObjectProperty();
$def->properties['pos']->columnName   = 'pos';
$def->properties['pos']->propertyName = 'pos';
$def->properties['pos']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT; 

$def->properties['parent_id'] = new ezcPersistentObjectProperty();
$def->properties['parent_id']->columnName   = 'parent_id';
$def->properties['parent_id']->propertyName = 'parent_id';
$def->properties['parent_id']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

$def->properties['system'] = new ezcPersistentObjectProperty();
$def->properties['system']->columnName   = 'system';
$def->properties['system']->propertyName = 'system';
$def->properties['system']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

return $def; 

?>
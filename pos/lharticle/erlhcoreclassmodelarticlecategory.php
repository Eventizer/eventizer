<?php

$def = new ezcPersistentObjectDefinition();
$def->table = "lh_article_category";
$def->class = "erLhcoreClassModelArticleCategory";

$def->idProperty = new ezcPersistentObjectIdProperty();
$def->idProperty->columnName = 'id';
$def->idProperty->propertyName = 'id';
$def->idProperty->generator = new ezcPersistentGeneratorDefinition(  'ezcPersistentNativeGenerator' );

$def->properties['name'] = new ezcPersistentObjectProperty();
$def->properties['name']->columnName   = 'name';
$def->properties['name']->propertyName = 'name';
$def->properties['name']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;
   
$def->properties['intro'] = new ezcPersistentObjectProperty();
$def->properties['intro']->columnName   = 'intro';
$def->properties['intro']->propertyName = 'intro';
$def->properties['intro']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;

$def->properties['url_alternative'] = new ezcPersistentObjectProperty();
$def->properties['url_alternative']->columnName   = 'url_alternative';
$def->properties['url_alternative']->propertyName = 'url_alternative';
$def->properties['url_alternative']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;

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

$def->properties['type'] = new ezcPersistentObjectProperty();
$def->properties['type']->columnName   = 'type';
$def->properties['type']->propertyName = 'type';
$def->properties['type']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

return $def; 

?>
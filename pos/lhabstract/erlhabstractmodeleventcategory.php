<?php

$def = new ezcPersistentObjectDefinition();
$def->table = "lh_abstract_event_category";
$def->class = "erLhAbstractModelEventCategory";

$def->idProperty = new ezcPersistentObjectIdProperty();
$def->idProperty->columnName = 'id';
$def->idProperty->propertyName = 'id';
$def->idProperty->generator = new ezcPersistentGeneratorDefinition(  'ezcPersistentNativeGenerator' );

$def->properties['name'] = new ezcPersistentObjectProperty();
$def->properties['name']->columnName   = 'name';
$def->properties['name']->propertyName = 'name';
$def->properties['name']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;

$def->properties['image'] = new ezcPersistentObjectProperty();
$def->properties['image']->columnName   = 'image';
$def->properties['image']->propertyName = 'image';
$def->properties['image']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;

$def->properties['image_path'] = new ezcPersistentObjectProperty();
$def->properties['image_path']->columnName   = 'image_path';
$def->properties['image_path']->propertyName = 'image_path';
$def->properties['image_path']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;

$def->properties['position'] = new ezcPersistentObjectProperty();
$def->properties['position']->columnName   = 'position';
$def->properties['position']->propertyName = 'position';
$def->properties['position']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

return $def;

?>
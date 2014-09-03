<?php

$def = new ezcPersistentObjectDefinition();
$def->table = "lh_group";
$def->class = "erLhcoreClassModelGroup";

$def->idProperty = new ezcPersistentObjectIdProperty();
$def->idProperty->columnName = 'id';
$def->idProperty->propertyName = 'id';
$def->idProperty->generator = new ezcPersistentGeneratorDefinition(  'ezcPersistentNativeGenerator' );

$def->properties['name'] = new ezcPersistentObjectProperty();
$def->properties['name']->columnName   = 'name';
$def->properties['name']->propertyName = 'name';
$def->properties['name']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING; 

$def->properties['system'] = new ezcPersistentObjectProperty();
$def->properties['system']->columnName   = 'system';
$def->properties['system']->propertyName = 'system';
$def->properties['system']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

return $def; 

?>
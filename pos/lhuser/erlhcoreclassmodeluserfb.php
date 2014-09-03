<?php

$def = new ezcPersistentObjectDefinition();
$def->table = "lh_user_fb";
$def->class = "erLhcoreClassModelUserFB";

$def->idProperty = new ezcPersistentObjectIdProperty();
$def->idProperty->columnName = 'user_id';
$def->idProperty->propertyName = 'user_id';
$def->idProperty->generator = new ezcPersistentGeneratorDefinition(  'ezcPersistentManualGenerator' );

$def->properties['fb_user_id'] = new ezcPersistentObjectProperty();
$def->properties['fb_user_id']->columnName   = 'fb_user_id';
$def->properties['fb_user_id']->propertyName = 'fb_user_id';
$def->properties['fb_user_id']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING; 

$def->properties['name'] = new ezcPersistentObjectProperty();
$def->properties['name']->columnName   = 'name';
$def->properties['name']->propertyName = 'name';
$def->properties['name']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING; 

$def->properties['link'] = new ezcPersistentObjectProperty();
$def->properties['link']->columnName   = 'link';
$def->properties['link']->propertyName = 'link';
$def->properties['link']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING; 

return $def; 

?>
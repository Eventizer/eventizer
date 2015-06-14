<?php

$def = new ezcPersistentObjectDefinition();
$def->table = "lh_saved_events";
$def->class = "erLhcoreClassModelSavedEvents";

$def->idProperty = new ezcPersistentObjectIdProperty();
$def->idProperty->columnName = 'id';
$def->idProperty->propertyName = 'id';
$def->idProperty->generator = new ezcPersistentGeneratorDefinition(  'ezcPersistentNativeGenerator' );

$def->properties['event_id'] = new ezcPersistentObjectProperty();
$def->properties['event_id']->columnName   = 'event_id';
$def->properties['event_id']->propertyName = 'event_id';
$def->properties['event_id']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

$def->properties['user_id'] = new ezcPersistentObjectProperty();
$def->properties['user_id']->columnName   = 'user_id';
$def->properties['user_id']->propertyName = 'user_id';
$def->properties['user_id']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

$def->properties['email_sent'] = new ezcPersistentObjectProperty();
$def->properties['email_sent']->columnName   = 'email_sent';
$def->properties['email_sent']->propertyName = 'email_sent';
$def->properties['email_sent']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

$def->properties['time'] = new ezcPersistentObjectProperty();
$def->properties['time']->columnName   = 'time';
$def->properties['time']->propertyName = 'time';
$def->properties['time']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;

return $def;

?>
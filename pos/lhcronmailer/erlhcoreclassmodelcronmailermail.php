<?php

$def = new ezcPersistentObjectDefinition();
$def->table = "lh_cron_mailer_mail";
$def->class = "erLhcoreClassModelCronMailerMail";

$def->idProperty = new ezcPersistentObjectIdProperty();
$def->idProperty->columnName = 'id';
$def->idProperty->propertyName = 'id';
$def->idProperty->generator = new ezcPersistentGeneratorDefinition(  'ezcPersistentSequenceGenerator' );

$def->properties['status'] = new ezcPersistentObjectProperty();
$def->properties['status']->columnName   = 'status';
$def->properties['status']->propertyName = 'status';
$def->properties['status']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

$def->properties['type'] = new ezcPersistentObjectProperty();
$def->properties['type']->columnName   = 'type';
$def->properties['type']->propertyName = 'type';
$def->properties['type']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

$def->properties['email'] = new ezcPersistentObjectProperty();
$def->properties['email']->columnName   = 'email';
$def->properties['email']->propertyName = 'email';
$def->properties['email']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;

$def->properties['name'] = new ezcPersistentObjectProperty();
$def->properties['name']->columnName   = 'name';
$def->properties['name']->propertyName = 'name';
$def->properties['name']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;

$def->properties['email_subject'] = new ezcPersistentObjectProperty();
$def->properties['email_subject']->columnName   = 'email_subject';
$def->properties['email_subject']->propertyName = 'email_subject';
$def->properties['email_subject']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;

$def->properties['email_content'] = new ezcPersistentObjectProperty();
$def->properties['email_content']->columnName   = 'email_content';
$def->properties['email_content']->propertyName = 'email_content';
$def->properties['email_content']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;

$def->properties['params'] = new ezcPersistentObjectProperty();
$def->properties['params']->columnName   = 'params';
$def->properties['params']->propertyName = 'params';
$def->properties['params']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;

$def->properties['send_time'] = new ezcPersistentObjectProperty();
$def->properties['send_time']->columnName   = 'send_time';
$def->properties['send_time']->propertyName = 'send_time';
$def->properties['send_time']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

$def->properties['created'] = new ezcPersistentObjectProperty();
$def->properties['created']->columnName   = 'created';
$def->properties['created']->propertyName = 'created';
$def->properties['created']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

return $def; 

?>
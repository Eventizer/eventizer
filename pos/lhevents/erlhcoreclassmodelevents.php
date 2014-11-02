<?php

$def = new ezcPersistentObjectDefinition();
$def->table = "lh_events";
$def->class = "erLhcoreClassModelEvents";

$def->idProperty = new ezcPersistentObjectIdProperty();
$def->idProperty->columnName = 'id';
$def->idProperty->propertyName = 'id';
$def->idProperty->generator = new ezcPersistentGeneratorDefinition(  'ezcPersistentNativeGenerator' );

$def->properties['title'] = new ezcPersistentObjectProperty();
$def->properties['title']->columnName   = 'title';
$def->properties['title']->propertyName = 'title';
$def->properties['title']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;

$def->properties['file'] = new ezcPersistentObjectProperty();
$def->properties['file']->columnName   = 'file';
$def->properties['file']->propertyName = 'file';
$def->properties['file']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;

$def->properties['file'] = new ezcPersistentObjectProperty();
$def->properties['file']->columnName   = 'file';
$def->properties['file']->propertyName = 'file';
$def->properties['file']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;

$def->properties['file_path'] = new ezcPersistentObjectProperty();
$def->properties['file_path']->columnName   = 'file_path';
$def->properties['file_path']->propertyName = 'file_path';
$def->properties['file_path']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;

$def->properties['start_date'] = new ezcPersistentObjectProperty();
$def->properties['start_date']->columnName   = 'start_date';
$def->properties['start_date']->propertyName = 'start_date';
$def->properties['start_date']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

$def->properties['end_date'] = new ezcPersistentObjectProperty();
$def->properties['end_date']->columnName   = 'end_date';
$def->properties['end_date']->propertyName = 'end_date';
$def->properties['end_date']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

$def->properties['country'] = new ezcPersistentObjectProperty();
$def->properties['country']->columnName   = 'country';
$def->properties['country']->propertyName = 'country';
$def->properties['country']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

$def->properties['address'] = new ezcPersistentObjectProperty();
$def->properties['address']->columnName   = 'address';
$def->properties['address']->propertyName = 'address';
$def->properties['address']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;

$def->properties['postcode'] = new ezcPersistentObjectProperty();
$def->properties['postcode']->columnName   = 'postcode';
$def->properties['postcode']->propertyName = 'postcode';
$def->properties['postcode']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;

$def->properties['description'] = new ezcPersistentObjectProperty();
$def->properties['description']->columnName   = 'description';
$def->properties['description']->propertyName = 'description';
$def->properties['description']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;

$def->properties['organizer_name'] = new ezcPersistentObjectProperty();
$def->properties['organizer_name']->columnName   = 'organizer_name';
$def->properties['organizer_name']->propertyName = 'organizer_name';
$def->properties['organizer_name']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;

$def->properties['organizer_description'] = new ezcPersistentObjectProperty();
$def->properties['organizer_description']->columnName   = 'organizer_description';
$def->properties['organizer_description']->propertyName = 'organizer_description';
$def->properties['organizer_description']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;

$def->properties['fb_link'] = new ezcPersistentObjectProperty();
$def->properties['fb_link']->columnName   = 'fb_link';
$def->properties['fb_link']->propertyName = 'fb_link';
$def->properties['fb_link']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;

$def->properties['tw_link'] = new ezcPersistentObjectProperty();
$def->properties['tw_link']->columnName   = 'tw_link';
$def->properties['tw_link']->propertyName = 'tw_link';
$def->properties['tw_link']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;

$def->properties['link'] = new ezcPersistentObjectProperty();
$def->properties['link']->columnName   = 'link';
$def->properties['link']->propertyName = 'link';
$def->properties['link']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;

$def->properties['variations'] = new ezcPersistentObjectProperty();
$def->properties['variations']->columnName   = 'variations';
$def->properties['variations']->propertyName = 'variations';
$def->properties['variations']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;

$def->properties['mtime'] = new ezcPersistentObjectProperty();
$def->properties['mtime']->columnName   = 'mtime';
$def->properties['mtime']->propertyName = 'mtime';
$def->properties['mtime']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;

return $def;

?>
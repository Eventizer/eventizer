<?php 
// php cron.php -s site_admin -c cron/util/generate_db_structure > doc/update_db/structure.json
$structureTables = array(
	'lh_abstract_url_alias',
	'lh_abstract_event_category',
	'lh_abstract_country',
	'lh_abstract_email_templates',
	'lh_article_category',
	'lh_article',
	'lh_article_static',
	'lh_cron_mailer_mail',
	'lh_events',
	'lh_forgotpasswordhash',
	'lh_group',
	'lh_grouprole',
	'lh_groupuser',
	'lh_role',
	'lh_rolefunction',
	'lh_users',
	'lh_users_remember',
	'lh_system_config',
);

$dataTables = array (
	'lh_abstract_country' => 'id',
	'lh_abstract_event_category' => 'id',
	'lh_article_category' => 'id',
	'lh_abstract_email_templates' => 'id',
	'lh_system_config' => 'identifier',
);
// Array which holds our version definition
$structuresTablesData = array();
$db = ezcDbInstance::get();
foreach ($structureTables as $table) {
	$sql = 'SHOW COLUMNS FROM '.$table;			
	$stmt = $db->prepare($sql);
	$stmt->execute();			
	$columnsData = $stmt->fetchAll(PDO::FETCH_ASSOC);	
	$structuresTablesData['tables'][$table] = $columnsData;	
}
foreach ($dataTables as $table => $identifier) {
	$sql = 'SELECT * FROM '.$table;			
	$stmt = $db->prepare($sql);
	$stmt->execute();			
	$recordsData = $stmt->fetchAll(PDO::FETCH_ASSOC);	
	$structuresTablesData['tables_data'][$table] = $recordsData;	
	$structuresTablesData['tables_data_identifier'][$table] = $identifier;
}
foreach ($structureTables as $table) {
	$sql = 'SHOW CREATE TABLE `'.$table.'`';			
	$stmt = $db->prepare($sql);
	$stmt->execute();
	$recordsData = $stmt->fetch(PDO::FETCH_ASSOC);	
	$structuresTablesData['tables_create'][$table] = $recordsData['create table'];
}
echo json_encode($structuresTablesData,JSON_PRETTY_PRINT);
?>
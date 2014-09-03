<?php

/*
 *
* php cron.php -s site_admin -c cron/update_db_langs
* 
* @TODO kalbu pridejimas
*/

ini_set("max_execution_time", "9600");
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);



$defaultSiteAccess = erConfigClassLhConfig::getInstance()->getSetting( 'site', 'site_languages' );
$table='lh_abstract_lb_forum';
$rows=array(
		array('row_name'=>'name','row_type'=>'VARCHAR( 100 )'),
	//	array('row_name'=>'content','row_type'=>'TEXT'),
	//	array('row_name'=>'body','row_type'=>'TEXT'),
	//	array('row_name'=>'alias_url','row_type'=>'VARCHAR( 255 )'),
//	array('row_name'=>'alternative_url','row_type'=>'VARCHAR( 255 )'),

);

$db = ezcDbInstance::get();

foreach ($defaultSiteAccess as $language) {
	
	$locale = strtolower($language['locale']);
	$tables='';
	
	foreach($rows as $key=>$row){
	
		$tables = 'ADD '.$row['row_name'].'_'.$locale.' '.$row['row_type'].'';
	
		$sql = 'ALTER TABLE '.$table.' '.$tables.';';
 		$stmt = $db->prepare($sql);
			try{
		 		$stmt->execute();
		 		echo "row".$language['locale']." created\n";
			}catch(Exception $e){
				echo "row".$language['locale']." exist\n";
			}
		}
		echo 'cron finished';
}
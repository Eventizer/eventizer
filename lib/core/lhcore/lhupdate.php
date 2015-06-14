<?php

class erLhcoreClassUpdate {
    const VERSION = 3;
    
    public static function version() {
        return (self::VERSION)/100;
    }
					
	public static function doTablesUpdate($definition, $executeQueries = true) {
		
		$errorMessages = array();
		$queries = array();
		
		$updateInformation = self::getTablesStatus($definition);
		
		$db = ezcDbInstance::get();
			
		foreach ($updateInformation as $table => $tableData) {
			
			if ($tableData['error'] == true) {
				
				foreach ($tableData['queries'] as $query) {
					
					try {
						
						if ($executeQueries) {
							$db->query($query);
						}
						
						$queries[] = $query;
						
					} catch (Exception $e) {
						$errorMessages[] = $e->getMessage();
					}
					
				}
				
			}
			
		}
		
		return array('error_messages' => $errorMessages, 'queries' => $queries);		
	}
	
	public static function getTablesStatus($definition) {
		
		$db = ezcDbInstance::get();
		
		$tablesStatus = array();		
		foreach ($definition['tables'] as $table => $tableDefinition) {
			$tablesStatus[$table] = array('error' => false,'status' => '','queries' => array());
			try {
				$sql = 'SHOW COLUMNS FROM '.$table;
				$stmt = $db->prepare($sql);
				$stmt->execute();
				$columnsData = $stmt->fetchAll(PDO::FETCH_ASSOC);				
				$columnsDesired = (array)$tableDefinition;
				
				$status = array();
				
				foreach ($columnsData as $columnExisting) {
					$columnFound = false;				
					foreach ($columnsDesired as $column) {
						if ($columnExisting['field'] == $column['field']) {
							$columnFound = true;							
						}
					}
					
					if ($columnFound == false){
						$status[] = "[{$columnExisting['field']}] column not defined in JSON file!";		
					}			
				}
				
				$columnsToRename = array();
				
				// We have defined table column changes over time
				if (isset($definition['tables_column_names_changes'][$table])){
				    $columnsNameChanges = $definition['tables_column_names_changes'][$table];
				    
				    foreach ($columnsData as $columnExisting) {
				        if (in_array($columnExisting['field'], array_keys($columnsNameChanges))) { // We have column which name has to change
				            $columnsToRename[] = $columnsNameChanges[$columnExisting['field']]['name'];				            
				            $tablesStatus[$table]['queries'][] = $columnsNameChanges[$columnExisting['field']]['q'];				            
				        }
				    }
				}
				
				foreach ($columnsDesired as $columnDesired) {
				    
				    // Add column only if it's not a rename operation
				    if (!in_array($columnDesired['field'], $columnsToRename))
				    {
    					$columnFound = false;
    					$typeMatch = true;
    					foreach ($columnsData as $column) {
    						if ($columnDesired['field'] == $column['field']) {
    							$columnFound = true;
    							
    							if ($columnDesired['type'] != $column['type']) {
    								$typeMatch = false;
    							}
    						}	
    					}
    
    					if ($typeMatch == false) {
    						$tablesStatus[$table]['error'] = true;
    						$status[] = "[{$columnDesired['field']}] column type is not correct";
    												
    						$tablesStatus[$table]['queries'][] = "ALTER TABLE `{$table}` CHANGE `{$columnDesired['field']}` `{$columnDesired['field']}` {$columnDesired['type']} NOT NULL;";
    					}
    					
    					if ($columnFound == false) {
    						$tablesStatus[$table]['error'] = true;
    						$status[] = "[{$columnDesired['field']}] column was not found";
    						
    						$default = '';
    						if ($columnDesired['default'] !== null){
    							$default = " DEFAULT '{$columnDesired['default']}'";
    						}
    								
    						$tablesStatus[$table]['queries'][] = "ALTER TABLE `{$table}` ADD `{$columnDesired['field']}` {$columnDesired['type']} NOT NULL{$default}, COMMENT='';";
    					}
				    }					
				}
				
				if (!empty($status)) {
					$tablesStatus[$table]['status'] = implode(", ", $status);
					$tablesStatus[$table]['error'] = true;
				}
								
			} catch (Exception $e) {
				$tablesStatus[$table]['error'] = true;
				$tablesStatus[$table]['status'] = "table does not exists";
				$tablesStatus[$table]['queries'][] = $definition['tables_create'][$table];
			}			
		}
				
		if (isset($definition['tables_indexes'])) {
			
			foreach ($definition['tables_indexes'] as $table => $dataTableIndex) {
				try {
					$sql = 'SHOW INDEX FROM '.$table;
					$stmt = $db->prepare($sql);
					$stmt->execute();
					$columnsData = $stmt->fetchAll(PDO::FETCH_ASSOC);
					$status = array();
			
					$existingIndexes = array();
					foreach ($columnsData as $indexData) {
						$existingIndexes[] = $indexData['key_name'];
					}
			
					$existingIndexes = array_unique($existingIndexes);
			
					$newIndexes = array_diff(array_keys($dataTableIndex['new']), $existingIndexes);
			
					foreach ($newIndexes as $newIndex) {
						$tablesStatus[$table]['queries'][] = $dataTableIndex['new'][$newIndex];
						$status[] = "{$newIndex} index was not found";
					}
			
					$removeIndexes = array_intersect($dataTableIndex['old'], $existingIndexes);
						
					foreach ($removeIndexes as $removeIndex) {
						$tablesStatus[$table]['queries'][] = "ALTER TABLE `{$table}` DROP INDEX `{$removeIndex}`;";
						$tablesStatus[$table]['error'] = true;
						$status[] = "{$removeIndex} legacy index was found";
					}
			
					if (!empty($status)) {
						$tablesStatus[$table]['status'] = implode(", ", $status);
						$tablesStatus[$table]['error'] = true;
					}
			
				} catch (Exception $e) {
					// Just not existing table perhaps
				}
			}
			
		}
				
		foreach ($definition['tables_data'] as $table => $dataTable) {
			$tableIdentifier = $definition['tables_data_identifier'][$table];
			
			$status = array();
			// Check that table has all required records
			foreach ($dataTable as $record) {	

				try {
					$sql = "SELECT COUNT(*) as total_records FROM `{$table}` WHERE `{$tableIdentifier}` = :identifier_value";				
					$stmt = $db->prepare($sql);
					$stmt->bindValue(':identifier_value',$record[$tableIdentifier]);
					$stmt->execute();
					$columnsData = $stmt->fetchColumn();
					if ($columnsData == 0){
						$status[] = "Record with identifier {$tableIdentifier} = {$record[$tableIdentifier]} was not found";
						
						$columns = array();
						$values = array();
						foreach ($record as $column => $value) {
							$columns[] = '`' . $column . '`';
							$values[] = $db->quote($value);
						}					
						$tablesStatus[$table]['queries'][] = "INSERT INTO `{$table}` (".implode(',', $columns).") VALUES (".implode(',', $values).")";					
					}
				} catch (Exception $e) {
					
					$status[] = "Record with identifier {$tableIdentifier} = {$record[$tableIdentifier]} was not found";
					
					$columns = array();
					$values = array();
					foreach ($record as $column => $value) {
						$columns[] = '`' . $column . '`';
						$values[] = $db->quote($value);
					}
					$tablesStatus[$table]['queries'][] = "INSERT INTO `{$table}` (".implode(',', $columns).") VALUES (".implode(',', $values).")";										
					// Perhaps table does not exists
				}			
			}
			
			if (!empty($status)){
				$tablesStatus[$table]['status'] .= implode(", ", $status);
				$tablesStatus[$table]['error'] = true;
			}
		}
		
		return $tablesStatus;
	}
		
	public static function getElasticStatus($definition) {
		
		$typeStatus = array();		
		
		$cfg = erConfigClassLhConfig::getInstance();
		$elasticIndex = $cfg->getSetting('elasticsearch','index');
		
		$elasticData = erLhcoreClassElasticClient::instance()->indices()->getMapping(array('index' => $elasticIndex));
				
		$currentMappingData = $elasticData[$elasticIndex]['mappings'];
				
		foreach ($definition['types'] as $type => $typeDefinition) {

			if(isset($currentMappingData[$type])) {
				
				$status = array();
				
				$currentTypeProperties = $currentMappingData[$type]['properties'];
				
				// Add property
				foreach ($typeDefinition as $property => $propertyData) {
					
					if(!isset($currentTypeProperties[$property])) {
												
						$status[] = '['.$property.'] property not found';
						
						$params = array(
							'index' => $elasticIndex,
							'type' => $type,
							'body' => array(
								$type => array(
									'properties' => array($property => $propertyData)
								)
							)
						);
						
						$typeStatus[$type]['actions']['type_property_add'][] = $params;
						
					}	
					
				}

				// Remove property
				/*				
				foreach (array_keys($currentTypeProperties) as $property) {

 					if(!isset($typeDefinition[$property])) {
						
 						$status[] = '['.$property.'] property removed';
						
 						$typeStatus[$type]['actions']['type_property_delete'][] = array();
						
 					}
					
				}
				*/
								
				if (!empty($status)) {
					$typeStatus[$type]['error'] = true;
					$typeStatus[$type]['status'] = implode(', ', $status);
				}				
				
			} else {
				
				// Add types
				$typeStatus[$type]['error'] = true;
				$typeStatus[$type]['status'] = 'type add';
				
				$params = array(
					'index' => $elasticIndex,
					'type' => $type,
					'body' => array(
						$type => array(
							'properties' => $typeDefinition
						)
					)
				);
							
				$typeStatus[$type]['actions']['type_add'][] = $params;
				
			}
			
		}	
		
		// Remove types		
		foreach (array_keys($currentMappingData) as $type) {
			
 			if(!isset($definition['types'][$type])) {
 				
 				$typeStatus[$type]['error'] = true;
 				$typeStatus[$type]['status'] = 'type removed';
 				
 				$params = array(
 					'index' => $elasticIndex,
 					'type' => $type
 				);			
 				
 				$typeStatus[$type]['actions']['type_delete'][] = $params;
 			
 			}		
			
		}
		
		return $typeStatus;
		
	}
	
	public static function doElasticUpdate($definition) {
		
		$errorMessages = array();
		
		$updateInformation = self::getElasticStatus($definition);
		
		foreach ($updateInformation as $type => $typeData) {
			
			if ($typeData['error'] == true) {
				
				foreach ($typeData['actions'] as $actionType => $actionParams) {
					
					foreach ($actionParams as $params) {
						
						try {
								
							if($actionType == 'type_add') {
								erLhcoreClassElasticClient::instance()->indices()->putMapping($params);
							} elseif($actionType == 'type_delete') {
								erLhcoreClassElasticClient::instance()->indices()->deleteMapping($params);
							} elseif($actionType == 'type_property_add') {
								erLhcoreClassElasticClient::instance()->indices()->putMapping($params);
							} elseif($actionType == 'type_property_delete') {
								// Not used now
							}
						
						} catch (Exception $e) {
							$errorMessages[] = $e->getMessage();
						}
						
					}
					
				}
				
			}
			
		}
			
		return $errorMessages;
		
	}
	
}
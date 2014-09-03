<?php

class erLhcoreClassSearchHandler {

	public static function getParams($params = array()) {
		
		$uparams = isset($params['uparams']) ? $params['uparams'] : array();
		
		$fieldsObjects = include ('lib/core/lh' . $params['module'] . '/searchattr/' . $params['module_file'] . '.php');
		
		$fields = $fieldsObjects['filterAttributes'];
		$orderOptions = $fieldsObjects['sortAttributes'];
		
		foreach ($fields as $key => $field) {
			$definition[$key] = $field['validation_definition'];
		}
		
		foreach ($uparams as $key => &$value) {
			if (! is_array($value))
				$value = urldecode($value);
		}
		
		$inputParams = new stdClass();
		$inputFrom = new stdClass();
		
		$form = new erLhcoreClassInputForm(INPUT_GET, $definition, null, $uparams, isset($params['use_override']) ? $params['use_override'] : false);
		$Errors = array();
		
		foreach ($fields as $key => $field) {
			
			$inputParams->$key = null;
			$inputFrom->$key = null;
			
			if ($form->hasValidData($key) && (($field['required'] == false && $field['valid_if_filled'] == false) || ($field['type'] == 'combobox') || ($field['required'] == true && $field['type'] == 'text' && $form->{$key} != ''))) {
				
				if (isset($field['datatype']) && $field['datatype'] == 'date_ymd') {
					
					$dateTemp = $form->{$key};
					
					if (self::isValidDateFormat($dateTemp) == false) {
						continue;
					}
				
				}
				
				if (isset($field['datatype']) && $field['datatype'] == 'date_en') {
					
					$dateTemp = $form->{$key};
					
					if ($params['clear_date'] == true) {
						
						if (self::isValidDateFormat($dateTemp, "d/m/Y") == false) {
							continue;
						}
					
					} else {
						
						if (self::isValidDateFormat($dateTemp, "dmY") == false) {
							continue;
						}
					}
				
				}
				
				$inputParams->$key = $form->{$key};
				$inputFrom->$key = $form->{$key};
				
				if (isset($field['datatype']) && $field['datatype'] == 'date_en') {
					
					if ($params['clear_date'] == true) {
						$inputParams->$key = str_replace("/", "", $form->{$key});
					} else {
						$inputFrom->$key = $inputFrom->$key = date("d/m/Y", self::formatDateToTimestamp($form->{$key}, "dmY"));
					}
				
				}
				
				if (isset($field['depend_fields'])) {
					foreach ($field['depend_fields'] as $depend) {
						if (! $form->hasValidData($depend) && ! key_exists($depend, $Errors)) {
							$Errors[$depend] = $fields[$depend]['trans'] . ' is required';
						}
					}
				}
			
			} elseif ($field['required'] == true) {
				$Errors[$key] = $field['trans'] . ' is required';
			} elseif (isset($field['valid_if_filled']) && $field['valid_if_filled'] == true && $form->hasValidData($key) && $form->{$key} != '') {
				$inputFrom->$key = $form->{$key};
				$inputParams->$key = $form->{$key};
				
				if (isset($field['depend_fields'])) {
					foreach ($field['depend_fields'] as $depend) {
						
						if (! $form->hasValidData($depend) && ! key_exists($depend, $Errors)) {
							$Errors[$depend] = $fields[$depend]['trans'] . ' is required';
						}
					}
				}
			
			} elseif (isset($field['valid_if_filled']) && $field['valid_if_filled'] == true && isset($_GET[$key]) && $_GET[$key] != '') {
				$Errors[$key] = $field['trans'] . ' is filled incorrectly!';
				$inputFrom->$key = $_GET[$key];
			} elseif (isset($field['depend_fields'])) { // No value, we can clean dependence fields
				
				foreach ($field['depend_fields'] as $depend) {
					$inputFrom->$depend = null;
					$inputParams->$depend = null;
				}
			}
		}
		
		$filter = array();
		
		if (isset($params['format_filter']) && count($Errors) == 0) {
			
			foreach ($fields as $key => $field) {
				
				if (($field['filter_type'] !== false && $inputParams->$key != '') || $inputParams->$key === 0) {
					
					if ($field['filter_type'] == 'filter') {
						
						if (is_bool($inputParams->$key) && $inputParams->$key == true) {
							$filter[$field['filter_type']][$field['filter_table_field']] = 1;
						} else {
							$filter[$field['filter_type']][$field['filter_table_field']] = $inputParams->$key;
						}
					
					} elseif ($field['filter_type'] == 'filterin_remote') {
						
						$args = array();
						foreach ($field['filter_in_args'] as $fieldInput) {
							$args[] = $inputParams->$fieldInput;
						}
						$filter['filterin'][$key] = call_user_func_array($field['filter_in_generator'], $args);
						
						if (count($filter['filterin'][$key]) == 0) {
							$filter['filterin'][$key] = array(
								- 1
							);
						}
						
						if (isset($field['depend_fields'])) {
							foreach ($field['depend_fields'] as $depend) {
								if ($inputFrom->$depend == - 1) {
									unset($filter['filterin'][$key]);
								}
							}
						}
					
					} elseif ($field['filter_type'] == 'filtergte') {
						
						if (isset($field['datatype']) && $field['datatype'] == 'date') {
							
							$dateFormated = self::formatDateToTimestamp($inputParams->$key);
							if ($dateFormated != false) {
								$filter['filtergte'][$field['filter_table_field']] = $dateFormated;
							}
						
						} elseif (isset($field['datatype']) && $field['datatype'] == 'date_ymd') {
							
							$dateFormated = self::formatDateToDateYmd($inputParams->$key);
							if ($dateFormated != false) {
								$filter['filtergte'][$field['filter_table_field']] = $dateFormated;
							}
						
						} elseif (isset($field['datatype']) && $field['datatype'] == 'date_en') {
							
							$dateFormated = self::formatDateToTimestamp($inputParams->$key, 'dmY');
							
							if (isset($field['filter_set_day_end']) && $field['filter_set_day_end'] == true) {
								$dateFormated = self::formatDateToTimestamp($inputParams->$key, 'dmY', true);
							} else {
								$dateFormated = self::formatDateToTimestamp($inputParams->$key, 'dmY');
							}
							
							if ($dateFormated != false) {
								$filter['filtergte'][$field['filter_table_field']] = $dateFormated;
							}
						
						} else {
							$filter['filtergte'][$field['filter_table_field']] = $inputParams->$key;
						}
					
					} elseif ($field['filter_type'] == 'filterlte') {
						
						if (isset($field['range_from']) && isset($filter['filtergte'][$fields[$field['range_from']]['filter_table_field']]) && $filter['filtergte'][$fields[$field['range_from']]['filter_table_field']] == $inputParams->$key) {
							unset($filter['filtergte'][$fields[$field['range_from']]['filter_table_field']]);
							$filter['filter'][$field['filter_table_field']] = $inputParams->$key;
						} else {
							
							if (isset($field['datatype']) && $field['datatype'] == 'date') {
								
								$dateFormated = self::formatDateToTimestamp($inputParams->$key);
								if ($dateFormated != false) {
									$filter['filterlte'][$field['filter_table_field']] = $dateFormated;
								}
							
							} elseif (isset($field['datatype']) && $field['datatype'] == 'date_ymd') {
								
								$dateFormated = self::formatDateToDateYmd($inputParams->$key);
								if ($dateFormated != false) {
									$filter['filterlte'][$field['filter_table_field']] = $dateFormated;
								}
							
							} elseif (isset($field['datatype']) && $field['datatype'] == 'date_en') {
								
								if (isset($field['filter_set_day_end']) && $field['filter_set_day_end'] == true) {
									$dateFormated = self::formatDateToTimestamp($inputParams->$key, 'dmY', true);
								} else {
									$dateFormated = self::formatDateToTimestamp($inputParams->$key, 'dmY');
								}
								
								if ($dateFormated != false) {
									$filter['filterlte'][$field['filter_table_field']] = $dateFormated;
								}
							
							} else {
								$filter['filterlte'][$field['filter_table_field']] = $inputParams->$key;
							}
						
						}
					
					} elseif ($field['filter_type'] == 'filter_join') {
						
						$filter['filter_join'][$field['join_table_name']] = $field['join_attributes'];
						$filter['filter_group'][] = $field['group_by_field'];
					
					} elseif ($field['filter_type'] == 'filter_left_join') {
						
						$filter['leftjoin'][$field['join_data']['table']] = $field['join_data']['fields'];
						
						if (isset($field['join_data']['filter_type']) && (isset($field['join_data']['filter_table_field']))) {
							$filter[$field['join_data']['filter_type']][$field['join_data']['filter_table_field']] = $inputParams->$key;
						}
						
						$filter['filter_group'][] = $field['join_data']['group'];
					
					} elseif ($field['filter_type'] == 'filter_map') {
						
						$mapObject = call_user_func($field['class'] . '::fetch', $inputParams->$key);
						$filter['filter'][$mapObject->field] = $mapObject->status;
					
					} elseif ($field['filter_type'] == 'like') {
						$filter['filterlike'][$field['filter_table_field']] = $inputParams->$key;
					} elseif ($field['filter_type'] == 'filterkeyword') {
						
						$inputFrom->$key = str_replace('+', ' ', urldecode($inputFrom->$key));
						
						if (isset($field['filter_transform_to_search']) && $field['filter_transform_to_search'] == true) {
							$filter['filterkeyword'][$field['filter_table_field']] = erLhcoreClassCharTransform::transformToSearch($inputParams->$key);
						} else {
							$filter['filterkeyword'][$field['filter_table_field']] = $inputParams->$key;
						}
					
					} elseif ($field['filter_type'] == 'filterin') {
						
						$filter['filterin'][$field['filter_table_field']] = $inputParams->$key;
					
					} elseif ($field['filter_type'] == 'filterbetween') {
						
						$parts = explode('_', $inputParams->$key);
						
						if (is_numeric($parts[0])) {
							$filter['filtergte'][$field['filter_table_field']] = (int) $parts[0];
						}
						
						if (is_numeric($parts[1])) {
							$filter['filterlte'][$field['filter_table_field']] = (int) $parts[1];
						}
					
					} elseif ($field['filter_type'] == 'filter_maappointment') {
						$filter['filter']['lh_fixture_appointment.steward_id'] = 0;
						$filter['filterin']['lh_fixture_appointment.position_id'] = array(
							1,
							2
						);
						$filter['innerjoin']['lh_fixture_appointment'] = array(
							'lh_fixture.id',
							'lh_fixture_appointment.fixture_id'
						);
						$filter['group'] = 'lh_fixture.id';
					} elseif ($field['filter_type'] == 'filter_steward_accreditation') {
						$filter['filter']['lh_accreditation.racecourse_id'] = $inputParams->$key;
						$filter['filter']['lh_users.type'] = erLhcoreClassModelUser::USER_TYPE_STEWARD;
						$filter['innerjoin']['lh_accreditation'] = array(
							'lh_users.id',
							'lh_accreditation.steward_id'
						);
						$filter['group'] = 'lh_users.id';
					}
				
				}
			}
			
			if (isset($currentOrder['as_append'])) {
				foreach ($currentOrder['as_append'] as $key => $appendSelect) {
					
					if (isset($currentOrder['replace_params'])) {
						
						$returnObj = call_user_func($currentOrder['param_call_func'], $inputParams->{$currentOrder['param_call_name_attr']});
						
						foreach ($currentOrder['replace_params'] as $attrObj => $targetString) {
							$appendSelect = str_replace($targetString, $returnObj->$attrObj, $appendSelect);
						}
					}
					
					$filter['as_append'] = $appendSelect . ' AS ' . $key;
				}
			}
			
			if (! isset($orderOptions['disabled'])) {
				$keySort = key_exists($inputParams->{$orderOptions['field']}, $orderOptions['options']) ? $inputParams->{$orderOptions['field']} : $orderOptions['default'];
				$currentOrder = $orderOptions['options'][$keySort];
				$filter['sort'] = $currentOrder['sort_column'];
				$inputFrom->sortby = $keySort;
				
				if (key_exists($inputParams->{$orderOptions['field']}, $orderOptions['options']) && $orderOptions['default'] != $inputParams->{$orderOptions['field']}) {
					$inputParams->sortby = $keySort;
				} else {
					// Standard sort mode does not need any append in URL
					if (isset($inputParams->sortby)) {
						unset($inputParams->sortby);
					}
				}
			}
		}
		
		return array(
			'errors' => $Errors,
			'input_form' => $inputFrom,
			'input' => $inputParams,
			'filter' => $filter
		);
	}

	public static function validateTraslationInput(& $filterData) {
		if (isset($filterData['input_form']->category) && $filterData['input_form']->category > 0) {
			$currentCategory = erLhAbstractModelLBCategory::fetch($filterData['input_form']->category);
			
			if ($currentCategory->type_work_id == erLhcoreClassModelLingbidWork::ORDER_TYPE_TRANSLATION) {
				
				$filterData['input']->language_content = null;
				$filterData['input_form']->language_content = null;
				
				if (isset($filterData['filter']['filter']['language_content_id'])) {
					unset($filterData['filter']['filter']['language_content_id']);
				}
			
			} elseif ($currentCategory->type_work_id == erLhcoreClassModelLingbidWork::ORDER_TYPE_COPYWRITING) {
				$filterData['input']->language_to = null;
				$filterData['input']->language_from = null;
				$filterData['input_form']->language_to = null;
				$filterData['input_form']->language_from = null;
				
				if (isset($filterData['filter']['filter']['language_from_id'])) {
					unset($filterData['filter']['filter']['language_from_id']);
				}
				
				if (isset($filterData['filter']['filter']['language_to_id'])) {
					unset($filterData['filter']['filter']['language_to_id']);
				}
			}
		}
		
		return $filterData;
	}

	public static function getURLAppendFromInputTransformAlias($inputParams, $params = array()) {
		
		$params['f'] .= '_alias';
		$URLappend = '';
		$URLappendAlias = '';
		$aliasOptions = erLhcoreClassURL::getAliasParams($params);
		
		foreach ($inputParams as $key => $value) {
			if (is_numeric($value) || $value != '') {
				$value = is_array($value) ? implode('/', $value) : urlencode($value);
				if ($aliasOptions !== false && key_exists($key, $aliasOptions)) {
					$options = $aliasOptions[$key];
					$alias = call_user_func($options['alias_fetch_function'], $value);
					if (isset($options['remove_key'])) {
						$URLappendAlias .= (isset($options['remove_key']) ? '' : "/({$key})") . ($alias !== false ? '/' . $alias : '/' . $value);
					}
				} else {
					$URLappend .= "/({$key})/" . $value;
				}
			}
		}
		
		return $URLappendAlias . $URLappend;
	}

	public static function transformToAliasArray($inputParams, $params) {
		$params['f'] .= '_alias';
		$aliasOptions = erLhcoreClassURL::getAliasParams($params);
		$paramsNew = clone $inputParams;
		
		foreach ($aliasOptions as $key => $aliasOptions) {
			if (isset($paramsNew->{$key}) && $paramsNew->{$key} !== '' && $paramsNew->{$key} !== 0 && $paramsNew->{$key} !== null) {
				$value = call_user_func($aliasOptions['alias_fetch_function'], $paramsNew->{$key});
				if ($value !== false) {
					$paramsNew->{$key} = $value;
				}
			}
		}
		
		return $paramsNew;
	
	}

	public static function getURLAppendFromInput($inputParams, $skipSort = false, $locationPrepend = false, $skipArray = array(), $ignoreKey = false) {
		$URLappend = '';
		$sortByAppend = '';
		$locationValue = '';
		
		foreach ($inputParams as $key => $value) {
			if (is_numeric($value) || $value != '') {
				$value = is_array($value) ? implode('/', $value) : urlencode($value);
				
				if ($key == 'location' && $locationPrepend == true) {
					$locationValue = '/' . $value;
				} elseif ($key == 'sortby' && ! in_array($key, $skipArray)) {
					$sortByAppend = "/({$key})/" . $value;
				} elseif (! in_array($key, $skipArray)) {
					if ((is_array($ignoreKey) && in_array($key, $ignoreKey)) || ($ignoreKey !== false && $ignoreKey == $key)) {
						$URLappend .= "/" . $value;
					} else {
						$URLappend .= "/({$key})/" . $value;
					}
				}
			}
		}
		
		if ($skipSort == false) {
			return $locationValue . $URLappend . $sortByAppend;
		} else {
			return $locationValue . $URLappend;
		}
	}

	public static function validateOfferAmount($offer) {
		$amount = str_replace(',', '.', $offer);
		
		if (is_numeric($amount) && $amount >= 1) {
			return $amount;
		}
		
		return false;
	}

	public static function validateOfferAmountZero($offer) {
		$amount = str_replace(',', '.', $offer);
		
		if (is_numeric($amount) && $amount >= 0) {
			return $amount;
		}
		
		return false;
	}

	public static function formatDateToTimestamp($date, $format = "d/m/Y", $setDayEnd = false) {
		
		$dateFormat = DateTime::createFromFormat($format, $date);
		
		if ($dateFormat != false) {
			$return = intval(self::formatTimeToYearMontDate($dateFormat->getTimestamp(), $setDayEnd));
		} else {
			$return = false;
		}
		
		return $return;
	
	}

	public static function formatTimeToYearMontDate($timestamp, $setDayEnd = false) {
		
		$year = date('Y', $timestamp);
		$month = date('m', $timestamp);
		$day = date('d', $timestamp);
		
		$hour = ($setDayEnd) ? 23 : 0;
		$minute = ($setDayEnd) ? 59 : 0;
		$second = ($setDayEnd) ? 59 : 0;
		
		return mktime($hour, $minute, $second, $month, $day, $year);
	
	}

	public static function formatDateToDateYmd($date, $format = "d/m/Y") {
		
		$dateFormat = DateTime::createFromFormat($format, $date);
		
		if ($dateFormat != false) {
			$return = intval(date("Ymd", $dateFormat->getTimestamp()));
		} else {
			$return = false;
		}
		
		return $return;
	}

	public static function isValidDateFormat($date, $format = "d/m/Y") {
		
		if (DateTime::createFromFormat($format, $date) != false) {
			$return = true;
		} else {
			$return = false;
		}
		
		return $return;
	}

	public static function detectPhone($value) {
		
		$value = preg_replace("/[^\+0-9]/", "", trim($value));
		
		if (preg_match("/^\+[1-9][0-9]{5,20}$/", $value)) { // it's already in e164 with the +
			return true;
		} elseif (preg_match("/^1[2-9][0-9]{9}$/", $value)) { // it's a North American number
			return true;
		} elseif (preg_match("/^[2-9][0-9]{9}$/", $value)) { // assume it's a North American number w/o country code
			return true;
		} elseif (preg_match("/^011[2-9][0-9]{5,20}$/", $value)) { // it's an international number with leading 011
			return true;
		} elseif (preg_match("/370[0-9]{8}$/", $value)) { // it's an international number with leading 011
			return true;
		} elseif (preg_match("/8[0-9]{8}$/", $value)) { // it's an international number with leading 011
			return true;
		} else
			return false;
		
		return false;
	}

	public static function isContactProvided($text) {
		
		$text = str_replace(array(
			"\n"
		), '', $text);
		
		if (preg_match('#([\s>])([.0-9a-z_+-]+)@(([0-9a-z-]+\.)+[0-9a-z]{2,})#i', $text)) {
			return true;
		}
		
		if (preg_match('/[a-z0-9_\-\+]+@[a-z0-9\-]+\.([a-z]{2,3})(?:\.[a-z]{2})?/i', $text)) {
			return true;
		}
		
		return false;
	}

	public static function isHasNotAallowedlidSymbol($text) {
		
		$text = str_replace(array(
			"\n"
		), '', $text);
		
		if (preg_match('/\@/', $text)) {
			return true;
		}
		
		return false;
	
	}

}
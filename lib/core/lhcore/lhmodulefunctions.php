<?php

class erLhcoreClassModuleFunctions {
	
    public static function getConditions($params, $q) {
    	
    	$conditions = array();
	
	   	if (isset($params['filter']) && count($params['filter']) > 0)
	   	{
	   		foreach ($params['filter'] as $field => $fieldValue)
	   		{
	   			$conditions[] = $q->expr->eq( $field, $q->bindValue($fieldValue ));
	   		}
	   	}
	
	   	if (isset($params['filterin']) && count($params['filterin']) > 0)
	   	{
	   		foreach ($params['filterin'] as $field => $fieldValue)
	   		{
	   			$conditions[] = $q->expr->in( $field, $fieldValue );
	   		}
	   	}
	
	   	if (isset($params['filterlt']) && count($params['filterlt']) > 0)
	   	{
	   		foreach ($params['filterlt'] as $field => $fieldValue)
	   		{
	   			$conditions[] = $q->expr->lt( $field, $q->bindValue($fieldValue ));
	   		}
	   	}
	
	   	if (isset($params['filtergt']) && count($params['filtergt']) > 0)
	   	{
	   		foreach ($params['filtergt'] as $field => $fieldValue)
	   		{
	   			$conditions[] = $q->expr->gt( $field, $q->bindValue($fieldValue ));
	   		}
	   	}
	   	
	   	if (isset($params['filtergte']) && count($params['filtergte']) > 0)
	   	{
	   		foreach ($params['filtergte'] as $field => $fieldValue)
	   		{
	   			$conditions[] = $q->expr->gte( $field, $fieldValue );
	   		}
	   	}
	   	
	   	if (isset($params['filterlte']) && count($params['filterlte']) > 0)
	   	{
	   		foreach ($params['filterlte'] as $field => $fieldValue)
	   		{
	   			$conditions[] = $q->expr->lte( $field, $fieldValue );
	   		}
	   	}
	   	
	   	if (isset($params['filternot']) && count($params['filternot']) > 0)
	   	{
	   		foreach ($params['filternot'] as $field => $fieldValue)
	   		{
	   			$conditions[] = $q->expr->neq( $field, $q->bindValue($fieldValue) );
	   		}
	   	}
	   	
	   	if (isset($params['filterall']) && count($params['filterall']) > 0)
	   	{
	   		foreach ($params['filterall'] as $field => $fieldValue)
	   		{
	   			$conditions[] = $q->expr->allin( $field, $fieldValue );
	   		}
	   	}
	   	 
	   	if (isset($params['filterlike']) && count($params['filterlike']) > 0)
	   	{
	   		foreach ($params['filterlike'] as $field => $fieldValue)
	   		{
	   			$conditions[] = $q->expr->like( $field, $q->bindValue('%'.$fieldValue.'%') );
	   		}
	   	}
	   	
	   	if (isset($params['leftjoin']) && count($params['leftjoin']) > 0)
	   	{
	   		foreach ($params['leftjoin'] as $table => $joinOn)
	   		{
	   			$q->leftJoin( $table, $q->expr->eq( $joinOn[0], $joinOn[1] ) );
	   		}
	   	}
	   	
	   	if (isset($params['innerjoinsame']) && count($params['innerjoinsame']) > 0)
	   	{
	   		foreach ($params['innerjoinsame'] as $table => $joinOn)
	   		{
	   			$q->innerJoin( $q->alias( $table, 't2' ), $q->expr->eq( $joinOn[0], $joinOn[1] ) );
	   		}
	   	}
	   	
	   	if (isset($params['filterlor']) && count($params['filterlor']) > 0)
	   	{
	   		
	   		$conditionsLor = array();
	   		
	   		foreach ($params['filterlor'] as $field => $fieldValue)
	   		{	   			
	   			foreach ($fieldValue as $fv) {
	   				$conditionsLor[] = $q->expr->eq( $field, $q->bindValue($fv));	
	   			}
	   		}
	   		
	   		$conditions[] = $q->expr->lOr($conditionsLor);
	   		
	   	}
	   	
	   	if (isset($params['filterlorf']) && count($params['filterlorf']) > 0)
	   	{
	   		
	   		$conditionsLor = array();
	   		
	   		foreach ($params['filterlorf'] as $field => $fieldValue)
	   		{	   			
	   			foreach ($fieldValue as $fv) {
	   				$conditionsLor[] = $q->expr->eq( $fv, $q->bindValue($field));	
	   			}
	   		}
	   		
	   		$conditions[] = $q->expr->lOr($conditionsLor);
	   		
	   	}
	   	
	   	if (isset($params['filternotin']) && count($params['filternotin']) > 0) {
	   		
	   		foreach ($params['filternotin'] as $field => $fieldValue)
	   		{
	   			if ( !empty($fieldValue) ) {
	   				$conditions[] =  $q->expr->not( $q->expr->in( $field, $fieldValue ) );
	   			}
	   		}
	   		
	   	}
	   	
	   	if (isset($params['filter_custom']) && count($params['filter_custom']) > 0)
	   	{
	   		foreach ($params['filter_custom'] as $fieldValue)
	   		{
	   			$conditions[] = $fieldValue;
	   		}
	   	}
	   		   	   	
	   	return $conditions;
    }
    
    public static function multi_implode($glue, $pieces, $key = null) {
    	
    	$string='';
    
    	if(is_array($pieces)) {
    		reset($pieces);
    		while(list($key,$value)=each($pieces))
    		{
    			$string.=$glue.self::multi_implode($glue, $value, $key);
    		}
    	} else {
    		return "{$key}_{$pieces}";
    	}
    
    	return trim($string, $glue);
    }
    
    public static function getSupportedImageTypes() {
    	return array('jpg','jpeg','png');
    }
    
    public static function getSupportedFileTypes() {
    	return array('zip','doc','docx','pdf','xls','xlsx','jpg','jpeg','png');
    }
    
    public static function isFile($fileName) {
    	 
    	$supportedExtensions = self::getSupportedFileTypes();
    
    	if (isset($_FILES[$fileName]) &&  is_uploaded_file($_FILES[$fileName]["tmp_name"]) && $_FILES[$fileName]["error"] == 0 ) {
    		$fileNameAray = explode('.',$_FILES[$fileName]['name']);
    		end($fileNameAray);
    		$extension = strtolower(current($fileNameAray));
    		return in_array($extension,$supportedExtensions);
    	}
    
    	return false;
    	
    }
    
 	public static function isImage($fileName) {
	    	
	   	$supportedExtensions = self::getSupportedImageTypes();
	    
	   	if (isset($_FILES[$fileName]) &&  is_uploaded_file($_FILES[$fileName]["tmp_name"]) && $_FILES[$fileName]["error"] == 0 ) {
	  		$fileNameAray = explode('.',$_FILES[$fileName]['name']);
	   		end($fileNameAray);
	   		$extension = strtolower(current($fileNameAray));
	   		return in_array($extension,$supportedExtensions);
	   	}
	    
	   	return false;

 	}
    
    public static function moveUploadedFile($fileName,$destination_dir) {
    	
    	if (isset($_FILES[$fileName]) &&  is_uploaded_file($_FILES[$fileName]["tmp_name"]) && $_FILES[$fileName]["error"] == 0 )
    	{
    		$fileNameAray = explode('.',$_FILES[$fileName]['name']);
    		end($fileNameAray);
    		$extension = current($fileNameAray);
    		 
    		$fileNamePhysic = self::generateImageSessionHash().time().'.'.strtolower($extension);
    
    		move_uploaded_file($_FILES[$fileName]["tmp_name"],$destination_dir . $fileNamePhysic);
    		chmod($destination_dir . $fileNamePhysic,erConfigClassLhConfig::getInstance()->getSetting( 'site', 'StorageFilePermissions' ));
    		 
    		return $fileNamePhysic;
    	}
    }
     
    public static function generateImageSessionHash($length = 15) {
    	
    	$allchar = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
    	 
    	$str = "" ;
    	 
    	mt_srand (( double) microtime() * 1000000 );
    	 
    	for ( $i = 0; $i<$length ; $i++ ) {
    		$str .= substr( $allchar, mt_rand (0,62), 1 );
    	}
    	 
    	return $str ;
    }
    
    public static function formatTimeToYearMontDate($timestamp,$dayEndTime = false) {
    	
    	$year = date('Y', $timestamp);
    	$month = date('m', $timestamp);
    	$day = date('d', $timestamp);
    	
    	if ($dayEndTime == true) {
    		return mktime(23, 59, 59, $month, $day, $year);
    	} else {
    		return mktime(0, 0, 0, $month, $day, $year);
    	}
    	
    }
    
    public static function validateFormDate($date, $format = 'Y-m-d', $setDayEndTime = false) {
    	
    	$dateFormat = DateTime::createFromFormat($format, $date);
    	
    	if ($dateFormat) {
    		return self::formatTimeToYearMontDate($dateFormat->getTimestamp(),$setDayEndTime);
    	}
    	
    	return false;
    	
    }
    
    public static function validateFormDateTime($date, $format = 'Y-m-d H:i:s') {
    	
    	$dateFormat = DateTime::createFromFormat($format, $date);
    	
    	if ($dateFormat) {
    		return $dateFormat->getTimestamp();
    	}
    	
    	return false;
    	
    }
    
    public static function generateHash($lenght = 50) {

    	$hash = '';
    			
		$allchar = "abcdefghijklmnopqrstuvwxyz1234567890";
    			
    	mt_srand (( double) microtime() * 1000000 );

		for ( $i = 0; $i<$lenght ; $i++ ) {
    		$hash .= substr( $allchar, mt_rand (0,35), 1 );
    	}
    	 
  		return $hash;
    }
    
    public static function formatAmount($amount) {
    	return number_format(($amount/100),2,'.', '');
    }
    
    public static function shrt($string = '',$max = 10,$append = '...',$wordrap = 30) {                        
        
    	$string = wordwrap($string,$wordrap,"\n",true);
          
        if (mb_strlen($string) <= $max) return htmlspecialchars($string);      
         
        $cutted = htmlspecialchars(mb_strcut($string,0,$max,'UTF-8').$append);
        
        return $cutted;
    }
     
    public static function percentage($val, $val_total, $precision = 0) {
    	 
    	return round( ($val / $val_total) * 100, $precision );
    
    }
    	
    public static function percentFromTotal($total, $percent, $precision = 2) {
    	
		return round((($total / 100) * $percent), $precision );
	
	}
	
	public static function amount2Digits($amount) {
		return (floor($amount*100))/100;
	}

	public static function zeroFill($num, $zerofill = 4) {
		return str_pad($num, $zerofill, '0', STR_PAD_LEFT);
	}
	
	public static function generateNumberObjects($start = 1, $end = 10, $fillZeroValue = false, $fillZeroName = false, $fillZeroLength = 2, $reverse = false ) {
	
		$data = array();
	
		$i = $start;
	
		while ($i <= $end) {
				
			$value = ($fillZeroValue) ? self::zeroFill($i,$fillZeroLength) : $i;
			$name = ($fillZeroName) ? self::zeroFill($i,$fillZeroLength) : $i;
				
			$object = new StdClass;
			$object->id = $value;
			$object->name = $name;
	
			$data[] = $object;
	
			$i++;
		}
	
		if($reverse) {
			$data = array_reverse($data);
		}
	
		return $data;
	
	}
	
	public static function daysCountBetween($startDate, $endDate, $dateFormat = "Y-m-d") {
	
		$date1 = new DateTime(date($dateFormat,$startDate));
		$date2 = new DateTime(date($dateFormat,$endDate));
		return $date1->diff($date2)->days;
	
	}
	
	/**
	 * convert date to date timestamp in UTC
	 * @param string $date
	 * @param string $format
	 */
	public static function getTimestamp($date, $format = "Y-m-d") {
	
	    $timestamp = DateTime::createFromFormat($format,$date);
	
	    $timestamp = $timestamp->format('U');
	    $datetime = new DateTime('now',new DateTimeZone('UTC'));
	    $datetime->setTimestamp($timestamp);
	
	    return $datetime->getTimestamp();
	}
	
	
	public static function moveLocalFile($fileName, $destination_dir, $extensionSeparator = '')
	{
	    $fileNameAray = explode('.',$fileName);
	    end($fileNameAray);
	    $extension = current($fileNameAray);
	     
	    $fileNamePhysic = md5($fileName.time().rand(0, 1000)).$extensionSeparator.strtolower($extension);
	     
	    rename($fileName, $destination_dir . $fileNamePhysic);
	    chmod($destination_dir . $fileNamePhysic, 0644);
	    return $fileNamePhysic;
	}
	
	public static function addhttp($url) {
	    if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
	        $url = "http://" . $url;
	    }
	    return $url;
	}
}

?>
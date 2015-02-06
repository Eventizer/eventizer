<?php
/**
 * 
 * @author Eventizer
 *
 */
class erLhcoreClassModelUser {
    use erLhcoreClassTrait;
    
    public static $dbTable = 'lh_users';
    public static $dbTableId = 'id';
    public static $dbSessionHandler = 'erLhcoreClassUser::getSession';
    public static $dbSortOrder = 'DESC';
	public function getState() {
		
		return array(
			'id'              		=> $this->id,
            'password'        		=> $this->password,
            'email'           		=> $this->email,
            'name'            		=> $this->name,
            'surname'         		=> $this->surname,
            'disabled'        		=> $this->disabled,
            'lastactivity'    		=> $this->lastactivity,
			'time_zone'     	 	=> $this->time_zone,
			'activate_hash'     	=> $this->activate_hash,
			'file'     	            => $this->file,
			'file_name'     	    => $this->file_name,
            'system'    			=> $this->system,
            'created'    			=> $this->created,
            'org_name'    		    => $this->org_name,
            'org_description'    	=> $this->org_description,
            'org_www'    	        => $this->org_www,
            'org_fb'    	        => $this->org_fb,
            'org_tw'    	        => $this->org_tw,
    	);
	}
	
	public function __toString() {
		return $this->name.' '.$this->surname;
	}

   	public function saveThis() {   		
   		$this->created = time();
   		erLhcoreClassUser::getSession()->save($this);
	}
   	 
   	 
   	public function removeThis() {
   		
   		// Remove user group
   		$q = ezcDbInstance::get()->createDeleteQuery();
   		$q->deleteFrom( 'lh_groupuser' )->where( $q->expr->eq( 'user_id', $this->id ) );
   		$stmt = $q->prepare();
   		$stmt->execute();
   		
   		// Remove user remember
   		$q = ezcDbInstance::get()->createDeleteQuery();
   		$q->deleteFrom( 'lh_users_remember' )->where( $q->expr->eq( 'user_id', $this->id ) );
   		$stmt = $q->prepare();
   		$stmt->execute();
   		
   		erLhcoreClassUser::getSession()->delete($this);
   		
   	}
   	
   	
   	public static function fetchUserByEmail($email) {
   	
   		$db = ezcDbInstance::get();
   		$stmt = $db->prepare('SELECT id FROM lh_users WHERE email = :email');
   		$stmt->bindValue( ':email',$email);
   		$stmt->execute();
   		$rows = $stmt->fetchAll();
   		 
   		if (isset($rows[0]['id'])) {
   			return $rows[0]['id'];
   		} else {
   			return false;
   		}
   	
   	}
   	
   	public function generateActivateHash() {   	
   		$this->activate_hash = erLhcoreClassModelForgotPassword::randomPassword(50);   	
   	}
   	
   	public function saveUser() {
   		 
   		$this->generateActivateHash();
   		$this->disabled = 1;
   		$this->saveThis();
   		 
   		$groupUser = new erLhcoreClassModelGroupUser();
   		$groupUser->group_id = erConfigClassLhConfig::getInstance()->getSetting( 'user_settings', 'default_user_group' );
   		$groupUser->user_id = $this->id;
   		erLhcoreClassUser::getSession()->save($groupUser);
   		 
   		$cacheManager = erConfigClassLhCacheConfig::getInstance();
   		$cacheManager->expireCache();
   		 
   		erLhcoreClassMail::sendRegistrationConfirm($this);
   		 
   	}
   	
   	public function setUserActive() {
   	
   		$this->disabled = 0;
   		$this->activate_hash = '';
   		$this->updateThis();
   	
   		erLhcoreClassMail::sendRegistrationComplete($this);
   	
   	}
   	
   	public function setPassword($password) {
   		$cfgSite = erConfigClassLhConfig::getInstance();
   		$secretHash = $cfgSite->getSetting( 'site', 'secrethash' );
   		$this->password = sha1($password.$secretHash.sha1($password));
   	}
   	
	public static function getUserCount($params = array(), $operation = "COUNT(lh_users.id)") {
   		 
   		$session = erLhcoreClassUser::getSession('slave');
   	
   		$q = $session->database->createSelectQuery();
   		 
   		$q->select( $operation )->from( "lh_users" );
   	
   		$conditions = erLhcoreClassModuleFunctions::getConditions($params, $q);
   	
   		if ( !empty($conditions) ) {
   			$q->where( $conditions );
   		}
   	
   		$stmt = $q->prepare();
   		$stmt->execute();
   		$result = $stmt->fetchColumn();
   	
   		return $result;
   	}
   
	public static function getUserList($paramsSearch = array()) {
   
   		$paramsDefault = array('limit' => 32, 'offset' => 0);
   	 
   		$params = array_merge($paramsDefault,$paramsSearch);
   	 
   		$session = erLhcoreClassUser::getSession();
   		
   		$q = $session->createFindQuery( 'erLhcoreClassModelUser' );
   	 
		$conditions = erLhcoreClassModuleFunctions::getConditions($params, $q);
   	
   		if ( !empty($conditions) ) {
   			$q->where( $conditions );
   		}
   
		if ($params['limit'] !== false) {
			$q->limit($params['limit'],$params['offset']);
		}
   
   		$q->orderBy(isset($params['sort']) ? $params['sort'] : 'id DESC' );
      
   		$objects = $session->find( $q );
   	 
   		return $objects;
	}
   
	public function __get($param) {
   	
    	switch ($param) {    	   			
    		
       		case 'tw_name':
       		    
       		    preg_match("|https?://(www\.)?twitter\.com/(#!/)?@?([^/]*)|", $this->org_tw, $matches);
       		    $this->tw_name = $matches[3];
       		    
       		   	return $this->tw_name;
       			break;
    		
       		case 'has_photo':
       		    $this->has_photo = false;
       		    
       		   	if ($this->file_name != '') {
       		   	    $this->has_photo = true;
       		   	}

       		   	return $this->has_photo;
       			break;
    		
       		case 'user_groups_id':
				$userGroups = erLhcoreClassModelGroupUser::getList(array('filter' => array('user_id' => $this->id)));
       		   	$this->user_groups_id = array();
       		   
       		   	if (!empty($userGroups)) {
       		   		foreach ($userGroups as $userGroup) {
       		   	 		$this->user_groups_id[] = $userGroup->group_id;
       		   		}
       		   	}

       		   	return $this->user_groups_id;
       			break;

       		case 'user_groups':
       		
       			$this->user_groups = array();
       			
       			foreach ($this->user_groups_id as $group) {
       				try {
       					$this->user_groups[] = erLhcoreClassModelGroup::fetch($group);
       				} catch (Exception $e) {
       					// Not found
       				}
       			}
       			
       			return $this->user_groups;
       			break;
       			
       		case 'lastactivity_front':
       			$this->lastactivity_front = '';
       		   
       		   	if ( $this->lastactivity > 0 ) {
       		    	$this->lastactivity_front = date('Y-m-d H:i:s');
       		   	};
       		   
       		   	return $this->lastactivity_front;
       			break;
       		
       		case 'lastactivity_ago':
       			$this->lastactivity_ago = '';
       		   
       		   	if ( $this->lastactivity > 0 ) {
                	$periods         = array("s.", "m.", "h.", "d.", "w.", "m.", "y.", "dec.");
                    $lengths         = array("60","60","24","7","4.35","12","10");
                                                                                                 
                    $difference     = time() - $this->lastactivity;
                                         
                    for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
                        $difference /= $lengths[$j];
                    }
                 
                    $difference = round($difference);
                    
                   $this->lastactivity_ago = "$difference $periods[$j]";       		       
       		   	};
       		   
       		   	return $this->lastactivity_ago;
       			break; 
       			
       			case 'variations_photo':
       			    $this->variations_photo = array();
       			     
       			    if ($this->variations != ''){
       			        $this->variations_photo = unserialize($this->variations);
       			    }
       			
       			    return $this->variations_photo;
       			    break;

       			case 'photow_150':
       			     
   			        if ($this->file_name) {
   			
   			            $instance = erLhcoreClassSystem::instance();
   			
   			            $variations = $this->variations_photo;
   			            $this->photow_150 = false;
   			
   			            if (isset($variations['photow_150'])) {
   			                $this->photow_150 = '/'.$this->file . '/photow_150_'.$this->file_name;
   			            } else {
   			                try {

   			                    $Storage = $this->file.'/'.$this->file_name;
               					erLhcoreClassImageConverter::getInstance()->converter->transform( 'photow_150', $Storage, $this->file.'/' . 'photow_150_'.$this->file_name );

               					$this->addVariantion('photow_150');
               					$this->photow_150 = '/'.$this->file . '/photow_150_'.$this->file_name;
               					 
   			                } catch (Exception $e) {
   			               		$this->photow_150 =  false;
   			                }
   			            }
   			        } else {
   			            $this->photow_150 =  false;
   			        }
   			     
   			    return $this->photow_150;
   			    break;
       			
       		default:
       			break;
       			
    	}
	}
	
	public function addVariantion( $variationItem )
	{
	    $variation = $this->variations_photo;
	    $variation[$variationItem] = true;
	    $this->variations = serialize($variation);
	    $this->updateThis();
	}
	  
	public static function userExists($email) {
    	$db = ezcDbInstance::get();
       	$stmt = $db->prepare('SELECT count(*) as foundusers FROM lh_users WHERE email = :email');
       	$stmt->bindValue( ':email',$email);       
       	$stmt->execute();
       	$rows = $stmt->fetchAll();
       
       	return $rows[0]['foundusers'] > 0;        
	}
	
	public static function userEmailExists($email, $skipUser = false) {
	
		$db = ezcDbInstance::get();
			
		if ($skipUser) {
			$stmt = $db->prepare('SELECT count(*) as foundusers FROM lh_users WHERE id != :userid AND email = :email');
			$stmt->bindValue( ':email',strtolower($email));
			$stmt->bindValue( ':userid',$skipUser);
		} else {
			$stmt = $db->prepare('SELECT count(*) as foundusers FROM lh_users WHERE email = :email');
			$stmt->bindValue( ':email',strtolower($email));
		}
			
		$stmt->execute();
		$rows = $stmt->fetchAll();
	
		return $rows[0]['foundusers'] > 0;
		
	}
	
	public static function userExist($id) {
	
		if ($id > 0) {
			try {
				return self::fetch($id);
			} catch (Exception $e) {
				return false;
			}
		}
	
		return false;
	
	}
	
	public static function validateInputRegistration(& $objectData) {
	
		if (!isset($_POST['csfr_token']) || !erLhcoreClassUser::instance()->validateCSFRToken($_POST['csfr_token'])) {
			erLhcoreClassModule::redirect('kernel/csrf-missing');
		}
		
	    $definition = array(
			'Name' => new ezcInputFormDefinitionElement(
				ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw'
			),
			'Surname' => new ezcInputFormDefinitionElement(
				ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw'
			),	
			'Email' => new ezcInputFormDefinitionElement(
				ezcInputFormDefinitionElement::OPTIONAL, 'validate_email'
			),	
			'Password' => new ezcInputFormDefinitionElement(
				ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw'
			),
			'Password1' => new ezcInputFormDefinitionElement(
				ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw'
			)			
		);
	    	    
	    $form = new ezcInputForm( INPUT_POST, $definition );
	    	
	    $Errors = array();
	    
	    if ( !$form->hasValidData( 'Name' ) || $form->Name == '' ) {
	    	$Errors[] = __t('user/form','Please enter name');
	    } else {
	    	$objectData->name = $form->Name;
	    }
	    
	    if ( !$form->hasValidData( 'Surname' ) || $form->Surname == '' ) {
	    	$Errors[] = __t('user/form','Please enter surname');
	    } else {
	    	$objectData->surname = $form->Surname;
	    }
	    
	    if ( !$form->hasValidData( 'Email' ) ) {
	    	$Errors[] = __t('user/form','Please enter a valid email address');
	    } else {
	    	$objectData->email = $form->Email;
	    	
    		if ( $form->hasValidData( 'Email' ) && self::userEmailExists($form->Email) === true ) {
    			$Errors[] = __t('user/form','Email address already registered');
    		} else {
    			$objectData->email = $form->Email;
    		}	    
	    }
	    		
    	if ( !$form->hasValidData( 'Password' ) || !$form->hasValidData( 'Password1' ) || $form->Password == '' || $form->Password1 == '' || $form->Password != $form->Password1 ) {
    		$Errors[] = __t('user/form','Passwords do not match');
    	} else {
    		$objectData->setPassword($form->Password);
    	}
	    
	    return $Errors;
		
	}
		
	public static function validateUserLogin (& $objectData) {
	
	    $definition = array(
	        'Password' => new ezcInputFormDefinitionElement(
	            ezcInputFormDefinitionElement::REQUIRED, 'string'
	        ),
	        'Username' => new ezcInputFormDefinitionElement(
	            ezcInputFormDefinitionElement::REQUIRED, 'unsafe_raw'
	        )
	    );
	    	
	    $form = new ezcInputForm( INPUT_POST, $definition );
	    
	    $Errors = array();
	
	    if ( !$form->hasValidData( 'Username' ) || $form->Username == '' ) {
	        $Errors['Username'] =  __t('user/form','Enter username');
	    } else {
	        $objectData->email = $form->Username;
	    }
	
	    if ( !$form->hasValidData( 'Password' ) || $form->Password == '' ) {
	        $Errors['Password'] =  __t('user/form','Enter password');
	    } else {
	        $objectData->password = $form->Password;
	    }
	
	    return $Errors;
	}
		
	
	
	public static function validateInputAdmin(& $objectData) {
			
		if (!isset($_POST['csfr_token']) || !erLhcoreClassUser::instance()->validateCSFRToken($_POST['csfr_token'])) {
			erLhcoreClassModule::redirect('kernel/csrf-missing');
		}
		
		$definition = array(
			'UserDisabled' => new ezcInputFormDefinitionElement(
				ezcInputFormDefinitionElement::OPTIONAL, 'boolean'
			),
			'DefaultGroup' => new ezcInputFormDefinitionElement(
				ezcInputFormDefinitionElement::OPTIONAL, 'int', null, FILTER_REQUIRE_ARRAY
			)
		);
		
		$form = new ezcInputForm( INPUT_POST, $definition );
			
		$Errors = array();
		
		if ( $form->hasValidData( 'UserDisabled' ) && $form->UserDisabled == true ) {
			$objectData->disabled = 1;
		} else {
			$objectData->disabled = 0;
		}
		
		if ( $form->hasValidData( 'DefaultGroup' ) ) {
			$objectData->user_groups_id = $form->DefaultGroup;
		} else {
			$Errors[] = __t('user/form','Please choose a default user group');
		}
			
		return $Errors;
		
	}
	
	public function changePhotoUrl($url_photo, $remove = true){
	    	
	    try {
	
	        $pathinfoData = pathinfo($url_photo);
	
	        $imgContent = file_get_contents($url_photo);
	       
	        $dir = 'var/userphoto/' . date('Y') . 'y/' . date('m') . '/' . date('d') .'/' . $this->id . '/';
	        $photo_dir = 'var/userphoto/' . date('Y') . 'y/' . date('m') . '/' . date('d') .'/' . $this->id ;
	        erLhcoreClassImageConverter::mkdirRecursive( $dir, true );
	
	        if($pathinfoData['extension']){
	            $ext = $pathinfoData['extension'];
	        }else{
	            $ext="jpg";
	        }
	
	        $newFileName = erLhcoreClassModelForgotPassword::randomPassword(20).'.'.$ext;
	
	        file_put_contents($dir.$newFileName, $imgContent);
	        		        	
	        if($remove == true)
	            $this->removeFile();
	
	        $this->file_name = $newFileName;
	        $this->file = $photo_dir;
	        	
	        $this->updateThis();
	
	    } catch (Exception $e) {
	        // Error
	    }
	    	
	}
	
	public function removeFile()
	{
	    if ($this->file_name != '') {
	        if ( file_exists($this->file . '/' . $this->file_name) ) {
	            unlink($this->file . '/' . $this->file_name);
	        }
	        
	        if ( file_exists($this->file . '/photow_150_' . $this->file_name) ) {
	            unlink($this->file . '/photow_150_' . $this->file_name);
	        }
	        erLhcoreClassImageConverter::removeRecursiveIfEmpty('var/userphoto/',str_replace('var/userphoto/', '', $this->file));
	
	        $this->file = '';
	        $this->file_name = '';
	        $this->updateThis();
	    }
	}
	
	public static function checkActivateHash($hash){
			
		if (trim($hash) != '') {
	
			$userData = self::getUserList(array('filter' => array('activate_hash' => $hash, 'disabled' => 1),'limit' => 1));
	
			if (count($userData)) {
				return current($userData);
			}
		}
			
		return false;
	}
	
	public static function exportCSV($params=array()) {
			
		$filter = array('filter' => array('system' => 0));
	
		if(isset($params['only_agree_receive_email']) && $params['only_agree_receive_email'] = true) {
			$filter['filter']['rceive_game_emails'] = 1;
		}
	
		header('Content-Type: text/csv; charset=utf-8');
		header("Content-Type: application/download; charset=utf-8");
		header( 'Content-Disposition: attachment;filename=users_CSV.csv');
		header("Content-Transfer-Encoding: binary");
	
		$fp = fopen('php://output', 'w');
			
		$userCount = self::getUserCount($filter);
	
		for ($i=0; $i<$userCount; $i+=10) {
	
			$users = self::getUserList(array_merge($filter,array('limit'=>10, 'offset'=>$i)));
	
			foreach($users as $user) {
				$row = array();
				$row[] = $user->email;
				$row[] = $user->name;
				$row[] = $user->surname;
				fputcsv($fp, $row);
			}
		}
	
		fclose($fp);
		exit;
	}
	
    public $id = null;
    public $password = '';
    public $email = '';
    public $name = '';
    public $surname = '';    
    public $disabled = 0;
    public $lastactivity = 0;
    public $activate_hash = '';
    public $time_zone = '';
    public $system = 0;
    public $created = 0;
    public $org_name = '';
    public $org_description = '';
    public $org_www = '';
    public $org_fb = '';
    public $org_tw = '';
    public $file = '';
    public $file_name = '';
    
}

?>
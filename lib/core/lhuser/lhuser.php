<?php

class erLhcoreClassUser {

	static function instance() {
		
		if (empty($GLOBALS['LhUserInstance'])) {
			$GLOBALS['LhUserInstance'] = new erLhcoreClassUser();
		}
		
		return $GLOBALS['LhUserInstance'];
	
	}

	function __construct() {
		
		$siteAccess = $this->getSiteAccessPartName();
		
		$options = new ezcAuthenticationSessionOptions();
		$options->validity = self::LOGIN_SESSION_TIME;
		$options->idKey = $siteAccess;
		
		// $options->idKey = 'lhc_ezcAuth_id';
		// $options->timestampKey = 'lhc_ezcAuth_timestamp';
		
		$this->session = new ezcAuthenticationSession($options);
		$this->session->start();
		
		$this->credentials = new ezcAuthenticationPasswordCredentials($this->session->load(), null);
		
		if (! $this->session->isValid($this->credentials)) {
			
			$logged = false;
			
			if (isset($_COOKIE['lhc_rm_u'])) {
				$logged = $this->validateRemember($_COOKIE['lhc_rm_u']);
			}
			
			if ($logged == false) {
				
				$this->authenticated = false;
				
				if (isset($_SESSION[$siteAccess . 'lhc_user_id'])) {
					unset($_SESSION[$siteAccess . 'lhc_user_id']);
					unset($_SESSION[$siteAccess . 'lhc_access_array']);
					unset($_SESSION[$siteAccess . 'lhc_access_timestamp']);
				}
			}
		
		} else {
			if (erLhcoreClassModelUser::userExist($_SESSION[$siteAccess . 'lhc_user_id'])) {
				$this->session->save($this->session->load());
				$this->userid = $_SESSION[$siteAccess . 'lhc_user_id'];
				$this->authenticated = true;
			} else {
				$this->logout();
			}
		}
	}

	function authenticate($username, $password, $remember = false) {
		
		$siteAccess = $this->getSiteAccessPartName();
		
		$this->session->destroy();
		
		$cfgSite = erConfigClassLhConfig::getInstance();
		$secretHash = $cfgSite->getSetting('site', 'secrethash');
		
		$this->credentials = new ezcAuthenticationPasswordCredentials($username, sha1($password . $secretHash . sha1($password)));
		
		$database = new ezcAuthenticationDatabaseInfo(ezcDbInstance::get(), 'lh_users', array(
			'email',
			'password'
		));
		$this->authentication = new ezcAuthentication($this->credentials);
		
		$this->filter = new ezcAuthenticationDatabaseFilter($database);
		$this->filter->registerFetchData(array(
			'id',
			'email',
			'disabled'
		));
		
		$this->authentication->addFilter($this->filter);
		$this->authentication->session = $this->session;
		
		if (! $this->authentication->run()) {
			return false;
			// build an error message based on $status
		} else {
			$data = $this->filter->fetchData();
			
			// Anonymous user does not have access to login
			$data = $this->filter->fetchData();
			if (erConfigClassLhConfig::getInstance()->getSetting('user_settings', 'anonymous_user_id') != $data['id'][0]) {
				
				if ($data['disabled'][0] == 0) {
					
					if (isset($_SESSION[$siteAccess . 'lhc_access_array'])) {
						unset($_SESSION[$siteAccess . 'lhc_access_array']);
					}
					
					if (isset($_SESSION[$siteAccess . 'lhc_access_timestamp'])) {
						unset($_SESSION[$siteAccess . 'lhc_access_timestamp']);
					}
					
					$_SESSION[$siteAccess . 'lhc_user_id'] = $data['id'][0];
					$this->userid = $data['id'][0];
					
					if ($remember === true) {
						$this->rememberMe();
					}
					
					$this->authenticated = true;
					$this->updateLastVisit();
					
					return true;
				} else {
					$this->session->destroy();
					throw new Exception(__t('user/login', 'You can not login. Your account is disabled'));
				}
			
			}
			
			return false;
		}
	}

	function getStatus() {
		return $this->authentication->getStatus();
	}

	function isLogged() {
		return $this->authenticated;
	}

	function setLoggedUser($user_id) {
		
		if ($user_id != $this->userid) {
			
			$siteAccess = $this->getSiteAccessPartName();
			
			$this->session->destroy();
			
			$this->credentials = new ezcAuthenticationIdCredentials($user_id);
			$this->authentication = new ezcAuthentication($this->credentials);
			
			$database = new ezcAuthenticationDatabaseInfo(ezcDbInstance::get(), 'lh_users', array(
				'id',
				'password'
			));
			$this->filter = new ezcAuthenticationDatabaseCredentialFilter($database);
			$this->filter->registerFetchData(array(
				'id',
				'email',
				'disabled'
			));
			$this->authentication->addFilter($this->filter);
			
			$this->authentication->session = $this->session;
			
			if (! $this->authentication->run()) {
				return false;
			} else {
				$data = $this->filter->fetchData();
				
				if (erConfigClassLhConfig::getInstance()->getSetting('user_settings', 'anonymous_user_id') != $data['id'][0]) {
					
					if ($data['disabled'][0] == 0) {
						
						$this->AccessArray = false;
						
						if (isset($_SESSION[$siteAccess . 'lhc_access_array'])) {
							unset($_SESSION[$siteAccess . 'lhc_access_array']);
						}
						
						if (isset($_SESSION[$siteAccess . 'lhc_access_timestamp'])) {
							unset($_SESSION[$siteAccess . 'lhc_access_timestamp']);
						}
						
						$_SESSION[$siteAccess . 'lhc_user_id'] = $data['id'][0];
						$this->userid = $data['id'][0];
						
						$this->authenticated = true;
						return true;
					} else {
						$this->session->destroy();
						throw new Exception(__t('user/login', 'You can not login. Your account is disabled'));
					}
				
				}
				
				return false;
			
			}
		}
	}

	function setLoggedUserInstantlyFromAdmin($user_id, $setSiteAccess = false) {
		
		if ($user_id != $this->userid) {
			
			$siteAccess = $this->getSiteAccessPartName($setSiteAccess);
			
			$cfgSite = erConfigClassLhConfig::getInstance();
			$secretHash = $cfgSite->getSetting('site', 'secrethash');
			
			$options = new ezcAuthenticationSessionOptions();
			$options->validity = self::LOGIN_SESSION_TIME;
			$options->idKey = $siteAccess;
			
			$this->session = new ezcAuthenticationSession($options);
			$this->session->destroy();
			$this->session->start();
			
			$this->credentials = new ezcAuthenticationIdCredentials($user_id);
			$this->authentication = new ezcAuthentication($this->credentials);
			
			$database = new ezcAuthenticationDatabaseInfo(ezcDbInstance::get(), 'lh_users', array(
				'id',
				'password'
			));
			$this->filter = new ezcAuthenticationDatabaseCredentialFilter($database);
			$this->filter->registerFetchData(array(
				'id',
				'email',
				'disabled'
			));
			$this->authentication->addFilter($this->filter);
			
			$this->authentication->session = $this->session;
			
			if (! $this->authentication->run()) {
				return false;
			} else {
				
				$data = $this->filter->fetchData();
				
				if (erConfigClassLhConfig::getInstance()->getSetting('user_settings', 'anonymous_user_id') != $data['id'][0]) {
					
					if ($data['disabled'][0] == 0) {
						
						$this->AccessArray = false;
						
						if (isset($_SESSION[$siteAccess . 'lhc_access_array'])) {
							unset($_SESSION[$siteAccess . 'lhc_access_array']);
						}
						
						if (isset($_SESSION[$siteAccess . 'lhc_access_timestamp'])) {
							unset($_SESSION[$siteAccess . 'lhc_access_timestamp']);
						}
						
						$_SESSION[$siteAccess . 'lhc_user_id'] = $data['id'][0];
						$this->userid = $data['id'][0];
						
						$this->authenticated = true;
						$this->updateLastVisit();
						
						return true;
					}
				
				}
				
				return false;
			
			}
		
		}
	
	}

	function logout() {
		
		$siteAccess = $this->getSiteAccessPartName();
		
		if (isset($_SESSION[$siteAccess . 'lhc_access_array'])) {
			unset($_SESSION[$siteAccess . 'lhc_access_array']);
		}
		if (isset($_SESSION[$siteAccess . 'lhc_access_timestamp'])) {
			unset($_SESSION[$siteAccess . 'lhc_access_timestamp']);
		}
		if (isset($_SESSION[$siteAccess . 'lhc_user_id'])) {
			unset($_SESSION[$siteAccess . 'lhc_user_id']);
		}
		
		if (isset($_COOKIE['lhc_rm_u'])) {
			unset($_COOKIE['lhc_rm_u']);
			setcookie('lhc_rm_u', '', time() - 31 * 24 * 3600, '/');
		}
		;
		
		$q = ezcDbInstance::get()->createDeleteQuery();
		
		// User remember
		$q->deleteFrom('lh_users_remember')->where($q->expr->eq('user_id', $q->bindValue($this->userid)));
		$stmt = $q->prepare();
		$stmt->execute();
		
		$this->session->destroy();
	
	}

	public static function getSession() {
		
		if (! isset(self::$persistentSession)) {
			
			self::$persistentSession = new ezcPersistentSession(ezcDbInstance::get(), new ezcPersistentCodeManager('./pos/lhuser'));
		
		}
		
		return self::$persistentSession;
	
	}

	function getUserData($useCache = false) {
		
		if ($useCache == true && isset($GLOBALS['UserModelCache_' . $this->userid]))
			return $GLOBALS['UserModelCache_' . $this->userid];
		
		$GLOBALS['UserModelCache_' . $this->userid] = erLhcoreClassUser::getSession()->load('erLhcoreClassModelUser', $this->userid);
		
		return $GLOBALS['UserModelCache_' . $this->userid];
	
	}

	function getUserID() {
		return $this->userid;
	}

	function updateLastVisit() {
		$db = ezcDbInstance::get();
		$db->query('UPDATE lh_users SET lastactivity = ' . time() . ' WHERE id = ' . $this->userid);
	}

	function getUserList() {
		
		$db = ezcDbInstance::get();
		$stmt = $db->prepare('SELECT * FROM lh_users ORDER BY id ASC');
		$stmt->execute();
		$rows = $stmt->fetchAll();
		
		return $rows;
	}

	function hasAccessTo($module, $functions) {
		
		$AccessArray = $this->accessArray();
		
		// Global rights
		if (isset($AccessArray['*']['*']) || isset($AccessArray[$module]['*'])) {
			return true;
		}
		
		// Provided rights have to be set
		if (is_array($functions)) {
			foreach ($functions as $function) {
				// Missing one of provided right
				if (isset($AccessArray[$module][$function]))
					return true;
			}
			return false;
		} else {
			if (! isset($AccessArray[$module][$functions]))
				return false;
		}
		
		return true;
	
	}

	function accessArray() {
		
		$siteAccess = $this->getSiteAccessPartName();
		
		if ($this->AccessArray !== false)
			return $this->AccessArray;
		
		if (isset($_SESSION[$siteAccess . 'lhc_access_array'])) {
			
			$this->AccessArray = $_SESSION[$siteAccess . 'lhc_access_array'];
			$this->AccessTimestamp = $_SESSION[$siteAccess . 'lhc_access_timestamp'];
			
			return $this->AccessArray;
			
			/* For future
            * $cacheObj = CSCacheAPC::getMem();
           if (($AccessTimestamp = $cacheObj->restore('cachetimestamp_accessfile_version_'.$cacheObj->getCacheVersion('site_version'))) === false)
           {
               $cfg = erConfigClassLhCacheConfig::getInstance();
               $AccessTimestamp = $cfg->getSetting( 'cachetimestamps', 'accessfile' );
               $cacheObj->store('cachetimestamp_accessfile_version_'.$cacheObj->getCacheVersion('site_version'),$AccessTimestamp);
           }

           if ( $this->AccessTimestamp === $AccessTimestamp)
           {
               return $this->AccessArray;
           }*/
		}
		
		$cfg = erConfigClassLhCacheConfig::getInstance();
		
		$_SESSION[$siteAccess . 'lhc_access_timestamp'] = $this->AccessTimestamp = $cfg->getSetting('cachetimestamps', 'accessfile');
		$_SESSION[$siteAccess . 'lhc_access_array'] = $this->AccessArray = $this->generateAccessArray();
		
		if ($this->AccessTimestamp < time()) {
			$AccessTimestamp = time() + 60 * 60 * 24 * 1;
			$cfg->setSetting('cachetimestamps', 'accessfile', $AccessTimestamp);
			$cfg->save();
			
			$_SESSION[$siteAccess . 'lhc_access_timestamp'] = $this->AccessTimestamp = $AccessTimestamp;
		}
		
		return $this->AccessArray;
	}

	function generateAccessArray() {
		
		if ($this->userid !== null) {
			$UserIDGenerate = $this->userid;
		} else {
			$UserIDGenerate = erConfigClassLhConfig::getInstance()->getSetting('user_settings', 'anonymous_user_id');
		}
		
		$accessArray = erLhcoreClassRole::accessArrayByUserID($UserIDGenerate);
		
		return $accessArray;
	
	}

	function rememberMe() {
		
		$siteAccess = $this->getSiteAccessPartName();
		
		$cfgSite = erConfigClassLhConfig::getInstance();
		$salt2 = erConfigClassLhConfig::getInstance()->getSetting('site', 'secrethash');
		$salt1 = erLhcoreClassModelForgotPassword::randomPassword(30);
		$rusr = new erLhcoreClassModelUserRemember();
		$rusr->user_id = $this->userid;
		$rusr->mtime = time();
		$rusr->saveThis();
		$hash = $salt1 . ':' . $rusr->id . ':' . sha1($this->userid . '_' . $rusr->id . $salt2 . $salt1 . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT'] . $siteAccess);
		setcookie('lhc_rm_u', $hash, time() + 365 * 24 * 3600, '/');
	
	}

	function validateRemember($hashCookie) {
		
		$siteAccess = $this->getSiteAccessPartName();
		
		$parts = explode(':', $hashCookie);
		
		if (count($parts) == 3) {
			list ($salt1, $id, $hash) = $parts;
			$cfgSite = erConfigClassLhConfig::getInstance();
			$salt2 = $cfgSite->getSetting('site', 'secrethash');
			
			try {
				$ruser = erLhcoreClassModelUserRemember::fetch($id);
				if ($hash == sha1($ruser->user_id . '_' . $ruser->id . $salt2 . $salt1 . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT'] . $siteAccess)) {
					$ruser->mtime = time();
					$ruser->updateThis();
					$this->setLoggedUser($ruser->user_id);
					// Update remember hash
					$salt1 = erLhcoreClassModelForgotPassword::randomPassword(30);
					$hash = $salt1 . ':' . $ruser->id . ':' . sha1($this->userid . '_' . $ruser->id . $salt2 . $salt1 . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT'] . $siteAccess);
					setcookie('lhc_rm_u', $hash, time() + 365 * 24 * 3600, '/');
					return true;
				}
			} catch (Exception $e) {
				return false;
			}
		} else {
			if (isset($_COOKIE['lhc_rm_u'])) {
				unset($_COOKIE['lhc_rm_u']);
				setcookie('lhc_rm_u', '', time() - 31 * 24 * 3600, '/');
			}
			;
		}
		
		return false;
	
	}

	function getSiteAccessPartName($setSiteAccess = false) {
		
		if ($setSiteAccess) {
			$siteAccess = $setSiteAccess;
		} else {
			$siteAccess = erLhcoreClassSystem::instance()->SiteAccess;
		}
		
		if ($siteAccess == self::SITEACCESS_BACKEND) {
			$siteAccess = self::SITEACCESS_BACKEND_NAME;
		} else {
			$siteAccess = self::SITEACCESS_FRONTEND_NAME;
		}
		
		return $siteAccess . '_';
	
	}

	public function getUserTimeZone() {
		
		if (($cacheTimeZone = CSCacheAPC::getMem()->getSession('lhc_user_timezone', true)) !== false) {
			return $cacheTimeZone;
		}
		
		try {
			$userData = $this->getUserData(true);
			CSCacheAPC::getMem()->setSession('lhc_user_timezone', $userData->time_zone, true);
			return $userData->time_zone;
		} catch (Exception $e) {
			CSCacheAPC::getMem()->setSession('lhc_user_timezone', '', true);
		}
	
	}

	function getCSFRToken() {
		
		if (! isset($_SESSION['csfr_token'])) {
			$_SESSION['csfr_token'] = md5(rand(0, 99999999) . time() . $this->userid);
		}
		
		return $_SESSION['csfr_token'];
	
	}

	public function validateCSFRToken($token) {
		return $this->getCSFRToken() == $token;
	}

	private static $persistentSession;

	private $userid;

	private $AccessArray = false;

	private $AccessTimestamp = false;

	private $cacheCreated = false;
	
	// Authentification things
	public $authentication;

	public $session;

	public $credentials;

	public $authenticated;

	public $status;

	public $filter;

	const SITEACCESS_BACKEND = 'site_admin';

	const SITEACCESS_BACKEND_NAME = 'backend';

	const SITEACCESS_FRONTEND_NAME = 'frontend';

	const LOGIN_SESSION_TIME = 1800;

}

?>
<?php

class CSCacheAPC {

	private static $m_objMem = NULL;

	public $cacheEngine = null;

	public $cacheGlobalKey = null;

	public $cacheKeys = array(
		'site_version' // Global site version
		);

	public function increaseImageManipulationCache() {
		$this->increaseCacheVersion('site_version');
	}

	function setSession($identifier, $value, $useGlobalCache = false) {
		$_SESSION[$identifier] = $value;
		
		if ($useGlobalCache == true) {
			$GLOBALS[$identifier] = $value;
		}
	}

	function getSession($identifier, $useGlobalCache = false) {
		
		if (isset($_SESSION[$identifier])) {
			return $_SESSION[$identifier];
		}
		
		if ($useGlobalCache == true) {
			if (isset($GLOBALS[$identifier])) {
				return $GLOBALS[$identifier];
			}
		}
		
		return false;
	}

	function __construct() {
		
		$cacheEngineClassName = erConfigClassLhConfig::getInstance()->getSetting('cacheEngine', 'className');
		$this->cacheGlobalKey = erConfigClassLhConfig::getInstance()->getSetting('cacheEngine', 'cache_global_key');
		
		if ($cacheEngineClassName !== false) {
			$this->cacheEngine = new $cacheEngineClassName();
		}
	}

	function __destruct() {

	}

	static function getMem() {
		if (self::$m_objMem == NULL) {
			self::$m_objMem = new CSCacheAPC();
		}
		return self::$m_objMem;
	}

	function delete($key) {
		if (isset($GLOBALS[$key]))
			unset($GLOBALS[$key]);
		
		if ($this->cacheEngine != null) {
			$this->cacheEngine->set($this->cacheGlobalKey . $key, false, 0);
		}
	}

	function restore($key) {
		
		if (isset($GLOBALS[$key]) && $GLOBALS[$key] !== false)
			return $GLOBALS[$key];
		
		if ($this->cacheEngine != null) {
			$GLOBALS[$key] = $this->cacheEngine->get($this->cacheGlobalKey . $key);
		} else {
			$GLOBALS[$key] = false;
		}
		
		return $GLOBALS[$key];
	}

	function getCacheVersion($cacheVariable, $valuedefault = 1, $ttl = 0) {
		
		if (isset($GLOBALS['CacheKeyVersion_' . $cacheVariable]))
			return $GLOBALS['CacheKeyVersion_' . $cacheVariable];
		
		if ($this->cacheEngine != null) {
			if (($version = $this->cacheEngine->get($this->cacheGlobalKey . $cacheVariable)) == false) {
				$version = $valuedefault;
				$this->cacheEngine->set($this->cacheGlobalKey . $cacheVariable, $version, 0, $ttl);
				$GLOBALS['CacheKeyVersion_' . $cacheVariable] = $valuedefault;
			} else
				$GLOBALS['CacheKeyVersion_' . $cacheVariable] = $version;
		
		} else {
			$version = $valuedefault;
			$GLOBALS['CacheKeyVersion_' . $cacheVariable] = $valuedefault;
		}
		
		return $version;
	}

	function increaseCacheVersion($cacheVariable, $valuedefault = 1, $ttl = 0) {
		if ($this->cacheEngine != null) {
			if (($version = $this->cacheEngine->get($this->cacheGlobalKey . $cacheVariable)) == false) {
				$this->cacheEngine->set($this->cacheGlobalKey . $cacheVariable, $valuedefault, 0, $ttl);
				$GLOBALS['CacheKeyVersion_' . $cacheVariable] = $valuedefault;
			} else {
				$this->cacheEngine->increment($this->cacheGlobalKey . $cacheVariable, $version + 1);
				$GLOBALS['CacheKeyVersion_' . $cacheVariable] = $version + 1;
			}
		
		} else {
			$GLOBALS['CacheKeyVersion_' . $cacheVariable] = $valuedefault;
		}
	}

	function store($key, $value, $ttl = 720000) {
		if ($this->cacheEngine != null) {
			$GLOBALS[$key] = $value;
			$this->cacheEngine->set($this->cacheGlobalKey . $key, $value, 0, $ttl);
		} else {
			$GLOBALS[$key] = $value;
		}
	}

}

class erLhcoreClassSystem {

	protected $Params;

	public function __construct() {
		$this->Params = array(
			'PHP_OS' => PHP_OS,
			'DIRECTORY_SEPARATOR' => DIRECTORY_SEPARATOR,
			'PATH_SEPARATOR' => PATH_SEPARATOR,
			'_SERVER' => $_SERVER
		);
		
		if (isset($this->Params['_SERVER']['REQUEST_TIME'])) {
			// REQUEST_TIME is a float and includes microseconds in PHP > 5.4.0
			// It should be casted to int in order to keep BC
			$this->Params['_SERVER']['REQUEST_TIME'] = (int) $this->Params['_SERVER']['REQUEST_TIME'];
		}
		
		$this->Attributes = array(
			'magickQuotes' => true,
			'hostname' => true
		);
		$this->FileSeparator = $this->Params['DIRECTORY_SEPARATOR'];
		$this->EnvSeparator = $this->Params['PATH_SEPARATOR'];
		
		// Determine OS specific settings
		if ($this->Params['PHP_OS'] === 'WINNT') {
			$this->OSType = "win32";
			$this->OS = "windows";
			$this->FileSystemType = "win32";
			$this->LineSeparator = "\r\n";
			$this->ShellEscapeCharacter = '"';
			$this->BackupFilename = '.bak';
		} else {
			$this->OSType = 'unix';
			if ($this->Params['PHP_OS'] === 'Linux') {
				$this->OS = 'linux';
			} else 
				if ($this->Params['PHP_OS'] === 'FreeBSD') {
					$this->OS = 'freebsd';
				} else 
					if ($this->Params['PHP_OS'] === 'Darwin') {
						$this->OS = 'darwin';
					} else {
						$this->OS = false;
					}
			$this->FileSystemType = "unix";
			$this->LineSeparator = "\n";
			$this->ShellEscapeCharacter = "'";
			$this->BackupFilename = '~';
		}
	}

	public static function instance() {
		if (is_null(self::$instance)) {
			self::$instance = new erLhcoreClassSystem();
		}
		return self::$instance;
	}

	/**
	 * Generate wwwdir from phpSelf if valid accoring to scriptFileName
	 * and return null if invalid and false if there is no index in phpSelf
	 *
	 * @param string $phpSelf        	
	 * @param string $scriptFileName        	
	 * @param string $index        	
	 * @return string null false form 'path/path2' if valid, null if not
	 *         and false if $index is not part of phpself
	 */
	protected static function getValidwwwDir($phpSelf, $scriptFileName, $index) {
		if (! isset($phpSelf[1]) || strpos($phpSelf, $index) === false)
			return false;
			
			// validate $index straight away
		if (strpos($scriptFileName, $index) === false)
			return null;
			
			// optimize '/index.php' pattern
		if ($phpSelf === "/{$index}")
			return '';
		
		$phpSelfParts = explode($index, $phpSelf);
		$validateDir = $phpSelfParts[0];
		// remove first path if home dir
		if ($phpSelf[1] === '~') {
			$uri = explode('/', ltrim($validateDir, '/'));
			array_shift($uri);
			$validateDir = '/' . implode('/', $uri);
		}
		
		// validate direclty with phpself part
		if (strpos($scriptFileName, $validateDir) !== false)
			return trim($phpSelfParts[0], '/');
			
			// validate with windows path
		if (strpos($scriptFileName, str_replace('/', '\\', $validateDir)) !== false)
			return trim($phpSelfParts[0], '/');
		
		return null;
	}

	static function init() {
		$index = 'index.php';
		$forceVirtualHost = null;
		
		$instance = erLhcoreClassSystem::instance();
		
		$instance = self::instance();
		$server = $instance->Params['_SERVER'];
		$phpSelf = $server['PHP_SELF'];
		$requestUri = $server['REQUEST_URI'];
		$scriptFileName = $server['SCRIPT_FILENAME'];
		$siteDir = rtrim(str_replace($index, '', $scriptFileName), '\/') . '/';
		$wwwDir = '';
		$IndexFile = '';
		$queryString = '';
		
		// see if we can use phpSelf to determin wwwdir
		$tempwwwDir = self::getValidwwwDir($phpSelf, $scriptFileName, $index);
		
		if ($tempwwwDir !== null && $tempwwwDir !== false) {
			
			// Force virual host or Auto detect IIS vh mode & Apache .htaccess mode
			if ($forceVirtualHost || (isset($server['IIS_WasUrlRewritten']) && $server['IIS_WasUrlRewritten']) || (isset($server['REDIRECT_URL']) && isset($server['REDIRECT_STATUS']) && $server['REDIRECT_STATUS'] == '200')) {
				if ($tempwwwDir) {
					$wwwDir = '/' . $tempwwwDir;
					$wwwDirPos = strpos($requestUri, $wwwDir);
					if ($wwwDirPos !== false) {
						$requestUri = substr($requestUri, $wwwDirPos + strlen($wwwDir));
					}
				}
			} else 			// Non virtual host mode, use $tempwwwDir to figgure out paths
			{
				$indexDir = $index;
				if ($tempwwwDir) {
					$wwwDir = '/' . $tempwwwDir;
					$indexDir = $wwwDir . '/' . $indexDir;
				}
				
				$IndexFile = '/' . $index;
				
				// remove sub path from requestUri
				$indexDirPos = strpos($requestUri, $indexDir);
				if ($indexDirPos !== false) {
					$requestUri = substr($requestUri, $indexDirPos + strlen($indexDir));
				} elseif ($wwwDir) {
					$wwwDirPos = strpos($requestUri, $wwwDir);
					if ($wwwDirPos !== false) {
						$requestUri = substr($requestUri, $wwwDirPos + strlen($wwwDir));
					}
				}
			}
		}
		
		// remove url and hash parameters
		if (isset($requestUri[1]) && $requestUri !== '/') {
			
			$uriGetPos = strpos($requestUri, '?');
			
			if ($uriGetPos !== false) {
				$queryString = substr($requestUri, $uriGetPos);
				if ($uriGetPos === 0)
					$requestUri = '';
				else
					$requestUri = substr($requestUri, 0, $uriGetPos);
			}
			
			$uriHashPos = strpos($requestUri, '#');
			if ($uriHashPos === 0)
				$requestUri = '';
			elseif ($uriHashPos !== false)
				$requestUri = substr($requestUri, 0, $uriHashPos);
		}
		
		$index = '/' . $index;
		
		// Get the right $_SERVER['REQUEST_URI'], when using nVH setup.
		if (preg_match("!^$wwwDir$index(.*)!", $phpSelf, $req)) {
			
			if (! $req[1]) {
				if ($phpSelf != "$wwwDir$index" and preg_match("!^$wwwDir(.*)!", $requestUri, $req)) {
					$requestUri = $req[1];
					$index = '';
				} elseif ($phpSelf == "$wwwDir$index" and (preg_match("!^$wwwDir$index(.*)!", $requestUri, $req) or preg_match("!^$wwwDir(.*)!", $requestUri, $req))) {
					$requestUri = $req[1];
				}
			} else {
				$requestUri = $req[1];
			}
		}
		
		// normalize slash use and url decode url if needed
		if ($requestUri === '/' || $requestUri === '') {
			$requestUri = '';
		} else {
			$requestUri = '/' . urldecode(trim($requestUri, '/ '));
		}
		
		if (($pos = strpos($requestUri, 'index.php')) !== false) {
			$requestUri = substr($requestUri, $pos + 9);
		}
		
		$instance->SiteDir = $siteDir;
		$instance->WWWDir = $wwwDir;
		$instance->IndexFile  = erConfigClassLhConfig::getInstance()->getSetting( 'site', 'force_virtual_host', false) === false ? '/index.php' : '';
		$instance->RequestURI = str_replace('//', '/', $requestUri);
		$instance->QueryString = $queryString;
		$instance->WWWDirLang = '';
	
	}

	public static function setSiteAccess($siteaccess) {
		
		$cfgSite = erConfigClassLhConfig::getInstance();
		
		$availableSiteaccess = $cfgSite->getOverrideValue('site', 'available_site_access');
		$defaultSiteAccess = $cfgSite->getOverrideValue('site', 'default_site_access');
		
		if ($defaultSiteAccess != $siteaccess && in_array($siteaccess, $availableSiteaccess)) {
			$optionsSiteAccess = $cfgSite->getOverrideValue('site_access_options', $siteaccess);
			erLhcoreClassSystem::instance()->Language = $optionsSiteAccess['locale'];
			erLhcoreClassSystem::instance()->ThemeSite = $optionsSiteAccess['theme'];
			erLhcoreClassSystem::instance()->ContentLanguage = $optionsSiteAccess['content_language'];
			erLhcoreClassSystem::instance()->WWWDirLang = '/' . $siteaccess;
			erLhcoreClassSystem::instance()->SiteAccess = $siteaccess;
		} else {
			$optionsSiteAccess = $cfgSite->getOverrideValue('site_access_options', $defaultSiteAccess);
			erLhcoreClassSystem::instance()->SiteAccess = $defaultSiteAccess;
			erLhcoreClassSystem::instance()->Language = $optionsSiteAccess['locale'];
			erLhcoreClassSystem::instance()->ThemeSite = $optionsSiteAccess['theme'];
			erLhcoreClassSystem::instance()->WWWDirLang = '';
			erLhcoreClassSystem::instance()->ContentLanguage = $optionsSiteAccess['content_language'];
		}
		
		erTranslationClassLhTranslation::getInstance()->initLanguage();
	}

	public static function setSiteAccessByLocale($locale) {
		
		$cfgSite = erConfigClassLhConfig::getInstance();
		
		$site_languages = $cfgSite->getOverrideValue('site', 'site_languages');
		
		foreach ($site_languages as $siteaccess => $site_language) {
			if ($site_language['locale'] == $locale) {
				self::setSiteAccess($siteaccess);
				break;
			}
		}
	
	}

	function wwwDir() {
		return $this->WWWDir;
	}

	public $baseHTTP;
	
	// / The path to where all the code resides
	public $SiteDir;
	// / The access path of the current site view
	// / The relative directory path of the vhless setup
	public $WWWDir;
	
	// The www dir used in links formating
	public $WWWDirLang;
	
	// / The filepath for the index
	public $IndexFile;
	// / The uri which is used for parsing module/view information from, may differ from $_SERVER['REQUEST_URI']
	public $RequestURI;
	// / The type of filesystem, is either win32 or unix. This often used to determine os specific paths.
	
	// / Current language
	public $Language;
	
	// Content language
	public $ContentLanguage;
	
	// / Theme site
	public $ThemeSite;

	public $SiteAccess;

	public $MobileDevice = false;

	private static $instance = null;

}

?>
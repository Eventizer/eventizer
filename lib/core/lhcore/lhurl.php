<?php

class erLhcoreClassURL extends ezcUrl {
    
    private static $instance = null;
    
    public function __construct($urlString, $urlCfgDefault)
    {
        parent::__construct($urlString, $urlCfgDefault);
    }
    
    public static function getInstance()  
    {
        if ( is_null( self::$instance ) )
        {  
            $sysConfiguration = erLhcoreClassSystem::instance();
            
            $urlCfgDefault = ezcUrlConfiguration::getInstance();
            $urlCfgDefault->basedir = $sysConfiguration->WWWDir;
            $urlCfgDefault->script  = $sysConfiguration->IndexFile;
            $urlCfgDefault->unorderedDelimiters = array( '(', ')' );            
            $urlCfgDefault->addOrderedParameter( 'siteaccess' ); 
            $urlCfgDefault->addOrderedParameter( 'module' ); 
            $urlCfgDefault->addOrderedParameter( 'function' );
                       
            $urlInstance = new erLhcoreClassURL($sysConfiguration->RequestURI, $urlCfgDefault);
                
            $siteaccess = $urlInstance->getParam( 'siteaccess' );
            $cfgSite = erConfigClassLhConfig::getInstance(); 
                                                          
            $availableSiteaccess = $cfgSite->getSetting( 'site', 'available_site_access' );
            $defaultSiteAccess = $cfgSite->getSetting( 'site', 'default_site_access' );
            
            $securePort = $cfgSite->getSetting( 'site', 'https_port' );
            $sysConfiguration->baseHTTP = isset($_SERVER["HTTPS"]) ? (($_SERVER["HTTPS"]==="on" || $_SERVER["HTTPS"]===1 || $_SERVER["SERVER_PORT"]===$securePort) ? "https://" : "http://") :  (($_SERVER["SERVER_PORT"]===$securePort) ? "https://" : "http://");
                                  
            if ($defaultSiteAccess != $siteaccess && in_array($siteaccess,$availableSiteaccess))
            {     
                $optionsSiteAccess = $cfgSite->getSetting('site_access_options',$siteaccess);                      
                $sysConfiguration->Language = $optionsSiteAccess['locale'];                         
                $sysConfiguration->ThemeSite = $optionsSiteAccess['theme'];
                $sysConfiguration->ContentLanguage = $optionsSiteAccess['content_language'];
                                         
                $sysConfiguration->WWWDirLang = '/'.$siteaccess; 
                $sysConfiguration->SiteAccess = $siteaccess; 
                
                if ($optionsSiteAccess['locale'] != 'en_EN')
                {
                	$params = erLhcoreClassDesign::translateToOriginal($urlInstance->getParam( 'module' ), $urlInstance->getParam( 'function' ));
                    $urlInstance->setParam('module',$urlInstance->getParam( 'module' ));
                    $urlInstance->setParam('function',$urlInstance->getParam( 'function' ));
                }
                
                $moduleExist = $urlInstance->getParam( 'module' ) != '' && erLhcoreClassModule::getModule($urlInstance->getParam( 'module' )) === false;
                 
                if ( $moduleExist ) {
                	// First try alias translation
                	$resultItem = self::getTranslatedURL($urlInstance->getParam( 'module' ));
                	if ( $resultItem !== false && $resultItem['type'] == self::TRANSLATION_URLALIAS ) {
                		$pathURL = explode('/',trim(erLhcoreClassSystem::instance()->RequestURI,'/'));
                		$arrayReplaces = array( 1 => $resultItem['id'] );
                		self::translatePath($pathURL,$arrayReplaces);
                		erLhcoreClassSystem::instance()->RequestURI = '/'.implode('/',$pathURL);
                		$urlInstance = new erLhcoreClassURL(erLhcoreClassSystem::instance()->RequestURI, $urlCfgDefault);
                		$moduleExist = false;
                	} elseif ($resultItem !== false && $resultItem['type'] == self::TRANSLATION_ARTICLE) {
                		$pathURL = explode('/',trim(erLhcoreClassSystem::instance()->RequestURI,'/'));
                		$arrayReplaces = array( 0 => 'article/view/'.$resultItem['id'] );
                		self::translatePath($pathURL,$arrayReplaces);
                		erLhcoreClassSystem::instance()->RequestURI = '/'.implode('/',$pathURL);
                		$urlInstance = new erLhcoreClassURL(erLhcoreClassSystem::instance()->RequestURI, $urlCfgDefault);
                	}
                }
                
            } else {
                
                $optionsSiteAccess = $cfgSite->getSetting('site_access_options',$defaultSiteAccess);
                
                // Falling back
                $sysConfiguration->SiteAccess = $defaultSiteAccess; 
                $sysConfiguration->Language = $optionsSiteAccess['locale'];                
                $sysConfiguration->ThemeSite = $optionsSiteAccess['theme'];    
                $sysConfiguration->ContentLanguage = $optionsSiteAccess['content_language'];
                
                // To reset possition counter
                $urlCfgDefault->removeOrderedParameter('siteaccess');
                $urlCfgDefault->removeOrderedParameter('module');
                $urlCfgDefault->removeOrderedParameter('function');
                         
                // Reinit parameters
                $urlCfgDefault->addOrderedParameter( 'module' ); 
                $urlCfgDefault->addOrderedParameter( 'function' );
                
                //Apply default configuration             
                $urlInstance->applyConfiguration($urlCfgDefault);
                
                if ($optionsSiteAccess['locale'] != 'en_EN')
                {
                	$params = erLhcoreClassDesign::translateToOriginal($urlInstance->getParam( 'module' ), $urlInstance->getParam( 'function' ));
                    $urlInstance->setParam('module',$urlInstance->getParam( 'module' ));
                    $urlInstance->setParam('function',$urlInstance->getParam( 'function' ));
                }     

                $moduleExist = $urlInstance->getParam( 'module' ) != '' && erLhcoreClassModule::getModule($urlInstance->getParam( 'module' )) === false;
                 
                if ( $moduleExist ) {
                	// First try alias translation
                	$resultItem = self::getTranslatedURL($urlInstance->getParam( 'module' ));
                	if ( $resultItem !== false && $resultItem['type'] == self::TRANSLATION_URLALIAS ) {
                		$pathURL = explode('/',trim(erLhcoreClassSystem::instance()->RequestURI,'/'));
                		$arrayReplaces = array( 0 => $resultItem['id'] );
                		self::translatePath($pathURL,$arrayReplaces);
                		erLhcoreClassSystem::instance()->RequestURI = '/'.implode('/',$pathURL);
                		$urlInstance = new erLhcoreClassURL(erLhcoreClassSystem::instance()->RequestURI, $urlCfgDefault);
                		$moduleExist = false;
                	} elseif ($resultItem !== false && $resultItem['type'] == self::TRANSLATION_ARTICLE) {
                		$pathURL = explode('/',trim(erLhcoreClassSystem::instance()->RequestURI,'/'));
                		$arrayReplaces = array( 0 => 'article/view/'.$resultItem['id'] );
                		self::translatePath($pathURL,$arrayReplaces);
                		erLhcoreClassSystem::instance()->RequestURI = '/'.implode('/',$pathURL);
                		$urlInstance = new erLhcoreClassURL(erLhcoreClassSystem::instance()->RequestURI, $urlCfgDefault);
                	}
                }
                
            }
            
            self::$instance =  $urlInstance;        
        }
        return self::$instance;
    }
    
    public static function getTranslatedURL($url, $suburl = '') {
    	
    	$cache = CSCacheAPC::getMem();
    
    	$cacheKey = md5('site_version_'.$cache->getCacheVersion('site_version').'_alias_'.$url.'_'.$suburl);
    
    	if (($returnAlias = $cache->restore($cacheKey)) === false)
    	{
    		$url = erLhcoreClassCharTransform::TransformToURL($url);
    		$returnAlias = false;
    
    		/* if ( $returnAlias === false ) {
    		 $list = erLhcoreClassModelArticle::getList(array('filter' => array('alias_url' => '/'.$url)));
    		if ( !empty($list) ) {
    		$subregion = current($list);
    		$returnAlias = array( 'type' => self::TRANSLATION_ARTICLE , 'id' => $subregion->id );
    		}
    		} */
    
    		if ( $returnAlias === false ) {
    			$list = erLhAbstractModelUrlAlias::getList(array('filter' => array('url_destination_'.strtolower(erLhcoreClassSystem::instance()->Language) => $url)));
    				
    			if ( !empty($list) ) {
    				$subregion = current($list);
    				$GLOBALS['CacheUrlAlias_'.$subregion->id] = $subregion;
    				$returnAlias = array( 'type' => self::TRANSLATION_URLALIAS , 'id' => $subregion->url_alias );
    			}
    		}
    
    		if ( $returnAlias !== false ) {
    			$cache->store($cacheKey,$returnAlias);
    		}
    	}
    
    	return $returnAlias;
    }
        
    const TRANSLATION_ARTICLE = 0;
    const TRANSLATION_URLALIAS = 1;
    
    public static function translatePath(& $partsArray, $arrayReplaces)
    {
    	foreach ($partsArray as $key => & $value)
    	{
    		if ( key_exists($key,$arrayReplaces) ) {
    			$value = $arrayReplaces[$key];
    		}
    	}
    }
    
}
?>
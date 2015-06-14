<?php 

/**
 * 
 * @author Evenziter
 *
 */

class erLhcoreClassExtensionSocialComments {
    
    public function run()
    {
        $dispatcher = erLhcoreClassEventDispatcher::getInstance();
		
		// Attatch event listeners
		$dispatcher->listen('event.event_view_additional_content_block',array($this,'additionalCommentBlock'));	
		$dispatcher->listen('system.developer_view_extenshions_block',array($this,'developerViewExtenshionsBlock'));	
		
    }
    
    public function additionalCommentBlock($params) {
    	
		$tpl = erLhcoreClassTemplate::getInstance( 'lhcomments/comments.tpl.php');
		
		try {
		  $data= erLhcoreClassModelSystemConfig::fetch('event_comments_code');
		  $tpl->set('code', str_replace('{{siteurl}}',  $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"], $data->value));
		} catch (Exception $e) {
		
		    $tpl->set('code', false);
		}
		
		echo $tpl->fetch();
    }
    
    public function developerViewExtenshionsBlock($params) {
        $settings = include 'extension/socialcomments/settings/settings.ini.php';
		return  array_merge(array('array_merge'=>1, 'settings_url' => __url('comments/settings')), $settings);
    }   
   
}
?>
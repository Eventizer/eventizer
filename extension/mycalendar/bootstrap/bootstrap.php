<?php 

/**
 * 
 * @author Evenziter
 *
 */

class erLhcoreClassExtensionMyCalendar {
    
    public function run()
    {
        $dispatcher = erLhcoreClassEventDispatcher::getInstance();
		
		// Attatch event listeners
		$dispatcher->listen('event.event_view_sidebar_links',array($this,'addEventViewSidebarLink'));		
		$dispatcher->listen('system.developer_view_extenshions_block',array($this,'developerViewExtenshionsBlock'));	
    }
    
    public function addEventViewSidebarLink($params) {
    	
		$tpl = erLhcoreClassTemplate::getInstance( 'lhmycalendar/link.tpl.php');
		$event = $params['event'];
		
		$gurl = 'https://www.google.com/calendar/render?action=TEMPLATE&text='.urlencode($event->title).'&dates='.urlencode($event->start_date_gcalendar).'/'.urlencode($event->end_date_gcalendar).'&details='.urlencode(__t('gcalendar/link','For details, link here: ')).urlencode($event->full_url).'&location='.urlencode($event->event_location).'&pli=1&sf=true&output=xml#f';
		$tpl->set('gurl', $gurl);
		
		$yurl = 'https://calendar.yahoo.com/?v=60&view=d&type=20&title='.urlencode($event->title).'&st='.urlencode($event->start_date_gcalendar).'&dur='.urlencode($event->event_duration).'&desc='.urlencode(__t('gcalendar/link','For details, link here: ')).urlencode($event->full_url).'&in_loc='.urlencode($event->event_location);
		$tpl->set('yurl', $yurl);
		
		echo $tpl->fetch();
    }
    
    public function developerViewExtenshionsBlock($params) {
        $settings = include 'extension/mycalendar/settings/settings.ini.php';
		return  array_merge(array('array_merge'=>1, ), $settings);
    }   
   
}
?>
<?php

/**
 * 
 * @author Eventizer
 *
 */
class erLhcoreClassModelSavedEvents
{
    use erLhcoreClassTrait;

    public static $dbTable = 'lh_saved_events';

    public static $dbTableId = 'id';

    public static $dbSessionHandler = 'erLhcoreClassEvents::getSession';

    public static $dbSortOrder = 'DESC';

    public function getState()
    {
        $stateArray = array(
            'id'                => $this->id,
            'event_id'          => $this->event_id,
            'user_id'           => $this->user_id,
            'email_sent'        => $this->email_sent,
            'time'              => $this->time,
        )
        ;
        
        return $stateArray;
    }

    public function __toString()
    {
        return $this->title;
    }

    public function saveThis()
    {
        if (! $this->time)
            $this->time = time();
        
        erLhcoreClassEvents::getSession()->saveOrUpdate($this);
    }

    public function __get($var)
    {
        switch ($var) {
            case 'user':
            
                $this->user = erLhcoreClassModelUser::fetch($this->user_id);
            
                return $this->user;
                break;
                
            case 'event':
            
                $this->event = erLhcoreClassModelEvents::fetch($this->event_id);
            
                return $this->event;
                break;
                
            default:
                break;
        }
    }
    
    /**
     * Send mails 3 days before event start
     */
    public static function sendSavedEventNotification() {
        $list = self::getList(array('limit'=>100,'filter' => array('email_sent' => 0)));
        
        foreach ($list as $item) {
          
            if ($item->event->start_date >= time()-3*24*60*60) {
                echo "\n";
                erLhcoreClassEventMail::sendSavedEventNotification($item);
                $item->email_sent  = 1;
                $item->updateThis();
                echo 'Sent to user ID:',$item->user_id, "\n";
            }
        }
    }

    public $id = null;

    public $event_id = '';
    
    public $user_id = '';
    
    public $email_sent = '';

    public $time = '';

}

?>
<?php
/**
 * 
 * @author Eventizer
 *
 */
class erLhcoreClassModelEvents {
    use erLhcoreClassTrait;
    
    public static $dbTable = 'lh_events';
    public static $dbTableId = 'id';
    public static $dbSessionHandler = 'erLhcoreClassEvents::getSession';
    public static $dbSortOrder = 'DESC';

    public function getState()
    {
        $stateArray = array(
            'id' => $this->id,
            'file' => $this->file,
            'title' => $this->title,
            'file_path' => $this->file_path,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'address' => $this->address,
            'postcode' => $this->postcode,
            'country' => $this->country,
            'description' => $this->description,
            'organizer_name' => $this->organizer_name,
            'organizer_description' => $this->organizer_description,
            'fb_link' => $this->fb_link,
            'tw_link' => $this->tw_link,
            'link' => $this->link,
            'mtime' => $this->mtime
        );
        
        return $stateArray;
    }

   
    public function __toString()
    {
        return $this->title;
    }


    public function saveThis()
    {
        if (! $this->mtime)
            $this->mtime = time();
        erLhcoreClassEvents::getSession()->saveOrUpdate($this);
        $this->clearCache();
    }

    public function removeThis()
    {
            $this->removePhoto();
            erLhcoreClassEvents::getSession()->delete($this);
            $this->clearCache();
    }

    public function clearCache()
    {
        CSCacheAPC::getMem()->increaseCacheVersion('event_cache_version');
    }

    public function __get($var)
    {
        switch ($var) {
            
            case 'url':
                if (erConfigClassLhConfig::getInstance()->getSetting( 'site', 'nice_url_enabled' ) == false) {
                    $this->url = __url('event/view').'/'.$this->id;
                } else {
                    $this->url = __url(urlencode(erLhcoreClassCharTransform::TransformToURL($this->title) . '-' . $this->id . 'e.html'), false);
                }
                return $this->url;
                break;
                
            case 'end_date_front':
                if ($this->start_date != '') {
                    $this->end_date_front = date('d/m/Y',$this->end_date);
                } else {
                    $this->end_date_front = '';
                }
                return $this->end_date_front;
                break;
                
            case 'start_date_front':
                if ($this->start_date != '') {
                    $this->start_date_front = date('d/m/Y',$this->start_date);
                } else {
                    $this->start_date_front = '';
                }
                return $this->start_date_front;
                break;
            
           
            default:
                break;
        }
    }

    public function removePhoto()
    {
        if ( $this->file != '') {
            
            $dirBase = 'var/media/';
            $dirImg = $dirBase . $this->id . '/images/';
            
            if (file_exists($dirImg . $this->file)) {
                unlink($dirImg . $this->file);
            }
                    
            erLhcoreClassImageConverter::removeRecursiveIfEmpty($dirBase, str_replace($dirBase, '', $dirImg));
            
            $this->file = '';
        }
    }

   
    public $id = null;

    public $title = '';

    public $file = '';

    public $file_path = '';

    public $start_date = '';

    public $end_date = '';

    public $address = '';

    public $postcode = '';

    public $country = '';

    public $description = '';

    public $organizer_name = '';

    public $organizer_description = '';

    public $fb_link = '';

    public $tw_link = '';

    public $link = '';
    
    public $mtime = '';
}

?>
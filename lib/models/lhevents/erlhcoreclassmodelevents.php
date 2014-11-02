<?php

/**
 * 
 * @author Eventizer
 *
 */
class erLhcoreClassModelEvents
{
    use erLhcoreClassTrait;

    public static $dbTable = 'lh_events';

    public static $dbTableId = 'id';

    public static $dbSessionHandler = 'erLhcoreClassEvents::getSession';

    public static $dbSortOrder = 'DESC';

    public function getState()
    {
        $stateArray = array(
            'id'                => $this->id,
            'file'              => $this->file,
            'title'             => $this->title,
            'file_path'         => $this->file_path,
            'start_date'        => $this->start_date,
            'end_date'          => $this->end_date,
            'address'           => $this->address,
            'postcode'          => $this->postcode,
            'country'           => $this->country,
            'description'       => $this->description,
            'organizer_name'    => $this->organizer_name,
            'organizer_description' => $this->organizer_description,
            'fb_link'           => $this->fb_link,
            'tw_link'           => $this->tw_link,
            'link'              => $this->link,
            'variations'        => $this->variations,
            'mtime'             => $this->mtime
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
                if (erConfigClassLhConfig::getInstance()->getSetting('site', 'nice_url_enabled') == false) {
                    $this->url = __url('event/view') . '/' . $this->id;
                } else {
                    $this->url = __url(urlencode(erLhcoreClassCharTransform::TransformToURL($this->title) . '-' . $this->id . 'e.html'), false);
                }
                return $this->url;
                break;
            
            case 'end_date_front':
                if ($this->start_date != '') {
                    $this->end_date_front = date('d/m/Y', $this->end_date);
                } else {
                    $this->end_date_front = '';
                }
                return $this->end_date_front;
                break;
            
            case 'start_date_front':
                if ($this->start_date != '') {
                    $this->start_date_front = date('d/m/Y', $this->start_date);
                } else {
                    $this->start_date_front = '';
                }
                return $this->start_date_front;
                break;
            
            case 'end_date_front_long':
                if ($this->end_date != '') {
                    $this->end_date_front_long = date('l, F dS Y H:i', $this->end_date);
                } else {
                    $this->end_date_front_long = '';
                }
                return $this->end_date_front_long;
                break;
            
            case 'start_date_front_long':
                if ($this->start_date != '') {
                    $this->start_date_front_long = date('l, F dS Y H:i', $this->start_date);
                } else {
                    $this->start_date_front_long = '';
                }
                return $this->start_date_front_long;
                break;
            
            case 'photo_thumb':
                $instance = erLhcoreClassSystem::instance();
                
                $variations = $this->variations_photo;
                $this->photo_thumb = false;
              
                if (isset($variations['photo_thumb'])) {
                    $this->photo_thumb = $instance->wwwDir() . '/' . $this->file_path .  'photo_thumb_' . $this->file;
                } else {
                    try {
                        erLhcoreClassImageConverter::getInstance()->converter->transform('photo_thumb', $this->file_path .  $this->file, $this->file_path . 'photo_thumb_' . $this->file);
                        chmod($this->file_path . '/' . 'photo_thumb_' . $this->file, erConfigClassLhConfig::getInstance()->getSetting('site', 'StorageFilePermissions'));
                        $this->addVariantion('photo_thumb');
                        $this->photo_thumb = $instance->wwwDir() . '/' . $this->file_path .  'photo_thumb_' . $this->file;
                    } catch (Exception $e) {
                        $this->photo_thumb = false;
                    }
                }
                return $this->photo_thumb;
                break;
            
            case 'variations_photo':
                $this->variations_photo = array();
                
                if ($this->variations != '') {
                    $this->variations_photo = unserialize($this->variations);
                }
                
                return $this->variations_photo;
                break;
            default:
                break;
        }
    }

    public function addVariantion($variationItem)
    {
        $variation = $this->variations_photo;
        $variation[$variationItem] = true;
        $this->variations = serialize($variation);
        $this->updateThis();
    }

    public function removePhoto()
    {
        if ($this->file != '') {
            
            $dirBase = 'var/events/';
            $dirImg = $dirBase . $this->id . '/images/';
            
            if (file_exists($dirImg . $this->file)) {
                unlink($dirImg . $this->file);
            }
            
            if (file_exists($dirImg . 'photo_thumb_'.$this->file)) {
                unlink($dirImg .'photo_thumb_'.$this->file);
            }
            
            erLhcoreClassImageConverter::removeRecursiveIfEmpty($dirBase, str_replace($dirBase, '', $dirImg));
            
            $this->file = '';
            $this->file_path = '';
            $this->variations = '';
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
    
    public $variations = '';

    public $mtime = '';
}

?>
<?

class erLhcoreClassModelEvents
{

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

    public function setState(array $properties)
    {
        foreach ($properties as $key => $val) {
            $this->$key = $val;
        }
    }

    public function __toString()
    {
        return $this->title;
    }

    public static function fetch($id)
    {
        return erLhcoreClassEvents::getSession()->load('erLhcoreClassModelEvents', $id);
    }

    public function saveThis()
    {
        if (! $this->mtime)
            $this->mtime = time();
        erLhcoreClassEvents::getSession()->saveOrUpdate($this);
        $this->clearCache();
    }

    public function updateThis()
    {
        erLhcoreClassEvents::getSession()->update($this);
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

    public static function getCount($params = array())
    {
        $session = erLhcoreClassEvents::getSession();
        
        $q = $session->database->createSelectQuery();
        
        $q->select("COUNT(lh_events.id)")->from("lh_events");
        
        $conditions = erLhcoreClassModuleFunctions::getConditions($params, $q);
        
        if (count($conditions) > 0) {
            $q->where($conditions);
        }
        
        $stmt = $q->prepare();
        
        $stmt->execute();
        
        $result = $stmt->fetchColumn();
        
        return $result;
    }

    public static function getList($paramsSearch = array())
    {
        $paramsDefault = array(
            'limit' => 32,
            'offset' => 0
        );
        
        $params = array_merge($paramsDefault, $paramsSearch);
        
        $session = erLhcoreClassEvents::getSession();
        
        $q = $session->createFindQuery('erLhcoreClassModelEvents');
        
        $conditions = erLhcoreClassModuleFunctions::getConditions($params, $q);
        
        if (count($conditions) > 0) {
            $q->where($conditions);
        }
        
        if ($params['limit'] !== false) {
            $q->limit($params['limit'], $params['offset']);
        }
        
        $q->orderBy(isset($params['sort']) ? $params['sort'] : 'id DESC');
        
        $objects = $session->find($q);
        
        return $objects;
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

   
    public static function validateInput(& $articleData)
    {
        if (! isset($_POST['csfr_token']) || ! erLhcoreClassUser::instance()->validateCSFRToken($_POST['csfr_token'])) {
            erLhcoreClassModule::redirect('kernel/csrf-missing');
        }
   
        
        $form = new ezcInputForm(INPUT_POST, $definition);
        
        $Errors = array();
        
        foreach ($languages as $language) {
            
            $locale = strtolower($language['locale']);
            $localeName = $language['title'];
            
            if (! $form->hasValidData('ArticleName_' . $locale) || $form->{'ArticleName_' . $locale} == '') {
                $Errors[] = erTranslationClassLhTranslation::getInstance()->getTranslation('articleadmin/formarticle', 'Please enter article name') . ' ' . $localeName;
            } else {
                $articleData->{'name_' . $locale} = $form->{'ArticleName_' . $locale};
            }
            
            if (! $form->hasValidData('ArticleIntro_' . $locale) || $form->{'ArticleIntro_' . $locale} == '') {
                $Errors[] = erTranslationClassLhTranslation::getInstance()->getTranslation('articleadmin/formarticle', 'Please enter article intro') . ' ' . $localeName;
            } else {
                $articleData->{'intro_' . $locale} = $form->{'ArticleIntro_' . $locale};
            }
            
            if ($form->hasValidData('ArticleBody_' . $locale)) {
                $articleData->{'body_' . $locale} = $form->{'ArticleBody_' . $locale};
            } else {
                $articleData->{'body_' . $locale} = '';
            }
            
            if ($form->hasValidData('AlternativeURL_' . $locale)) {
                $articleData->{'alternative_url_' . $locale} = $form->{'AlternativeURL_' . $locale};
            } else {
                $articleData->{'alternative_url_' . $locale} = '';
            }
            
            if ($form->hasValidData('AliasURL_' . $locale)) {
                $articleData->{'alias_url_' . $locale} = $form->{'AliasURL_' . $locale};
            } else {
                $articleData->{'alias_url_' . $locale} = '';
            }
        }
        
        if (! $form->hasValidData('ArticlePos')) {
            $Errors[] = erTranslationClassLhTranslation::getInstance()->getTranslation('articleadmin/formarticle', 'Please enter article position');
        } else {
            $articleData->pos = $form->ArticlePos;
        }
        
        if ($form->hasValidData('OpenNewPage') && $form->OpenNewPage == true) {
            $articleData->open_new_page = 1;
        } else {
            $articleData->open_new_page = 0;
        }
        
        if ($form->hasValidData('HideArticle') && $form->HideArticle == true) {
            $articleData->hide = 1;
        } else {
            $articleData->hide = 0;
        }
        
        if (empty($Errors)) {
            
            if ($_FILES["ArticleThumb"]["error"] != 4) {
                if (isset($_FILES["ArticleThumb"]) && is_uploaded_file($_FILES["ArticleThumb"]["tmp_name"]) && $_FILES["ArticleThumb"]["error"] == 0 && erLhcoreClassImageConverter::isPhoto('ArticleThumb')) {
                    
                    if ($articleData->id == null) {
                        $articleData->saveThis();
                    }
                    
                    $articleData->removePhoto();
                    
                    $dir = 'var/media/' . $articleData->id . '/images/';
                    
                    erLhcoreClassImageConverter::mkdirRecursive($dir);
                    
                    $articleData->has_photo = 1;
                    $articleData->file_name = erLhcoreClassModuleFunctions::moveUploadedFile('ArticleThumb', $dir);
                } else {
                    $Errors[] = 'Incorrect photo file!';
                }
            }
            
            if (isset($_POST['DeletePhoto']) && $_POST['DeletePhoto'] == 1) {
                $articleData->removePhoto();
            }
        }
        
        return $Errors;
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
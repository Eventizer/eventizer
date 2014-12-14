<?php 
/**
 * 
 * @author eventizer
 *
 */
class erLhAbstractModelEventCategory {
    use erLhcoreClassTrait;
    
    public static $dbTable = 'lh_abstract_event_category';
    public static $dbTableId = 'id';
    public static $dbSessionHandler = 'erLhcoreClassAbstract::getSession';
    public static $dbSortOrder = 'DESC';
        
	public function getState() {
		
		return array(
           'id'         => $this->id,
           'name'       => $this->name,
           'image_path' => $this->image_path,
           'image'      => $this->image,
		   'position' 	=> $this->position,
       	);
	}

	public function __toString() {
		return $this->name;
	}   

    
	public function getModuleTranslations() {
		return array('name' => 'Event category');
	}
   
	
	
	public function __get($var) {
		
	   switch ($var) {
			case 'left_menu':
	   	       $this->left_menu = '';
	   		   return $this->left_menu;
	   		break;
			
			case 'menu':
	   		   return  'events';
	   		break;
	   		
	   		case 'image_url_img':
	   		    $this->image_url_img = false;
	   		    if ($this->image != '') {
	   		        $this->image_url_img = '<img src="' . erLhcoreClassSystem::instance()->wwwDir() . '/' . $this->image_path . $this->image . '"/>';
	   		    }
	   		
	   		    return $this->image_url_img;
	   		    break;
	   		    	
	   		case 'image_fullpath':
	   		    $this->image_fullpath = '/' . $this->image_path . $this->image;
	   		    return $this->image_fullpath;
	   		    break;
	   			
	   	default:
	   		break;
	   }
	}
	    
	public static function countryExist($id) {
		
		if ($id > 0) {
			try {
				return self::fetch($id);
			} catch (Exception $e) {
				return false;
			}
		}
	
		return false;
	}
	
	public function deleteTeamLogoImage() {
	    $this->deletePhoto('image');
	}
	
	public function moveImage() {
	    $this->movePhoto('image');
	}
	
	
	public function movePhoto($attr, $isLocal = false, $localFile = false) {
	    $this->deletePhoto($attr);
	
	    if ($this->id != null) {
	        $dir = 'var/storage/eventcategories/' . date('Y') . 'y/' . date('m') . '/' . date('d') . '/' . $this->id . '/';
	        	
	        erLhcoreClassFileUpload::mkdirRecursive($dir);
	        	
	        if ($isLocal == false) {
	            $this->$attr = erLhcoreClassModuleFunctions::moveUploadedFile('AbstractInput_' . $attr, $dir . '/', '.');
	        } else {
	            $this->$attr = erLhcoreClassModuleFunctions::moveLocalFile($localFile, $dir . '/', '.');
	        }
	        	
	        $this->{$attr . '_path'} = $dir;
	    } else {
	        $this->{$attr . '_pending'} = true;
	    }
	}
	
	public function deletePhoto($attr) {
	    if ($this->$attr != '') {
	        if (file_exists($this->{$attr . '_path'} . $this->$attr)) {
	            unlink($this->{$attr . '_path'} . $this->$attr);
	        }
	        	
	        erLhcoreClassFileUpload::removeRecursiveIfEmpty('var/storage/eventcategories/', str_replace('var/storage/eventcategories/', '', $this->{$attr . '_path'}));
	        	
	        $this->$attr = '';
	        $this->{$attr . '_path'} = '';
	    }
	}
	
	public $id = null;
   	public $name = '';
   	public $image = '';
   	public $image_path = '';
   	public $position = 0;
   	
   	public $hide_delete = true;
	
}

?>
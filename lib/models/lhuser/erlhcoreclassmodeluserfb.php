<?

class erLhcoreClassModelUserFB {
        
    public function getState()
   {
       return array(
               'user_id'        => $this->user_id,
               'fb_user_id'     => $this->fb_user_id,
               'name'     => $this->name,
               'link'     => $this->link,
       );
   }
   
   public function setState( array $properties )
   {
       foreach ( $properties as $key => $val )
       {
           $this->$key = $val;
       }
   }

   public static function fetch($user_id)
   {
   	 $user = erLhcoreClassUser::getSession('slave')->load( 'erLhcoreClassModelUserFB', (int)$user_id );
   	 return $user;
   }
   
   public static function findOne($paramsSearch) {
	
   		$list = self::getList($paramsSearch);
   		if (!empty($list))
   			return current($list);
   
   		return false;
	}
   
   public function removeThis()
   {
        erLhcoreClassUser::getSession()->delete( $this);
   }
   
   public static function isFBLoginOwner($user_id, $skipChecking = false)
   {
        $fblogin = self::fetch($user_id);
       
        if ( $skipChecking==true ) return $fblogin;
       
       $currentUser = erLhcoreClassUser::instance();              
       if ($fblogin->user_id == $currentUser->getUserID()) return $fblogin;
        
       return false;
   }
   
   public static function getCount($params = array())
   {
       $session = erLhcoreClassUser::getSession('slave');
       $q = $session->database->createSelectQuery();  
       $q->select( "COUNT(user_id)" )->from( "lh_user_fb" );   
         
       if (isset($params['filter']) && count($params['filter']) > 0)
       {
           $conditions = array();
           
           foreach ($params['filter'] as $field => $fieldValue)
           {
               $conditions[] = $q->expr->eq( $field, $q->bindValue($fieldValue) );
           }
           
           $q->where( 
                 $conditions   
           );
      }  
             
      $stmt = $q->prepare();       
      $stmt->execute();  
      $result = $stmt->fetchColumn(); 
            
      return $result; 
   }
   
   public function saveThis()
   {
        erLhcoreClassUser::getSession()->saveOrUpdate( $this );
   }
   
   public function setPassword($password)
   {
       $cfgSite = erConfigClassLhConfig::getInstance();
	   $secretHash = $cfgSite->getSetting( 'site', 'secrethash' );
       $this->password = sha1($password.$secretHash.sha1($password));
   } 
   
   public static function getList($paramsSearch = array())
   {             
       $paramsDefault = array('limit' => 32, 'offset' => 0);
       
       $params = array_merge($paramsDefault,$paramsSearch);
       
       $session = erLhcoreClassUser::getSession('slave');
       $q = $session->createFindQuery( 'erLhcoreClassModelUserFB' );  
       
       $conditions = array(); 
       
       if (isset($params['filter']) && count($params['filter']) > 0)
       {                     
           foreach ($params['filter'] as $field => $fieldValue)
           {
               $conditions[] = $q->expr->eq( $field, $q->bindValue($fieldValue) );
           }
       } 
      
       if (isset($params['filterin']) && count($params['filterin']) > 0)
       {
           foreach ($params['filterin'] as $field => $fieldValue)
           {
               $conditions[] = $q->expr->in( $field, $fieldValue );
           } 
       }
      
       if (isset($params['filterlt']) && count($params['filterlt']) > 0)
       {
           foreach ($params['filterlt'] as $field => $fieldValue)
           {
               $conditions[] = $q->expr->lt( $field, $q->bindValue($fieldValue) );
           } 
       }
      
       if (isset($params['filtergt']) && count($params['filtergt']) > 0)
       {
           foreach ($params['filtergt'] as $field => $fieldValue)
           {
               $conditions[] = $q->expr->gt( $field,$q->bindValue( $fieldValue ));
           } 
       }      
      
       if (count($conditions) > 0)
       {
          $q->where( 
                     $conditions   
          );
       } 
      
       $q->limit($params['limit'],$params['offset']);
                
       $q->orderBy(isset($params['sort']) ? $params['sort'] : 'user_id DESC' ); 
       
              
       $objects = $session->find( $q );
         
      return $objects; 
   }

	public function __get($var) {
   		
		switch ($var) {
			case 'user':

				$this->user = false;
				
				try {
					$this->user  = erLhcoreClassModelUser::fetch($this->user_id);
				} catch (Exception $e) {
					$this->user = false;
				}
				
				return $this->user;
				break;
				
   			default:
				break;
   		}
   		
   }
   
	public function setFBPicture() {
				
		if ($this->user_id != null && $this->user != false) {
			
			if ($this->user->has_photo == false) {
				
				try {
						
					$facebook = new Facebook(array(
						'appId'  => erConfigClassLhConfig::getInstance()->getSetting( 'facebook', 'app_id' ),
						'secret' => erConfigClassLhConfig::getInstance()->getSetting( 'facebook', 'secret' ) ,
					));
				
					$facebookUserId = $facebook->getUser();
						
					$userProfilePhoto = $facebook->api($facebookUserId.'?fields=picture.type(square).width(500).height(500)');
				
					if($userProfilePhoto['picture']['data']['is_silhouette'] == false) {
						$this->user->changePhotoUrl($userProfilePhoto['picture']['data']['url']);
					}
						
				} catch (Exception $e) {
					// Error
				}				
			}   			
   		}   	
	}
   
    public $user_id = null;
    public $fb_user_id = null;
    public $link = null;
    public $name = null;
}

?>
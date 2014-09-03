<?php

class erLhcoreClassModelCronMailerMail {
        
	public function getState() {
    	
       	$stateArray = array(
			'id'					=> $this->id,			
			'status'       			=> $this->status,
			'type'					=> $this->type,			
			'send_time'       		=> $this->send_time,
			'email'       			=> $this->email,						
			'name'       			=> $this->name,						
			'email_subject'     	=> $this->email_subject,						
			'email_content'     	=> $this->email_content,						
			'params'     			=> $this->params,						
			'created'       		=> $this->created,
       	);
       
    	return $stateArray;
       
	}
   
	public function setState( array $properties ) {
    	foreach ( $properties as $key => $val ) {
        	$this->$key = $val;
       	}
   	} 
      	
	public static function fetch($id) {
		return erLhcoreClassCronMailer::getSession()->load( 'erLhcoreClassModelCronMailerMail', $id);
   	}
   	
   	public function saveThis() {
   		$this->created = time();   		
		erLhcoreClassCronMailer::getSession()->save( $this );
	}
   	 
   	public function updateThis() {
   		erLhcoreClassCronMailer::getSession()->update($this);
   	}
   	 
   	public function removeThis() {
		erLhcoreClassCronMailer::getSession()->delete($this);
   	}
   
	public static function getCount($params = array(), $operation = "COUNT(lh_cron_mailer_mail.id)") {
   	
		$session = erLhcoreClassCronMailer::getSession();
	   	
		$q = $session->database->createSelectQuery();
	   	
		$q->select( $operation )->from( "lh_cron_mailer_mail" );
	   	 
		$conditions = erLhcoreClassModuleFunctions::getConditions($params, $q);
			
		if (count($conditions) > 0) {
			$q->where( $conditions );
		}
	   	 
	   	$stmt = $q->prepare();
	   	
	   	$stmt->execute();
	   	
	   	$result = $stmt->fetchColumn();
	   
	   	return $result;
	}
   
	public static function getList($paramsSearch = array()) {

		$paramsDefault = array('limit' => 32, 'offset' => 0);
	   	 
	   	$params = array_merge($paramsDefault,$paramsSearch);
	   	 
	   	$session = erLhcoreClassCronMailer::getSession();
	   	
	   	$q = $session->createFindQuery( 'erLhcoreClassModelCronMailerMail' );

	   	$conditions = erLhcoreClassModuleFunctions::getConditions($params, $q);
	   	
	   	if (count($conditions) > 0) {
	   		$q->where($conditions);
	   	}
	   	
	   	if ($params['limit'] !== false) {
			$q->limit($params['limit'],$params['offset']);
		}
	   
	   	$q->orderBy(isset($params['sort']) ? $params['sort'] : 'id DESC' );
	   	
	   	$objects = $session->find( $q );
	   
		return $objects;
	}	
	
	public function __get($variable) {
	
		switch ($variable) {
	
			case 'params_data':
				
				$this->params_data = false;
				
				if ($this->params != '') {
					$this->params_data = unserialize($this->params);
				} 
				
				return $this->params_data;
				break;
				
			default:
				break;
		}	
	}
	
	public function send() {
		
		if($this->type == self::MAIL_TYPE_LEAGUE_PROMOTE) {
			erLhcoreClassMail::sendLeaguePromoteMail($this);
		} elseif($this->type == self::MAIL_TYPE_LEAGUE_INACTIVE_MEMBERS) {
			erLhcoreClassMail::sendInactiveLeagueMembersMail($this);
		} elseif ($this->type == self::MAIL_TYPE_LEAGUE_RESTART) {
			erLhcoreClassMail::sendLeagueRestartMail($this);
		}
		
		$this->status = self::MAIL_STATUS_SEND;
		$this->send_time = time();
		$this->updateThis();
		
	}
	
	const MAIL_STATUS_NEW = 0;
	const MAIL_STATUS_SEND = 1;
	
	const MAIL_TYPE_LEAGUE_RESTART = 1; // League restart msg
	const MAIL_TYPE_LEAGUE_INACTIVE_MEMBERS = 2; // Chairman send msg to inactive league members
	const MAIL_TYPE_LEAGUE_PROMOTE = 3; // Chairman send promote msg
	
    public $id = null;
    public $status = self::MAIL_STATUS_NEW; 
    public $type = 0;      
    public $send_time = 0;  
    public $email = '';  
    public $name = '';  
    public $email_subject = '';  
    public $email_content = '';  
    public $params = '';  
    public $created = 0;
    
}

?>
<?php

class erLhcoreClassModelCronMailerMail {
    use erLhcoreClassTrait;
    
    public static $dbTable = 'lh_cron_mailer_mail';
    public static $dbTableId = 'id';
    public static $dbSessionHandler = 'erLhcoreClassCronMailer::getSession';
    public static $dbSortOrder = 'DESC';
    
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
   
	
   	
   	public function saveThis() {
   		$this->created = time();   		
		erLhcoreClassCronMailer::getSession()->save( $this );
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
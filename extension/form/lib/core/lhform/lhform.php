<?php

class erLhcoreClassForm {
	
	private static $instance = null;
	public $conf;
	
	public function __construct()
	{
		$this->conf = include('extension/form/settings/settings.ini.php');
	}
	
	public function getSetting($section, $key)
	{
		if (isset($this->conf[$section][$key])) {
			return $this->conf[$section][$key];
		} else {
			throw new Exception('Setting with section {'.$section.'} value {'.$key.'}');
		}
	}
	
	public static function getInstance()
	{
		if ( is_null( self::$instance ) )
		{
			self::$instance = new erLhcoreClassForm();
		}
		return self::$instance;
	}
}

?>
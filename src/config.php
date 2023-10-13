<?php

class Config {
	
	public $session_created;
	public $title;
	public $main_url;
	public $timeout;
	public $api_url;
	public $token_request_field;
	public $search_field;
	public $interface_id;
	public $timestamp;
	public $timestamp_string;
	public $msg_id;
	public $username;
	public $user_pwd;
	public $created;
	public $user_ip;
	public $authdata;
	
	public function api_user_timestamp(){	
	
		$currentYear = date('Y');
		$currentTimestamp = time();
		$currentYearSummerTimestampStart = mktime(0,0,0,25,3,$currentYear); // Latvian Summer time start
		$currentYearSummerTimestampEnd   = mktime(0,0,0,28,10,$currentYear); // Latvian Summer time end
    
		// Add one hour for a Summer time period
		if ( $currentYearSummerTimestampStart <= $currentTimestamp && $currentTimestamp <= $currentYearSummerTimestampEnd ) {
			// Summer period
			return time() + 3 * 3600;
		} else {
			// off-season
			return time() + 2 * 3600;
		}
	}
	
	
	
	// Main configuration variables
	
	public function __construct(){
	
		$this->session_created = time();
		
		// Website title and header
		$this->title = 'Simourg document validator';
		
		// System URL address
		$this->main_url = "https://example.com/";
		
		//Session timeout
		$this->timeout = 300;
		
		// API URL address
		$this->api_url = "https://api.simbase.example.com";
		
		// XML API request fields
		$this->token_request_field = "o_validator_token";
		$this->search_field = "o_validator_data";
		
		// SimBASE API interface ID
		$this->interface_id = hexdec('D000001');
		
		// Defining message counter ID 
		$timestamp = $this->api_user_timestamp(); // execute function
		$timestamp_string = strval($timestamp); // convert to string
		$this->msg_id = substr($timestamp_string, - 10); // take last 10 figures and convert to integer
		
		// SimBASE API user data
		$this->username = 'user.api';
		$this->user_pwd = 'api.password';
		
		// Timestamp of API request
		$this->created  = $this->api_user_timestamp();
		
		// IP of request originator
		$this->user_ip = $_SERVER['REMOTE_ADDR'];
		//$user_ip  = '159.148.13.99';
		
		// SimBASE API authentication data encoded in BASE64 
		$this->authdata = base64_encode('<authdata msg_id="'.$this->msg_id.'" user="'.$this->username.'" password="'.$this->user_pwd.'" msg_type="3020" user_ip="'.$this->user_ip.'"/>');
	
    }
	
}


?>

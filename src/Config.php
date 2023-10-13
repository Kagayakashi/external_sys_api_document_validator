<?php

namespace Validator;

class Config {
	
	public $recaptcha;
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
	
	// Main configuration variables
	
	public function __construct(){
		// Website title and header
		$title = 'Simourg document validator';
		if(! empty($_ENV['SITE_TITLE'])) {
			$title = $_ENV['SITE_TITLE'];
		}
		$this->title = $title;

		// Website ask captcha again
		$recaptcha = 5;
		if(! empty($_ENV['SITE_RECAPTCHA'])) {
			$recaptcha = (int) $_ENV['SITE_RECAPTCHA'];
		}
		$this->recaptcha = $recaptcha;
		
		//Session timeout
		$d = 300;
		if(! empty($_ENV['SBAPI_TIMEOUT'])) {
			$d = $_ENV['SBAPI_TIMEOUT'];
		}
		$this->timeout = $d;
		
		// API URL address
		$d = 'https://api.simbase.example.com';
		if(! empty($_ENV['SBAPI_URL'])) {
			$d = $_ENV['SBAPI_URL'];
		}
		$this->api_url = $d;
		
		// XML API request fields
		$d = 'o_validator_token';
		if(! empty($_ENV['TOKEN_FIELD'])) {
			$d = $_ENV['TOKEN_FIELD'];
		}
		$this->token_request_field = $d;
		
		$d = 'o_validator_data';
		if(! empty($_ENV['SEARCH_FIELD'])) {
			$d = $_ENV['SEARCH_FIELD'];
		}
		$this->search_field = $d;
		
		// SimBASE API interface ID
		$d = 'D000001';
		if(! empty($_ENV['SBAPI_INTERFACE_ID'])) {
			$d = $_ENV['SBAPI_INTERFACE_ID'];
		}
		$this->interface_id = hexdec($d);
		
		// SimBASE API user data
		$d = 'user.api';
		if(! empty($_ENV['SBAPI_USER'])) {
			$d = $_ENV['SBAPI_USER'];
		}
		$this->username = $d;
		
		$d = 'api.password';
		if(! empty($_ENV['SBAPI_HASH_PASSWORD'])) {
			$d = $_ENV['SBAPI_HASH_PASSWORD'];
		}
		$this->user_pwd = $d;
    }
	
}


?>

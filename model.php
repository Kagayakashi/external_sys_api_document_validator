<?php

class Model {
	
	private $config;
	
	public function __construct(){
		
		$this->config = include_once('../config.php');
	}

	public function get_token(){
		
		// Get token into session
		// used in language switch && link -> site/?token=...
		if( isset( $_POST['token'] ) && !empty( $_POST['token'] ) ){ $token = $_POST['token']; }
		elseif( isset( $_GET['token'] ) ){ $token = $_GET['token']; }
		else{ $token = 'empty'; }
		
		$_SESSION['TOKEN'] = $token;
		
		return;
	}
	
	public function get_lang(){
		
		// Get lang into session
		// used in language switch && link -> site/?lang=...
		if( isset( $_POST['lang'] ) && !empty( $_POST['lang'] ) ){ $lang = $_POST['lang']; }
		elseif( isset( $_GET['lang'] ) ){ $lang = $_GET['lang']; }
		else{ $lang = 'en'; }
		
		$_SESSION['LANG'] = $lang;
		
		return;
	}
	
	public function get_xml(){
		
		// Forming an XML request
		// get xml from file
		// insert data from config into xml
		// save xml in session
		
		$xml = file_get_contents('../request.xml');
		$xml = str_replace(
			array( 'INTERFACE_ID_S', 'MSG_ID_S', 'SESSION_CREATED_S', 'AUTHDATA_S', 'TOKEN_REQUEST_FIELD_S', 'TOKEN_VALUE_S', "SEACH_FIELD_S" ),
			array( $this->config['API_INTERFACE_ID'], $this->config['MSG_ID'], $_SESSION['START_TIME'], $this->config['AUTHDATA'], $this->config['TOKEN_REQUEST_FIELD'], $_SESSION['TOKEN'], $this->config['SEARCH_FIELD'] ), $xml
		);
		
		$_SESSION['XML'] = $xml;
		
		return;
	}
	
	public function get_response(){
		
		// Send XML request to API with curl
		// get xml from session
		// form response settings
		// send response
		
		$api = $this->config['API_URL'];
		$xml = $_SESSION['XML'];
		$ch = curl_init( $api ); 
		curl_setopt($ch, CURLOPT_URL, $api );
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 4);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, 
		array('Content-Type: text/xml; charset=utf-8', 
			  'Content-Length: '.strlen($xml)));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
		
		$response = curl_exec($ch);
		curl_close($ch);
        
		$_SESSION['RESPONSE'] = $response;
		
		return;
	}
	
	public function is_response(){
		
		// Check if response is not empty
		// if response have not records, clear response variable
		$response = $_SESSION['RESPONSE'];
        
		$xml = simplexml_load_string( $response );
		$records = $xml->body->data['records'];
		
		if( $records > 0 ){ return; }
		else{ unset( $_SESSION['RESPONSE'] ); } 
		
		return;
	}
	
	public function get_object_data(){

		// Get object json from response
		// get json data from response
		
		$response = $_SESSION['RESPONSE'];
		$xml = simplexml_load_string($response);
		$data = $xml->body->data->{'object'}->field;
        
        $data = (string) $data;

        // Два обратных слеша заменить на перенос новой строки
        $data = str_replace(array("\r", "\n"), array('', ''), $data);
        
        //echo $data;
        
        //die();
        
		$data = json_decode($data, true );
        
		$_SESSION['OBJECT_DATA'] = $data;
		
		return;
	}
	
	public function is_object_data(){
		
		// check json key names in object data
		$data = $_SESSION['OBJECT_DATA'];
        
		//if( empty( $data ) || !isset( $data ) ){ return 404; }
		// check for validator key in json
		$error = 4;
		$key = $data['simbase_service_key'];
		
		if($key == 'simbase_validator_data' ){ $error--; }
		if( array_key_exists( 'simbase_service_key', $data ) ){ $error--; }
		if( array_key_exists( 'simbase_object_number', $data ) ){ $error--; }
		if( array_key_exists( 'validator_data', $data ) ){ $error--; }
		
		if( $error > 0 ){ return 404; }
		
		return;
			
	}
	
	public function get_data_html(){

		// forming data page html
		
		$lang = $_SESSION['LANG'];
		$data = $_SESSION['OBJECT_DATA'];
		
		$title = $this->config['TITLE'];
		
		$_SESSION['OBJECT_DATA'] = $data;
		
		// get all data with language list
		$all_data = $data['validator_data'];
		
		// get doc number
		$doc = $data['simbase_object_number'];
		
		// get language data by selected language
		$lang_data = $all_data[ $lang ];
		
		// remove status from language data array and save it
		$status = array_shift( $lang_data ); 
		$status = $status[1];
		
		$status_code = $data['simbase_object_status_code'];
		
		// Check status name, get status color and image name
		// #ffbc00 - yellow error
		if ( $status_code == "valid" ){ $status_color = '#05a904'; $status_img = 'valid'; } 
		elseif( $status_code == "expired" ){ $status_color = '#b01919'; $status_img = 'expired'; }
		elseif( $status_code == "pending" ){ $status_color = '#2e6eac'; $status_img = 'pending'; }
		elseif( $status_code == "cancelled" ){ $status_color = '#b01919'; $status_img = 'cancelled'; }
		elseif( $status_code == "archived" ){ $status_color = '#949494'; $status_img = 'archived'; }
		//elseif( $status_code == "error" ){ $status_color = '#ffbc00'; $status_img = 'error'; }
		else{ $status_color = 'black'; $status_img = 'error'; }
		
		// if status in language data is empty, use status from all data in english
		if( empty( $status ) ){ $status = ucwords( $status_img ); } 
		
		// include data html page
		include_once('../html/data.php');
		
		$_SESSION['LANG'] = $lang;
		
		return;		
	}
	
	public function get_language_list( $active_lang, $all_data ){
		
		// get language list with <li>lang</li> template for navigation in data page
		// used in ../html/data.php
		
		// get key name from all data array
		while( $each = current( $all_data ) ) {
			$lang = key( $all_data );
			
			$active = '';
			if( $active_lang == $lang ){ $active = 'active'; }
			
			echo '<li>
					<button type="submit" name="lang" value="'.$lang.'" class="'.$active.'">'.strtoupper( $lang ).'</button>
				</li>';
			
			
			next($all_data);
		}
		
		return;
	}
	
	public function get_search_html(){
				
		// forming data page html		
		$title = $this->config['TITLE'];
		
		include '../html/search.php';
		
		return;		
	}
	
	public function get_error_html( $error ){
		
		// forming data page html
		$title = $this->config['TITLE'];
		
		//if error = 404, error page with 'something went wrong',
		//else 'document not found'
		if( $error === 404 ){ include '../html/wrong.php'; }
		else{ include '../html/error.php'; }
		
		return;		
	}
	
	public function check_timeout(){
		
		// if session expire
		if ( $_SESSION['START_TIME'] < time() - $this->config['TIMEOUT'] ) {
			$this->session_off();
		}
		
		return;
	}
		
	public function back(){
		
		// If button back has been clicked, turn off session
		if( isset( $_GET['back'] ) ){ $this->session_off(); }
		
		return;
	}
	
	public function session_off(){
		
		// turning off session and redirect to main page
		session_unset();
		session_destroy();
			
		header('Location: /');
		return;
	}
}


?>

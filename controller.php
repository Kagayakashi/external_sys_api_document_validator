<?php

include_once('../model.php');

class Controller {
	
	private $model;
	
	public function __construct(){
		
		//function that executed when page loaded
		
		// create model
		// check if back button has been clicked -> session destroy
		// get token
		// get language
		// choose page
		
        $this->model = new Model();
		$this->model->back();
		$this->model->get_token();
		$this->model->get_lang();
		$this->choose_page();
    }
	
	
	
	public function choose_page(){
		
		$this->model->check_timeout();
		$token = $_SESSION['TOKEN'];
		
		// If object data already exist, show data page.
		// If object data already exist, show data page.
		if( isset( $_SESSION['OBJECT_DATA'] ) && $token != 'empty' ){ 
			
			$data = $_SESSION['OBJECT_DATA'];
			$doc = $data['simbase_object_number'];
			
			if( $doc == $token ){ $this->show_data(); } 
			else{ $this->make_request(); }
		}
		elseif( isset( $_SESSION['OBJECT_DATA'] ) ){ $this->show_data(); }
		
		// If token is empty, show search page
		elseif( $token == 'empty' || empty( $_SESSION['TOKEN'] ) ){ $this->show_search(); }
		
		// If token already exist, get response -> show data or error page
		elseif( $token != 'empty' ){
			$this->make_request();
		}
	}
	
	public function make_request(){
		
		$this->model->get_xml();
		$this->model->get_response();
		$this->model->is_response();
		
		if( isset( $_SESSION['RESPONSE'] ) ){ $this->show_data(); }
		else{ $this->show_error( 0 ); }
	}
	
	public function show_data(){
		
		// data page 
		$this->model->get_object_data();
		$error = $this->model->is_object_data();
		
		// If we got the response, but json structure error
		// show error page
		if( $error == 404 ){ $this->show_error( $error ); }
		else{ $this->model->get_data_html(); }
		
	}
	
	public function show_search(){
		
		// search page
		$this->model->get_search_html();
		
	}
	
	public function show_error( $error ){
		
		// Error page
		// if $error = 404 (something went wrong)
		// else (document not found)
		$this->model->get_error_html( $error );
		
	}
	
}


?>

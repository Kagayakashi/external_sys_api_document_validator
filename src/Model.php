<?php

namespace Validator;

use Validator\Request;
use Exception;

class Model {
    private $response;

    public function getDataByToken($token, $lang)
    {
        $request = new Request($token, $lang);
        $this->response = $request->getSbData($token);
        $this->isDataEmpty();
    }
    
    public function isDataEmpty(){
        $xml = simplexml_load_string($this->response);
        $records = $xml->body->data['records'];
        if((integer) $records == 0) {
            throw new Exception("Information not found", 1);
        }
    }
    
    public function prepareData(){
        $xml = simplexml_load_string($this->response);
        $data = $xml->body->data->{'object'}->field;
        $data = (string) $data;
        $data = str_replace(array("\r", "\n"), array('', ''), $data);
        $data = json_decode($data, JSON_UNESCAPED_UNICODE);
        
        return $data;
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
    
    public function get_data_html($data, $token, $lang){
        $config = new Config;
        
        // prepare pictures
        $pictures = [];
        if( ! empty( $data['validator_pictures'] ) ){
            $pictures = $this->preparePictures( $data['validator_pictures'] );
        }

        // prepare files
        $files = [];
        if( ! empty( $data['validator_files'] ) ){
            $files = $this->prepareFiles( $data['validator_files'] );
            $_SESSION['files'] = $files;
        }

        // get all data with language list
        $all_data = $data['validator_data'];
        
        // get doc number
        $doc = $data['simbase_object_number'];
        
        if(!array_key_exists($lang, $all_data)) {
            $lang = "en";
        }
        
        // get language data by selected language
        $lang_data = $all_data[$lang];
        
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
        include __DIR__ . '/html/data.php';
        
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
        $config = new Config;
        include __DIR__ . '/html/search.php';
        
        return;
    }

    public function get_captcha_html(){
        $config = new Config;
        include __DIR__ . '/html/captcha.php';
        
        return;
    }
    
    public function get_error_html( $error ){
        $config = new Config;        
        //if error = 500, error page with 'something went wrong',
        //else 'document not found'
        if( $error === 500 ){ include __DIR__ . '/html/wrong.php'; }
        else{ include __DIR__ . '/html/error.php'; }
        
        return;
    }

    protected function preparePictures( $pictures ){
        $res = [];
        foreach ($pictures as $picture) {
            if( count( $picture ) === 2 ) {
                $res[$picture[0]] = $picture[1];
            }
        }
        return $res;
    }

    protected function prepareFiles( $files ){
        $res = [];
        foreach ($files as $file) {
            if( count( $file ) === 3 ) {
                $res[$file[0]]['base64'] = $file[1];
                $res[$file[0]]['name'] = $file[2];
            }
        }

        return $res;
    }
}

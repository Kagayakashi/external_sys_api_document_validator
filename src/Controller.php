<?php

namespace Validator;

use Exception;
use Validator\Model;

class Controller {
    private $token;
    private $language;
    private $model;
    
    public function __construct($token, $language){
        $this->token = $token;
        $this->language = $language;
        $this->model = new Model();
    }

    public function captchaCompleted()
    {
        if(isset($_SESSION["first_captcha_entered"]) && $_SESSION["first_captcha_entered"] === false) {
            $_SESSION["first_captcha_entered"] = true;
        }
        
        $_SESSION["ask_captcha"] = false;
        $_SESSION["request_counter"] = 0;
    }

    public function render()
    {
        if(empty($this->token)) {
            $this->model->get_search_html();
        }
        else {
            $this->showData();
        }
    }

    private function showData() {
        try {
            $this->model->getDataByToken($this->token, $this->language);
            $data = $this->model->prepareData();
            $this->model->get_data_html($data, $this->token, $this->language);
        }
        catch (Exception $e) {
            // Требует ввести капчу
            if($e->getCode() == 1337) {
                return $this->model->get_captcha_html();
            }

            $this->model->get_error_html($e->getCode()); 
        }        
    }
}

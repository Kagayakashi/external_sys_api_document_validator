<?php

namespace Validator;

use Exception;
use Validator\Model;

class Controller {
    private $download;
    private $token;
    private $language;
    private $model;
    
    public function __construct($download, $token, $language){
        $this->download = $download;
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
        if(!empty($this->download)) {
            $this->postFile();
        }
        if(! empty($this->token)) {
            $this->showData();
        }
        else {
            $this->model->get_search_html();
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

    private function postFile() {
        if (! empty($this->download) && isset($_SESSION['files']) && isset($_SESSION['files'][$this->download])) {
            $file = $_SESSION['files'][$this->download];
            
            // Декодируем base64 в бинарные данные
            $fileData = base64_decode($file['base64']);
            
            // Устанавливаем заголовки для скачивания файла
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment;'); // Здесь указывается имя файла  filename="downloaded_file.ext"
            
            // Отправляем бинарные данные файла в выходной поток
            echo $fileData;
            exit;
        }
    }
}

<?php

namespace Validator;

use Validator\XmlFormer;
use Exception;

class Request
{
    private $config;

    public function __construct($token, $lang)
    {
        $default = new Config;
        
        $ip = isset($_SERVER['HTTP_CLIENT_IP']) 
            ? $_SERVER['HTTP_CLIENT_IP'] 
            : (isset($_SERVER['HTTP_X_FORWARDED_FOR']) 
            ? $_SERVER['HTTP_X_FORWARDED_FOR'] 
            : $_SERVER['REMOTE_ADDR']);

        $config['url'] = $default->api_url;
        $config['interface_id'] = $default->interface_id;
        $config['created'] = '2022-06-30 04:20:00';
        $config['authdata'] = base64_encode('<authdata msg_id="1" user="'. $default->username .'" password="'. $default->user_pwd .'" msg_type="3020" user_ip="' . $ip . '"/>');
        $config['token_value'] = $token;
        $config['language'] = $lang;
        $config['token_field'] = $default->token_request_field;
        $config['search_field'] = $default->search_field;
        $config['timeout'] = $default->timeout;
        $config['recaptcha'] = $default->recaptcha;

        $this->config = $config;

        // Проверка капчи
        $this->initCaptcha($token, $lang);
    }

    public function getSbData()
    {
        $api = $this->config['url'];

        $xmlObject = new XmlFormer();
        $xml = $xmlObject->getSbData($this->config);
        $ch = curl_init( $api ); 
        curl_setopt($ch, CURLOPT_URL, $api );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, $this->config['timeout']);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, 
        array('Content-Type: text/xml; charset=utf-8',
              'Content-Length: '.strlen($xml)));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);

        $response = curl_exec($ch);

        if(!$response) {
            throw new Exception("Internal error", 500);
        }

        curl_close($ch);

        $this->counterRequest($this->config['token_value'], $this->config['language']);

        return $response;
    }

    private function initCaptcha($token, $lang)
    {

        if(!isset($_SESSION["ask_captcha"])) {
            $_SESSION["ask_captcha"] = false;
        }

        if(!isset($_SESSION["first_captcha_entered"])) {
            $_SESSION["first_captcha_entered"] = false;
        }

        if(!isset($_SESSION["request_counter"])) {
            $_SESSION["request_counter"] = 0;
        }

        if(!isset($_SESSION["prev_token"])) {
            $_SESSION["prev_token"] = "";
        }

        if(!isset($_SESSION["prev_language"])) {
            $_SESSION["prev_language"] = "";
        }

        // Перезапрос через смену языка. Не запрашивать капчу.
        if($_SESSION["prev_token"] == $token && $_SESSION["prev_language"] != $lang) {
            return;
        }

        $this->askCaptcha();
    }

    private function counterRequest($token, $lang)
    {
        $_SESSION["request_counter"]++;
        $_SESSION["prev_token"] = $token;
        $_SESSION["prev_language"] = $lang;
    }

    private function askCaptcha()
    {
        if($_SESSION["request_counter"] === 1 && !$_SESSION["first_captcha_entered"]) {
            // Первый раз запросить на второй раз. После этого каждые N раз
            $_SESSION["ask_captcha"] = true;
        }
        elseif($_SESSION["request_counter"] > 0 && $_SESSION["request_counter"] % $this->config['recaptcha'] == 0) {
            $_SESSION["ask_captcha"] = true;
        }

        if($_SESSION["ask_captcha"] === true) {
            throw new Exception("Complete captcha!", 1337);
        }
    }
}

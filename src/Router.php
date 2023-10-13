<?php

namespace Validator;

use Validator\Controller;

class Router
{
    private $token;
    private $download;
    private $language;
    private $captcha;
    
    public function __construct()
    {
        $this->getUriParams();
        $this->routeToAction();
    }

    private function getUriParams()
    {
        $this->getUriDownload();
        $this->getUriToken();
        $this->getUriLang();
        $this->getCaptcha();
    }

    private function getUriDownload()
    {
        if(isset($_GET["download"])) {
            $this->download = $_GET["download"];
        }
    }

    private function getUriToken()
    {
        if(isset($_GET["token"])) {
            $this->token = $_GET["token"];
        }
    }

    private function getUriLang()
    {
        if(isset($_GET["lang"])) {
            $this->language = $_GET["lang"];
        }
    }

    private function getCaptcha()
    {
        if(isset($_POST["captcha"])) {
            $this->captcha = true;
        }
    }

    private function routeToAction()
    {
        $controller = new Controller($this->download, $this->token, $this->language);
        if($this->captcha) {
            return $controller->captchaCompleted();
        }
        else {
            $controller->render();
        }
    }
}

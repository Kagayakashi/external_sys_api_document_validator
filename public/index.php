<?php

require_once '../vendor/autoload.php';

try {
    $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->load();
} catch (\Throwable $th) {
    //
}

session_start();

$router = new \Validator\Router;

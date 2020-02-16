<?php
define('ZOOCAPTCHA1', true);
$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    case '/' :
        require __DIR__ . '/views/index.html';
        break;
    case '' :
        require __DIR__ . '/views/index.html';
        break;
    case '/captcha' :
        require __DIR__ . '/src/GenerateCaptcha.php';
        break;
    case '/send' :
        require __DIR__ . '/views/SendMessage.php';
        break;
    default:
        http_response_code(404);
        require __DIR__ . '/views/404.php';
        break;
}
<?php
if (!defined('ZOOCAPTCHA1')) {
    header('HTTP/1.0 403 Forbidden');
    exit;
}

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') &&
$_SERVER['REQUEST_METHOD'] == 'POST') {
    require 'CaptchaNonceNoCookie.php';
    require 'Cors.php';
    Cors::setCors();

    $myCaptcha = new CaptchaNonceNoCookie();
    $output = array(
        'crypted' => $myCaptcha->crypted(),
        'image' => $myCaptcha->display(),
        'digits' => $myCaptcha->digits,
    );
    header('Content-Type: application/json');
    echo json_encode($output);
} else {
    header('HTTP/1.0 403 Forbidden');
    exit;
}


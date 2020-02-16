<?php

if(!defined('ZOOCAPTCHA1')) {
    header('HTTP/1.0 403 Forbidden');
    exit;
 }
require 'CaptchaNonceNoCookie.php';

$myCaptcha = new CaptchaNonceNoCookie();
$output = array(
    'crypted' => $myCaptcha->crypted(),
    'image' => $myCaptcha->display(),
    'digits' => $myCaptcha->digits,
);
header('Content-Type: application/json');
echo json_encode($output);

<?php
if(!defined('ZOOCAPTCHA1')) {
    header('HTTP/1.0 403 Forbidden');
    exit;
 }
define( 'ABSPATH', dirname(dirname(__FILE__)) . '/' );
require ABSPATH.'src/CaptchaNonceNoCookie.php';

if(!CaptchaNonceNoCookie::validate($_POST['crypted'], $_POST['captcha'])) {
    echo json_encode(array('response' => 'Sorry, the CAPTCHA code you entered was not correct!'));
} else {
    echo json_encode(array('status' => '200'));
    // mail function
}

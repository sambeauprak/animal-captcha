<?php
if (!defined('ZOOCAPTCHA1')) {
    header('HTTP/1.0 403 Forbidden');
    exit;
}

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') &&
$_SERVER['REQUEST_METHOD'] == 'POST') {
    require ABSPATH . 'src/CaptchaNonceNoCookie.php';
    require ABSPATH . 'src/Cors.php';

    Cors::setCors();


    if (!CaptchaNonceNoCookie::validate($_POST['crypted'], $_POST['captcha'])) {
        echo json_encode(array(
            'sent' => false,
            'message' => 'Sorry, the CAPTCHA code you entered was not correct!'
        ));
    } else {
        
        // mail function
    }
} else {
    header('HTTP/1.0 403 Forbidden');
    exit;
}
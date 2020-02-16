# Animal Captcha
An alternative to Google ReCAPTCHA without cookies in compliance with GDPR

## How does it work?
Animal Captcha generate a simple CAPTCHA graphic incorporated into an HTML form to prevent automated submission by malicious scripts.

The user needs to type in an animal name into an input text field to check whether he is human or not.

Example: ![Captcha preview](docs/preview.png "Captcha preview")

This code doesn't requires a SESSION variable so, no cookies in compliance with GDPR.

## Security

### Preventing direct access PHP file
To prevent direct access on included files, you can define a constant in the main page which includes files and check on all included files whether the constant is defined or not.

In the main page:
```php
define('MyConstant', true);
```

In the included files
```php
if(!defined('MyConstant')) {
  header('HTTP/1.0 403 Forbidden');
  exit;
}
```

You can also prevent direct access and allows the access only if the request is an AJAX call by adding headers in the AJAX Call
```JavaScript
headers: new Headers({
    "X-Requested-With": "XMLHttpRequest"
})
```

and check in the included PHP files if the XMLHttpRequest has passed
```php
if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ) ) {
    // execute the code
} else {
    // Return a 403 status error
    header('HTTP/1.0 403 Forbidden');
    exit();
}
```

## Routes
Animal Captcha comes with a simple PHP router (thanks to Tania Rasca).

Here's the list of routes available:
* `/`&nbsp;&nbsp;&nbsp;&nbsp; index page
* `/captcha`&nbsp;&nbsp;&nbsp;&nbsp; generates a captcha image
* `/send`&nbsp;&nbsp;&nbsp;&nbsp; form action
* `default`&nbsp;&nbsp;&nbsp;&nbsp; by default, a 404 page is displayed

## Getting started

### Clone the repository

```git
# using SSH
git clone git@github.com:sambeauprak/animal-captcha.git
```

```git
# using HTTPS
git clone https://github.com/sambeauprak/animal-captcha.git
```

### Edit the mail action page
```php
// views/SendMessage.php

<?php
if(!defined('ZOOCAPTCHA1')) {
    header('HTTP/1.0 403 Forbidden');
    exit;
 }
require ABSPATH.'src/CaptchaNonceNoCookie.php';

if(!CaptchaNonceNoCookie::validate($_POST['crypted'], $_POST['captcha'])) {
    echo json_encode(array('response' => 'Sorry, the CAPTCHA code you entered was not correct!'));
} else {
    echo json_encode(array('status' => '200'));
    // Type your mail function here
}

```

### Connect with your HTML form

* Set the method to "post" and the action to "/send"
    ```html 
    <form method="post" action="/send">
    ```
* Add a hidden input and set "crypted" as name
    ```html 
    <input type="hidden" name="crypted" value="">
    ```
* Add an image with an empty src 
    ```html
    <img src="" alt="Captcha">
    ```
* Add a required input text field and set the name as "captcha" 
    ```html
    <input type="text" required name="captcha">
    ```
</form>


```html
<!-- Example -->
<form method="POST" action="/send">
    <input type="hidden" name="crypted" value="">
    <p><img src="" alt="Captcha"></p>
    <p>CAPTCHA: <input type="text" required name="captcha"><br>
    <p><input type="submit"></p>
</form>
```

* Use JavaScript to generate a Captcha image
    ```JavaScript
        // Generate Captcha
        fetch("/captcha", {
            method: "POST",
            headers: new Headers({
                "X-Requested-With": "XMLHttpRequest"
            })
        }).then(function(response) {
            return response.json()
        }).then(function(values) {
            document.querySelector('input[name=crypted]').value = values.crypted;
            document.querySelector('img[alt=Captcha]').src = values.image;
            document.querySelector('input[name=captcha]').pattern = '\\w{' + values.digits + '}';
        })
    ```

And now you should have a form with a Captcha image protection like this:

![Captcha preview](docs/preview.png "Captcha preview")

That's it !

### Credits
Thanks to :
* Tania Rasca and her great [simple PHP router](https://www.taniarascia.com/the-simplest-php-router/) 
* The Art of Web and their [CAPTCHA with no cookies implementation](https://www.the-art-of-web.com/php/captcha-no-cookie/) 

All credits go to these awesome coders!

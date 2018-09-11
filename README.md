# PHP Simple Captcha 

A php simple captcha implementation that suite to any type of system built on php.

[![Latest Stable Version](https://img.shields.io/packagist/v/lorddashme/php-simple-captcha.svg?style=flat-square)](https://packagist.org/packages/lorddashme/php-simple-captcha) [![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%205.6-8892BF.svg?style=flat-square)](https://php.net/) [![Build Status](https://img.shields.io/travis/LordDashMe/php-simple-captcha/master.svg?style=flat-square)](https://travis-ci.org/LordDashMe/php-simple-captcha) [![Coverage Status](https://img.shields.io/coveralls/LordDashMe/php-simple-captcha/master.svg?style=flat-square)](https://coveralls.io/github/LordDashMe/php-simple-captcha?branch=master)

## Requirement(s)

- PHP version from 5.6.* up to latest.

## Install

- It's advice to install the package via Composer. Use the command below to install the package:

```txt
composer require lorddashme/php-simple-captcha
```

## Usage

- The basic usage of the package:

```php
<?php

include __DIR__  . '/vendor/autoload.php';

use LordDashMe\SimpleCaptcha\Captcha;

// Initialize the captcha class.
$captcha = new Captcha();

// Execute the random generation of code.
$captcha->code();

// Execute the image captcha rendering.
$captcha->image();

// The generated captcha code, something like "QwErTyx..."
echo $captcha->getCode(); 

// The generated captcha image that included the code above  
// and the output is base64 data image "data:image/png;base64,iVBORw0KGgoAA..."
echo $captcha->getImage(); 
```
- The package also provided a simple way to validate the user input code base on the captcha image:
  
  - For example we have a registration page file:
    ```php
    <?php
    
    // registration-page.php

    include __DIR__  . '/vendor/autoload.php';

    use LordDashMe\SimpleCaptcha\Captcha;

    $captcha = new Captcha();
    $captcha->code();
    $captcha->image();
    $captcha->storeSession();
    ?>
    <form method="POST" action="/reg-validation-page.php">
      ...
      <img src="<?php echo $captcha->getImage(); ?>">
      <input type="text" name="user_captcha_code" value="">
    </form>
    ```
  - And the validation page file:
    ```php
    <?php 
    
    // reg-validation-page.php
    
    include __DIR__  . '/vendor/autoload.php';

    use LordDashMe\SimpleCaptcha\Captcha;

    $captcha = new Captcha();
    $data = $captcha->getSession(); // return(s) array( 'code' => 'QwErTyx...' )
    
    if ($_POST['user_captcha_code'] === $data['code']) {
      return 'Code is valid!';
    } else {
      return 'Code is invalid!';
    }
    ```

## License

This package is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

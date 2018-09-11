# PHP Simple Captcha 

A php simple captcha implementation that suite to any type of system built on php.

[![Latest Stable Version](https://img.shields.io/packagist/v/LordDashMe/php-simple-captcha.svg?style=flat-square)](https://packagist.org/packages/LordDashMe/php-simple-captcha) [![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%205.6-8892BF.svg?style=flat-square)](https://php.net/) [![Build Status](https://img.shields.io/travis/LordDashMe/php-simple-captcha/master.svg?style=flat-square)](https://travis-ci.org/LordDashMe/php-simple-captcha) [![Coverage Status](https://img.shields.io/coveralls/LordDashMe/php-simple-captcha/master.svg?style=flat-square)](https://coveralls.io/github/LordDashMe/php-simple-captcha?branch=master)

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

// The generated captcha code, something like "QwErtyx..."
echo $captcha->getCode(); 

// The generated captcha image that include the code above and 
// the output is base64 url "data:image/png;base64,iVBORw0KGgoAA..."
echo $captcha->getImage(); 
```

## License

This package is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

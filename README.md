# PHP Simple Captcha 

A simple captcha package that suite to any type of web application built on php.

[![Latest Stable Version](https://img.shields.io/packagist/v/lorddashme/php-simple-captcha.svg?style=flat-square)](https://packagist.org/packages/lorddashme/php-simple-captcha) [![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%205.6-8892BF.svg?style=flat-square)](https://php.net/) [![Build Status](https://img.shields.io/travis/LordDashMe/php-simple-captcha/master.svg?style=flat-square)](https://travis-ci.org/LordDashMe/php-simple-captcha) [![Coverage Status](https://img.shields.io/coveralls/LordDashMe/php-simple-captcha/master.svg?style=flat-square)](https://coveralls.io/github/LordDashMe/php-simple-captcha?branch=master)

## Sample

![PHP Simple Captcha](resources/img/simple-captcha-sample.png) ![PHP Simple Captcha 1](resources/img/simple-captcha-sample-1.png) ![PHP Simple Captcha 2](resources/img/simple-captcha-sample-2.png) ![PHP Simple Captcha 3](resources/img/simple-captcha-sample-3.png)

## Requirement(s)

- PHP version from 5.6.* up to latest.

## Install

- It is advice to install the package via Composer. Use the command below to install the package:

```txt
composer require lorddashme/php-simple-captcha
```

## Usage

- Below are the available functions:

| Function | Description |
| -------- | ----------- |
| <img width=200/>  |<img width=200/> |
| ```code(length);``` | Execute the generation of random code base on the given length. <br> (Default length is 5) |
| ```image();``` | Execute the generation of image and the content will be base on the ```code(length);``` method. |
| ```getCode();``` | To get the current code generated by the ```code(length);``` method. <br> (Example return value ```QwErTyx...```) |
| ```getImage();``` | To get the current image generated by the ```image();``` method. <br> (Example return value ```data:image/png;base64,iVBORw0KGgoAA...```) |
| ```storeSession();``` | Use to store the generated values in the captcha session. This is use for validation in another request or page. |
| ```getSession();``` | Use to get the current stored session generated values in the captcha session. This is use to validate the generated code against the user organic inputed code. <br> (Example return value ```array('code' => '...')```) |

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

- Basic usage can also be done by the implementation below:

```php
<?php

include __DIR__  . '/vendor/autoload.php';

use LordDashMe\SimpleCaptcha\Facade\Captcha;

// Initialize the facade captcha class.
Captcha::init();
// Execute the random generation of code.
Captcha::code();
// Execute the image captcha rendering.
Captcha::image();

// The generated captcha code, something like "QwErTyx..."
echo Captcha::getCode();
// The generated captcha image that included the code above  
// and the output is base64 data image "data:image/png;base64,iVBORw0KGgoAA..."
echo Captcha::getImage();
```

- The package also provided a simple way to validate the user input code.
  
  - For example we have a registration page file:

    - Initialize the Captcha class together with the code and image generation function.

    - Use the ```storeSession()``` to save the generated captcha details in the captcha own session.

    - The stored session is essential for validating the user input.

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

            Your other fields here...

            <img src="<?php echo $captcha->getImage(); ?>">
            <input type="text" name="user_captcha_code" value="">
            <input type="submit" value="Register">

        </form>
        ```
  - And the validation page file:

    - We need to initialize again the Captcha class but now we don't need to initialize the code and image generation.

    - The generation will only be use when we want to show a new captcha image and code.

    - But in this scenario we want only to validate the user input captcha code.

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

- To change the default configuration setup of the Captcha class you can override the below codes:

```php
<?php

include __DIR__  . '/vendor/autoload.php';

use LordDashMe\SimpleCaptcha\Captcha;
use LordDashMe\SimpleCaptcha\Facade\Captcha as CaptchaFacade;

$config = array(
    'session_name'       => 'ldm-simple-captcha',
    'session_index_name' => 'LDM_SIMPLE_CAPTCHA',
    'session_https'      => false,
    'session_http_only'  => true,
    'font_color'         => '#999',
    'font_size_min'      => 28,
    'font_size_max'      => 28,
    'angle_min'          => 0,
    'angle_max'          => 10,
    'shadow'             => true,
    'shadow_color'       => '#fff',
    'shadow_offset_x'    => -3,
    'shadow_offset_y'    => 1,
    'backgrounds' => array(
        '45-degree-fabric.png',
        'cloth-alike.png',
        'grey-sandbag.png',
        'kinda-jean.png',
        'polyester-lite.png',
        'stitched-wool.png',
        'white-carbon.png',
        'white-wave.png'
    ),
    'fonts' => array(
        'times_new_yorker.ttf'
    )
);

$captcha = new Captcha($config);

// Or in a static like class initialization.

CaptchaFacade::init($config);
```

- Note in overriding the config of Captcha class.

  1. The ```backgrounds``` and ```fonts``` are tightly coupled in the directory of the plugin.
  
  2. If you want to override the ```backgrounds``` and ```fonts``` you need to extends the Captcha class with your New class that overrides the protected methods of Captcha class for resources directory ```backgroundsDirectoryPath()``` and ```fontsDirectoryPath```.

    ```php
    <?php

    include __DIR__  . '/vendor/autoload.php';

    use LordDashMe\SimpleCaptcha\Captcha;

    class MyNewCaptcha extends Captcha
    {
        public function __construct($config = array())
        {
            parent::__construct($config);
        }

        protected function backgroundsDirectoryPath()
        {
            return 'path/to/your/custom/backgrounds/';
        }

        protected function fontsDirectoryPath()
        {
            return 'path/to/your/custom/fonts/'; 
        }
    }
    ```

## License

This package is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

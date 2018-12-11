# PHP Simple Captcha 

A simple captcha package that fit to any type of web application built on php.

[![Latest Stable Version](https://img.shields.io/packagist/v/lorddashme/php-simple-captcha.svg?style=flat-square)](https://packagist.org/packages/lorddashme/php-simple-captcha) [![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%205.6-8892BF.svg?style=flat-square)](https://php.net/) [![Build Status](https://img.shields.io/travis/LordDashMe/php-simple-captcha/master.svg?style=flat-square)](https://travis-ci.org/LordDashMe/php-simple-captcha) [![Coverage Status](https://img.shields.io/coveralls/LordDashMe/php-simple-captcha/master.svg?style=flat-square)](https://coveralls.io/github/LordDashMe/php-simple-captcha?branch=master)

## Sample

![PHP Simple Captcha Sample 1](resources/img/sample1.png) ![PHP Simple Captcha Sample 2](resources/img/sample2.png) ![PHP Simple Captcha Sample 3](resources/img/sample3.png) ![PHP Simple Captcha Sample 4](resources/img/sample4.png)

## Requirement(s)

- PHP version from 5.6.* up to latest.

## Install

- Recommended to install using Composer. Use the command below to install the package:

```txt
composer require lorddashme/php-simple-captcha
```

## Usage

- List of available functions:

| Function | Description |
| -------- | ----------- |
| <img width=200/>  |<img width=200/> |
| ```code(length);``` | Execute the generation of random code base on the given length. <br> The default length is 5. |
| ```image();``` | Execute the generation of image and the content will be base on the ```code(length);``` function. |
| ```getCode();``` | To get the current code generated by the ```code(length);``` method. <br> The example return value ```QwErTyx...``` |
| ```getImage();``` | To get the current image generated by the ```image();``` function. <br> The example return value ```data:image/png;base64,iVBORw0KGgoAA...``` |
| ```storeSession();``` | Use to store the generated values in the captcha session. This is use for validation in another request or page. |
| ```getSession();``` | Use to get the current stored session generated values in the captcha session. This is use to validate the generated code against the user organic inputed code. <br> The example return value ```array('code' => '...')``` |

- Basic usage:

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
// The generated captcha image that include the code above. 
// The output is base64 data image "data:image/png;base64,iVBORw0KGgoAA..."
echo $captcha->getImage();
```

- Also can be done by using the code below:

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
// The generated captcha image that include the code above.  
// The output is base64 data image "data:image/png;base64,iVBORw0KGgoAA..."
echo Captcha::getImage();
```

### Session Captcha Usage

- The package also provided a simple way to validate the user input code.
  
  - For example we have a login page:

    - Initialize the Captcha class together with the code and image generation process.

    - Use the ```storeSession()``` to save the generated details in the captcha session.

    - The stored session is essential for validating the user input later on.

    ```php
    <?php

    // login.php

    include __DIR__  . '/vendor/autoload.php';

    use LordDashMe\SimpleCaptcha\Captcha;

    $captcha = new Captcha();
    $captcha->code();
    $captcha->image();
    $captcha->storeSession();

    ?>

    <form action="validate-login.php" method="POST">

      ...

      <img src="<?php echo $captcha->getImage(); ?>">
      <input type="text" name="user_captcha_code" value="">

      <input type="submit" value="Login">

    </form>
    ```
  - And the validation route:

    - We need to initialize again the Captcha class but now we don't need to initialize the code and image generation.

    - The generation will only be use when we want to show a new captcha image and code.

    - In this scenario we want only to validate the user input captcha code.

    ```php
    <?php

    // validate-login.php

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

   - You may also check the [sample](sample) in the root directory of the package that will show you the actual implementation.

### Captcha Configuration

- To change the default config:

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
    'font_color'         => '#000',
    'font_size_min'      => 26,
    'font_size_max'      => 28,
    'angle_min'          => 0,
    'angle_max'          => 9,
    'shadow'             => true,
    'shadow_color'       => '#fff',
    'shadow_offset_x'    => -3,
    'shadow_offset_y'    => 1,
    'backgrounds' => array(
        'bg1.png',
        'bg2.png',
        'bg3.png',
        'bg4.png',
        'bg5.png',
        'bg6.png',
        'bg7.png',
        'bg8.png'
    ),
    'fonts' => array(
        'capsmall_clean.ttf'
    )
);

$captcha = new Captcha($config);

// Or in a static like class initialization.

CaptchaFacade::init($config);
```

### Note

- Overriding the default config:

  - The ```backgrounds``` and ```fonts``` are tightly coupled in the directory of the package.
  
  - If you want to override the ```backgrounds``` and ```fonts``` you need to extends the Captcha class with your new class that overrides the protected methods of Captcha class for resources directory ```backgroundsDirectoryPath()``` and ```fontsDirectoryPath```.

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

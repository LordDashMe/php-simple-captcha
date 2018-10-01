<?php

require __DIR__ . '/../vendor/autoload.php';

use LordDashMe\SimpleCaptcha\Captcha;

$captcha = new Captcha();
$captcha->code();
$captcha->image();
$captcha->storeSession();

?>
<!DOCTYPE html>
<html>
<head>
    <title>PHP Simple Captcha</title>
</head>
<body>
    <form action="validate-login.php" method="POST">
        <label>Username:</label>
        <input type="text" id="username" name="username" value="" />
        <br>
        <br>
        <label>Password:</label>
        <input type="password" id="password" name="password" value="" autocomplete="off" />
        <br>
        <br>
        <img src="<?php echo $captcha->getImage(); ?>">
        <br>
        <input type="text" id="user_captcha_code" name="user_captcha_code" value="" />
        <br>
        <br>
        <input type="submit" id="login_submit" name="login_submit" value="Login" />
    </form>
</body>
</html>
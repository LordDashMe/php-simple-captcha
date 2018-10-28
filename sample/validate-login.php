<?php

if (! isset($_POST['login_submit'])) {
    header('Location: login.php');
}

require __DIR__ . '/../vendor/autoload.php';

use LordDashMe\SimpleCaptcha\Captcha;

$captcha = new Captcha();
$data = $captcha->getSession();

if ($_POST['user_captcha_code'] === $data['code']) {
    echo 'Code is valid!';
} else {
    echo 'Code is invalid!';
}

<?php

namespace LordDashMe\SimpleCaptcha\Tests\Unit\Facade;

use PHPUnit\Framework\TestCase;
use LordDashMe\SimpleCaptcha\Facade\Captcha;

class CaptchaTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_init_captcha_class_in_a_static_way()
    {
        Captcha::init();
    }
}
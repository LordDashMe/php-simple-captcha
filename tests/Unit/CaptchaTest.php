<?php

namespace LordDashMe\SimpleCaptcha\Tests\Unit;

use Mockery as Mockery;
use PHPUnit\Framework\TestCase;
use LordDashMe\SimpleCaptcha\Captcha;

class CaptchaTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_load_captcha_class()
    {
        $this->assertInstanceOf(Captcha::class, new Captcha());
    }

    /**
     * @test
     */
    public function it_should_generate_captcha_code_base_on_the_given_length()
    {
        $captcha = new Captcha();
        $captcha->code(5);

        $this->assertEquals(5, strlen($captcha->getCode()));
    }

    /**
     * @test
     */
    public function it_should_generate_captcha_image_base_on_the_generated_code()
    {
        $captcha = new Captcha();
        $captcha->code(5);
        $captcha->image();

        $this->assertEquals('', $captcha->getImage());
    }
}
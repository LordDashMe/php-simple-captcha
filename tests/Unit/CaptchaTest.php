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

        $this->assertNotEmpty($captcha->getImage());    
    }

    /**
     * @test
     */
    public function it_should_generate_captcha_image_base_on_the_generated_code_with_config_restriction()
    {
        $captcha = new Captcha(array(
            'angle_min' => -1,
            'angle_max' => 11,
            'font_size' => 9
        ));
        $captcha->code(5);
        $captcha->image();

        $this->assertNotEmpty($captcha->getImage());

        $captcha->init(array(
            'angle_min' => 11,
            'angle_max' => -1,
        ));
        $captcha->code(5);
        $captcha->image();

        $this->assertNotEmpty($captcha->getImage());
    }

    /**
     * @test
     */
    public function it_should_store_the_code_in_flash_session()
    {
        $captcha = new Captcha();
        $captcha->code(5);
        $captcha->image();
        $captcha->storeSession();

        $this->assertTrue(isset($_SESSION['PHP_SIMPLE_CAPTCHA']));

        session_write_close();
    }

    /**
     * @test
     * @depends it_should_store_the_code_in_flash_session
     */
    public function it_should_get_the_code_in_flash_session()
    {
        $captcha = new Captcha();

        $captchaStoredData = $captcha->getSession();

        $this->assertTrue(isset($captchaStoredData['code']));
    }

    /**
     * @test
     * @depends it_should_get_the_code_in_flash_session
     */
    public function it_should_get_the_null_value_in_flash_session()
    {
        $captcha = new Captcha();

        $captchaStoredData = $captcha->getSession();

        $this->assertTrue(! isset($captchaStoredData['code']));
    }
}
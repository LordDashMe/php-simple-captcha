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
    public function it_should_generate_captcha_image_without_shadow_base_on_the_generated_code()
    {
        $captcha = new Captcha(array('shadow' => false));
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
            'font_size_min' => 9
        ));
        $captcha->code(4);
        $captcha->image();

        $this->assertNotEmpty($captcha->getImage());

        $captcha->init(array(
            'angle_min' => 11,
            'angle_max' => -1,
        ));
        $captcha->code(5);
        $captcha->image();

        $this->assertNotEmpty($captcha->getImage());

        $captcha->init(array(
            'font_size_min' => 11,
            'font_size_max' => -1,
        ));
        $captcha->code(5);
        $captcha->image();

        $this->assertNotEmpty($captcha->getImage());
    }

    /**
     * @test
     */
    public function it_should_generate_captcha_image_and_with_mocked_textbox_size_when_text_position_xmin_greater_than_xmax()
    {
        $captcha = Mockery::mock('LordDashMe\SimpleCaptcha\Captcha[textBoxSize]')
            ->shouldAllowMockingProtectedMethods();
        $captcha->shouldReceive('textBoxSize')
            ->andReturn(array(
                0 => -5,
                1 => 13,
                2 => 228,
                3 => 13,
                4 => 228,
                5 => -34,
                6 => -5,
                7 => -34
            ));
        $captcha->code(5);
        $captcha->image();

        $this->assertNotEmpty($captcha->getImage());   
    }

    /**
     * @test
     */
    public function it_should_generate_captcha_image_and_with_mocked_textbox_size_when_text_position_ymin_greater_than_ymax()
    {
        $captcha = Mockery::mock('LordDashMe\SimpleCaptcha\Captcha[textBoxSize]')
            ->shouldAllowMockingProtectedMethods();
        $captcha->shouldReceive('textBoxSize')
            ->andReturn(array(
                0 => -6,
                1 => 13,
                2 => 110,
                3 => -7,
                4 => 103,
                5 => -47,
                6 => -13,
                7 => -26
            ));
        $captcha->code(5);
        $captcha->image();

        $this->assertNotEmpty($captcha->getImage());
    }

    /**
     * @test
     */
    public function it_should_generate_captcha_image_and_with_mocked_textbox_size_when_text_position_x_and_y_are_minimum_value()
    {
        $captcha = Mockery::mock('LordDashMe\SimpleCaptcha\Captcha[textBoxSize]')
            ->shouldAllowMockingProtectedMethods();
        $captcha->shouldReceive('textBoxSize')
            ->andReturn(array(
                0 => -1,
                1 => 1,
                2 => 120,
                3 => 1,
                4 => 120,
                5 => -27,
                6 => -1,
                7 => -27
            ));
        $captcha->code(5);
        $captcha->image();

        $this->assertNotEmpty($captcha->getImage());
    }

    /**
     * @test
     */
    public function it_should_generate_captcha_image_and_with_mocked_textbox_size_when_text_position_x_and_y_are_not_minimum_value()
    {
        $captcha = Mockery::mock('LordDashMe\SimpleCaptcha\Captcha[textBoxSize]')
            ->shouldAllowMockingProtectedMethods();
        $captcha->shouldReceive('textBoxSize')
            ->andReturn(array(
                0 => -1,
                1 => 9,
                2 => 100,
                3 => 5,
                4 => 99,
                5 => -30,
                6 => -2,
                7 => -27
            ));
        $captcha->code(5);
        $captcha->image();

        $this->assertNotEmpty($captcha->getImage());
    }

    /**
     * @test
     */
    public function it_should_generate_captcha_image_and_with_mocked_text_angle_when_text_angle_is_negative_value()
    {
        $captcha = Mockery::mock('LordDashMe\SimpleCaptcha\Captcha[textAngle]')
            ->shouldAllowMockingProtectedMethods();
        $captcha->shouldReceive('textAngle')
            ->andReturn(-5);
        $captcha->code(5);
        $captcha->image();

        $this->assertNotEmpty($captcha->getImage());
    }

    /**
     * @test
     */
    public function it_should_generate_captcha_image_and_with_mocked_text_angle_when_text_angle_is_positive_value()
    {
        $captcha = Mockery::mock('LordDashMe\SimpleCaptcha\Captcha[textAngle]')
            ->shouldAllowMockingProtectedMethods();
        $captcha->shouldReceive('textAngle')
            ->andReturn(5);
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

        $this->assertTrue(isset($_SESSION['LDM_SIMPLE_CAPTCHA']));

        session_write_close();
    }

    /**
     * @test
     * @depends it_should_store_the_code_in_flash_session
     */
    public function it_should_return_false_in_get_session_when_session_cookie_is_not_set()
    {
        $captcha = new Captcha();

        $captchaStoredData = $captcha->getSession();

        $this->assertTrue(! $captchaStoredData);
    }

    /**
     * @test
     * @depends it_should_store_the_code_in_flash_session
     */
    public function it_should_get_the_code_in_flash_session()
    {
        $_COOKIE['ldm-simple-captcha'] = 'mocked session cookie.';

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
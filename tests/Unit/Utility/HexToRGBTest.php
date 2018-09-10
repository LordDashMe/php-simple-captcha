<?php

namespace LordDashMe\SimpleCaptcha\Tests\Unit\Utility;

use Mockery as Mockery;
use PHPUnit\Framework\TestCase;
use LordDashMe\SimpleCaptcha\Utility\HexToRGB;

class HexToRGBTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_load_hex_to_rgb_class()
    {
        $this->assertInstanceOf(HexToRGB::class, new HexToRGB());
    }

    /**
     * @test
     * @expectedException LordDashMe\SimpleCaptcha\Exception\Utility\HexToRGB
     * @expectedExceptionCode 100
     */
    public function it_should_throw_invalid_string_type_when_given_hex_is_not_string()
    {
        HexToRGB::convert(null);
    }

    /**
     * @test
     * @expectedException LordDashMe\SimpleCaptcha\Exception\Utility\HexToRGB
     * @expectedExceptionCode 101 
     */
    public function it_should_throw_invalid_string_length_when_given_hex_is_not_valid_length()
    {
        HexToRGB::convert('null');
    }

    /**
     * @test
     */
    public function it_should_convert_given_hex_string_to_rgb_in_array_return_type()
    {
        $rgb = HexToRGB::convert('#555');

        $this->assertInternalType('array', $rgb);
    }
    
    /**
     * @test
     */
    public function it_should_convert_given_hex_string_to_rgb_in_string_return_type()
    {
        $rgb = HexToRGB::convert('#555', true);

        $this->assertInternalType('string', $rgb);
    }

    /**
     * @test
     */
    public function it_should_convert_given_hex_string_with_6_length_to_rgb_in_array_return_type()
    {
        $rgb = HexToRGB::convert('#555555');

        $this->assertInternalType('array', $rgb);
    }
}
<?php

/*
 * This file is part of the Simple Captcha.
 *
 * (c) Joshua Clifford Reyes <reyesjoshuaclifford@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LordDashMe\SimpleCaptcha\Utility;

use LordDashMe\SimpleCaptcha\Exception\Utility\HexToRGB as HexToRGBException;

/**
 * HexToRGB Utility Class.
 * 
 * @author Joshua Clifford Reyes <reyesjoshuaclifford@gmail.com>
 */
class HexToRGB
{
    /**
     * The convert process of hex to rgb type.
     * This only accept hex string data type.
     * 
     * @param  string  $hexString          The hex string that will be converted.
     * @param  bool    $returnAsString     (Optional) The return type if string.
     * @param  string  $separator          (Optional) The separator if the return type is string.
     * 
     * @throws LordDashMe\SimpleCaptcha\Exception\Utility\HexToRGB::isInvalidStringType
     * @throws LordDashMe\SimpleCaptcha\Exception\Utility\HexToRGB::isInvalidStringLength
     * 
     * @return array|string
     */
    public static function convert($hexString, $returnAsString = false, $separator = ',')
    {
        if (! \is_string($hexString)) {
            throw HexToRGBException::isInvalidStringType();
        }

        $hexString = \preg_replace("/[^0-9A-Fa-f]/", '', $hexString);

        $rgb = array();

        if (\strlen($hexString) === 6) {

            $color = \hexdec($hexString);
            $rgb['r'] = 0xFF & ($color >> 0x10);
            $rgb['g'] = 0xFF & ($color >> 0x8);
            $rgb['b'] = 0xFF & $color;

        } else if (\strlen($hexString) === 3) {

            $rgb['r'] = \hexdec(\str_repeat(\substr($hexString, 0, 1), 2));
            $rgb['g'] = \hexdec(\str_repeat(\substr($hexString, 1, 1), 2));
            $rgb['b'] = \hexdec(\str_repeat(\substr($hexString, 2, 1), 2));

        } else {
            throw HexToRGBException::isInvalidStringLength();
        }

        return ($returnAsString) ? \implode($separator, $rgb) : $rgb;
    }
}
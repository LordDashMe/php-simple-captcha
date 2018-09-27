<?php

/*
 * This file is part of the Simple Captcha.
 *
 * (c) Joshua Clifford Reyes <reyesjoshuaclifford@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LordDashMe\SimpleCaptcha\Exception\Utility;

use LordDashMe\SimpleCaptcha\Exception\CaptchaException;

/**
 * Hex To RGB Exception Class.
 * 
 * @author Joshua Clifford Reyes <reyesjoshuaclifford@gmail.com>
 */
class HexToRGB extends CaptchaException
{
    const IS_INVALID_STRING_TYPE = 1;
    const IS_INVALID_STRING_LENGTH = 2;

    public static function isInvalidStringType(
        $message = 'The string type is invalid.', 
        $code = self::IS_INVALID_STRING_TYPE, 
        $previous = null
    ) {
        return new static($message, $code, $previous);
    }

    public static function isInvalidStringLength(
        $message = 'The string length is invalid.', 
        $code = self::IS_INVALID_STRING_LENGTH, 
        $previous = null
    ) {
        return new static($message, $code, $previous);
    }
}
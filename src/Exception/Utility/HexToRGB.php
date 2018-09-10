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

use LordDashMe\SimpleCaptcha\Exception\Captcha as CaptchaException;

/**
 * Hex To RGB Exception Class.
 * 
 * @author Joshua Clifford Reyes <reyesjoshuaclifford@gmail.com>
 */
class HexToRGB extends CaptchaException
{
    const ERROR_CODE_UNRESOLVED_STRING_TYPE = 100;
    const ERROR_CODE_UNRESOLVED_STRING_LENGTH = 101;

    public static function isInvalidStringType($message = '', $code = null, $previous = null)
    {
        $message = 'The string type is invalid.';
        return new static($message, self::ERROR_CODE_UNRESOLVED_STRING_TYPE, $previous);
    }

    public static function isInvalidStringLength($message = '', $code = null, $previous = null)
    {
        $message = 'The string length is invalid.';
        return new static($message, self::ERROR_CODE_UNRESOLVED_STRING_LENGTH, $previous);
    }
}
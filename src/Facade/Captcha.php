<?php

/*
 * This file is part of the Simple Captcha.
 *
 * (c) Joshua Clifford Reyes <reyesjoshuaclifford@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LordDashMe\SimpleCaptcha\Facade;

use LordDashMe\StaticClassInterface\Facade;

/**
 * Captcha Facade Class.
 * 
 * @author Joshua Clifford Reyes <reyesjoshuaclifford@gmail.com>
 */
class Captcha extends Facade
{
    /**
     * {@inheritdoc}
     */
    public static function getStaticClassAccessor()
    {
        return 'LordDashMe\SimpleCaptcha\Captcha';
    }
}
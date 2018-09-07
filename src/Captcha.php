<?php

/*
 * This file is part of the Simple Captcha.
 *
 * (c) Joshua Clifford Reyes <reyesjoshuaclifford@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LordDashMe\SimpleCaptcha;

/**
 * Captcha Facade Class.
 * 
 * A php simple captcha implementation that suite to any type of system built on php.
 * 
 * @author Joshua Clifford Reyes <reyesjoshuaclifford@gmail.com>
 */
class Captcha
{
    /**
     * The captcha generated unique code.
     * 
     * @return string 
     */
    protected $code = '';

    /**
     * The captcha generated image code.
     * 
     * @return string
     */
    protected $image = '';

    public function __construct() {}

    /**
     * The getter method for the code property class.
     * 
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }
    
    /**
     * The code generated by the generate unique code method base
     * on the given length. The code generated will be pass to the
     * code property that will be use to print an image of captcha code.
     * 
     * @param  int  $length  The given length for the captcha code.
     * 
     * @return $this
     */
    public function code($length)
    {
        $this->code = $this->generateUniqueCode($length);

        return $this;
    }
    
    /**
     * Generate unique code base on the given length and
     * the allowed code characters.
     * 
     * @param  int  $length   The code max length to be generate.
     * 
     * @return string
     */
    protected function generateUniqueCode($length)
    {
        $characters = $this->allowedCodeCharacters();
        $charactersLength = (strlen($characters) - 1);
        
        $code = '';
        
        for ($i = 0; $i < $length; $i++) {
            $number = rand(0, $charactersLength);
            $jumbleNumber = rand(0, $number);
            $code .= $characters[$jumbleNumber];
        }
        
        return $code;   
    }

    /**
     * The allowed code characters that can be generated
     * by the generated unique code method.
     * 
     * @return string
     */
    protected function allowedCodeCharacters()
    {
        return 'ABCDEFGHJKLMNPRSTUVWXYZabcdefghjkmnprstuvwxyz23456789';
    }

    /**
     * The image generated by the generated image captcha method.
     * 
     * @return $this
     */
    public function image()
    {

    }

    /**
     * The getter method for the image property class.
     * 
     * @return string
     */
    public function getImage()
    {
        
    }
}
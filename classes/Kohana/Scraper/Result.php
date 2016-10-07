<?php

defined('SYSPATH') OR die('No direct script access.');

/**
 * @package    Kohana/Scraper
 * @author     Dariusz Rorat
 * @copyright  (c) 2016 Dariusz Rorat
 * @license    BSD
 */
class Kohana_Scraper_Result
{
    // Raw result resource
    protected $_result;

    public function __construct($result)
    {
        $this->_result = $result;
    }

    public function as_plaintext()
    {
        return $this->_result->plaintext;
    }

    public function as_htmldom()
    {
        return $this->_result;
    }

    public function get($selector, $idx=null, $lowercase=false)
    {
        return $this->_result->find($selector, $idx, $lowercase);
    }

    public function __toString()
    {
        return (string) $this->as_htmldom();
    }
}

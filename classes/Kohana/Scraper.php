<?php

defined('SYSPATH') OR die('No direct access allowed.');

include Kohana::find_file('vendor', 'simplehtmldom/simple_html_dom');

class Kohana_Scraper
{
    const FROM_FILE = 10;
    const FROM_STRING = 20;

    protected $_input;
    protected $_mode;

    /**
    * Creates and returns a Scraper.
    * @param   string  input
    * @param   int mode
    * @return  Scraper
    */

    public static function factory($input, $mode = Scraper::FROM_FILE)
    {
        return new Scraper($input, $mode);
    }

    protected function __construct($input, $mode = Scraper::FROM_FILE)
    {
        $this->_input = $input;
        $this->_mode = $mode;
    }

    public function execute()
    {
        return $this->_execute_parser();
    }

    /**
     * Get HTML DOM from file or string
     * @return  Scraper_Result
     * @throws Scraper_Exception
     */

    protected function _execute_parser()
    {
        switch ($this->_mode)
        {
            case Scraper::FROM_FILE:
            {
                if (Kohana::$profiling)
                {
                    $benchmark = Profiler::start("Scraper", $this->_input);
                }
                try
                {
                    $html = file_get_html($this->_input);
                }
                catch (Exception $ex)
                {
                    throw new Scraper_Exception($ex->getMessage());
                }
            }
            break;
            case Scraper::FROM_STRING:
            {
                if (Kohana::$profiling)
                {
                    $benchmark = Profiler::start("Scraper", substr($this->_input, 0, 200));
                }
                try
                {
                    $html = str_get_html($this->_input);
                }
                catch (Exception $ex)
                {
                    throw new Scraper_Exception($ex->getMessage());
                }
            }
            break;
        }

        if (isset($benchmark))
        {
            Profiler::stop($benchmark);
        }
        return new Scraper_Result($html);
    }
}

// End Scraper

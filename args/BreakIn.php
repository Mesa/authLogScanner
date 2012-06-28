<?php
/**
 * @author Mesa <mesa@xebro.de>
 * @license http://creativecommons.org/licenses/by-nc-sa/3.0/
 * @link    http://www.xebro.de
 */
class BreakIn extends Args
{
    protected $names = null;

    public function __construct()
    {
        $this->order = 1;
        $this->regex = "/[(?<ip>\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3})] failed - POSSIBLE BREAK-IN ATTEMPT/";
        $trenner = $this->getTrenner();
        $this->headline = $trenner . "====>  Possible Break in <====\n" . $trenner;
    }

    public function scanLine ( $text )
    {
        preg_match($this->regex, $text, $matches);

        if ( isset($matches["ip"])) {
            $this->addIp($matches["ip"]);
        }
    }
}

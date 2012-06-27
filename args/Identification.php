<?php

class Identification extends Args
{
    public function __construct()
    {
        $this->regex = "/Did not receive identification string from (?<ip>\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3})/";
        $trenner = $this->getTrenner();
        $this->headline = $trenner . "===> No Identification <===\n" . $trenner;
        $this->post_text = $trenner ."\n";
    }

    public function scanLine ( $text )
    {
        preg_match($this->regex, $text, $matches);

        if ( isset($matches["ip"])) {
            $this->addIp($matches["ip"]);
        }
    }
}
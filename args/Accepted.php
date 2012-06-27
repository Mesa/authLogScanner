<?php

class Accepted extends Args
{
    public function __construct()
    {
        $this->regex = "/Accepted publickey for (?<name>\w+) from (?<ip>\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3})/";
        $trenner = $this->getTrenner();
        $this->headline = $trenner . "====>    Accepted    <====\n" . $trenner;
        $this->post_text = $trenner ."\n";
    }

    public function scanLine ( $text )
    {
        preg_match($this->regex, $text, $matches);

        if ( isset($matches["ip"])) {
            $this->addIp($matches["ip"]);
        }

        if ( isset($matches["name"])) {
            if (! isset($this->names[$matches["name"]])){
                $this->names[$matches["name"]] = 1;
            } else {
                $this->names[$matches["name"]]++;
            }
        }
    }

    public function getData ()
    {
        $data = $this->pre_text;
        $data .= $this->headline;

        $list = $this->speicher->getAll();

        foreach ($list as $key => $value) {
            $data .= sprintf("%-16s => %3d\n",$key, $value);
        }
        $data .= sprintf("\n%'_".$this->trenner_length."s\n","Names");

        foreach ( $this->names as $key => $value) {
            $data .= sprintf("%-17s => %3d\n", $key, $value);
        }

        $data .= "\n\n";
        return $data;
    }
}
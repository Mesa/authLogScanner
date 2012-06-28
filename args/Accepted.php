<?php
/**
 * @author Mesa <mesa@xebro.de>
 * @license http://creativecommons.org/licenses/by-nc-sa/3.0/
 * @link    http://www.xebro.de
 */
class Accepted extends Args
{
    protected $names = null;

    public function __construct()
    {
        $this->regex = "/Accepted publickey for (?<name>\w+) from (?<ip>\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3})/";
        $trenner = $this->getTrenner();
        $this->headline = $trenner . "====>    Accepted    <====\n" . $trenner;
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

        if ( count($this->names) > 0 ){

            $data .= sprintf("\n%'_".$this->trenner_length."s\n","Names");
            foreach ($this->names as $key => $value) {
                $data .= sprintf("%-17s => %3d\n", $key, $value);
            }
        }

        if ( $data == $this->pre_text . $this->headline) {
            $data .= "Nothing found";
        }

        $data .= "\n\n";
        return $data;
    }
}
<?php

abstract class Args
{
    protected $speicher = null;
    protected $regex = null;
    protected $headline = null;
    protected $post_text = null;
    protected $pre_text = null;
    public $order = false;
    protected $trenner_length = 25;

    public function setSpeicher( Speicher $speicher)
    {
        $this->speicher = $speicher;
    }

    protected function addIp ( $ip )
    {
        $this->speicher->add($ip);
    }

    public function getData ( )
    {
        $data = $this->pre_text;
        $data .= $this->headline;

        $list = $this->speicher->getAll();

        foreach ($list as $key => $value) {
            $data .= sprintf("%-16s => %3d\n",$key, $value);
        }
        $data .= $this->post_text;

        return $data;
    }

    protected function getTrenner()
    {
        $string = "";
        for ( $i=0; $i<=$this->trenner_length;$i++) {
            $string .= "-";
        }
        return $string . "\n";
    }

    abstract public function scanLine( $text );
}
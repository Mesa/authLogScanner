<?php
/**
 * @author Mesa <mesa@xebro.de>
 * @license http://creativecommons.org/licenses/by-nc-sa/3.0/
 * @link    http://www.xebro.de
 */

class FileScannerException extends Exception
{
    public function printMessage ()
    {
        $msg  = $this->message . "\n";
        $msg .= $this->file . " [" . $this->line ."]\n";
        $msg .= "----------\n";
        $msg .= $this->getTraceAsString();
        return $msg;
    }
}
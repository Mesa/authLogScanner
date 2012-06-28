<?php

class FileScannerException extends Exception
{
    public function printMessage ()
    {
        echo $this->message . "\n";
        echo $this->file . " [" . $this->line ."]\n";
        echo "----------\n";
        echo $this->getTraceAsString();
    }
}
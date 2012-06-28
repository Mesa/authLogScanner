<?php
/**
 * @author Mesa <mesa@xebro.de>
 * @license http://creativecommons.org/licenses/by-nc-sa/3.0/
 * @link    http://www.xebro.de
 */
class FileScanner
{
    protected $file = null;
    protected $args_obj = null;

    protected function setFile ( $file )
    {
        if (is_file($file) and is_readable($file)) {
            $this->file = $file;
        } else {
            throw new FileScannerException("File not found [". $file . "]");
        }
    }

    protected function loadArgs( $dir )
    {
        if ( $dir == "") {
            throw new FileScannerException("Dir was empty");
        }

        $path = __DIR__ ."/". $dir;

        if ( substr($path, -1) != "/") {
            $path .= "/";
        }

        if (is_dir($path)) {
            /**
             * Delete all "old" arg objects from last scan
             */
            $this->args_obj = array();
            $dir = glob($path . "*.php");

            foreach ($dir as $file) {
                $data = pathinfo($file);
                include $file;
                $obj =  new $data["filename"]();
                $obj->setSpeicher(new Speicher());
                if ($obj->order !== false) {
                    insertArray($this->args_obj, array($obj), $obj->order);
                } else {
                    $this->args_obj[] = $obj;
                }
            }
        } else {
            throw new FileScannerException("Directory not found [" . $dir . "]");
        }
    }

    public function scanFile ( $file, $args_dir )
    {
        $this->setFile($file);
        $this->loadArgs($args_dir);

        $all_lines = file($this->file);

        foreach ($all_lines as $line) {
            foreach ($this->args_obj as $obj) {
                $obj->scanLine($line);
            }
        }

        $data = "";
        foreach ($this->args_obj as $obj) {
            $data .= $obj->getData();
        }

        return $data;
    }
}
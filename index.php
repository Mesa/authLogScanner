<?php
/**
 * @author Mesa <mesa@xebro.de>
 * @license http://creativecommons.org/licenses/by-nc-sa/3.0/
 * @link    http://www.xebro.de
 */
require "Speicher.php";
require "Args.class.php";
require "FileScannerException.php";
require "FileScanner.php";

require "config.php";

date_default_timezone_set("UTC");

try {
    $scanner = new FileScanner();
    $data = $scanner->scanFile($auth_log_path, $auth_log_args);
    echo $data;
    /**
     * copy data from origin file to backup.
     */
    $data = file_get_contents($auth_log_path);
    file_put_contents($auth_bak_path . date("y.m.d")."auth.log", $data, FILE_APPEND);
    /**
     * and clear origin file.
     */
    file_put_contents($auth_log_path, "");
} catch (FileScannerException $e) {
    echo $e->printMessage();
} catch ( Exception $e) {
    echo $e->getMessage();
}

function insertArray(&$target, $insert, $position)
{
    $last_part = array_splice($target, $position);
    array_splice($target, count($target), 0, $insert);
    array_splice($target, count($target), 0, $last_part);
}

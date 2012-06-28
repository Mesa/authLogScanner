<?php

include "Speicher.php";
include "Args.class.php";
include "FileScannerException.php";
include "FileScanner.php";

include "config.php";
date_default_timezone_set("UTC");
try {
    $scanner = new FileScanner();
    $data = $scanner->scanFile($auth_log_path, $auth_log_args);
    echo $data;
    $data = file_get_contents($auth_log_path);
    file_put_contents($auth_bak_path . date("y.m.d")."auth.log", $data, FILE_APPEND);
    file_put_contents($auth_log_path, "");
} catch (FileScannerException $e) {
    $e->printMessage();
} catch ( Exception $e) {
    echo $e->getMessage();
}

function insertArray(&$target, $insert, $position) {
    $last_part = array_splice($target, $position);
    array_splice($target, count($target), 0, $insert);
    array_splice($target, count($target), 0, $last_part);
}

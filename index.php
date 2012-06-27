<?php

include "Speicher.php";
include "Args.class.php";
include "FileScannerException.php";
include "FileScanner.php";

include "config.php";

try {
    $scanner = new FileScanner();
    $data = $scanner->scanFile($auth_log_path, $auth_log_args);
    echo $data;
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

<?php

// Making sure we see all the errors
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
ini_set('error_reporting', E_ALL);
ini_set('log_errors', '1');

// Using double-dirname trick to get path to the parent directory
$dbPath = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'db.sqlite';

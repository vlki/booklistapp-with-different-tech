<?php

// Using triple-dirname trick to get path to the grand-parent directory
$dbPath = dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . 'db.sqlite';

return [
    'default' => 'sqlite',

    'connections' => [
        'sqlite' => [
            'driver' => 'sqlite',
            'database' => $dbPath,
            'prefix' => '',
        ],
    ],
];

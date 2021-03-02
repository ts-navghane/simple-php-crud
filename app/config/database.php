<?php

declare(strict_types=1);

$dbConfig = [
    'db_host' => 'spcpostgres',
    'db_port' => '5432',
    'db_user' => 'spc_user',
    'db_pass' => 'spc_pass',
    'db_name' => 'spc_db',
    'db_charset' => 'UTF-8',
];

$dsn = "pgsql:host=".$dbConfig['db_host'].';port='.$dbConfig['db_port'].';dbname='.$dbConfig['db_name'];
$conn = null;

try {
    $conn = new PDO($dsn, $dbConfig['db_user'], $dbConfig['db_pass']);
} catch (PDOException $exception) {
    die('Error in connecting!');
}

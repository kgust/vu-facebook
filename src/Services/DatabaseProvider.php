<?php

namespace VU\App\Services;

use PDO;

/**
 * Provides an instance of the PDO database class.
 */
class DatabaseProvider
{
    public $pdo;

    public function __construct()
    {
        $config = require __DIR__.'/../../config.php';
        $dsn = "mysql:dbname={$config['db']['name']};host={$config['db']['host']}";
        $user = $config['db']['user'];
        $password = $config['db']['pass'];

        $this->pdo = new PDO($dsn, $user, $password);
    }
}

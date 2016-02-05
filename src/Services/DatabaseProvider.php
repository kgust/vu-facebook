<?php

namespace VU\App\Services;

use PDO;
use PDOException;
use StdClass;

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

    /**
     * If database entry exists update it, else create a new one.
     *
     * @param StdClass $photo Class containing the values
     *
     * @return bool Was the insert/update successful?
     */
    public function insertOrUpdate(StdClass $photo)
    {
        try {
            $select = $this->pdo->prepare('SELECT id FROM photos WHERE id = ?');
            $result = $select->execute([$photo->id]);
            if ($result === false) {
                echo $select->errorInfo()[2];
            }

            if (!$select->fetch()) {
                $sql = 'INSERT INTO photos (id, name, source, picture, created_time, likes)';
                $sql .= ' VALUES (?, ?, ?, ?, ?, ?)';
                $insert = $this->pdo->prepare($sql);
                $result = $insert->execute([
                    $photo->id,
                    $photo->name,
                    $photo->source,
                    $photo->picture,
                    $photo->created_time,
                    $photo->likes->summary->total_count,
                ]);
                if (!$result) {
                    echo $insert->errorInfo()[2];
                }
            } else {
                $sql = 'UPDATE photos SET name=?,source=?,picture=?,created_time=?,likes=? WHERE id = ?';
                $update = $this->pdo->prepare($sql);
                $result = $update->execute([
                    $photo->name,
                    $photo->source,
                    $photo->picture,
                    $photo->created_time,
                    $photo->likes->summary->total_count,
                    $photo->id,
                ]);
                if (!$result) {
                    echo $update->errorInfo()[2];
                }
            }

            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}

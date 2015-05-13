<?php

function render($template, Array $args)
{
    // usually a bad practice but I need to get these variables into current scope.
    extract($args);

    ob_start();
    include($template);
    $contents = ob_get_contents();
    ob_end_clean();

    return $contents;
}

function insertOrUpdate($pdo, $photo)
{
    try {
        $select = $pdo->prepare("SELECT id FROM photos WHERE id = ?");
        $result = $select->execute([$photo->id]);
        if ($result === false) {
            print($select->errorInfo()[2]);
        }

        if (!$select->fetch()) {
            $sql = 'INSERT INTO photos (id, name, source, picture, created_time, likes)';
            $sql .= ' VALUES (?, ?, ?, ?, ?, ?)';
            $insert = $pdo->prepare($sql);
            $result = $insert->execute([
                $photo->id,
                $photo->name,
                $photo->source,
                $photo->picture,
                $photo->created_time,
                $photo->likes->summary->total_count,
            ]);
            if (!$result) {
                print($insert->errorInfo()[2]);
            }
        } else {
            $sql = 'UPDATE photos SET name=?,source=?,picture=?,created_time=?,likes=? WHERE id = ?';
            $update = $pdo->prepare($sql);
            $result = $update->execute([
                $photo->name,
                $photo->source,
                $photo->picture,
                $photo->created_time,
                $photo->likes->summary->total_count,
                $photo->id,
            ]);
            if (!$result) {
                print($update->errorInfo()[2]);
            }
        }
    } catch(PDOException $e) {
        echo $e->getMessage();
    }
}

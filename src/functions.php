<?php

/**
 * Render a template.
 *
 * @param string $template Pathname of the template
 * @param array  $args     Array of arguments to pass in
 *
 * @return string
 */
function render($template, array $args)
{
    extract($args);

    ob_start();
    include $template;
    $contents = ob_get_contents();
    ob_end_clean();

    return $contents;
}

/**
 * If database entry exists update it, else create a new one.
 *
 * @param PDO      $pdo   Database connection
 * @param StdClass $photo Class containing the values
 *
 * @return bool Was the insert/update successful?
 */
function insertOrUpdate(PDO $pdo, StdClass $photo)
{
    try {
        $select = $pdo->prepare('SELECT id FROM photos WHERE id = ?');
        $result = $select->execute([$photo->id]);
        if ($result === false) {
            echo $select->errorInfo()[2];
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
                echo $insert->errorInfo()[2];
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
                echo $update->errorInfo()[2];
            }
        }

        return $result;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

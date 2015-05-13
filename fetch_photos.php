<?php

/* Connect to an ODBC database using driver invocation */
$dsn = 'mysql:dbname=testdb;host=127.0.0.1';
$user = 'dbuser';
$password = 'dbpass';

try {
    $pdo = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit;
}

$fields = 'id,name,source,created_time,likes';
$json = file_get_contents(
    'http://graph.facebook.com/vanderbilt/photos/uploaded?fields='.$fields
);
$content = json_decode($json, false);

$sql = 'INSERT INTO photos (image_id, name, source, created_time, likes) '.
       'VALUES (?, ?, ?, ?, ?)';

$statement = $pdo->prepare($sql);

foreach ($content->data as $photo) {
    $photo->likes = count($photo->likes->data);
    if (!property_exists($photo, 'name')) {
        $photo->name = '';
    }
    var_dump($photo);

    $statement->execute([
        $photo->id,
        $photo->name,
        $photo->source,
        $photo->created_time,
        $photo->likes,
    ]);
}

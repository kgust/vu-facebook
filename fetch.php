<?php

require 'vendor/autoload.php';
require 'src/functions.php';

$db = new \VU\App\Services\DatabaseProvider();
$pdo = $db->pdo;
$config = require 'config.php';
$facebook_url = $config['facebook_url'];
$url = $facebook_url;

/* Fetch records from the Facebook API and update the database. */
do {
    $json = file_get_contents($url);
    $content = json_decode($json, false);
    $url = false;

    foreach ($content->data as $photo) {
        if (!property_exists($photo, 'name')) {
            $photo->name = '';
        }

        $rows = insertOrUpdate($pdo, $photo);
    }

    if (property_exists($content->paging, 'next')) {
        $url = $facebook_url.'&after='.$content->paging->cursors->after;
    }
} while ($url);

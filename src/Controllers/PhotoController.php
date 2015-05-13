<?php namespace VU\App\Controllers;

use PDO;
use League\Container\Container;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use VU\App\Services\DatabaseProvider;

class PhotoController
{
    private $container;
    private $pdo;

    public function __construct()
    {
        $this->db = new DatabaseProvider; 
	$this->pdo = $this->db->pdo;
    }

    public function index(Request $request, Response $response)
    {
        $sql = 'SELECT * FROM photos ORDER BY created_time DESC';
        $rows = $this->pdo->query($sql);

	$content = render('src/views/index.html.php', ['pictures' => $rows]);
        $response->setContent($content);
        $response->setStatusCode(200);
        return $response;
    }

    public function show(Request $request, Response $response, array $args)
    {
        $id = $args['id'];

        $sql = "SELECT * FROM photos WHERE id='{$id}'";
        $statement = $this->pdo->query($sql);
	$row = $statement->fetch();

	$content = render('src/views/details.html.php', ['row' => $row]);
        $response->setContent($content);
        $response->setStatusCode(200);
        return $response;
    }
}

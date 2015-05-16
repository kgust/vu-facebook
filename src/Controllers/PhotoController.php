<?php namespace VU\App\controllers;

use PDO;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use VU\App\Services\DatabaseProvider;

class PhotoController
{
    /**
     * @var $pdo Database connection
     */
    private $pdo;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->db = new DatabaseProvider;
        $this->pdo = $this->db->pdo;
    }

    /**
     * Index action
     *
     * @param Request Request object
     * @param Response Response object
     *
     * @return Response
     */
    public function index(Request $request, Response $response)
    {
        $sql = 'SELECT * FROM photos ORDER BY created_time DESC';
        $rows = $this->pdo->query($sql);

        $content = render('src/views/index.html.php', ['pictures' => $rows]);
        $response->setContent($content);
        $response->setStatusCode(200);

        return $response;
    }

    /**
     * Show photo details action
     *
     * @param Request  $request  Request object
     * @param Response $response Response object
     * @param Array    $args     Array of arguments
     *
     * @return Response
     */
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

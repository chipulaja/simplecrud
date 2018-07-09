<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../bin/Doctrine.php';
require __DIR__ . '/../bin/db-config.php';
$doctrine = new Doctrine($dbConfig);
$em = $doctrine->em;

$app = new Slim\App(['settings' => ['displayErrorDetails' => true]]);

$container = $app->getContainer();
$view = new League\Plates\Engine('../public/views');
$container['view'] = $view;
$container['em'] = $em;

$app->get('/', function (Request $request, Response $response) use ($app) {
    $reader = new SimpleCrud\Service\ArtikelReader($this->get("em"));
    $data   = $reader->getData();
    $response->getBody()->write(
        $this->get('view')->render(
            'index',
            ["data" => $data]
        )
    );
    return $response;
});

$app->get('/add', function (Request $request, Response $response) use ($app) {
    $response->getBody()->write(
        $this->get('view')->render(
            'add'
        )
    );
    return $response;
});

$app->post('/add', function (Request $request, Response $response) use ($app) {
    $data   = $request->getParams();
    $creator = new SimpleCrud\Service\ArtikelCreator($this->get("em"));
    $result = $creator->dispatch($data);

    $reader = new SimpleCrud\Service\ArtikelReader($this->get("em"));
    $data   = $reader->getData();

	return $this->response->withRedirect("/");
});

$app->get('/view/{id}', function (Request $request, Response $response, $args) use ($app) {
    $id     = $args["id"];
    $reader = new SimpleCrud\Service\ArtikelReader($this->get("em"));
    $data   = $reader->getArtikelById($id);
    if (!empty($data)) {
        $response->getBody()->write(
            $this->get('view')->render(
                'view',
                ["data" => $data]
            )
        );
    } else {
        $response->getBody()->write(
            $this->get('view')->render('dataTidakDitemukan',[])
        );
    }
});


$app->post('/add-comment/{id}', function (Request $request, Response $response, $args) use ($app) {
    $data       = $request->getParams();
    $data["id"] = $args["id"];
    $creator    = new SimpleCrud\Service\KomentarCreator($this->get("em"));
    $result     = $creator->dispatch($data);

    return $this->response->withRedirect("/view/".$data["id"]);
});


$app->get('/edit/{id}', function (Request $request, Response $response, $args) use ($app) {
    $id     = $args["id"];
    $reader = new SimpleCrud\Service\ArtikelReader($this->get("em"));
    $data   = $reader->getArtikelById($id);
    if (!empty($data)) {
        $response->getBody()->write(
            $this->get('view')->render(
                'edit',
                ["data" => $data]
            )
        );
    } else {
        $response->getBody()->write(
            $this->get('view')->render('dataTidakDitemukan',[])
        );
    }
    return $response;
});

$app->post('/edit/{id}', function (Request $request, Response $response, $args) use ($app) {
    $data   = $request->getParams();
    $data["id"] = $args["id"];
    $updater = new SimpleCrud\Service\ArtikelUpdater($this->get("em"));
    $updater->dispatch($data);

    return $this->response->withRedirect("/");
});

$app->get('/delete-confirm/{id}', function (Request $request, Response $response, $args) {
    $id     = $args["id"];
    $reader = new SimpleCrud\Service\ArtikelReader($this->get("em"));
    $data   = $reader->getArtikelById($id);
    if (!empty($data)) {
        $response->getBody()->write(
            $this->get('view')->render(
                'deleteConfirm',
                ["data" => $data]
            )
        );
    } else {
        $response->getBody()->write(
            $this->get('view')->render('dataTidakDitemukan',[])
        );
    }
    return $response;
});

$app->post('/delete/{id}', function (Request $request, Response $response, $args) {
    $data       = $request->getParams();
    $reader     = new SimpleCrud\Service\ArtikelReader($this->get("em"));
    $artikel    = $reader->getArtikelById($args["id"]);

    if (!empty($artikel)) {
        $remover = new SimpleCrud\Service\ArtikelRemover($this->get("em"));
        $remover->dispatch($artikel, $data);
        return $this->response->withRedirect("/");
    } else {
        $response->getBody()->write(
            $this->get('view')->render('dataTidakDitemukan',[])
        );
    }
});

$app->run();

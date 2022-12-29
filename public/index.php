<?php

require_once __DIR__ . '/../src/controller/ParticipantsController.php';
require_once __DIR__ . '/../src/controller/FormationsController.php';

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

use Symfony\Component\Dotenv\Dotenv;

require __DIR__ . '/../vendor/autoload.php';

$dotenv = new Dotenv();
$dotenv->load(__DIR__ . '/../.env');

$app = AppFactory::create();

$app->addErrorMiddleware(true, true, true);

$app->get('/', function (Request $request, Response $response) {
    $response->getBody()->write('Hello World!');
    return $response;
});

$app->post('/participants', function (Request $request, Response $response) {

    if ($request->getHeaderLine('content-type') !== 'application/json') {
        return $response->withStatus(415)->withHeader('Content-Type', 'application/json');
    }

    $data = $request->getParsedBody();

    $participantsController = new ParticipantsController();
    $participantsController->createParticipants($data['firstname'], $data['lastname'], $data['company'] ?? null);

    $jsonResponse = json_encode(['status' => 200]);

    $response->getBody()->write($jsonResponse);

    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/participants', function (Request $request, Response $response) {

    $participantsController = new ParticipantsController();
    $participants = $participantsController->getParticipants();

    $jsonResponse = json_encode(['status' => 200, 'data' => $participants]);

    $response->getBody()->write($jsonResponse);

    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/participants/{id}', function (Request $request, Response $response, $args) {

    $id = $args['id'];

    $participantsController = new ParticipantsController();
    $participants = $participantsController->getOneParticipants($id);

    if (!$participants) {
        $jsonResponse = json_encode(['status' => 404, 'data' => $participants]);

        $response->getBody()->write($jsonResponse);

        return $response->withStatus(404);
    }

    $jsonResponse = json_encode(['status' => 200, 'data' => $participants]);

    $response->getBody()->write($jsonResponse);

    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/formations', function (Request $request, Response $response) {

    $formationsController = new FormationsController();
    $formations = $formationsController->getFormations();

    $jsonResponse = json_encode(['status' => 200, 'data' => $formations]);

    $response->getBody()->write($jsonResponse);

    return $response->withHeader('Content-Type', 'application/json');
});

$app->run();

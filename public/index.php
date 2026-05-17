<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

$app->get('/', function (Request $request, Response $response) {

    include_once __DIR__ . '/../includes/db_connect.php';
    include_once __DIR__ . '/../dao/MusicsDao.php';
    include_once __DIR__ . '/../controller/MusicsController.php';

    $musicsController = new MusicsController($db);
    $llistaMusics = $musicsController->obtenirMusics();

    $cardsHtml = "";

    foreach ($llistaMusics as $music) {
        $id   = (int)$music['grup_id'];
        $nom  = htmlspecialchars($music['grup_nom'], ENT_QUOTES, 'UTF-8');
        $img  = htmlspecialchars($music['img_url'], ENT_QUOTES, 'UTF-8');

        $cardsHtml .= "
            <a class='card' href='detail.php?id=$id'>
                <img src=\"$img\" alt=\"$nom\">
                <div class='card-label'>
                    <span class='tag'>Grup Musical</span>
                    <h4>$nom</h4>
                </div>
            </a>
        ";
    }

    $htmlContent = "
        <!DOCTYPE html>
        <html lang='ca'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Grups Musicals</title>
            <link rel='stylesheet' href='assets/css/style.css'>
        </head>
        <body>

            <header>
                <h1>Grups Musicals</h1>
                <span>Descobreix els artistes</span>
            </header>

            <div class='grid-container'>
                $cardsHtml
            </div>

        </body>
        </html>
    ";

    include_once __DIR__ . '/../includes/db_close.php';

    $response->getBody()->write($htmlContent);
    return $response->withHeader('Content-Type', 'text/html; charset=UTF-8');
});

$app->run();
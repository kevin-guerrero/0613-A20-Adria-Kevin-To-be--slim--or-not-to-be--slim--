<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

$app->get('/detail.php', function (Request $request, Response $response) {

    $params = $request->getQueryParams();
    $id = isset($params['id']) ? (int)$params['id'] : 0;

    include_once __DIR__ . '/../includes/db_connect.php';
    include_once __DIR__ . '/../dao/MusicsDao.php';
    include_once __DIR__ . '/../controller/MusicsController.php';

    $musicsController = new MusicsController($db);
    $music = $musicsController->obtenirMusicPerId($id);

    if (!$music) {
        $response->getBody()->write("<p>Músic no trobat.</p>");
        return $response->withStatus(404)->withHeader('Content-Type', 'text/html; charset=UTF-8');
    }

    $nom   = htmlspecialchars($music['grup_nom'], ENT_QUOTES, 'UTF-8');
    $desc  = htmlspecialchars($music['grup_descripcio'], ENT_QUOTES, 'UTF-8');
    $img   = htmlspecialchars($music['img_url'], ENT_QUOTES, 'UTF-8');

    // Convertir URL de YouTube a embed
    $videoUrl = $music['video_url'];
    $embedUrl = '';
    if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $videoUrl, $matches)) {
        $embedUrl = 'https://www.youtube.com/embed/' . $matches[1];
    }

    $videoHtml = $embedUrl
        ? "<iframe src=\"$embedUrl\" allowfullscreen></iframe>"
        : "<p class='no-video'>Vídeo no disponible.</p>";

    $htmlContent = "
        <!DOCTYPE html>
        <html lang='ca'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>$nom</title>
            <link rel='stylesheet' href='assets/css/style.css'>
        </head>
        <body>

            <header>
                <a class='back-link' href='/'>← Tornar</a>
            </header>

            <div class='detail-container'>

                <div class='detail-hero'>
                    <img src=\"$img\" alt=\"$nom\">
                    <div class='detail-hero-overlay'>
                        <span class='tag'>Grup Musical</span>
                        <h1>$nom</h1>
                    </div>
                </div>

                <div class='detail-body'>
                    <div class='detail-desc'>
                        <p>$desc</p>
                    </div>
                    <div class='detail-video'>
                        $videoHtml
                    </div>
                </div>

            </div>

        </body>
        </html>
    ";

    include_once __DIR__ . '/../includes/db_close.php';

    $response->getBody()->write($htmlContent);
    return $response->withHeader('Content-Type', 'text/html; charset=UTF-8');
});

$app->run();
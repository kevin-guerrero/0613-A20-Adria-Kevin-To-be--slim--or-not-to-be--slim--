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

        $nom = htmlspecialchars($music['grup_nom'], ENT_QUOTES, 'UTF-8');
        $desc = htmlspecialchars($music['grup_descripcio'], ENT_QUOTES, 'UTF-8');
        $img = htmlspecialchars($music['img_url'], ENT_QUOTES, 'UTF-8');
        $video = htmlspecialchars($music['video_url'], ENT_QUOTES, 'UTF-8');

        $cardsHtml .= "
            <div class='card'
                data-nom=\"$nom\"
                data-desc=\"$desc\"
                data-video=\"$video\">

                <img src=\"$img\" alt=\"$nom\">

                <div class='container'>
                    <h4><b>$nom</b></h4>
                </div>
            </div>
        ";
    }

    $htmlContent = "
        <!DOCTYPE html>
        <html lang='ca'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Pàgina Principal</title>
            <link rel='stylesheet' href='assets/css/style.css'>
        </head>
        <body>

            <div class='grid-container'>
                $cardsHtml
            </div>

            <div id='details-modal'>
                <div class='modal-content'>
                    <span class='close' onclick='closeModal()'>&times;</span>
                    <h2 id='modal-title'></h2>
                    <p id='modal-desc'></p>
                    <a id='modal-video' href='' target='_blank'>Veure Vídeo en YouTube</a>
                </div>
            </div>

            <script>
                document.querySelectorAll('.card').forEach(card => {
                    card.addEventListener('click', function () {
                        showDetails(
                            this.dataset.nom,
                            this.dataset.desc,
                            this.dataset.video
                        );
                    });
                });

                function showDetails(nom, desc, video) {
                    document.getElementById('modal-title').innerText = nom;
                    document.getElementById('modal-desc').innerText = desc;
                    document.getElementById('modal-video').href = video;
                    document.getElementById('details-modal').style.display = 'block';
                }

                function closeModal() {
                    document.getElementById('details-modal').style.display = 'none';
                }

                window.onclick = function(event) {
                    if (event.target.id === 'details-modal') {
                        closeModal();
                    }
                }
            </script>

        </body>
        </html>
    ";

    include_once __DIR__ . '/../includes/db_close.php';

    $response->getBody()->write($htmlContent);
    return $response->withHeader('Content-Type', 'text/html; charset=UTF-8');
});

$app->run();
<?php 
class MusicsDao {
    private $connection;

    private function formatMusics($fila) {
        return [
            'grup_id' => $fila['grup_id'],
            'grup_nom' => $fila['grup_nom'],
            'grup_descripcio' => $fila['grup_descripcio'],
            'img_url' => $fila['img_url'],
            'video_url' => $fila['video_url']
        ];
    }

    public function __construct($pconnection) {
        $this->connection = $pconnection;
    }

    public function obtenirMusics() {
        $query = "SELECT * FROM grups";
        $resultat = $this->connection->query($query);
        $musics = [];
        while ($fila = $resultat->fetchArray(SQLITE3_ASSOC)) {
            $musics[] = $this->formatMusics($fila);
        }

        return $musics;
    }
}
?>
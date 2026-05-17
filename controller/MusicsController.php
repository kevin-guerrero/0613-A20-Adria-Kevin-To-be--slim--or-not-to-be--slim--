<?php
include_once __DIR__ . '/../dao/MusicsDao.php';

class MusicsController {
    private $musicsDao;

    public function __construct($connection) {
        $this->musicsDao = new MusicsDao($connection);
    }

    public function obtenirMusics() {
        $llistaMusics = $this->musicsDao->obtenirMusics();
        return $llistaMusics;
    }

    public function obtenirMusicPerId($id) {
        return $this->musicsDao->obtenirMusicPerId($id);
    }
}
?>
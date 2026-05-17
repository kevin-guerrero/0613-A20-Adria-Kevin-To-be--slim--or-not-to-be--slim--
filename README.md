# Grups Musicals

Lloc web dinàmic de biografies de grups musicals.

## Tecnologies

- PHP + Slim Framework
- SQLite3
- HTML/CSS (sense frameworks)

## Estructura

```
├── controller/
│   └── MusicsController.php
├── dao/
│   └── MusicsDao.php
├── includes/
│   ├── db_connect.php
│   └── db_close.php
├── public/
│   ├── index.php       # Llistat de grups
│   ├── detail.php      # Detall d'un grup amb vídeo de YouTube
│   └── assets/css/
│       └── style.css
└── README.md
```

## Instal·lació

```bash
composer install
php -S localhost:8000 -t public
```

Accedeix a [http://localhost:8000](http://localhost:8000).

## Funcionament

- La pàgina principal mostra tots els grups extrets de la base de dades.
- En clicar una card s'accedeix a la pàgina de detall (`detail.php?id=X`).
- Cada pàgina de detall mostra la biografia i el vídeo incrustat de YouTube.

## Vídeo de demostració


<?php
// Crear la base de dades
$db = new SQLite3('Musics.db');

// Creem la taula grups si no existeix
$db->exec("CREATE TABLE IF NOT EXISTS grups (
    grup_id INTEGER PRIMARY KEY AUTOINCREMENT,
    grup_nom TEXT NOT NULL,
    grup_descripcio TEXT NOT NULL,
    img_url TEXT NOT NULL,
    video_url TEXT NOT NULL
);");

// Inserir grups
$db->exec("INSERT INTO grups (grup_nom, grup_descripcio, img_url, video_url) VALUES

('The Rolling Stones',
'Banda de rock britànica formada a Londres l''any 1962. Se''ls coneix com \"Ses Majestats Satàniques\" i han estat el símbol de la rebel·lia i el \"rock and roll\" pur durant més de sis dècades.',
'https://e01-elmundo.uecdn.es/especiales/2012/cultura/rolling-stones/img/labanda05-g.jpg',
'https://youtu.be/RcZn2-bGXqQ'),

('AC/DC',
'Banda de hard rock formada a Sydney, Austràlia, l''any 1973 pels germans escocesos Malcolm i Angus Young. Són coneguts pel seu so elèctric, els seus riffs potents i l''energia inesgotable d''Angus a l''escenari, vestit sempre amb el seu icònic uniforme escolar.',
'https://cdn-images.dzcdn.net/images/cover/de48d988a82fc401f4b9bafc2639f7d0/0x1900-000000-80-0-0.jpg',
'https://youtu.be/pAgnJDJN4VA?list=RDpAgnJDJN4VA'),

('The Beatles',
'Grup de rock britànic format a Liverpool el 1960. Els seus integrants van ser John Lennon, Paul McCartney, George Harrison i Ringo Starr. Van revolucionar no només la música, sinó també la moda, el cinema i la cultura popular de tot el món.',
'https://img2.rtve.es/n/1976826?w=1600',
'https://youtu.be/KQetemT1sWc?list=RDKQetemT1sWc'),

('Iron Maiden',
'Banda britànica de heavy metal formada a Londres l''any 1975. És considerada una de les bandes més importants del gènere, coneguda per les seves cançons èpiques, les guitarres potents i la mascota Eddie.',
'https://www.ironmaiden.com/files/2024/08/WS_2023_Lineup.jpg',
'https://youtu.be/X4bgXH3sJ2Q'),

('Ed Sheeran',
'És un cantautor i músic britànic nascut a Halifax el 1991. El seu estil barreja el pop acústic amb el folk, el soul i tocs de hip-hop. És famós pel seu cabell pèl-roig i per la seva capacitat de connectar amb el públic a través de lletres molt personals i quotidianes.',
'https://www.hola.com/horizon/square/b2af06968434-gettyimages-2221735623.jpg',
'https://youtu.be/2Vv-BfVoq4g?si=a2L3YVN_yZL_g3U6'),

('Coldplay',
'Banda britànica de rock alternatiu formada a Londres l''any 1997. El grup està format per Chris Martin, Jonny Buckland, Guy Berryman i Will Champion. Són coneguts per cançons emotives i melodies molt reconeixibles com \"Yellow\", \"Fix You\" o \"Viva la Vida\".',
'https://images.squarespace-cdn.com/content/v1/6440045c09a3142556f95a75/1720703406475-524J042IHE0O30ESKOXV/Coldplay.png',
'https://youtu.be/E0UN-pVTLf4?si=FG_BPrD9xl8cVE4s');

");

// Tancar la connexió
$db->close();
?>
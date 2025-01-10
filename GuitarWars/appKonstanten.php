<?php

// hier definieren wir alle Konstanten, die wir für die App benötigen
    define('MAXDATEIGROESSE', 4000000);
    define('ORDNER', 'screenshot_files/');

    // Funktion zum Generieren eines eindeutigen Dateinamens
    function generateUniqueFilename($originalFilename) {
        $extension = pathinfo($originalFilename, PATHINFO_EXTENSION);
        return uniqid('screenshot_', true) . '.' . $extension;
    }

?>
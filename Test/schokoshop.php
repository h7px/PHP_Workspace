<?php

// Konstante für Pralinenpreise
define('PREIS_5ER', 9.90);
define('PREIS_8ER', 12.90);
define('PREIS_12ER', 20.90);
define('PREIS_25ER', 43.90);

if (isset($_GET['submit'])) {
    // Überprüfung, ob alle Felder ausgefüllt sind
    if (!empty($_GET['pralinen']) && !empty($_GET['filiale']) && !empty($_GET['zeit']) && !empty($_GET['nachname'])) {
        $pralinen = $_GET['pralinen'];
        $filiale = htmlspecialchars($_GET['filiale']);
        $zeit = htmlspecialchars($_GET['zeit']);
        $nachname = htmlspecialchars($_GET['nachname']);
        
        // Preisermittlung
        $preis = 0;
        switch ($pralinen) {
            case "5er Pralinenmix":
                $preis = PREIS_5ER;
                break;
            case "8er Pralinenmix":
                $preis = PREIS_8ER;
                break;
            case "12er Pralinenmix":
                $preis = PREIS_12ER;
                break;
            case "25er Pralinenmix":
                $preis = PREIS_25ER;
                break;
            default:
                echo "<h1>Verarbeitung nicht möglich!</h1>";
                echo "<p>Ungültige Auswahl für Pralinen.</p>";
                echo '<a href="schokoshop.html">Hier geht es zum Formular.</a>';
                exit;
        }
        
        // Erfolgreiche Bestätigung
        echo "<h1>Vielen Dank für Ihre Vorbestellung.</h1>";
        echo "<p>Die Pralinen können morgen um $zeit Uhr in der Filiale in $filiale abgeholt werden.</p>";
        echo "<p>Ihre Pralinen: $pralinen - Preis: " . number_format($preis, 2, ',', '.') . " €</p>";
    } else {
        // Fehlermeldung, wenn Daten fehlen
        echo "<h1>Verarbeitung nicht möglich!</h1>";
        echo "<p>Sie müssen zuerst das Formular ausfüllen!</p>";
        echo '<a href="schokoshop.html">Hier geht es zum Formular.</a>';
    }
}

?>

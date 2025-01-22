<?php
//Um auf Session-Variablen zugreifen zu können, muss zuerst die Sitzung wieder gestartet werden.
session_start();

// Zugriff auf Session-Variablen 
echo $_SESSION['vorname'] . " " . $_SESSION['nachname'];

// Neue Session-Variable für die Adresse hinzufügen
$_SESSION['adresse'] = "Hauptstraße 1";

echo "Das ist die Session-ID: " . session_id();

?>
<a href="seite3.php">Weiter zu Seite 3</a>
<?php
//Um auf Session-Variablen zugreifen zu können, muss zuerst die Sitzung wieder gestartet werden.
session_start();

// Zugriff auf Session-Variablen 
echo $_SESSION['vorname'] . " " . $_SESSION['nachname'] . " " . $_SESSION['adresse'];

// Alle Session-Variablen löschen
session_unset();

// Die gesamte Session zerstören
session_destroy();

echo "Das ist die Session-ID: " . session_id();

echo $_SESSION['vorname'];

?>
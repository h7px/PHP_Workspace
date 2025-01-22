<?php
// Damit eine Seite zum privaten Bereich gehört, müssen wir eine Session erzeugen. Das heißt, am Server wird eine Datei angelegt, die Session-Variablen zu dieser Sitzung speichern kann. Die Datei erhält einen Namen aus Ziffern und Buchstaben. Außerdem wird ein Browser-Cookie erzeugt. (PHPSESSID)
session_start();

// Session-Variablen erzeugen
$_SESSION['vorname'] = "Hans";
$_SESSION['nachname'] = "Mayer";

echo "Das ist die Session-ID: " . session_id();

?>
<a href="seite2.php">Weiter zu Seite 2</a>
<?php

require_once("Auto.class.php");

$auto = new Auto();

for($i = 0; $i < 5; $i++) {
    $auto->beschleunigen();
}

echo "Die aktuelle Geschwindigkeit ist: " . $auto->getGeschwindigkeit() . " km/h.<br><br>";

for($i = 0; $i < 3; $i++) {
    $auto->bremsen();
}

echo "Die aktuelle Geschwindigkeit ist: " . $auto->getGeschwindigkeit() . " km/h.<br>";

?>
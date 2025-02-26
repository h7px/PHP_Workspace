<?php

require_once("Auto.class.php");

$auto = new Auto(0);
$auto->setGeschwindigkeit(50); 

echo "Die aktuelle Geschwindigkeit ist: " . $auto->getGeschwindigkeit() . " km/h.<br><br>";

$auto->setGeschwindigkeit(20);

echo "Die aktuelle Geschwindigkeit ist: " . $auto->getGeschwindigkeit() . " km/h.<br>";

?>
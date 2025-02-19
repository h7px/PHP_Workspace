<?php

require_once("Rechteck.class.php");

// Ein neues Rechteck-Objekt 
$rechteck = new Rechteck(23,54);
$rechteck2 = new Rechteck(56,18);

// Ausgabe 1. Rechteck

echo "Das Rechteck hat eine Länge von " . $rechteck->getLaenge() . ".<br>";
echo "Das Rechteck hat eine Breite von " . $rechteck->getBreite() . ".<br>";
echo "Das Rechteck hat eine Fläche von " . $rechteck->berechneFlaeche() . ".<br>";
echo "Das Rechteck hat einen Umfang von " . $rechteck->berechneUmfang() . ".<br><br>";

// Ausgabe 2. Rechteck

echo "Das 2. Rechteck hat eine Länge von " . $rechteck2->getLaenge() . ".<br>";
echo "Das 2. Rechteck hat eine Breite von " . $rechteck2->getBreite() . ".<br>";
echo "Das 2. Rechteck hat eine Fläche von " . $rechteck2->berechneFlaeche() . ".<br>";
echo "Das 2. Rechteck hat einen Umfang von " . $rechteck2->berechneUmfang() . ".<br><br>";

// Ändern der Breite des 2. Rechtecks
$rechteck2->setBreite(30);
echo "Das 2. Rechteck hat eine Breite von " . $rechteck2->getBreite() . ".<br>";

?>
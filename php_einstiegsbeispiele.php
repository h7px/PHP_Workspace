<?php
// 1. Ausgabe eines Absatzes mit Fett-Markierung und Zeilenumbruch
echo "<p>Es ist noch kein <strong>Meister</strong> vom Himmel gefallen!<br>Übung macht den <strong>Meister</strong>!</p>";

// 2. Zwei Variablen anlegen und addieren
$zahl1 = 10;
$zahl2 = 15;
$summe = $zahl1 + $zahl2;
echo "Die Summe von $zahl1 und $zahl2 ist: $summe<br>";

// 3. Variable zahl1 um 1 erhöhen und ausgeben
$zahl1++;
echo "Die neue Zahl1 ist: $zahl1<br>";

// 4. Nettopreis berechnen und runden
$bruttopreis = 116;
$umsatzsteuer = 20;
$nettopreis = $bruttopreis / (1 + $umsatzsteuer / 100);
echo "Der Nettopreis ist: " . round($nettopreis, 2) . " Euro<br>";

// 5. Array jahreszeiten erstellen
$jahreszeiten = array("Frühjahr", "Sommer", "Herbst", "Winter");

// a. Herbst ausgeben
echo "Der Herbst ist: " . $jahreszeiten[2] . "<br>";

// b. Array durchlaufen und alle Jahreszeiten ausgeben
foreach ($jahreszeiten as $jahreszeit) {
    echo "$jahreszeit<br>";
}

// 6. Array fruechte erstellen
$fruechte = array("Birne", "Banane", "Kiwi", "Apfel", "Kirsche");

// a. Array ausgeben
print_r($fruechte);
echo "<br>";

// b. Array sortieren und ausgeben
sort($fruechte);
print_r($fruechte);
echo "<br>";

// c. Prüfen ob Apfel vorhanden ist und seine Position ausgeben
$position = array_search("Apfel", $fruechte);
if ($position !== false) {
    echo "Apfel ist an Position: $position<br>";
} else {
    echo "Apfel ist nicht in der Liste<br>";
}

// d. Kiwi ans Ende hinzufügen und ausgeben
$fruechte[] = "Kiwi";
print_r($fruechte);
echo "<br>";

// e. Mango am Anfang hinzufügen und ausgeben
array_unshift($fruechte, "Mango");
print_r($fruechte);
echo "<br>";

// f. Doppelte Werte entfernen und ausgeben
$fruechte = array_unique($fruechte);
print_r($fruechte);
echo "<br>";

// g. Erstes Element löschen und ausgeben
array_shift($fruechte);
print_r($fruechte);
echo "<br>";

// h. Letztes Element löschen und ausgeben
array_pop($fruechte);
print_r($fruechte);
echo "<br>";

// 7. Assoziatives Array mit Wochentagen erstellen
$wochentage = array("mo" => "Montag", "di" => "Dienstag", "mi" => "Mittwoch", "do" => "Donnerstag", "fr" => "Freitag", "sa" => "Samstag", "so" => "Sonntag");

// a. Wochentage durchlaufen und ausgeben
foreach ($wochentage as $tag) {
    echo "$tag<br>";
}

// b. Text mit Donnerstag ausgeben
echo "Heute ist " . $wochentage["do"] . ".<br>";

// c. Prüfen, ob Sonntag enthalten ist
if (in_array("Sonntag", $wochentage)) {
    echo "Sonntag ist im Array enthalten.<br>";
} else {
    echo "Sonntag ist nicht im Array enthalten.<br>";
}

// 8. Assoziatives Array für Hauptstädte erstellen
$hauptstadt = array("AT" => "Wien", "DE" => "Berlin", "DK" => "Kopenhagen", "PL" => "Warschau", "FR" => "xxx");

// a. Anzahl der Länder ausgeben
echo "Es gibt " . count($hauptstadt) . " Länder im Array.<br>";

// b. Hauptstadt von DK ausgeben
echo "Die Hauptstadt von DK ist: " . $hauptstadt["DK"] . ".<br>";

// c. Länder mit ihren Hauptstädten ausgeben
foreach ($hauptstadt as $land => $stadt) {
    echo "Die Hauptstadt von $land ist $stadt.<br>";
}

// d. Prüfen, ob Berlin enthalten ist
if (in_array("Berlin", $hauptstadt)) {
    echo "Berlin ist in der Liste der Hauptstädte enthalten.<br>";
} else {
    echo "Berlin ist nicht in der Liste der Hauptstädte enthalten.<br>";
}

// e. Paris als Hauptstadt von Frankreich festlegen
$hauptstadt["FR"] = "Paris";

// f. Prüfen, ob der Schlüssel IT enthalten ist
if (array_key_exists("IT", $hauptstadt)) {
    echo "ja<br>";
} else {
    echo "nein<br>";
}
?>

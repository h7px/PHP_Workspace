<?php
$bezeichnung_tisch = "Schreibtisch";
$bezeichnung_stuhl = "Bürostuhl";
$bezeichnung_lampe = "Lampe";
$bezeichnung_pctisch = "Computertisch";

$preis_tisch = 1999.00;
$preis_stuhl = 589.00;
$preis_lampe = 29.00;
$preis_pctisch = 999.00;

define("MWST", 0.19); 
define("EURO", "€");

$netto_gesamt = $preis_tisch + $preis_stuhl + $preis_lampe + $preis_pctisch;
$brutto_gesamt = $netto_gesamt * (1 + MWST);

$brutto_tisch = $preis_tisch * (1 + MWST);
$brutto_stuhl = $preis_stuhl * (1 + MWST);
$brutto_lampe = $preis_lampe * (1 + MWST);
$brutto_pctisch = $preis_pctisch * (1 + MWST);

echo "<h1>Mit Variablen, Operatoren und Konstanten arbeiten</h1>";
echo "<ul>";
echo "<p>Netto-Gesamtpreis der eingekauften Artikel: " . $netto_gesamt. " " . EURO . "</p>";
echo "<p>Brutto-Gesamtpreis der eingekauften Artikel: " . $brutto_gesamt . " " . EURO . "</p>";
echo "<hr>";
echo "<p>Brutto-Preis <strong>$bezeichnung_tisch</strong>: " . $brutto_tisch . " " . EURO . "</p>";
echo "<p>Brutto-Preis <strong>$bezeichnung_stuhl</strong>: " . $brutto_stuhl . " " . EURO . "</p>";
echo "<p>Brutto-Preis <strong>$bezeichnung_lampe</strong>: " . $brutto_lampe . " " . EURO . "</p>";
echo "<p>Brutto-Preis <strong>$bezeichnung_pctisch</strong>: " . $brutto_pctisch . " " . EURO . "</p>";
echo "</ul>";
?>

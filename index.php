<?php

$name = "Adrian";
$zahl = 17;
$datum = date("l jS \of F Y h:i:s A");
$zahl1 = 7;
$zahl2 = 8;
$ergebnis = $zahl1 * $zahl2;

echo "Hallo Welt!<br>";
echo "Mein Name ist $name und ich bin $zahl Jahre alt. Heute ist der $datum.";
echo "<br>Das Ergebnis der Multiplikation ist: $ergebnis";
// echo "<br>Das Ergebnis der Multiplikation ist: " . $ergebnis;

define ("NAME", "<br>Adrian, ");
define ("ALTER", 17);
echo NAME;
echo ALTER;

echo ++$zahl;
echo $zahl++;

?>
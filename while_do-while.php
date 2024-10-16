<?php

echo "<h1>while- und do-while-Schleife</h1>";

$zahl = 1;
echo "while-Schleife (Startwert: $zahl)<br>";
echo "<br>";
while ($zahl <= 5) {
    echo "$zahl<br>";
    $zahl++;
}

echo "<hr>";

$zahl = 1;
echo "do-while-Schleife (Startwert: $zahl)<br><br>";
do {
    echo "$zahl<br>";
    $zahl++;
} while ($zahl <= 5);

echo "<hr>";

$zahl = 20;
echo "<br>while-Schleife (Startwert: $zahl)<br>";
while ($zahl <= 5) {
    echo "$zahl<br>";
}

echo "<br>";

$zahl = 20;
echo "<br>do-while-Schleife (Startwert: $zahl)<br>";
do {
    echo "<br>$zahl<br>";
} while ($zahl <= 5);
?>

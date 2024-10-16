<?php

echo "<h1>bewertung-switch.php</h1>";

$punkte = 10; 

switch ($punkte) {
    case 10:
        echo "Sehr gut";
        break;
    case 9:
        echo "Gut";
        break;
    case 8:
        echo "Befriedigend";
        break;
    case 7:
        echo "Ausreichend";
        break;
    default:
        echo "Leider zu wenige Punkte erreicht";
        break;
}
?>

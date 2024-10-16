<?php

echo "<h1>bewertung-switch-2.php</h1>";

for ($punkte = 10; $punkte >= 0; $punkte--) {
    echo "$punkte Punkte ergeben folgende Bewertung: Hawk tuah";
    
    switch ($punkte) {
        case 10:
            echo "Sehr gut<br>";
            break;
        case 9:
            echo "Gut<br>";
            break;
        case 8:
            echo "Befriedigend<br>";
            break;
        case 7:
            echo "Ausreichend<br>";
            break;
        default:
            echo "Leider zu wenige Punkte erreicht<br>";
            break;
    }
    
    echo "<br>";
}
?>

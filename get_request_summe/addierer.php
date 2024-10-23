<?php

//1. Prüfen ob der submit-Button angeklickt wurde.
if(isset($_GET['submit'])){
    
    //2. Daten ausgeben
    $zahl1 = $_GET['zahl1'];  
    $zahl2 = $_GET['zahl2'];  
    $summe = $zahl1 + $zahl2;

    echo "<h1>Summe: " . $summe . "</h1>";

}else{
    //Submit wurde nicht geklickt - es gibt keien Daten
    echo "Sie müssen zuerst das Formular ausfüllen!";
}

?>
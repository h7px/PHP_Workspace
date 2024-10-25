<?php

//1. Prüfen ob der submit-Button angeklickt wurde.
if(isset($_GET['submit'])){
    
    //2. Daten ausgeben
    $zahl1 = $_GET['zahl1'];  
    $zahl2 = $_GET['zahl2'];  
    $zinssatz = 0.03;
    $summe = $zahl1 * $zinssatz * $zahl2;

    echo "<h1>Zinsen: " . $summe . " €</h1>";

}else{
    //Submit wurde nicht geklickt - es gibt keien Daten
    echo "Sie müssen zuerst das Formular ausfüllen!";
}

?>
<?php

//1. Prüfen ob der submit-Button angeklickt wurde.
if(isset($_GET['submit'])){
    
    //2. Daten ausgeben
    echo "<h1>Vorname " . $_GET['vorname'] . "</h1>";
    echo "<h1>Nachname " . $_GET['nachname'] . "</h1>";

}else{
    //Submit wurde nicht geklickt - es gibt keien Daten
    echo "Sie müssen zuerst das Formular ausfüllen!";
}

?>
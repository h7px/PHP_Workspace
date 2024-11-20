<?php

$pralinen1 = array($_GET['pralinen']);
$preis = array(9.90, 12.90, 20.90, 43,90);

if($pralinen1 !== "5er Pralinenmix"){

    } 
    elseif($pralinen1 !== "8er Pralinenmix"){

    }
    elseif($pralinen1 !== "12er Pralinenmix"){

    }
    elseif($pralinen1 !== "25er Pralinenmix"){

    } else {

    }
    
    
$p5er = 9.90;
$p8er = 12.90;
$p12er = 20.90;
$p25er = 43.90;

if(isset($_GET['submit'])){

if(!empty($_GET['pralinen']) && !empty($_GET['filiale']) && !empty($_GET['zeit']) && !empty($_GET['nachname'])) {

    echo "<h1> Vielen Dank für Ihre Vorbestellung." "</h1>";
    echo "<p>Die Pralinen können morgen um " . $_GET['zeit'] . " Uhr in der Filiale in " . $_GET['filiale'] . " abgeholt werden.</p>";
    echo "<p>Ihre Pralinen: " . $praline . " Preis: " . $preis . " € </p>";

}else{

    echo "<h1> Verarbeitung nicht möglich!" "</h1>";
    echo "<p> Sie müssen zuerst das Formular ausfüllen! " "</p>";
    echo '<a href="schokoshop.html">Hier geht es zum Formular.</a><br>'

}

}

?>

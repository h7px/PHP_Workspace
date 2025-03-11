<?php
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $_SESSION["zufriedenheit"] = $_POST["zufriedenheit"];
    $_SESSION["besuche"] = $_POST["besuche"];
    setcookie("zufriedenheit", $_POST["zufriedenheit"], time() + 86400);
    setcookie("besuche", $_POST["besuche"], time() + 86400);
    header("Location: abschluss.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Umfragezusammenfassung und Dankeschön</title>
</head>
<body>
    <?php 
    echo "<h1>Vielen Dank für die Teilnahme an unserer Umfrage, " . $_SESSION["name"] . "!</h1>";
    echo "<h2>Ihre Umfrageantworten wurden erfolgreich gespeichert.</h2>";
    echo "<h3>Ihr Name: " . $_SESSION["name"] . "</h3>";
    echo "<h3>Ihre Antworten auf die Umfragefragen: </h3>";
    echo "<h4>Frage 1: " . $_SESSION["zufriedenheit"] . "</h4>";
    echo "<h4>Frage 2: " . $_SESSION["besuche"] . "</h4>";
    ?>
    <a href="index.php">Zur Startseite</a>
</body>
</html>
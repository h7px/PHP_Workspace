<?php

if (isset( $_GET["submit"])) {

    if(!empty( $_GET["name"]) || !empty($_GET["gb"]) || !empty( $_GET["email"])) {
        echo("Deine Anmeldung war erfolgreich! <br>");
        echo("Name:" . $_GET["name"] . "<br> Der E-Mail des Erziehungsberechtigten lautet: " . $_GET["email"] . "<br>");
        //Die Übermittlung von Keys erfolgt aufgrund der "Name" eigenschaft  Arrays werden keine eckigen Klammern mitgegeben
        $zweig=$_GET["zweig"];
        if (isset($_GET["zweig"])) {  //Kopieren des Arrays in eine eigene Variable
            echo("<ul>");
foreach ($_GET["zweig"] as $value) {
        //li = List Items
    echo("<li>$value</li>");
        }
        //ul = unordert list
        echo("</ul>");}} else{}

} else {


    ?>










<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anmelde Formular</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>

    
<form action="<?php echo($_SERVER['SCRIPT_NAME']);?>" method="get">
<img src="logo.png" alt="Logo" style="max-width: 100px;">
    <h1>Anmeldeformular</h1>
    <h2>Ausbildungswunsch</h2>

<p>Ich interessiere mich für die...</p>
<input type="checkbox" name="zweig[]" id="zweig" value="CLASSIC BUSINESS HAK">Classic Business HAK <br>
<input type="checkbox" name="zweig[]" id="zweig" value="PRAXIS HAS">Praxis HAK<br>
<input type="checkbox" name="zweig[]" id="zweig" value="DIGITAL BUSINESS HAK">Digital Business HAK <br>
<input type="checkbox" name="zweig[]" id="zweig" value="HTL MECHATRONIK">HTL Mechatronik <br>

    <h2>Deine persönlichen Daten</h2><br>
<label for="name">Vor- und Zuname: </label>
<input type="text" name="name" id="name" required><br>

<label for="ge">Geschlecht</label>
<!--Name muss den gleichen Wert haben, denn der Name gibt die Button-Group(Zusammengehöre Radio Buttons lol) an -->
<input type="radio" name="ge" id="ge" value="männlich">Männlich<br>
<input type="radio" name="ge" id="ge" value="weiblich">Weiblich<br>
<input type="radio" name="ge" id="ge" value="divers">Divers<br>

<label for="gb">Geburtsdatum</label>
<input type="date" name="gb" id="gb" required ><br>

<label for="haus">Straße und Hausnummer</label>
<input type="text" name="haus" id="haus" required ><br>

<label for="ort">Ort</label><br>
<input type="text" name="ort" id="ort" required><br>

<label for="plz">PLZ</label>
<input type="number" name="plz" id="plz" required min="1000" max="9999"><br><br>

<label for="schule">Derzeit besuche ich folgende Schule</label>
<select name="schule" id="schule">
<option name="schule" value="Volkschule">Volkschule</option>
<option name="schule" value="Kindergarten">Kindergarten</option>
<option name="schule" value="Krabbelgruppe">Krabbelgruppe</option>
</select>


<h2>Erziehungsberechtigte/r</h2>

<label for="erziehung">Vor- und Zuname</label>
<input type="text" name="erziehung" id="erziehung" required><br>

<label for="email">E-Mail Adresse</label>
<input type="email" name="email" id="email" required ><br>

<label for="tel">Telefonnummer</label>
<input type="text" name="tel" id="tel" required><br><br>



<h2>Sonstiges</h2>
<label for="sonstiges">Anmerkungen</label><br><br>
<textarea name="sonstiges" id="sontiges"></textarea><br><br>
<label for="einwilligung">Zustimmung der Datenverarbeitung</label><br>
<input type="checkbox" name="" id="" value="einwilligung" required>Ich willige ein...<br><br>

<input type="submit" name="submit" value="Anmelden">

</form>

</body>
</html>   
<?php  }  //Geschlossene Klammer vom obrigen PHP Code ?>
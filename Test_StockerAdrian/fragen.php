<?php
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $_SESSION["name"] = $_POST["name"];
    header("Location: fragen.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bewertung der Umfragefragen</title>
</head>
<body>
    <form action="abschluss.php" method="POST">
    <label for="zufriedenheit">Wie zufrieden sind Sie mit unserer Website?</label>
    <select name="zufriedenheit" id="zufriedenheit" required>
    <option value="Sehr zufrieden">Sehr zufrieden</option>
    <option value="Zufrieden">Zufrieden</option>
    <option value="Neutral">Neutral</option>
    <option value="Unzufrieden">Unzufrieden</option>
    </select>          
    <br><br>

    <label for="besuche">Wie oft besuchen Sie unsere Seite?</label>
    <select name="besuche" id="besuche" required>
    <option value="Täglich">Täglich</option>
    <option value="Wöchentlich">Wöchentlich</option>
    <option value="Monatlich">Monatlich</option>
    <option value="Selten">Selten</option>
    </select>          
    <br><br>

    <input type="submit" value="Senden">
    </form>

</body>
</html>

<?php

require_once("dbconnection.php");

$benutzername = "";
$punkte = "";
$meldung = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $benutzername = trim($_POST["benutzername"]);
    $punkte = trim($_POST["punkte"]);
    

    if (empty($benutzername) || empty($punkte)) {
        $meldung = "Bitte füllen Sie alle Felder aus.";
    } elseif (!is_numeric($punkte)) {
        $meldung = "Die Punktezahl muss eine Zahl sein.";
    } else {
        try {

            $sql = "INSERT INTO highscores (benutzername, punkte) VALUES (:benutzername, :punkte)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':benutzername' => $benutzername,
                ':punkte' => $punkte,
            ]);
            $meldung = "Highscore erfolgreich gemeldet!";
        } catch (PDOException $e) {
            $meldung = "Fehler beim Einfügen des Highscores: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Highscore melden</title>
</head>
<body>
    <h1>Highscore melden</h1>
    
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['SCRIPT_NAME']); ?>">
        <label for="benutzername">Name:</label>
        <input type="text" id="benutzername" name="benutzername" value="<?php echo htmlspecialchars($benutzername); ?>" required>
        <br><br>
        
        <label for="punkte">Punkte:</label>
        <input type="text" id="punkte" name="punkte" value="<?php echo htmlspecialchars($punkte); ?>" required>
        <br><br>
        
        <button type="submit">Highscore melden</button>
    </form>
    
    <p><?php echo $meldung; ?></p>
</body>
</html>

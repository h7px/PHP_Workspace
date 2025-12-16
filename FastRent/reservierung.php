<?php
$host = 'localhost';
$dbname = 'leihwagen'; 
$user = 'fastrent'; 
$password = 'prompt'; 

define("AUDI", 180);
define("VW", 60);
define("TESLA", 100);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['fahrzeug']) && !empty($_POST['betreuer']) && !empty($_POST['kunde']) && !empty($_POST['entlehndatum']) && !empty($_POST['tage'])) {
        $fahrzeug = htmlspecialchars(trim($_POST['fahrzeug']));
        $betreuer = htmlspecialchars(trim($_POST['betreuer']));
        $kunde = htmlspecialchars(trim($_POST['kunde']));
        $entlehndatum = htmlspecialchars(trim($_POST['entlehndatum']));
        $tage = (int) $_POST['tage'];

        switch ($fahrzeug) {
            case "Audi A4":
                $preis = AUDI * $tage;
                break;
            case "VW Golf":
                $preis = VW * $tage;
                break;
            case "Tesla Model 3":
                $preis = TESLA * $tage;
                break;
            default:
                exit('Unbekanntes Fahrzeug.');
        }

        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                ]);
        
        $stmt = $pdo->prepare(
            'INSERT INTO reservierungen (fahrzeug, betreuer, kundenname, entlehndatum, tage)
            VALUES (:fahrzeug, :betreuer, :kundenname, :entlehndatum, :tage)'
        );

        $stmt->execute([
            ':fahrzeug'   => $fahrzeug,
            ':betreuer'   => $betreuer,
            ':kundenname' => $kunde,
            ':entlehndatum' => $entlehndatum,
            ':tage'       => $tage,
        ]);

        echo "<h1>Reservierung gespeichert.</h1>";
        echo "<p>Sehr geehrte/r Herr/Frau <b>$kunde</b>, Ihr <b>$fahrzeug</b> ist ab <b>$entlehndatum</b> für Sie reserviert!</p>";
        echo "<p>Kosten: <b>$preis Euro</b>, Laufzeit: <b>$tage Tage</b></p>";
        echo "<p>Bei Fragen wenden Sie sich bitte an <b>$betreuer</b>.</p>";
    } else {
        echo "<h1>Verarbeitung nicht möglich!</h1><p>Bitte füllen Sie alle Felder aus.</p><a href=\"formular.html\">Zurück zum Formular</a>";
    }
}
?>
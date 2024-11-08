<?php
// anmeldeformular.php
// Database connection parameters
$host = '127.0.0.1'; // Update with your database host
$dbname = 'anmeldeformular'; // Update with your database name
$user = 'root'; // Update with your database username
$password = ''; // Update with your database password

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Get and sanitize form inputs
    $ausbildung = [];
    if (isset($_GET['cbhak'])) $ausbildung[] = "Classic Business HAK";
    if (isset($_GET['dbhak'])) $ausbildung[] = "Digital Business HAK";
    if (isset($_GET['phas'])) $ausbildung[] = "Praxis HAS";
    if (isset($_GET['htlm'])) $ausbildung[] = "HTL Mechatronik";

    $ausbildung_str = implode(", ", $ausbildung);
    $name = !empty($_GET['name']) ? htmlspecialchars($_GET['name']) : NULL;
    $geburtsdatum = !empty($_GET['gbdatum']) ? htmlspecialchars($_GET['gbdatum']) : NULL;
    $adresse = !empty($_GET['adresse']) ? htmlspecialchars($_GET['adresse']) : NULL;
    $ort = !empty($_GET['ort']) ? htmlspecialchars($_GET['ort']) : NULL;
    $schule = !empty($_GET['schule']) ? htmlspecialchars($_GET['schule']) : NULL;
    $ename = !empty($_GET['ename']) ? htmlspecialchars($_GET['ename']) : NULL;
    $email = !empty($_GET['email']) ? htmlspecialchars($_GET['email']) : NULL;
    $telefon = !empty($_GET['tel']) ? htmlspecialchars($_GET['tel']) : NULL;
    $anmerkungen = !empty($_GET['anm']) ? htmlspecialchars($_GET['anm']) : NULL;
    $zustimmung = isset($_GET['zustimmung']) ? 1 : 0;
    $geschlecht = !empty($_GET['geschlechtValue']) ? htmlspecialchars($_GET['geschlechtValue']) : NULL;

    // Insert data into the database
    try {
        // Establish database connection
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare SQL statement
        $stmt = $pdo->prepare("INSERT INTO anmeldungen (ausbildung, name, geburtsdatum, adresse, ort, schule, ename, email, telefon, anmerkungen, zustimmung, geschlecht) 
                               VALUES (:ausbildung, :name, :geburtsdatum, :adresse, :ort, :schule, :ename, :email, :telefon, :anmerkungen, :zustimmung, :geschlecht)");

        // Bind parameters
        $stmt->bindParam(':ausbildung', $ausbildung_str);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':geburtsdatum', $geburtsdatum);
        $stmt->bindParam(':adresse', $adresse);
        $stmt->bindParam(':ort', $ort);
        $stmt->bindParam(':schule', $schule);
        $stmt->bindParam(':ename', $ename);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telefon', $telefon);
        $stmt->bindParam(':anmerkungen', $anmerkungen);
        $stmt->bindParam(':zustimmung', $zustimmung, PDO::PARAM_BOOL);
        $stmt->bindParam(':geschlecht', $geschlecht);

        // Execute the statement
        $stmt->execute();

        // Confirmation message
        echo "<!DOCTYPE html>
        <html lang='de'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Bestätigung der Anmeldung</title>
            <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css' rel='stylesheet'>
        </head>
        <body class='bg-light'>
            <div class='container mt-5'>
                <h1 class='text-center mb-5'>Bestätigung der Anmeldung</h1>
                <div class='bg-white p-4 rounded shadow-sm'>
                    <h2>Ausbildungswunsch</h2>
                    <p>". htmlspecialchars($ausbildung_str) ."</p>
                    
                    <h2>Persönliche Daten</h2>
                    <p><strong>Vor- und Nachname:</strong> ". htmlspecialchars($name) ."</p>
                    <p><strong>Geschlecht:</strong> ". htmlspecialchars($geschlecht) ."</p>
                    <p><strong>Geburtsdatum:</strong> ". htmlspecialchars($geburtsdatum) ."</p>
                    <p><strong>Adresse:</strong> ". htmlspecialchars($adresse) .", ". htmlspecialchars($ort) ."</p>
                    <p><strong>Derzeitige Schule:</strong> ". htmlspecialchars($schule) ."</p>
                    
                    <h2>Erziehungsberechtigte/-r</h2>
                    <p><strong>Vor- und Nachname:</strong> ". htmlspecialchars($ename) ."</p>
                    <p><strong>E-Mail-Adresse:</strong> ". htmlspecialchars($email) ."</p>
                    <p><strong>Telefonnummer:</strong> ". htmlspecialchars($telefon) ."</p>

                    <h2>Anmerkungen</h2>
                    <p>". htmlspecialchars($anmerkungen) ."</p>

                    <h2>Zustimmung zur Datenverarbeitung</h2>
                    <p>". ($zustimmung ? "Ja" : "Nein") ."</p>
                    
                    <div class='text-center mt-4'>
                        <a href='anmeldeformular.html' class='btn btn-primary'>Zurück zum Formular</a>
                    </div>
                </div>
            </div>
        </body>
        </html>";
    } catch (PDOException $e) {
        echo "Fehler: Ungültige Daten eingegeben! " . $e->getMessage();
    }
} else {
    // Redirect to form if accessed directly
    header("Location: anmeldeformular.html");
    exit();
}
?>

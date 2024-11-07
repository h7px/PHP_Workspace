<?php
// anmeldeformular.php

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Get and sanitize form inputs
    $ausbildung = [];
    if (isset($_GET['cbhak'])) $ausbildung[] = "Classic Business HAK";
    if (isset($_GET['dbhak'])) $ausbildung[] = "Digital Business HAK";
    if (isset($_GET['phas'])) $ausbildung[] = "Praxis HAS";
    if (isset($_GET['htlm'])) $ausbildung[] = "HTL Mechatronik";

    $name = htmlspecialchars($_GET['name']);
    $geburtsdatum = htmlspecialchars($_GET['gbdatum']);
    $adresse = htmlspecialchars($_GET['adresse']);
    $ort = htmlspecialchars($_GET['ort']);
    $schule = htmlspecialchars($_GET['schule']);
    $ename = htmlspecialchars($_GET['ename']);
    $email = htmlspecialchars($_GET['email']);
    $telefon = htmlspecialchars($_GET['tel']);
    $anmerkungen = htmlspecialchars($_GET['anm']);
    $zustimmung = isset($_GET['zustimmung']) ? "Ja" : "Nein";

    // Display a confirmation page
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
                <p>". implode(", ", $ausbildung) ."</p>
                
                <h2>Persönliche Daten</h2>
                <p><strong>Vor- und Nachname:</strong> $name</p>
                <p><strong>Geburtsdatum:</strong> $geburtsdatum</p>
                <p><strong>Adresse:</strong> $adresse, $ort</p>
                <p><strong>Derzeitige Schule:</strong> $schule</p>
                
                <h2>Erziehungsberechtigte/-r</h2>
                <p><strong>Vor- und Nachname:</strong> $ename</p>
                <p><strong>E-Mail-Adresse:</strong> $email</p>
                <p><strong>Telefonnummer:</strong> $telefon</p>

                <h2>Anmerkungen</h2>
                <p>$anmerkungen</p>

                <h2>Zustimmung zur Datenverarbeitung</h2>
                <p>$zustimmung</p>
                
                <div class='text-center mt-4'>
                    <a href='anmeldeformular.html' class='btn btn-primary'>Zurück zum Formular</a>
                </div>
            </div>
        </div>
    </body>
    </html>";
} else {
    // Redirect to form if accessed directly
    header("Location: anmeldeformular.html");
    exit();
}
?>

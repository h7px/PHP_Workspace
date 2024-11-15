<?php
// Database connection parameters
$host = '127.0.0.1'; // Update with your database host
$dbname = 'vermisst'; // Update with your database name
$user = 'root'; // Update with your database username
$password = ''; // Update with your database password

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Get and sanitize form inputs
    $vorname = !empty($_GET['vname']) ? htmlspecialchars($_GET['vname']) : NULL;
    $nachname = !empty($_GET['nname']) ? htmlspecialchars($_GET['nname']) : NULL;
    $email = !empty($_GET['email']) ? htmlspecialchars($_GET['email']) : NULL;
    $wanngesehen = !empty($_GET['wanngesehen']) ? htmlspecialchars($_GET['wanngesehen']) : NULL;
    $wogesehen = !empty($_GET['wogesehen']) ? htmlspecialchars($_GET['wogesehen']) : NULL;
    $da = isset($_GET['minka']) && $_GET['minka'] == 'Ja' ? 1 : 0;
    $angaben = !empty($_GET['angaben']) ? htmlspecialchars($_GET['angaben']) : NULL;

    // Insert data into the database
    try {
        // Establish database connection
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare SQL statement
        $stmt = $pdo->prepare("INSERT INTO sichtungen (vorname, nachname, email, wanngesehen, wogesehen, da, angaben) 
                               VALUES (:vorname, :nachname, :email, :wanngesehen, :wogesehen, :da, :angaben)");

        // Bind parameters
        $stmt->bindParam(':vorname', $vorname);
        $stmt->bindParam(':nachname', $nachname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':wanngesehen', $wanngesehen);
        $stmt->bindParam(':wogesehen', $wogesehen);
        $stmt->bindParam(':da', $da, PDO::PARAM_BOOL);
        $stmt->bindParam(':angaben', $angaben);

        // Execute the statement
        $stmt->execute();

        // Confirmation message
        echo "<!DOCTYPE html>
        <html lang='de'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Bestätigung der Sichtung</title>
            <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' rel='stylesheet'>
        </head>
        <body class='bg-light'>
            <div class='container mt-5'>
                <h1 class='text-center mb-5'>Bestätigung der Sichtung</h1>
                <div class='bg-white p-4 rounded shadow-sm'>
                    <h2>Vielen Dank!</h2>
                    <p>Ihre Meldung wurde erfolgreich übermittelt.</p>
                    <div class='text-center mt-4'>
                        <a href='" . htmlspecialchars($_SERVER['PHP_SELF']) . "' class='btn btn-primary'>Zurück zum Formular</a>
                    </div>
                </div>
            </div>
        </body>
        </html>";
    } catch (PDOException $e) {
        echo "Fehler: Ungültige Daten eingegeben! " . $e->getMessage();
    }
} else {
    // Display the form if it's not a GET request
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vermisst</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding: 20px;
        }
        form {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        img {
            display: block;
            margin: auto;
        }
    </style>
</head>
<body>

<form action="<?php echo htmlspecialchars($_SERVER['SCRIPT_NAME']); ?>" method="get">
    <img src="katze.png" alt="Logo" class="mb-4" style="max-width: 100px;">
    <h3 class="text-center mb-4">Wenn Sie sie gesehen haben, dann füllen Sie bitte dieses Formular aus:</h3>

    <div class="mb-3">
        <label for="vname" class="form-label">Vorname:</label>
        <input type="text" class="form-control" id="vname" name="vname">
    </div>

    <div class="mb-3">
        <label for="nname" class="form-label">Nachname:</label>
        <input type="text" class="form-control" id="nname" name="nname">
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Wie lautet Ihre E-Mail-Adresse?</label>
        <input type="email" class="form-control" id="email" name="email">
    </div>

    <div class="mb-3">
        <label for="wanngesehen" class="form-label">Wann haben Sie Minka gesehen?</label>
        <input type="date" class="form-control" id="wanngesehen" name="wanngesehen">
    </div>

    <div class="mb-3">
        <label for="wogesehen" class="form-label">Wo haben Sie sie gesehen?</label>
        <input type="text" class="form-control" id="wogesehen" name="wogesehen">
    </div>

    <div class="mb-3">
        <label class="form-label">Ist Minka noch bei Ihnen?</label><br>
        <div class="form-check form-check-inline">
            <input type="radio" class="form-check-input" name="minka" id="minkaJa" value="Ja">
            <label for="minkaJa" class="form-check-label">Ja</label>
        </div>
        <div class="form-check form-check-inline">
            <input type="radio" class="form-check-input" name="minka" id="minkaNein" value="Nein">
            <label for="minkaNein" class="form-check-label">Nein</label>
        </div>
    </div>

    <div class="mb-3">
        <label for="angaben" class="form-label">Weitere Angaben:</label>
        <textarea rows="3" class="form-control" id="angaben" name="angaben"></textarea>
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-primary">Sichtung melden</button>
    </div>
</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
}
?>

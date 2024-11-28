<?php
if (isset($_GET['submit'])) {
    // Check if all required fields are filled
    if (!empty($_GET['vname']) && !empty($_GET['nname']) && !empty($_GET['email']) && !empty($_GET['wanngesehen']) && !empty($_GET['wogesehen']) && !empty($_GET['angaben'])) {
    
        $vorname = htmlspecialchars($_GET['vorname']);
        require_once("dbconnection.php");

        try {

            $sql = "SELECT * FROM meldungen";
            $stmt;

            // Prepare SQL statement
            $stmt = $pdo->prepare("
                INSERT INTO sichtungen (vorname, nachname, email, wanngesehen, wogesehen, da, angaben) 
                VALUES (:vorname, :nachname, :email, :wanngesehen, :wogesehen, :da, :angaben)
            ");

            $stmt->bindParam(":vorname",$vorname);

             // Bind and execute the statement
            $stmt->execute([
                ':vorname' => $_GET['vname'],
                ':nachname' => $_GET['nname'],
                ':email' => $_GET['email'],
                ':wanngesehen' => $_GET['wanngesehen'],
                ':wogesehen' => $_GET['wogesehen'],
                ':da' => isset($_GET['minka']) && $_GET['minka'] === 'Ja' ? 1 : 0, // Convert radio button value to 1/0
                ':angaben' => $_GET['angaben']
            ]);

            // Success message
            echo "<div class='alert alert-success text-center'>Vielen Dank! Ihre Meldung wurde erfolgreich gespeichert.</div>";
        } catch (PDOException $e) {
            // Error message
            echo "<div class='alert alert-danger text-center'>Fehler bei der Speicherung: " . $e->getMessage() . "</div>";
        }
    } else {
        // Display error if form validation fails
        echo "<div class='alert alert-warning text-center'>Bitte füllen Sie das Formular richtig aus.</div>";
    }
}
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
        <button type="submit" class="btn btn-primary" name="submit">Sichtung melden</button>
    </div>
</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

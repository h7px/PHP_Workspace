<?php

require_once("dbconnection.php");

$benutzername = "";
$punkte = "";
$meldung = "";
$screenshot_name = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $benutzername = trim($_POST["benutzername"]);
    $punkte = trim($_POST["punkte"]);

    // Auslesen der Daten der übertragenen Datei
    // {"screenshot", "zweiteDatei", "dritteDatei"}
    // |-> "name": "screenshot"
    // |-> "size": "32000"
    // |-> "type": "jpeg"
    // |-> "tmp_name": "di2n4kdnd3.jpg"
    $screenshot_name = trim($_FILES["screenshot"]["name"]);
    $screenshot_type = $_FILES["screenshot"]["type"];
    $screenshot_size = $_FILES["screenshot"]["size"];
    $screenshot_tmp_name = $_FILES["screenshot"]["tmp_name"];

    // Überprüfen, ob der Typ der Datei und die Größe der Datei in Ordnung sind.
    if (($screenshot_type == "image/jpeg" || 
        $screenshot_type == "image/png" ||
        $screenshot_type == "image/gif") && 
        $screenshot_size > 0 && 
        $screenshot_size <= 32000){
        
    // Datei ok --> Datei aus dem temporären Ordner am Server in den Zielordner auf dem Server verschieben. (dort bleibt die Datei bis der zugehörige DB-Eintrag gelöscht wird)
    // Zielpfad festlegen
    $ziel = "/screenshot_files/" . $screenshot_name;
    // Verschieben der Datei
    if(move_uploaded_file($screenshot_tmp_name, $ziel)){
        // Datei wurde in den Zielordner am Webserver verschoben.
        // Jetzt kann der Eintrag in die DB geschrieben werden.
        

        if (empty($benutzername) || empty($punkte)) {
            $meldung = "Bitte füllen Sie alle Felder aus.";
        } elseif (!is_numeric($punkte)) {
            $meldung = "Die Punktezahl muss eine Zahl sein."; 
        } else {
            try {
                $sql = "INSERT INTO highscores (benutzername, punkte, screenshot) VALUES (:benutzername, :punkte, :screenshot)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    ':benutzername' => $benutzername,
                    ':punkte' => $punkte,
                    ':screenshot' => $screenshot_name,
                ]);
                $meldung = "Highscore erfolgreich gemeldet!";
            } catch (PDOException $e) {
                $meldung = "Fehler beim Einfügen des Highscores: " . $e->getMessage();
            }
        }
    }

    } else {
        // Fehler beim Verschieben der Datei
    }

    }


   
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Highscore melden</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center mb-0">Highscore melden</h2>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($meldung)): ?>
                            <div class="alert <?php echo strpos($meldung, 'erfolgreich') !== false ? 'alert-success' : 'alert-danger'; ?>" role="alert">
                                <?php echo htmlspecialchars($meldung); ?>
                            </div>
                        <?php endif; ?>
                        
                        <!-- Form-Tag ergänzen (enctype="multipart/form-data") - Wichtig: Dateien können nur mit POST übertragen werden. -->
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER['SCRIPT_NAME']); ?>" class="needs-validation" enctype="multipart/form-data" novalidate>
                            <div class="mb-3">
                                <label for="benutzername" class="form-label">Name:</label>
                                <input type="text" class="form-control" id="benutzername" name="benutzername" 
                                    value="<?php echo htmlspecialchars($benutzername); ?>" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="punkte" class="form-label">Punkte:</label>
                                <input type="number" class="form-control" id="punkte" name="punkte" 
                                    value="<?php echo htmlspecialchars($punkte); ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="screenshot" class="form-label">Screenshot:</label>
                                <input type="file" class="form-control" id="screenshot" name="screenshot" required>
                            </div>
                            
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Highscore melden</button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <div class="text-center mt-3">
                    <a href="index.php" class="btn btn-secondary">Zurück zur Highscore-Liste</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

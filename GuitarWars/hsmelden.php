<?php

require_once("dbconnection.php");
require_once("appKonstanten.php");

$benutzername = "";
$punkte = "";
$meldung = "";
$screenshot_name = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $benutzername = trim($_POST["benutzername"]);
    $punkte = trim($_POST["punkte"]);

    $screenshot_name = trim($_FILES["screenshot"]["name"]);
    $screenshot_type = $_FILES["screenshot"]["type"];
    $screenshot_size = $_FILES["screenshot"]["size"];
    $screenshot_tmp_name = $_FILES["screenshot"]["tmp_name"];

    if (($screenshot_type == "image/jpeg" || 
        $screenshot_type == "image/png" ||
        $screenshot_type == "image/gif") && 
        $screenshot_size > 0 && 
        $screenshot_size <= MAXDATEIGROESSE){
        
        $ziel = ORDNER . $screenshot_name;
        
        if (!file_exists("screenshot_files")) {
            mkdir("screenshot_files", 0777, true);
        }
        
        if(move_uploaded_file($screenshot_tmp_name, $ziel)){
            if (empty($benutzername) || empty($punkte)) {
                $meldung = "Bitte füllen Sie alle Felder aus.";
            } elseif (!is_numeric($punkte)) {
                $meldung = "Die Punktezahl muss eine Zahl sein."; 
            } elseif (strlen($benutzername) > 30) {
                $meldung = "Der Benutzername darf maximal 30 Zeichen lang sein.";
            } elseif ($punkte <= 0 || $punkte > 999999) {
                $meldung = "Bitte geben Sie eine gültige Punktzahl ein (1-999999).";
            } else {
                try {
                   
                    $benutzername = trim(htmlspecialchars($benutzername));
                    $punkte = trim($punkte);
                    $sql = "INSERT INTO highscores (benutzername, punkte, screenshot) VALUES (:benutzername, :punkte, :screenshot)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([
                        ':benutzername' => $benutzername,
                        ':punkte' => $punkte,
                        ':screenshot' => $screenshot_name,
                    ]);
                    $meldung = "Highscore erfolgreich gemeldet!";
                } catch (PDOException $e) {
                     if (file_exists($ziel)) {
                        unlink($ziel);
                    }
                    $meldung = "Fehler beim Einfügen des Highscores: " . $e->getMessage();
                }
            }
        } else {
            $meldung = "Fehler beim Hochladen des Screenshots.";
        }
    } else {
        $meldung = "Ungültiger Dateityp oder Dateigröße. Erlaubt sind JPEG, PNG oder GIF bis 4 Megabyte.";
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

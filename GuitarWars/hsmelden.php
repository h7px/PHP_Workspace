<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

require_once("dbconnection.php");
require_once("appKonstanten.php");

$punkte = "";
$meldung = "";
$screenshot_name = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
            if (empty($punkte)) {
                $meldung = "Bitte füllen Sie alle Felder aus.";
            } elseif (!is_numeric($punkte)) {
                $meldung = "Die Punktezahl muss eine Zahl sein."; 
            } elseif ($punkte <= 0 || $punkte > 999999) {
                $meldung = "Bitte geben Sie eine gültige Punktzahl ein (1-999999).";
            } else {
                try {
                    $sql = "INSERT INTO highscores (benutzername, punkte, screenshot) VALUES (:benutzername, :punkte, :screenshot)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([
                        ':benutzername' => $_SESSION['username'],
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
    <title>Guitar Wars - Highscores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .navbar-nav {
            margin-left: auto;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <i class="bi bi-guitar"></i> Guitar Wars
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">
                            <i class="bi bi-trophy"></i> Highscores
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="hsmelden.php">
                            <i class="bi bi-plus-circle"></i> Score melden
                        </a>
                    </li>
                    <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="admin.php">
                                <i class="bi bi-shield-lock"></i> Administration
                            </a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <span class="nav-link">
                            <i class="bi bi-person-circle"></i> Angemeldet als <?php echo htmlspecialchars($_SESSION['username']); ?>
                        </span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
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
                        
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="needs-validation" enctype="multipart/form-data" novalidate>
                            <div class="mb-3">
                                <label for="benutzername" class="form-label">Name:</label>
                                <input type="text" class="form-control" id="benutzername" name="benutzername" 
                                    value="<?php echo htmlspecialchars($_SESSION['username']); ?>" readonly disabled>
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

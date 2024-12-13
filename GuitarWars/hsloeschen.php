<?php
require_once("dbconnection.php");

$meldung = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm_delete'])) {
    try {
        $id = $_POST['id'];
        $screenshot = $_POST['screenshot'];

        if (!empty($screenshot)) {
            $screenshot_path = "screenshot_files/" . $screenshot;
            if (file_exists($screenshot_path)) {
                unlink($screenshot_path);
            }
        }

        $sql = "DELETE FROM highscores WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);

        header("Location: admin.php");
        exit;
    } catch (PDOException $e) {
        $meldung = "Fehler beim Löschen des Highscores: " . $e->getMessage();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = isset($_GET['id']) ? $_GET['id'] : '';
    $name = isset($_GET['name']) ? htmlspecialchars($_GET['name']) : '';
    $punkte = isset($_GET['punkte']) ? htmlspecialchars($_GET['punkte']) : '';
    $datum = isset($_GET['datum']) ? htmlspecialchars($_GET['datum']) : '';
    $screenshot = isset($_GET['screenshot']) ? htmlspecialchars($_GET['screenshot']) : '';

    if (empty($id)) {
        header("Location: admin.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Highscore löschen - Bestätigung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center mb-0">Highscore löschen</h2>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($meldung)): ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $meldung; ?>
                            </div>
                        <?php endif; ?>

                        <div class="alert alert-warning" role="alert">
                            Möchten Sie den folgenden Highscore wirklich löschen?
                        </div>

                        <div class="mb-4">
                            <p><strong>Name:</strong> <?php echo $name; ?></p>
                            <p><strong>Punkte:</strong> <?php echo $punkte; ?></p>
                            <p><strong>Datum:</strong> <?php echo $datum; ?></p>
                            <?php if (!empty($screenshot)): ?>
                                <p><strong>Screenshot:</strong></p>
                                <img src="screenshot_files/<?php echo $screenshot; ?>" 
                                     alt="Screenshot" class="img-fluid mb-3" 
                                     style="max-width: 200px;">
                            <?php endif; ?>
                        </div>

                        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="hidden" name="screenshot" value="<?php echo $screenshot; ?>">
                            
                            <div class="d-grid gap-2">
                                <button type="submit" name="confirm_delete" class="btn btn-danger">
                                    Ja, Highscore löschen
                                </button>
                                <a href="admin.php" class="btn btn-secondary">
                                    Nein, zurück zur Übersicht
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 
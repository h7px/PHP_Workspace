<?php
require_once("dbconnection.php");

try {
    $sql = "SELECT id, benutzername, punkte, datum, screenshot, bestaetigt FROM highscores WHERE bestaetigt = 0 ORDER BY punkte DESC";
    $stmt = $pdo->query($sql);
    $highscores = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Fehler beim Abrufen der Highscores: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guitar Wars - Administration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Guitar Wars - Administration</h2>
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Punkte</th>
                        <th>Name</th>
                        <th>Datum</th>
                        <th>Screenshot</th>
                        <th>Aktion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($highscores)): ?>
                        <?php foreach ($highscores as $highscore): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($highscore['punkte']); ?></td>
                                <td><?php echo htmlspecialchars($highscore['benutzername']); ?></td>
                                <td><?php echo htmlspecialchars($highscore['datum']); ?></td>
                                <td>
                                    <?php if (!empty($highscore['screenshot'])): ?>
                                        <img src="screenshot_files/<?php echo htmlspecialchars($highscore['screenshot']); ?>" 
                                             alt="Screenshot" style="max-width: 100px;">
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if (!$highscore['bestaetigt']): ?>
                                        <a href="hsbestaetigen.php?id=<?php echo $highscore['id']; ?>&datum=<?php echo urlencode($highscore['datum']); ?>&name=<?php echo urlencode($highscore['benutzername']); ?>&punkte=<?php echo urlencode($highscore['punkte']); ?>&screenshot=<?php echo urlencode($highscore['screenshot']); ?>" 
                                           class="btn btn-success btn-sm me-2">
                                            Bestätigen
                                        </a>
                                    <?php endif; ?>
                                    <a href="hsloeschen.php?id=<?php echo $highscore['id']; ?>&datum=<?php echo urlencode($highscore['datum']); ?>&name=<?php echo urlencode($highscore['benutzername']); ?>&punkte=<?php echo urlencode($highscore['punkte']); ?>&screenshot=<?php echo urlencode($highscore['screenshot']); ?>" 
                                       class="btn btn-danger btn-sm"
                                       onclick="return confirm('Möchten Sie diesen Highscore wirklich löschen?');">
                                        Löschen
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">Keine Highscores vorhanden.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        
        <div class="text-center mt-3">
            <a href="index.php" class="btn btn-secondary">Zurück zur Highscore-Liste</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 
<?php

require_once("dbconnection.php");

try {
    $sql = "SELECT benutzername, punkte, datum, screenshot FROM highscores ORDER BY punkte DESC";
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
    <title>Guitar Wars - Highscores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Highscores</h2>
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Punkte</th>
                        <th>Name</th>
                        <th>Datum</th>
                        <th>Screenshot</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($highscores)): ?>
                        <?php foreach ($highscores as $index => $highscore): ?>
                            <tr <?php echo $index === 0 ? 'class="table-warning fw-bold"' : ''; ?>>
                                <td><?php echo htmlspecialchars($highscore['punkte']); ?></td>
                                <td><?php echo htmlspecialchars($highscore['benutzername']); ?></td>
                                <td><?php echo htmlspecialchars($highscore['datum']); ?></td>
                                <td>
                                    <?php if (!empty($highscore['screenshot'])): ?>
                                        <img src="screenshot_files/<?php echo htmlspecialchars($highscore['screenshot']); ?>" 
                                             alt="Screenshot" style="max-width: 100px;">
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center">Keine Highscores vorhanden.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

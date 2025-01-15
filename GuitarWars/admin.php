<?php
session_start();

// Check if user is logged in and is an admin
if (!isset($_SESSION['user_id']) || !isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header("Location: login.php");
    exit;
}

require_once("dbconnection.php");

try {
    $sql = "SELECT id, benutzername, punkte, datum, screenshot, bestaetigt FROM highscores ORDER BY punkte DESC";
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .navbar-nav {
            margin-left: auto;
        }
        .btn-group-vertical {
            width: 100%;
        }
        .btn-group-vertical .btn {
            margin-bottom: 0.25rem;
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
                    <li class="nav-item">
                        <a class="nav-link" href="admin.php">
                            <i class="bi bi-shield-lock"></i> Administration
                        </a>
                    </li>
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
        <h2 class="mb-4">Guitar Wars - Administration</h2>
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Punkte</th>
                        <th>Name</th>
                        <th>Datum</th>
                        <th>Screenshot</th>
                        <th>Status</th>
                        <th style="width: 140px;">Aktion</th>
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
                                    <?php echo $highscore['bestaetigt'] ? 'Bestätigt' : 'Unbestätigt'; ?>
                                </td>
                                <td>
                                    <div class="btn-group-vertical">
                                        <?php if (!$highscore['bestaetigt']): ?>
                                            <a href="hsbestaetigen.php?id=<?php echo $highscore['id']; ?>&datum=<?php echo urlencode($highscore['datum']); ?>&name=<?php echo urlencode($highscore['benutzername']); ?>&punkte=<?php echo urlencode($highscore['punkte']); ?>&screenshot=<?php echo urlencode($highscore['screenshot']); ?>" 
                                               class="btn btn-success btn-sm">
                                                Bestätigen
                                            </a>
                                        <?php else: ?>
                                            <a href="hswiderrufen.php?id=<?php echo $highscore['id']; ?>&datum=<?php echo urlencode($highscore['datum']); ?>&name=<?php echo urlencode($highscore['benutzername']); ?>&punkte=<?php echo urlencode($highscore['punkte']); ?>&screenshot=<?php echo urlencode($highscore['screenshot']); ?>" 
                                               class="btn btn-warning btn-sm">
                                                Widerrufen
                                            </a>
                                        <?php endif; ?>
                                        <a href="hsloeschen.php?id=<?php echo $highscore['id']; ?>&datum=<?php echo urlencode($highscore['datum']); ?>&name=<?php echo urlencode($highscore['benutzername']); ?>&punkte=<?php echo urlencode($highscore['punkte']); ?>&screenshot=<?php echo urlencode($highscore['screenshot']); ?>" 
                                           class="btn btn-danger btn-sm">
                                            Löschen
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">Keine Highscores vorhanden.</td>
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
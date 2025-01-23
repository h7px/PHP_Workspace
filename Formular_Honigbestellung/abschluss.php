<?php
session_name("HONIG");
session_start();

// If no session data, redirect back to form
if (!isset($_SESSION['honigsorte'])) {
    header("Location: formular.php");
    exit;
}

$bestellungAbgeschlossen = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Store address data in session
    $_SESSION['name'] = $_POST['name'];
    $_SESSION['adresse'] = $_POST['adresse'];
    $_SESSION['email'] = $_POST['email'];
    
    $bestellungAbgeschlossen = true;
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bestellung abschließen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center mb-0">
                            <?php echo $bestellungAbgeschlossen ? 'Bestellung abgeschlossen' : 'Adressdaten eingeben'; ?>
                        </h2>
                    </div>
                    <div class="card-body">
                        <?php if (!$bestellungAbgeschlossen): ?>
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name:</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>

                                <div class="mb-3">
                                    <label for="adresse" class="form-label">Adresse:</label>
                                    <textarea class="form-control" id="adresse" name="adresse" rows="3" required></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">E-Mail:</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary">Bestellung abschließen</button>
                                    <a href="bestellung.php" class="btn btn-secondary">Zurück zur Übersicht</a>
                                </div>
                            </form>
                        <?php else: ?>
                            <h3>Bestellungsdetails:</h3>
                            <ul class="list-group mb-4">
                                <li class="list-group-item">
                                    <strong>Honigsorte:</strong> <?php echo htmlspecialchars($_SESSION['honigsorte']); ?>
                                </li>
                                <li class="list-group-item">
                                    <strong>Menge:</strong> <?php echo htmlspecialchars($_SESSION['menge']); ?> Gläser
                                </li>
                                <li class="list-group-item">
                                    <strong>Glasgröße:</strong> <?php echo htmlspecialchars($_SESSION['glasgroesse']); ?>
                                </li>
                                <li class="list-group-item">
                                    <strong>Name:</strong> <?php echo htmlspecialchars($_SESSION['name']); ?>
                                </li>
                                <li class="list-group-item">
                                    <strong>Adresse:</strong> <?php echo nl2br(htmlspecialchars($_SESSION['adresse'])); ?>
                                </li>
                                <li class="list-group-item">
                                    <strong>E-Mail:</strong> <?php echo htmlspecialchars($_SESSION['email']); ?>
                                </li>
                                <li class="list-group-item">
                                    <strong>Preis pro Glas:</strong> <?php echo number_format($_SESSION['einzelpreis'], 2, ',', '.'); ?> €
                                </li>
                                <li class="list-group-item">
                                    <strong>Gesamtpreis:</strong> <?php echo number_format($_SESSION['gesamtpreis'], 2, ',', '.'); ?> €
                                </li>
                            </ul>

                            <div class="alert alert-info">
                                <strong>Session-ID:</strong> <?php echo session_id(); ?>
                            </div>

                            <?php
                            // Clear session variables and destroy session
                            session_unset();
                            session_destroy();
                            ?>

                            <div class="alert alert-success">
                                Ihre Bestellung wurde erfolgreich aufgenommen! Die Session wurde beendet.
                            </div>

                            <div class="d-grid">
                                <a href="formular.php" class="btn btn-primary">Neue Bestellung aufgeben</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
session_name("HONIG");
session_start();

// Define price constants (same as in formular.php)
define('PREIS_250G', 4.90);
define('PREIS_500G', 8.90); 
define('PREIS_1000G', 15.90);

// Store form data in session
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['honigsorte'] = $_POST['honigsorte'];
    $_SESSION['menge'] = $_POST['menge'];
    $_SESSION['glasgroesse'] = $_POST['glasgroesse'];
    
switch ($_SESSION['glasgroesse']) {
    case '250g':
        $preis_pro_glas = PREIS_250G;
        break;
    case '500g':
        $preis_pro_glas = PREIS_500G;
        break;
    case '1000g':
        $preis_pro_glas = PREIS_1000G;
        break;
    default:
        $preis_pro_glas = 0;
        break;
}

    $_SESSION['einzelpreis'] = $preis_pro_glas;
    $_SESSION['gesamtpreis'] = $preis_pro_glas * $_SESSION['menge'];
}

// If no session data, redirect back to form
if (!isset($_SESSION['honigsorte'])) {
    header("Location: formular.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bestellungsübersicht</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center mb-0">Bestellungsübersicht</h2>
                    </div>
                    <div class="card-body">
                        <h4>Ihre Bestellung:</h4>
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
                                <strong>Preis pro Glas:</strong> <?php echo number_format($_SESSION['einzelpreis'], 2, ',', '.'); ?> €
                            </li>
                            <li class="list-group-item">
                                <strong>Gesamtpreis:</strong> <?php echo number_format($_SESSION['gesamtpreis'], 2, ',', '.'); ?> €
                            </li>
                        </ul>

                        <div class="alert alert-info">
                            <strong>Session-ID:</strong> <?php echo session_id(); ?>
                        </div>

                        <div class="d-grid gap-2">
                            <a href="abschluss.php" class="btn btn-primary">Weiter zur Adresseingabe</a>
                            <a href="formular.php" class="btn btn-secondary">Zurück zum Formular</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

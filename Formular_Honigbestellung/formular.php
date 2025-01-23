<?php
session_name("HONIG");
session_start();

define('PREIS_250G', 4.90);
define('PREIS_500G', 8.90); 
define('PREIS_1000G', 15.90);
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Honigbestellung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center mb-0">Honigbestellung</h2>
                    </div>
                    <div class="card-body">
                        <form method="post" action="bestellung.php">
                            <div class="mb-3">
                                <label for="honigsorte" class="form-label">Honigsorte:</label>
                                <select class="form-select" id="honigsorte" name="honigsorte" required>
                                    <option value="">Bitte wählen</option>
                                    <option value="Blütenhonig">Blütenhonig</option>
                                    <option value="Waldhonig">Waldhonig</option>
                                    <option value="Akazienhonig">Akazienhonig</option>
                                    <option value="Lindenhonig">Lindenhonig</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="menge" class="form-label">Menge (in Gläsern):</label>
                                <input type="number" class="form-control" id="menge" name="menge" 
                                       min="1" max="10" required>
                                <div class="form-text">Maximal 10 Gläser pro Bestellung</div>
                            </div>

                            <div class="mb-3">
                                <label for="glasgroesse" class="form-label">Glasgröße:</label>
                                <select class="form-select" id="glasgroesse" name="glasgroesse" required>
                                    <option value="">Bitte wählen</option>
                                    <option value="250g">250g (<?php echo number_format(PREIS_250G, 2, ',', '.'); ?> €)</option>
                                    <option value="500g">500g (<?php echo number_format(PREIS_500G, 2, ',', '.'); ?> €)</option>
                                    <option value="1000g">1000g (<?php echo number_format(PREIS_1000G, 2, ',', '.'); ?> €)</option>
                                </select>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Weiter zur Bestellung</button>
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

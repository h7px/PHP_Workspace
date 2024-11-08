<?php
// anmeldeformular.php
// Database connection parameters
$host = '127.0.0.1'; // Update with your database host
$dbname = 'anmeldeformular'; // Update with your database name
$user = 'root'; // Update with your database username
$password = ''; // Update with your database password

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "GET" && !isset($_GET['submitted'])) {
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anmeldeformular</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Header styling */
        .header {
            width: 100%;
            padding: 10px 20px;
            background-color: #f8f9fa;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transform: translateY(-100%);
            transition: transform 0.3s ease-in-out;
        }
        
        .header.visible {
            transform: translateY(0);
        }

        .header .logo {
            max-width: 50px;
            margin-right: 15px;
        }

        .header-title {
            font-size: 1.25rem;
            font-weight: bold;
            color: #333;
        }

        body {
            padding-top: 70px; /* To offset the fixed header */
        }
        
        h2 {
            margin-bottom: 15px;
        }

        /* Form container styling */
        .form-container {
            max-width: 950px; /* Set max-width to make the form box smaller */
        }

        .animated-slider {
            -webkit-appearance: none;
            width: 100%;
            height: 8px;
            border-radius: 5px;
            outline: none;
            background-size: 200% 100%;
            animation: colorShift 6s infinite ease-in-out; /* Extended time for a smooth transition */
        }

        .animated-slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 20px;
            height: 20px;
            background-color: #333;
            border-radius: 50%;
            cursor: pointer;
        }

        .gender-display-box {
            margin-top: 10px;
            padding: 5px;
            width: 100%;
            text-align: center;
            font-size: 1rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f8f9fa;
        }

    </style>
</head>
<body class="bg-light">

    <!-- Scrollable Header -->
    <header class="header d-flex align-items-center">
        <img src="haklogo.png" alt="Logo" class="logo img-fluid" style="max-width: 60px;">
        <span class="header-title ml-auto" style="font-size: 30px;">Anmeldeformular</span>
    </header>

    <div class="container mt-5 form-container">
        <!-- Logo at the top -->
        <div class="text-center mb-4">
            <img src="haklogo.png" alt="Logo" class="img-fluid" style="max-width: 100px;">
        </div>
        
        <h1 class="text-center mb-5">Anmeldeformular</h1>

        <form method="GET" action="<?php echo $_SERVER['SCRIPT_NAME'];?>?submitted=1" id="anmeldeformular" class="bg-white p-4 rounded shadow-sm">
            <!-- Ausbildungswunsch Section -->
            <h2>Ausbildungswunsch</h2>
            <p>*Ich interessiere mich für die:</p>

            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="cbhak" name="cbhak">
                <label for="cbhak" class="form-check-label">Classic Business HAK</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="dbhak" name="dbhak">
                <label for="dbhak" class="form-check-label">Digital Business HAK</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="phas" name="phas">
                <label for="phas" class="form-check-label">Praxis HAS</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="htlm" name="htlm">
                <label for="htlm" class="form-check-label">HTL Mechatronik</label>
            </div>

            <hr>

            <!-- Personal Data Section -->
            <h2>Deine persönlichen Daten</h2>
            <div class="form-group">
                <label for="name">*Vor- und Nachname (Schüler/-in)</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="geschlecht">*Geschlecht</label>
                <div class="d-flex align-items-center">
                    <strong>Männlich</strong>
                    <input type="range" class="form-control mx-3 animated-slider" id="geschlecht" name="geschlecht" value="0" required>
                    <strong>Weiblich</strong>
                </div>
                <div class="gender-display-box" id="genderDisplayBox"></div>
                <input type="hidden" id="geschlechtValue" name="geschlechtValue" value="Männlich"> <!-- Hidden input for gender -->
            </div>            
            <div class="form-group">
                <label for="gbdatum">*Geburtsdatum</label>
                <input type="date" class="form-control" id="gbdatum" name="gbdatum" required>
            </div>
            <div class="form-group">
                <label for="adresse">*Straße und Hausnummer</label>
                <input type="text" class="form-control" id="adresse" name="adresse" required>
            </div>
            <div class="form-group">
                <label for="ort">*PLZ und Ort</label>
                <input type="text" class="form-control" id="ort" name="ort" required>
            </div>
            <div class="form-group">
                <label for="schule">*Derzeit besuche ich folgende Schule:</label>

                <br>
                <select name="schule" id="schule">
                <option value="">Option auswählen</option>
                <option value="Hauptschule">Hauptschule</option>
                <option value="Gymnasium">Gymnasium</option>
                <option value="Polytechnische Schule">Polytechnische Schule</option>
                <option value="Musikschule">Musikschule</option>
                <option value="Sonderschule">Sonderschule</option>
            </select>

          <!--     <input type="text" class="form-control" id="schule" name="schule" required> -->
          
            </div>

            <hr>

            <!-- Guardian Section -->
            <h2>Erziehungsberechtigte/-r</h2>
            <div class="form-group">
                <label for="ename">*Vor- und Nachname (Erziehungsberechtigte/-r)</label>
                <input type="text" class="form-control" id="ename" name="ename" required>
            </div>
            <div class="form-group">
                <label for="email">*E-Mail-Adresse</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="tel">*Telefonnummer:</label>
                <input type="tel" class="form-control" id="tel" name="tel" required>
            </div>

            <hr>

            <!-- Other Comments Section -->
            <h2>Sonstiges</h2>
            <div class="form-group">
                <label for="anm">Anmerkungen</label>
                <textarea rows="4" class="form-control" id="anm" name="anm"></textarea>
            </div>

            <p>*Zustimmung zur Datenverarbeitung:</p> 
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="zustimmung" name="zustimmung" required>
                <label for="zustimmung" class="form-check-label">Ich willige ein...</label>
            </div>

            <br>

            <!-- Submit Button -->
            <div class="text-center">
                <input type="submit" value="Voranmelden" class="btn btn-primary">
            </div>
        </form>
    </div>

    <!-- JavaScript for Header Animation on Scroll -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(window).scroll(function() {
            if ($(this).scrollTop() > 50) {
                $(".header").addClass("visible");
            } else {
                $(".header").removeClass("visible");
            }
        });

        document.getElementById("geschlecht").addEventListener("input", function() {
            const genderDisplayBox = document.getElementById("genderDisplayBox");
            const genderValue = this.value;
            genderDisplayBox.innerHTML = genderValue < 50 ? "Männlich" : "Weiblich";
            document.getElementById("geschlechtValue").value = genderDisplayBox.innerHTML;
        });
    </script>
</body>
</html>
<?php
} else {
    // Handle the form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['zustimmung'])) {
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "INSERT INTO anmeldeformular (ausbildung_hak, ausbildung_dbhak, ausbildung_phas, ausbildung_htlm, 
                    schueler_name, geschlecht, geburtsdatum, adresse, ort, schule, eltern_name, email, telefon, 
                    anmerkungen) 
                    VALUES (:cbhak, :dbhak, :phas, :htlm, :name, :geschlechtValue, :gbdatum, :adresse, :ort, 
                    :schule, :ename, :email, :tel, :anm)";

            $stmt = $pdo->prepare($query);

            $stmt->bindParam(':cbhak', isset($_POST['cbhak']));
            $stmt->bindParam(':dbhak', isset($_POST['dbhak']));
            $stmt->bindParam(':phas', isset($_POST['phas']));
            $stmt->bindParam(':htlm', isset($_POST['htlm']));
            $stmt->bindParam(':name', $_POST['name']);
            $stmt->bindParam(':geschlechtValue', $_POST['geschlechtValue']);
            $stmt->bindParam(':gbdatum', $_POST['gbdatum']);
            $stmt->bindParam(':adresse', $_POST['adresse']);
            $stmt->bindParam(':ort', $_POST['ort']);
            $stmt->bindParam(':schule', $_POST['schule']);
            $stmt->bindParam(':ename', $_POST['ename']);
            $stmt->bindParam(':email', $_POST['email']);
            $stmt->bindParam(':tel', $_POST['tel']);
            $stmt->bindParam(':anm', $_POST['anm']);

            $stmt->execute();
            echo "<p>Voranmeldung erfolgreich übermittelt. Vielen Dank!</p>";
        } catch (PDOException $e) {
            die("Datenbankfehler: " . $e->getMessage());
        }
    } else {
        echo "<p>Fehler: Formular nicht vollständig ausgefüllt oder nicht korrekt übermittelt.</p>";
    }
}
?>

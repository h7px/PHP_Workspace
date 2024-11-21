<?php
define("Wien", 450);
define("Graz", 550);
define("Innsbruck", 550);

if (isset($_GET['submit'])) {
    if (!empty($_GET['auto']) && !empty($_GET['filiale']) && !empty($_GET['datum']) && !empty($_GET['alter'])) {
        $auto = htmlspecialchars($_GET['auto']);
        $filiale = htmlspecialchars($_GET['filiale']);
        $date = htmlspecialchars($_GET['datum']);
        $alter = htmlspecialchars($_GET['alter']);

        $preis = 0;
        switch ($filiale) {
            case "Wien":
                $preis = Wien;
                break;
            case "Graz":
                $preis = Graz;
                break;
            case "Innsbruck":
                $preis = Innsbruck;
                break;
            default:
                echo "<h1>Verarbeitung nicht möglich!</h1>";
                echo "<p>Sie müssen das Formular zuerst ausfüllen!</p>";
                echo '<a href="autos.html">Hier geht es zum Formular.</a>';
                exit;
        }
        echo "<p>Das Auto kann am $date in der Filiale in $filiale abgeholt werden.</p>";
        echo "<p>Ihr Auto: $auto - Preis: " . $preis . " Euro</p>";
    } else {
        echo "<h1>Verarbeitung nicht möglich!</h1>";
        echo "<p>Sie müssen zuerst das Formular ausfüllen!</p>";
        echo '<a href="autos.html">Hier geht es zum Formular.</a>';
    }
}
?>

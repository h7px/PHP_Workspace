<?php
session_start();

if(isset($_SESSION["name"])){
    echo "Sie haben bereits an der Umfrage teilgenommen!";
    exit();
}

?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Umfrageeinleitung</title>
</head>
<body>
    <h1>Willkommen! Sie nehmen gerade an einer Umfrage teil.</h1>
    <form action="fragen.php" method="POST">
    <label for="name">Name:</label>
    <input type="name" name="name" required>
    <input type="submit" value="Senden">
    </form>
</body>
</html>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $_SESSION["name"] = $_POST["name"];
    setcookie("name", $_POST["name"], time() + 86400);
    header("Location: fragen.php");
    exit();
}

?>
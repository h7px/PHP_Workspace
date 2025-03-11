<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="produkte.php" method="POST">
        Name: <input type="text" name="name"><br>
        Alter: <input type="number" name="alter"><br>
        <input type="submit" name="name">
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $_SESSION["name"] = $_POST["name"];
    $_SESSION["alter"] = $_POST["alter"];
    header("Location: produkte.php");
}
?>

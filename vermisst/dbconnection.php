<?php

try {
    $dsn = "mysql:host=127.0.0.1;dbname=vermisst;charset=utf8";
    $pdo = new PDO($dsn, 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Set error mode to exceptions
} catch (PDOException $e) {
    die("Fehler beim Verbinden zur Datenbank: " . $e->getMessage()); // Provide a specific error message
}

?>

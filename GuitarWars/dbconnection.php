<?php

try {
    $dsn = "mysql:host=127.0.0.1;dbname=guitarWars;charset=utf8";
    $pdo = new PDO($dsn, 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
} catch (PDOException $e) {
    die("Fehler beim Verbinden zur Datenbank: " . $e->getMessage()); 
}

?>

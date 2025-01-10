<?php
require_once("dbconnection.php");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    try {
        $id = $_GET['id'];
        
        $sql = "UPDATE highscores SET bestaetigt = 1 WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        
        header("Location: admin.php");
        exit;
    } catch (PDOException $e) {
        die("Fehler beim Bestätigen des Highscores: " . $e->getMessage());
    }
} else {
    header("Location: admin.php");
    exit;
}
?>

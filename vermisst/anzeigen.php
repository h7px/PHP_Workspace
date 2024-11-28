<?php 
// Verbindung zur Datenbank herstellen
require_once("db-connection");

try{
    //SQL Abfrage vorbereiten
$sql = "SELECT * FROM meldungen";
$stmt=$pdo->query($sql);

//oder query


//Ergebnisse abrufen

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
catch (PDOException $e) {

    die("Fehler beim Aufbau der : " . $e->getMessage());
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Einträge aus der Tabelle "meldungen"</h1>
    <?php if (count($results) > 0 ): ?>

    <table>

<thead>

<tr>

<th>Vorname</th>
<th>Nachname</th>
<th>E-Mail</th>
<th>Ort</th>
<th>Zeit</th>
<th>Am leben?</th>
<th>Weitere Angaben</th>
</tr>
</thead>

<tbody>
    <?php foreach ($results as $row): ?>
    <tr>

    <td><?php echo htmlspecialchars($row['vname']);?></td>
    <td><?php echo htmlspecialchars($row['nname']);?></td>
    <td><?php echo htmlspecialchars($row['email']);?></td>
    <td><?php echo htmlspecialchars($row['wanngesehen']);?></td>
    <td><?php echo htmlspecialchars($row['wogesehen']);?></td>
    <td><?php echo htmlspecialchars($row['minka']);?></td>
    <td><?php echo htmlspecialchars($row['angaben']);?></td>

    </tr>
    <?php endforeach; ?>
</tbody>

</table>
</body>
</html>
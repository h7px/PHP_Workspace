<?php
$host = '127.0.0.1'; // Update with your database host
$dbname = 'vermisst'; // Update with your database name
$user = 'root'; // Update with your database username
$password = ''; // Update with your database password

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vermisst</title>

<style>
div{
    padding: 5px;
}
</style>

</head>
<body>
    
<form action="<?php echo($_SERVER['SCRIPT_NAME']);?>" method="get">
<img src="katze.png" alt="Logo" style="max-width: 100px;">
<h3 class="text-center mb-5">Wenn Sie sie gesehen haben, dann füllen Sie bitte dieses Formular aus:</h3>

<div class="form-group">
<label for="vname">Vorname:</label>
<input type="text" class="form-control" id="vname" name="vname">
</div>

<div class="form-group">
<label for="nname">Nachname:</label>
<input type="text" class="form-control" id="nname" name="nname">
</div>

<div class="form-group">
<label for="email">Wie lautet Ihre E-Mail-Adresse?</label>
<input type="email" class="form-control" id="email" name="email">
</div>

<div class="form-group">
<label for="wanngesehen">Wann haben Sie Minka gesehen?</label>
<input type="date" class="form-control" id="wanngesehen" name="wanngesehen">
</div>

<div class="form-group">
<label for="wogesehen">Wo haben Sie sie gesehen?</label>
<input type="text" class="form-control" id="wogesehen" name="wogesehen">
</div>

<div class="form-group">
<label for="minka">Ist Minka noch bei Ihnen?</label>
<input type="radio" class="form-control" name="minka" id="minka" value="Ja">Ja
<input type="radio" class="form-control" name="minka" id="minka" value="Nein">Nein
</div>

<div class="form-group">
<label for="angaben">Weitere Angaben:</label>
<textarea rows="2" class="form-control" id="angaben" name="angaben"></textarea>
</div>

<div class="text-center">
<input type="submit" value="Sichtung melden" class="btn btn-primary">
</div>
</form>

</body>
</html>


<?php

if (!isset($_COOKIE['language'])) {
    $language = 'de';
} else {
    $language = $_COOKIE['language'];
}

if (!isset($_COOKIE['bgcolor'])) {
    $bgcolor = '#ffffff';
} else {
    $bgcolor = $_COOKIE['bgcolor'];
}

if (!isset($_COOKIE['articles'])) {
    $articles = 5;
} else {
    $articles = $_COOKIE['articles'];
}

// Form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['reset'])) {
        if (isset($_POST['language'])) {
            setcookie('language', $_POST['language'], time() + (86400 * 30));
            $language = $_POST['language'];
        }
        
        if (isset($_POST['bgcolor'])) {
            setcookie('bgcolor', $_POST['bgcolor'], time() + (86400 * 30));
            $bgcolor = $_POST['bgcolor'];
        }
        
        if (isset($_POST['articles'])) {
            setcookie('articles', $_POST['articles'], time() + (86400 * 30));
            $articles = $_POST['articles'];
        }
    } else {
        setcookie('language', '', time() - 3600);
        setcookie('bgcolor', '', time() - 3600);
        setcookie('articles', '', time() - 3600);
        
        // Standard-Werte
        $language = 'de';
        $bgcolor = '#ffffff';
        $articles = 5;
    }
}

//Willkommen 
if ($language === 'de') {
    $willkommen = 'Willkommen auf unserer Nachrichtenseite!';
} else {
    $willkommen = 'Welcome to our news site!';
}

?>

<!DOCTYPE html>
<html lang="<?php echo $language; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $language === 'de' ? 'Einstellungen' : 'Settings'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: <?php echo $bgcolor; ?>;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center mb-0"><?php echo $language === 'de' ? 'Einstellungen' : 'Settings'; ?></h2>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info">
                            <?php echo $willkommen; ?>
                        </div>
                        <form method="post">
                            <div class="mb-3">
                                <label for="language" class="form-label"><?php echo $language === 'de' ? 'Sprache:' : 'Language:'; ?></label>
                                <select class="form-select" id="language" name="language" required>
                                    <option value="de" <?php echo $language === 'de' ? 'selected' : ''; ?>>Deutsch</option>
                                    <option value="en" <?php echo $language === 'en' ? 'selected' : ''; ?>>English</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="bgcolor" class="form-label"><?php echo $language === 'de' ? 'Hintergrundfarbe:' : 'Background color:'; ?></label>
                                <select class="form-select" id="bgcolor" name="bgcolor" required>
                                    <option value="#ffffff" <?php echo $bgcolor === '#ffffff' ? 'selected' : ''; ?>><?php echo $language === 'de' ? 'Weiß' : 'White'; ?></option>
                                    <option value="#f0f0f0" <?php echo $bgcolor === '#f0f0f0' ? 'selected' : ''; ?>><?php echo $language === 'de' ? 'Hellgrau' : 'Light gray'; ?></option>
                                    <option value="#ffe4e1" <?php echo $bgcolor === '#ffe4e1' ? 'selected' : ''; ?>><?php echo $language === 'de' ? 'Rosa' : 'Pink'; ?></option>
                                    <option value="#e6f3ff" <?php echo $bgcolor === '#e6f3ff' ? 'selected' : ''; ?>><?php echo $language === 'de' ? 'Hellblau' : 'Light blue'; ?></option>
                                    <option value="#f0fff0" <?php echo $bgcolor === '#f0fff0' ? 'selected' : ''; ?>><?php echo $language === 'de' ? 'Mintgrün' : 'Mint green'; ?></option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="articles" class="form-label"><?php echo $language === 'de' ? 'Anzahl der Artikel:' : 'Number of articles:'; ?></label>
                                <select class="form-select" id="articles" name="articles" required>
                                    <?php for($i = 5; $i <= 20; $i += 5): ?>
                                        <option value="<?php echo $i; ?>" <?php echo $articles == $i ? 'selected' : ''; ?>><?php echo $i; ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary"><?php echo $language === 'de' ? 'Einstellungen speichern' : 'Save settings'; ?></button>
                                <button type="submit" name="reset" class="btn btn-danger"><?php echo $language === 'de' ? 'Einstellungen zurücksetzen' : 'Reset settings'; ?></button>
                            </div>
                        </form>
                        
                        <div class="mt-4">
                            <h3><?php echo $language === 'de' ? 'Aktuelle Artikel' : 'Current Articles'; ?></h3>
                            <p><?php echo $language === 'de' ? "Anzahl der angezeigten Artikel: $articles" : "Number of displayed articles: $articles"; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
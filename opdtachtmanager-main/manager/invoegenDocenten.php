<?php

include "functions.php";
$aanmelden = new gebruiker($myDb);
try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      
      $aanmelden->invoegenDocenten($naam = ($_POST['naam']), $achternaam = ($_POST['achternaam']), $role = 'docent', $diploma = ($_POST['diploma']), $email = ($_POST['email']), $hash = ($_POST['wachtwoord']));
        $hash = password_hash($wachtwoord, PASSWORD_DEFAULT);

        
        
        header("Location: overzichtDocenten.php");
        exit();
    }
} catch (Exception $e) {
    echo $e->getMessage();
}



?>



<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoegen Docenten</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            padding-top: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
        }
        .nav-pills {
            margin-bottom: 20px;
        }
        h1 {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Invoegen Docenten</h1>
    <form method="POST">
        <div class="mb-3">
            <label for="naam" class="form-label">Naam</label>
            <input type="text" class="form-control" id="naam" name="naam" required>
        </div>
        <div class="mb-3">
            <label for="achternaam" class="form-label">Achternaam</label>
            <input type="text" class="form-control" id="achternaam" name="achternaam" required>
        </div>
        <div class="mb-3">
            <label for="diploma" class="form-label">Diploma</label>
            <input type="text" class="form-control" id="diploma" name="diploma" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="wachtwoord" class="form-label">Wachtwoord</label>
            <input type="password" class="form-control" id="wachtwoord" name="wachtwoord" required>
        </div>
        <button type="submit" class="btn btn-primary">Invoegen</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>  

</body>
</html>
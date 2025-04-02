<?php

include "functions.php";
$aanmelden = new gebruiker($myDb);

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {  
        $aanmelden->aanmelden($_POST['naam'],$_POST['achternaam'],$_POST['email'], $role ='manager',$_POST['wachtwoord']);
        $hash = password_hash($_POST['wachtwoord'], PASSWORD_DEFAULT);
        header("Location: login.php");
        exit;
      
        
    } 
} catch (\Exception $e) {   
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
    
<form method="POST">
<div class="mb-3">
    <label for="naam" class="form-label">Naam</label>
    <input type="naam" class="form-control" name="naam" aria-describedby="emailHelp">
    <div id="naam" class="form-text"></div>
  </div>

  <div class="mb-3">
    <label for="achternaam" class="form-label">achternaam</label>
    <input type="achternaam" class="form-control" name="achternaam" aria-describedby="emailHelp">
    <div id="achternaam" class="form-text"></div>
  </div>
  <label for="email" class="form-label">email</label>
    <input type="achternaam" class="form-control" name="email" aria-describedby="emailHelp">
    <div id="email" class="form-text"></div>
  </div>

  <div class="mb-3">
    <label for="wachtwoord" class="form-label">Password</label>
    <input type="wachtwoord" class="form-control" name="wachtwoord">
  </div>
  </div>
  <button type="submit" class="btn btn-primary">Toevoegen</button>
</form>


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>
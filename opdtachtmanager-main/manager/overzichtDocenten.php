<?php
include "functions.php"; 


try {
    $gebruiker = new gebruiker($myDb);
    $gebruikerData = $gebruiker->overzichtManager(); 
} catch (Exception $e) {
    echo $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Overzicht klanten</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            padding-top: 20px;
        }
        .table-container {
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

    <a href="invoegenDocenten.php" class="btn btn-secondary">Docent Invoegen</a>
    <a href="manager.php" class="btn btn-secondary">Terug</a>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Naam</th>
                <th scope="col">Achternaam</th>
                <th scope="col">Role</th>
                <th scope="col">Email</th>
            </tr>
        </thead>
        <tbody>
        <?php 
            foreach ($gebruikerData as $gebruiker) 
                if ($gebruiker['role'] !== 'manager') {
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($gebruiker['naam']); ?></td>
                        <td><?php echo htmlspecialchars($gebruiker['achternaam']); ?></td>
                        <td><?php echo htmlspecialchars($gebruiker['role']); ?></td>
                        <td><?php echo htmlspecialchars($gebruiker['email']); ?></td>
                        <td><a href="edit-producten.php?id=<?php echo $product['iDGebruiker'];?>" class="btn btn-primary">Edit</a></td>
                        <td><a href="delete-producten.php?id=<?php echo $product['iDGebruiker'];?>" class="btn btn-danger">Delete</a></td>
                    </tr>
                    <?php  } ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>  

</body>
</html>

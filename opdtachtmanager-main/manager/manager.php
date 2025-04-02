<?php
include "functions.php"; 

session_start();
if (!isset($_SESSION['userId'])) {
    header('Location: login.php');
    exit();
}

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
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['naam']); ?>!</h1>
    <a href="overzichtDocenten.php" class="btn btn-secondary">Docenten</a>

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
            foreach ($gebruikerData as $gebruiker) {
                if ($gebruiker['role'] == 'manager') { 
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($gebruiker['naam']); ?></td>
                        <td><?php echo htmlspecialchars($gebruiker['achternaam']); ?></td>
                        <td><?php echo htmlspecialchars($gebruiker['role']); ?></td>
                        <td><?php echo htmlspecialchars($gebruiker['email']); ?></td>
                    </tr>
                    <?php 
                }
            }
        ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>  

</body>
</html>

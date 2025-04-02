<?php
include 'functions.php';

session_start();
ob_start();

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = htmlspecialchars($_POST['email']);
        $wachtwoord = $_POST['wachtwoord'];
        $db = new gebruiker($myDb);
        $user = $db->login($email);
        if ($user) {
            $verify = password_verify($wachtwoord, $user['wachtwoord']);
            if ($verify) {
                $_SESSION['userId'] = $user['iDGebruiker'];
                $_SESSION['naam'] = $user['naam'];
                $_SESSION['role'] = $user['role'];

                if ($user['role'] === 'manager') {
                    header('Location: manager.php');
                } elseif ($user['role'] === 'docent') {
                    header('Location: docenten.php');
                } elseif ($user['role'] === 'leerling') {
                    header('Location: leerling.php'); 
                } elseif ($user['role'] === 'roostermaker') {
                    header('Location: rooster.php');
                } else {
                    echo "Unknown role.";
                }
                exit();
            } else {
                echo "Incorrect username or password";
            }
        } else {
            echo "Incorrect username or password";
        }
    }
} catch (Exception $e) {
    echo $e->getMessage();
}

ob_end_flush();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form method="POST">
        <div>
            <input type="text" name="email" placeholder="Email">
        </div>
        <div>
            <input type="password" name="wachtwoord" placeholder="Wachtwoord">
        </div>
        <div>
            <input type="submit" value="Login">
        </div>
    </form>
</body>
</html>

<?php
// login.php
include_once 'includes/header.php';

// Redirect if already logged in
if(isset($_SESSION['user_id'])) {
    header('Location: admin/dashboard.php');
    exit;
}

$error = '';

// Process login form
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate user input
    if(empty($_POST['username']) || empty($_POST['password'])) {
        $error = 'Vul alstublieft zowel gebruikersnaam als wachtwoord in.';
    } else {
        // Attempt to login
        $user = new User($db);
        $user->username = $_POST['username'];
        $user->password = $_POST['password'];
        
        if($user->login()) {
            // Login successful - create session
            $_SESSION['user_id'] = $user->userID;
            $_SESSION['full_name'] = $user->fullName;
            $_SESSION['role'] = $user->role;
            
            // Redirect to admin dashboard
            header('Location: admin/dashboard.php');
            exit;
        } else {
            $error = 'Ongeldige gebruikersnaam of wachtwoord.';
        }
    }
}
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Medewerkers Login</h2>
                    
                    <?php if(!empty($error)): ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php endif; ?>
                    
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="mb-3">
                            <label for="username" class="form-label">Gebruikersnaam</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Wachtwoord</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Inloggen</button>
                        </div>
                    </form>
                    
                    <div class="mt-3 text-center">
                        <small class="text-muted">Alleen voor medewerkers van Hotel Ter Duin.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once 'includes/footer.php'; ?>
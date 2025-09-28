<?php
session_start();
require_once '../config/database.php';

// Initialiser la base de données
$db = new Database();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    $user = $db->findUserByEmail($email);
    
    if ($user && isset($user['password']) && password_verify($password, $user['password'])) {
        $_SESSION['user'] = [
            'id' => $user['id_utilisateur'],
            'nom' => $user['nom'],
            'email' => $user['email']
        ];
        header('Location: ../index.php');
        exit;
    } else {
        $error = "Email ou mot de passe incorrect";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - LearnWebDev</title>
    <link rel="stylesheet" href="../public/bootstrap-4.0.0-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php include 'navLog.php'; ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white text-center">
                        <h3 class="mb-0">Connexion</h3>
                    </div>
                    <div class="card-body p-4">
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php endif; ?>
                        
                        <form method="POST">
                            <div class="form-group">
                                <label for="email">Email :</label>
                                <input type="email" class="form-control" id="email" name="email" required 
                                       value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                            </div>
                            
                            <div class="form-group">
                                <label for="password">Mot de passe :</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            
                            <button type="submit" class="btn btn-primary btn-block">Se connecter</button>
                        </form>
                        
                        <div class="text-center mt-3">
                            <p>Pas encore de compte ? <a href="register.php">Créer un compte</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../js/jquery-3.2.1.slim.min.js"></script>
    <script src="../public/bootstrap-4.0.0-dist/js/bootstrap.min.js"></script>
</body>
</html>
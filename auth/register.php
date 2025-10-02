<?php
require_once __DIR__ . '/../config/database.php';

    $db = new Database(__DIR__ . '/../data/utilisateur.json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    
    // Validation
    $errors = [];
    
    if (empty($nom)) {
        $errors[] = "Le nom est requis";
    }
    
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email invalide";
    }
    
    // Vérifier si l'email existe déjà
    $existing_user = $db->findUserByEmail($email);
    if ($existing_user) {
        $errors[] = "Cet email est déjà utilisé";
    }
    
    if (strlen($password) < 6) {
        $errors[] = "Le mot de passe doit contenir au moins 6 caractères";
    }
    
    if ($password !== $confirm_password) {
        $errors[] = "Les mots de passe ne correspondent pas";
    }
    
    if (empty($errors)) {
        $user_id = uniqid();
        $user_data = [
            'id_utilisateur' => $user_id,
            'nom' => $nom,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'progression' => [
                'cours_termines' => [],
                'scores_quiz' => [
                    'html' => 0,
                    'css' => 0,
                    'javascript' => 0,
                    'php' => 0,
                    'sql' => 0
                ],
                'projets_realises' => []
            ],
            'date_inscription' => date('Y-m-d H:i:s')
        ];
        
        if ($db->saveUser($user_data)) {
            $_SESSION['user'] = [
                'id' => $user_id,
                'nom' => $nom,
                'email' => $email
            ];
            header('Location: index.php');
            exit;
        } else {
            $errors[] = "Erreur lors de la création du compte";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - LearnWebDev</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-success text-white text-center">
                        <h3 class="mb-0">Créer un compte</h3>
                    </div>
                    <div class="card-body p-4">
                        <?php if (!empty($errors)): ?>
                            <div class="alert alert-danger">
                                <?php foreach ($errors as $error): ?>
                                    <div><?php echo $error; ?></div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        
                        <form method="POST">
                            <div class="form-group">
                                <label for="nom">Nom complet :</label>
                                <input type="text" class="form-control" id="nom" name="nom" required 
                                       value="<?php echo htmlspecialchars($_POST['nom'] ?? ''); ?>">
                            </div>
                            
                            <div class="form-group">
                                <label for="email">Email :</label>
                                <input type="email" class="form-control" id="email" name="email" required 
                                       value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                            </div>
                            
                            <div class="form-group">
                                <label for="password">Mot de passe :</label>
                                <input type="password" class="form-control" id="password" name="password" required 
                                       minlength="6">
                                <small class="form-text text-muted">Minimum 6 caractères</small>
                            </div>
                            
                            <div class="form-group">
                                <label for="confirm_password">Confirmer le mot de passe :</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                            </div>
                            
                            <button type="submit" class="btn btn-success btn-block">Créer mon compte</button>
                        </form>
                        
                        <div class="text-center mt-3">
                            <p>Déjà un compte ? <a href="index.php?page=connexion">Se connecter</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
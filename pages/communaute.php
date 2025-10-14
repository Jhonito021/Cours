<?php

if (!isset($_SESSION['user'])) {
    header("Location: index.php?page=connexion");
    exit;
}

// Fichier JSON des utilisateurs
$usersFile = __DIR__ . '/../auth/utilisateur.json';
$usersData = json_decode(file_get_contents($usersFile), true);

// Vérifier que le tableau d'utilisateurs existe
if (!isset($usersData['utilisateurs'])) {
    $usersData['utilisateurs'] = [];
}

// Récupérer l'id correct de l'utilisateur connecté
$currentUserId = $_SESSION['user']['id'] ?? $_SESSION['user']['id_utilisateur'] ?? null;

// Si aucun id valide, rediriger vers connexion
if ($currentUserId === null) {
    header("Location: index.php?page=connexion");
    exit;
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Communauté</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .card:hover {
            transform: translateY(-5px);
            transition: 0.3s;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        .avatar {
            text-align: center;
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 50%;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4"><i class="fas fa-users"></i> Communauté</h2>
    <div class="row">
        <?php foreach ($usersData['utilisateurs'] as $user): 
            // Exclure le profil connecté
            if (($user['id_utilisateur'] ?? $user['id']) == $currentUserId) continue; 

            $avatar = !empty($user['avatar']) ? "uploads/avatars/{$user['avatar']}" : "https://via.placeholder.com/80";
        ?>
        <div class="col-md-8">
            
        </div>
        <div class="col-md-3">
            <div class="mb-4">
                <div class="card text-center p-3">
                    <div class="text-center">
                        <img src="<?= $avatar ?>" class="avatar mb-2" alt="Avatar">
                    </div>
                    <h5><?= htmlspecialchars($user['nom'] ?? 'Utilisateur') ?></h5>
                    <p class="text-muted"><?= htmlspecialchars($user['email'] ?? '-') ?></p>
                    <a href="index.php?page=message&id=<?= $user['id_utilisateur'] ?? $user['id'] ?>" class="btn btn-primary btn-sm">
                        <i class="fas fa-envelope"></i> Message
                    </a>
                </div>
            </div>
        </div>
        
        <?php endforeach; ?>
        <?php if (empty($usersData['utilisateurs']) || count($usersData['utilisateurs']) <= 1): ?>
            <p class="text-muted ml-3">Aucun autre utilisateur pour le moment.</p>
        <?php endif; ?>
    </div>
</div>
</body>
</html>

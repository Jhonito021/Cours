<?php

$db = new Database();
$user_data = $db->findUserByEmail($_SESSION['user']['email']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - LearnWebDev</title>
    <link rel="stylesheet" href="../public/bootstrap-4.0.0-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php include '../include/header.php'; ?>

    <div class="container mt-5">
        <!-- Message de bienvenue personnalisé -->
        <div class="alert alert-info">
            <h4>👋 Bienvenue, <?php echo htmlspecialchars($user_data['nom']); ?> !</h4>
            <p class="mb-0">Membre depuis : <?php echo $user_data['date_inscription'] ?? 'Aujourd\'hui'; ?></p>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <img src="https://via.placeholder.com/150" class="rounded-circle mb-3" alt="Avatar">
                        <h4><?php echo htmlspecialchars($user_data['nom']); ?></h4>
                        <p class="text-muted"><?php echo htmlspecialchars($user_data['email']); ?></p>
                        
                        <?php
                        $total_cours = 5; // Total des cours disponibles
                        $cours_termines = count($user_data['progression']['cours_termines']);
                        $pourcentage = ($cours_termines / $total_cours) * 100;
                        ?>
                        <div class="progress mb-2">
                            <div class="progress-bar bg-success" style="width: <?php echo $pourcentage; ?>%">
                                <?php echo round($pourcentage); ?>%
                            </div>
                        </div>
                        <small>Progression globale</small>
                    </div>
                </div>

                <!-- Actions rapides -->
                <div class="card mt-4">
                    <div class="card-header">
                        <h6 class="mb-0">Actions rapides</h6>
                    </div>
                    <div class="card-body">
                        <a href="cours.php" class="btn btn-outline-primary btn-block mb-2">
                            📚 Continuer les cours
                        </a>
                        <a href="../auth/logout.php" class="btn btn-outline-danger btn-block">
                            🚪 Déconnexion
                        </a>
                    </div>
                </div>
            </div>

            <!-- Le reste du code des statistiques reste identique -->
            <!-- ... -->
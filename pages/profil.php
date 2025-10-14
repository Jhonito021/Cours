<?php
require_once __DIR__ . '/../config/database.php';

$db = new Database();
$user_data = $db->findUserByEmail($_SESSION['user']['email']);

// Avatar : si vide, mettre image par défaut
$avatarPath = !empty($user_data['avatar']) ? "uploads/avatars/{$user_data['avatar']}" : "https://via.placeholder.com/150";

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - LearnWebDev</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<div class="container mt-5">
    <!-- Message de bienvenue personnalisé -->
    <div class="alert alert-info">
        <h4> Bienvenue, <?php echo htmlspecialchars($user_data['nom']); ?> !</h4>
        <p class="mb-0">Membre depuis : <?php echo $user_data['date_inscription'] ?? 'Aujourd\'hui'; ?></p>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    
                    <img src="<?php echo $avatarPath ?>" class="rounded-circle mb-3" alt="Avatar" style="width:80px; height:80px; border-radius:50%; object-fit: cover;">
                   
                    <h4><?php echo htmlspecialchars($user_data['nom']); ?></h4>
                    <p class="text-muted"><?php echo htmlspecialchars($user_data['email']); ?></p>
                    
                    <?php
                    $total_cours = 5; // Total des cours disponibles
                    $cours_termines = count($user_data['progression']['cours_termines']);
                    $pourcentage = ($cours_termines / $total_cours) * 100;
                    ?>
                </div>
            </div>

            <!-- Actions rapides -->
            <div class="card mt-4">
                <div class="card-header">
                    <h6 class="mb-0">Actions rapides</h6>
                </div>
                <div class="card-body">
                    <a href="index.php?page=cours" class="btn btn-outline-primary btn-block mb-2">
                        <i class="fas fa-play"></i> Continuer les cours
                    </a>
                    <a href="index.php?page=modification" class="btn btn-outline-warning btn-block mb-2">
                        <i class="fas fa-edit"></i> Modifier mon profil
                    </a>
                    <a href="index.php?page=suppression" 
                       onclick="return confirm('⚠️ Êtes-vous sûr de vouloir supprimer votre profil ? Cette action est irréversible !');" 
                       class="btn btn-outline-danger btn-block mb-2">
                        <i class="fas fa-trash"></i> Supprimer mon profil
                    </a>
                    <a href="index.php?page=deconnexion" class="btn btn-outline-secondary btn-block" onclick=" return confirm('Souhaitez-vous vraim');">
                        <i class="fas fa-door-open"></i> Déconnexion
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <!-- Statistiques -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Mes Statistiques</h5>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-3">
                            <div class="stat-item">
                                <h3><?php echo count($user_data['progression']['cours_termines']); ?></h3>
                                <p>Cours terminés</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat-item">
                                <h3><?php echo count($user_data['progression']['projets_realises']); ?></h3>
                                <p>Projets réalisés</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat-item">
                                <h3><?php echo array_sum($user_data['progression']['scores_quiz']); ?></h3>
                                <p>Score moyen</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat-item">
                                <h3>5h</h3>
                                <p>Temps d'étude</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Progression par technologie -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Progression par Technologies</h5>
                </div>
                <div class="card-body">
                    <?php foreach($user_data['progression']['scores_quiz'] as $tech => $score): ?>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-1">
                                <span><strong><?php echo strtoupper($tech); ?></strong></span>
                                <span><?php echo $score; ?>%</span>
                            </div>
                            <div class="progress">
                                <div class="progress-bar 
                                    <?php if ($score >= 80) echo 'bg-success';
                                          elseif ($score >= 50) echo 'bg-warning';
                                          else echo 'bg-danger';
                                    ?>" style="width: <?php echo $score; ?>%">
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</body>
</html>


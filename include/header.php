<?php
$is_logged_in = isset($_SESSION['user']);
$user = $is_logged_in ? $_SESSION['user'] : null;

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apprentissage Technologies Web</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <i class="fas fa-book"></i> LearnDevWeb
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">
                    <a class="nav-link" href="index.php?page=acceuil">
                        <i class="fas fa-home"></i> Accueil
                    </a>
                </li>
                <?php if ($is_logged_in): ?>
                    <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'cours.php' ? 'active' : ''; ?>">
                        <a class="nav-link" href="index.php?page=cours">
                            <i class="fas fa-book-open"></i> Cours
                        </a>
                    </li>
                <?php else: ?>
                    <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'cours.php' ? 'active' : ''; ?>">
                        <a class="nav-link" href="index.php?page=connexion">
                            <i class="fas fa-book-open"></i> Cours
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
            <ul class="navbar-nav ml-auto">
                <?php if ($is_logged_in): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
                            <?= htmlspecialchars($user['nom']) ?>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="index.php?page=profil">
                                <i class="fas fa-user"></i> Mon profil
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="index.php?page=deconnexion">
                                <i class="fas fa-door-open"></i> Déconnexion
                            </a>
                        </div>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=connexion">
                            <i class="fas fa-sign-in-alt"></i> Connexion
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=inscription">
                            <i class="fas fa-user-plus"></i> Inscription
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

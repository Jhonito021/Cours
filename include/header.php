<?php

$is_logged_in = isset($_SESSION['user']);
$user = $is_logged_in ? $_SESSION['user'] : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>apprentissage Technologies Web</title>
    <link rel="stylesheet" href="public/bootstrap-4.0.0-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/bootstrap-4.0.0-dist/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="index.php">LearnWebDev</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">
                    <a class="nav-link" href="index.php?page=acceuil">Accueil</a>
                </li>
                <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'cours.php' ? 'active' : ''; ?>">
                    <a class="nav-link" href="index.php?page=cours">Cours</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <?php if ($is_logged_in): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
                            👋 <?php echo htmlspecialchars($user['nom']); ?>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="index.php?page=profil">Mon profil</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="../auth/logout.php">Déconnexion</a>
                        </div>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="../auth/login.php">Connexion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../auth/register.php">Inscription</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
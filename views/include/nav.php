<?php 
    $is_logged_in = isset($_SESSION['user']);
    $user = $is_logged_in ? $_SESSION['user'] : null;
?>
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a href="index.php" class="navbar-brand">LearnWeb</a>

        <!-- Bouton collapse -->
        <button class="navbar-toggler" type="button">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Menu principal -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : '' ?>">
                    <a href="index.php" class="nav-link">
                        <i class="fas fa-home"></i> Accueil
                    </a>
                </li>
                <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'cours.php' ? 'active' : '' ?>">
                    <a href="pages/cours.php" class="nav-link">
                        <i class="fas fa-book-open"></i> Cours
                    </a>
                </li>

                <?php if ($is_logged_in) : ?>
                    <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'profil.php' ? 'active' : '' ?>">
                        <a href="profil.php" class="nav-link">
                            <i class="fas fa-user-circle"></i> Profil
                        </a>
                    </li>
                <?php endif; ?>
            </ul>

            <ul class="navbar-nav ml-auto">
                <?php if ($is_logged_in): ?>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" id="navBarDropdown" role="button">
                            Coucou! <?php echo htmlspecialchars($user['nom']); ?>
                        </a>
                        <div class="dropdown-menu" id="dropdown-menu">
                            <a href="profil.php" class="dropdown-item">
                                <i class="fas fa-user-circle"></i> Mon profil
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="auth/logout.php" class="dropdown-item">
                                <i class="fas fa-sign-out-alt"></i> Déconnexion
                            </a>
                        </div>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a href="auth/login.php" class="nav-link">
                            <i class="fas fa-sign-in-alt"></i> Connexion
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="auth/register.php" class="nav-link">
                            <i class="fas fa-user-plus"></i> Inscription
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>


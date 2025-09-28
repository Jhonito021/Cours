<!-- Navigaion -->
     <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a href="index.php" class="navbar-brand">LearnWeb</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-ico"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : '' ?>">
                        <a href="index.php" class="nav-link">Acceuil</a>
                    </li>
                    <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'cours.php' ? 'active' : '' ?>">
                        <a href="#" class="nav-link">Cours</a>
                    </li>

                    <?php if ($is_logged_in) : ?>
                        <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'profil.php' ? 'active' : '' ?>">
                            <a href="#" class="nav-link">Profil</a>
                        </li>
                    <?php endif; ?>
                </ul>

                <ul class="navbar-nav ml-auto">
                    <?php if ($is_logged_in): ?>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" id="navBarDropdown" role="button" data-toggle="dropdon">
                                Coucou! <?php echo htmlspecialchars($user['nom']); ?>
                            </a>
                            <div class="dropdown-menu">
                                <a href="profil.php" class="dropdown-ite">Mon profil</a>
                                <div class="dropdown-divider"></div>
                                <a href="auth/logout.php" class="dropdown-item">Déconnexion</a>
                            </div>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a href="auth/login.php" class="nav-link">Connexion</a>
                        </li>
                        <li class="nav-item">
                            <a href="auth/register.php" class="nav-link">Inscription</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>

        </div>
     </nav>

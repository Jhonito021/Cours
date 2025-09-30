
    <!-- Hero Section -->
     <section class="hero bg-light py-5">
        <div class="container text-center">
            <h1 class="display-4">
                Apprenez le Développement Web <i class="fas fa-globe"></i>
            </h1>
            <p class="lead">
                HTML, CSS, JavaScript, PHP et SQL - Débutant à Expert
            </p>

            <?php if ($is_logged_in): ?>
                <div class="alert alert-succes d-inline-block">
                    Bienvenu, <?php echo htmlspecialchars($user['nom']); ?>!
                </div> <br>
                <a href="pages/cours.php" class="btn btn-primary btn-lg">Contineur l'apprentissage</a>
            <?php else: ?>
                <div class="mt-4">
                    <a href="auth/register.php" class="btn btn-primary btn-lg mt-3">Commencer gratuitement</a>
                    <a href="auth/login.php" class="btn btn-outline-primary btn-lg mt-3">
                        <i class="fas fa-sign-in-alt"></i> Se connecter
                    </a>
                </div>
            <?php endif; ?>
        </div>
     </section>

    <!-- Technologies Section -->
    <section class="py-5">
        <div class="container">
        <h2 class="text-center mb-5">Technologies Couvertes</h2>
            <div class="row justify-content-center align-items-center">
                <div class="col-md-2 col-6 mb-4 d-flex justify-content-center align-items-center">
                    <i class="fab fa-html5 icone-tech" style="color: #e34c26;"></i>
                </div>
                <div class="col-md-2 col-6 mb-4 d-flex justify-content-center align-items-center">
                    <i class="fab fa-css3-alt icone-tech" style="color: #264de4;"></i>
                </div>
                <div class="col-md-2 col-6 mb-4 d-flex justify-content-center align-items-center">
                    <i class="fab fa-js-square icone-tech" style="color: #f7df1e;"></i>
                </div>
                <div class="col-md-2 col-6 mb-4 d-flex justify-content-center align-items-center">
                    <i class="fab fa-php icone-tech" style="color: #777bb4;"></i>
                </div>
                <div class="col-md-2 col-6 mb-4 d-flex justify-content-center align-items-center">
                    <i class="fas fa-database icone-tech" style="color: #dc3545;"></i>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Cours Récents -->
    <section class="bg-light py-5">
        <div class="container">
            <h2 class="text-center mb-5">Derniers Cours Ajoutés</h2>
            <div class="row">
                <?php foreach (array_slice($cours_data['cours'], 0, 3) as $cours): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <span class="badge badge-<?php echo $cours['badge_color']; ?> mb-2">
                                    <?php echo $cours['technologie']; ?>
                                </span>
                                <h5 class="card-title"> <?php echo $cours['description']; ?></h5>
                                <p class="card-text"> <?php echo $cours['titre']; ?></p>
                                <p class="text-muted">
                                    <small>
                                        <i class="fas fa-signal"></i> Niveau: <?php echo $cours['niveau']; ?> 
                                        . <i class="fas fa-clock"></i> Durée: <?php echo $cours['duree'] ?>
                                    </small>
                                </p>
                            </div>
                            <div class="card-footer">
                                <a href="pages/cours_detail.php?id=<?php echo $cours['id']; ?>" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-eye"></i> Voir le cours
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php include 'include/footer.php'; ?>
</body>
</html>



<?php 
    $cours_data = json_decode(file_get_contents('data/cours.json'), true);
    session_start();
    $is_logged_in = isset ($_SESSION['user']);
    $user = $is_logged_in ? $_SESSION['user'] : null;
    include 'include/header.php'; 
    include 'include/nav.php';
?>
    <!-- Hero Section -->
     <section class="hero bg-light py-5">
        <div class="container text-center">
            <h1 class="display-4">
                Apprenez le Développement Web
            </h1>
            <p class="lead">
                HTML, CSS, JavaScript, PHP et SQL - Débutant à Expert
            </p>

            <?php if ($is_logged_in): ?>
                <div class="alert alert-succes d-inline-block">
                    Bienvenu, <?php echo htmlspecialchars($user['nom']); ?>!
                </div> <br>
                <a href="" class="btn btn-primary btn-lg">Contineur l'apprentissage</a>
            <?php else: ?>
                <div class="mt-4">
                    <a href="auth/register.php" class="btn btn-primary btn-lg mt-3">Commencer gratuitement</a>
                    <a href="auth/login.php" class="btn btn-outline-primary btn-lg mt-3">Se connecter</a>
                </div>
            <?php endif; ?>
        </div>
     </section>

    <!-- Technologies Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Technologies Couvertes</h2>
            <div class="row">
                <div class="col-md-2 col-6 text-center mb-4">
                    <p class="mt-2">HTML5</p>
                </div>
                <div class="col-md-2 col-6 text-center mb-4">
                    <p class="mt-2">CSS</p>
                </div>
                <div class="col-md-2 col-6 text-center mb-4">
                    <p class="mt-2">JavaScript</p>
                </div>
                <div class="col-md-2 col-6 text-center mb-4">
                    <p class="mt-2">PHP</p>
                </div>
                <div class="col-md-2 col-6 text-center mb-4">
                    <p class="mt-2">SQL</p>
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
                                        Niveau: <?php echo $cours['niveau']; ?> Durée: <?php echo $cours['duree'] ?>
                                    </small>
                                </p>
                            </div>
                            <div class="card-footer">
                                <a href="#" class="btn" id="<?php echo $cours['id'] ?>">Voir le cours.</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</body>
</html>
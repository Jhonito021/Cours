<?php 
    if (!isset($_SESSION['user'])) {
        header('Location: ../auth/login.php');
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../public/bootstrap-4.0.0-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/bootstrap-4.0.0-dist/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    
    <div class="container mt-5">
        <h1 class="mb-4">Tous les Cours</h1>
        
        <!-- Filtres -->
        <div class="row mb-5">
            <div class="col-md-6">
                <select class="form-control" id="filterTechnology">
                    <option value="">Toutes les technologies</option>
                    <option value="HTML">HTML</option>
                    <option value="CSS">CSS</option>
                    <option value="JavaScript">JavaScript</option>
                    <option value="PHP">PHP</option>
                    <option value="SQL">SQL</option>
                </select>
            </div>
            <div class="col-md-6">
                <select class="form-control" id="filterLevel">
                    <option value="">Tous les niveaux</option>
                    <option value="débutant">Débutant</option>
                    <option value="intermédiaire">Intermédiaire</option>
                    <option value="avancé">Avancé</option>
                </select>
            </div>
        </div>

        <!-- Liste des cours -->
        <div class="row" id="coursList">
            <?php foreach($cours_data['cours'] as $cours): ?>
            <div class="col-lg-4 col-md-6 mb-4 cours-item" 
                 data-technology="<?php echo $cours['technologie']; ?>" 
                 data-level="<?php echo $cours['niveau']; ?>">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge badge-<?php echo $cours['badge_color']; ?>">
                                <?php echo $cours['technologie']; ?>
                            </span>
                            <span class="badge badge-secondary"><?php echo $cours['niveau']; ?></span>
                        </div>
                        <h5 class="card-title"><?php echo $cours['titre']; ?></h5>
                        <p class="card-text"><?php echo $cours['description']; ?></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">Durée: <?php echo $cours['duree']; ?></small>
                            <span class="badge badge-light"><?php echo count($cours['sections']); ?> sections</span>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent">
                        <a href="cours_detail.php?id=<?php echo $cours['id']; ?>" class="btn btn-primary btn-block">
                            Commencer le cours
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="../js/jquery-3.2.1.slim.min.js"></script>
    <script src="../bootstrap-4.0.0-dist/js/bootstrap.min.js"></script>
    <script src="../js/filter.js"></script>
</body>
</html>

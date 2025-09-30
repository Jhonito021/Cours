<?php
require_once '../include/auth_check.php';
$cours_id = $_GET['id'] ?? 1;
$cours_data = json_decode(file_get_contents('../data/cours.json'), true);
$cours = null;

foreach($cours_data['cours'] as $c) {
    if($c['id'] == $cours_id) {
        $cours = $c;
        break;
    }
}

if(!$cours) {
    header('Location: cours.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $cours['titre']; ?> - LearnWebDev</title>
    <link rel="stylesheet" href="../public/bootstrap-4.0.0-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../public/bootstrap-4.0.0-dist/css/style.css">
</head>
<body>
    <?php include '../include/header.php'; ?>

    <div class="container mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="cours.php"><i class="fas fa-book"></i> Cours</a></li>
                <li class="breadcrumb-item active"><?php echo $cours['titre']; ?></li>
            </ol>
        </nav>

        <div class="row">
            <!-- Sidebar des sections -->
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="fas fa-list-ol"></i> Sections du cours</h6>
                    </div>
                    <div class="list-group list-group-flush">
                        <?php foreach($cours['sections'] as $index => $section): ?>
                        <a href="#section-<?php echo $section['id_section']; ?>" 
                           class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <span>
                                <i class="fas fa-play-circle text-primary mr-2"></i>
                                <?php echo $section['titre']; ?>
                            </span>
                            <span class="badge badge-light"><?php echo $index + 1; ?></span>
                        </a>
                        <?php endforeach; ?>
                        <?php if(!empty($cours['exercices'])): ?>
                        <a href="#exercices" class="list-group-item list-group-item-action list-group-item-warning">
                            <i class="fas fa-pencil-alt"></i> Exercices pratiques
                            <span class="badge badge-warning"><?php echo count($cours['exercices']); ?></span>
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Contenu principal -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h2 class="mb-0"><?php echo $cours['titre']; ?></h2>
                                <div class="mt-2">
                                    <span class="badge badge-secondary">
                                        <i class="fas fa-signal"></i> <?php echo $cours['niveau']; ?>
                                    </span>
                                    <span class="badge badge-info">
                                        <i class="far fa-clock"></i> <?php echo $cours['duree']; ?>
                                    </span>
                                </div>
                            </div>
                            <div class="text-right">
                                <button class="btn btn-light btn-sm">
                                    <i class="fas fa-bookmark"></i> Sauvegarder
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="lead"><i class="fas fa-info-circle"></i> <?php echo $cours['description']; ?></p>

                        <!-- Sections de cours -->
                        <?php foreach($cours['sections'] as $section): ?>
                        <section id="section-<?php echo $section['id_section']; ?>" class="mb-5">
                            <h4><i class="fas fa-play-circle text-primary"></i> <?php echo $section['titre']; ?></h4>
                            <p><?php echo nl2br($section['contenu']); ?></p>
                            
                            <?php if(!empty($section['exemple_code'])): ?>
                            <div class="card bg-light mb-3">
                                <div class="card-header">
                                    <strong><i class="fas fa-code"></i> Exemple de code :</strong>
                                </div>
                                <div class="card-body">
                                    <pre class="mb-0"><code><?php echo htmlspecialchars($section['exemple_code']); ?></code></pre>
                                </div>
                            </div>
                            <?php endif; ?>
                        </section>
                        <?php endforeach; ?>

                        <!-- Exercices -->
                        <?php if(!empty($cours['exercices'])): ?>
                        <section id="exercices" class="mb-5">
                            <h4 class="text-warning"><i class="fas fa-pencil-alt"></i> Exercices Pratiques</h4>
                            <?php foreach($cours['exercices'] as $exercice): ?>
                            <div class="card mb-3">
                                <div class="card-header bg-warning text-dark">
                                    <strong><i class="fas fa-tasks"></i> Exercice <?php echo $exercice['id_exercice']; ?></strong>
                                </div>
                                <div class="card-body">
                                    <p><?php echo $exercice['enonce']; ?></p>
                                    
                                    <!-- Éditeur de code -->
                                    <div class="mb-3">
                                        <label><strong><i class="fas fa-edit"></i> Votre solution :</strong></label>
                                        <textarea class="form-control code-editor" rows="6" 
                                                  placeholder="Écrivez votre code ici..."></textarea>
                                    </div>
                                    
                                    <button class="btn btn-success btn-sm verifier-code" 
                                            data-solution='<?php echo htmlspecialchars(json_encode($exercice['solution'])); ?>'>
                                        <i class="fas fa-check"></i> Vérifier mon code
                                    </button>
                                    
                                    <!-- Indices -->
                                    <div class="mt-3">
                                        <button class="btn btn-outline-info btn-sm" type="button" 
                                                data-toggle="collapse" 
                                                data-target="#indices-<?php echo $exercice['id_exercice']; ?>">
                                            <i class="fas fa-lightbulb"></i> Afficher les indices
                                        </button>
                                        <div class="collapse mt-2" id="indices-<?php echo $exercice['id_exercice']; ?>">
                                            <div class="card card-body">
                                                <ul class="mb-0">
                                                    <?php foreach($exercice['indices'] as $indice): ?>
                                                    <li><?php echo $indice; ?></li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </section>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../js/jquery-3.2.1.slim.min.js"></script>
    <script src="../bootstrap-4.0.0-dist/js/bootstrap.min.js"></script>
    <script src="../js/editor.js"></script>
</body>
</html>
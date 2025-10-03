<?php

if (!isset($_SESSION['user'])) {
    header("Location: index.php?page=connexion");
    exit;
}

$usersFile = __DIR__ . '/../auth/utilisateur.json';
$usersData = json_decode(file_get_contents($usersFile), true);

$userId = $_SESSION['user']['id'];

// Trouver l'utilisateur
$user = null;
foreach ($usersData['utilisateurs'] as $u) {
    if ($u['id_utilisateur'] == $userId) {
        $user = $u;
        break;
    }
}

// Supprimer l'utilisateur si confirmation reçue
if (isset($_POST['confirm'])) {
    foreach ($usersData['utilisateurs'] as $index => $u) {
        if ($u['id_utilisateur'] == $userId) {
            unset($usersData['utilisateurs'][$index]);
            break;
        }
    }

    // Réindexer le tableau pour JSON propre
    $usersData['utilisateurs'] = array_values($usersData['utilisateurs']);
    file_put_contents($usersFile, json_encode($usersData, JSON_PRETTY_PRINT));

    session_destroy();
    header("Location: index.php?page=acceuil&msg=deleted");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Supprimer mon compte</title>
</head>
<body class="mt-0">
    <div class="container mt-5 text-center">
        <h2 class="text-danger">Confirmer la suppression</h2>
        <h4><?= htmlspecialchars($user['nom']) ?></h4>
        <p>Êtes-vous sûr de vouloir supprimer votre compte ? <strong>Cette action est irréversible.</strong></p>
        <form method="post">
            <button type="submit" name="confirm" class="btn btn-danger">Oui, supprimer mon compte</button>
            <a href="index.php?page=profil" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</body>
</html>

<?php


if (!isset($_SESSION['user'])) {
    header("Location: index.php?page=connexion");
    exit;
}

$usersFile = __DIR__ . '/../auth/utilisateur.json';
$usersData = json_decode(file_get_contents($usersFile), true);

// Trouver l'utilisateur connecté
$userId = $_SESSION['user']['id'];
$userIndex = null;
foreach ($usersData['utilisateurs'] as $index => $u) {
    if ($u['id_utilisateur'] == $userId) {
        $userIndex = $index;
        break;
    }
}

if ($userIndex === null) {
    echo "Utilisateur introuvable.";
    exit;
}

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom']);
    $email = trim($_POST['email']);
    $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_BCRYPT) : $usersData['utilisateurs'][$userIndex]['password'];

    // Gestion de l'upload de l'avatar
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
        $ext = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
        $avatarName = 'avatar_'.$userId.'.'.$ext;
        $uploadDir = __DIR__ . '/../uploads/avatars/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
        move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadDir . $avatarName);
        $usersData['utilisateurs'][$userIndex]['avatar'] = $avatarName;
    }

    // Mise à jour JSON
    $usersData['utilisateurs'][$userIndex]['nom'] = $nom;
    $usersData['utilisateurs'][$userIndex]['email'] = $email;
    $usersData['utilisateurs'][$userIndex]['password'] = $password;

    file_put_contents($usersFile, json_encode($usersData, JSON_PRETTY_PRINT));

    // Mise à jour session
    $_SESSION['user']['nom'] = $nom;
    $_SESSION['user']['email'] = $email;
    $_SESSION['user']['avatar'] = $usersData['utilisateurs'][$userIndex]['avatar'] ?? '';

    header("Location: index.php?page=profil&msg=updated");
    exit;
}

// Avatar : si vide, mettre image par défaut
$avatarPath = !empty($user_data['avatar']) ? "uploads/avatars/{$user_data['avatar']}" : "https://via.placeholder.com/150";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Profil</title>
</head>
<body class="mt-0">
    <div class="container mt-5">
        <h2>Modifier mon profil</h2>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group text-center">
                <img src="<?= $avatarPath ?>" alt="Avatar" style="width:100px;height:100px;border-radius:50%;" class="mb-3">
            </div>
            <div class="form-group">
                <label>Nom</label>
                <input type="text" name="nom" class="form-control" value="<?= htmlspecialchars($usersData['utilisateurs'][$userIndex]['nom']) ?>" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($usersData['utilisateurs'][$userIndex]['email']) ?>" required>
            </div>
            <div class="form-group">
                <label>Mot de passe (laisser vide pour ne pas changer)</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="form-group">
                <label>Avatar / Photo de profil</label>
                <input type="file" name="avatar" accept="image/*" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Enregistrer</button>
            <a href="index.php?page=profil" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</body>
</html>

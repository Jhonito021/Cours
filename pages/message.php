<?php

if (!isset($_SESSION['user'])) {
    header("Location: index.php?page=connexion");
    exit;
}

// Fichiers JSON
$usersFile = __DIR__ . '/../auth/utilisateur.json';
$usersData = json_decode(file_get_contents($usersFile), true);
$messagesFile = __DIR__ . '/../data/messages.json';
$messagesData = file_exists($messagesFile) ? json_decode(file_get_contents($messagesFile), true) : [];

// ID du destinataire
$recipientId = $_GET['id'] ?? null;
if (!$recipientId) {
    echo "Utilisateur introuvable.";
    exit;
}

// Trouver l'utilisateur destinataire
$recipient = null;
foreach ($usersData['utilisateurs'] as $user) {
    if (($user['id_utilisateur'] ?? $user['id']) == $recipientId) {
        $recipient = $user;
        break;
    }
}
if (!$recipient) {
    echo "Utilisateur introuvable.";
    exit;
}

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $messageText = trim($_POST['message']);
    if ($messageText !== '') {
        $messagesData[] = [
            'from' => $_SESSION['user']['id_utilisateur'] ?? $_SESSION['user']['id'],
            'to' => $recipientId,
            'message' => $messageText,
            'date' => date('H:i')
        ];
        file_put_contents($messagesFile, json_encode($messagesData, JSON_PRETTY_PRINT));
        header("Location: index.php?page=message&id=$recipientId&sent=1");
        exit;
    }
}

// Avatar de l’utilisateur connecté
$currentAvatar = !empty($_SESSION['user']['avatar']) ? "uploads/avatars/{$_SESSION['user']['avatar']}" : "https://via.placeholder.com/50";
// Avatar du destinataire
$recipientAvatar = !empty($recipient['avatar']) ? "uploads/avatars/{$recipient['avatar']}" : "https://via.placeholder.com/50";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Chat avec <?= htmlspecialchars($recipient['nom']) ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../public/css/style.css">
    <style>
        .chat-container { max-width: 800px; margin: auto; }
        .message { display: flex; margin-bottom: 10px; }
        .message .avatar { width: 50px; height: 50px; border-radius: 50%; overflow: hidden; }
        .message .text { max-width: 70%; padding: 10px; border-radius: 15px; }
        .message.sent { justify-content: flex-end; }
        .message.sent .text { background-color: #007bff; color: #fff; }
        .message.received .text { background-color: #f1f0f0; }
        .message .text small { display: block; font-size: 0.7em; color: #666; margin-top: 3px; }
        .action-quick { margin-bottom: 10px; }
    </style>
</head>
<body>
<div class="container chat-container mt-5">
    <!-- Action rapide : autres utilisateurs -->
    <div class="action-quick card-header mb-4">
        <h5>Envoyer un message rapide à :</h5>
        <div class="row">
            <?php 
            foreach ($usersData['utilisateurs'] as $user) {
                if (($user['id_utilisateur'] ?? $user['id']) == ($_SESSION['user']['id_utilisateur'] ?? $_SESSION['user']['id'])) continue;
                $avatar = !empty($user['avatar']) ? "uploads/avatars/{$user['avatar']}" : "https://via.placeholder.com/50";
                echo "<div class='col-md-2 text-center mb-2'>
                        <a href='index.php?page=message&id=" . ($user['id_utilisateur'] ?? $user['id']) . "'>
                            <img src='$avatar' class='rounded-circle' style='width:50px;height:50px;object-fit:cover;'><br>
                            <small>" . htmlspecialchars($user['nom']) . "</small>
                        </a>
                    </div>";
            }
            ?>
        </div>
    </div>
    <div class="card-header">
        <h3>
            <img src="<?= $recipientAvatar ?>" class="rounded-circle" style="width:40px; height:40px; object-fit:cover;"> <?= htmlspecialchars($recipient['nom']) ?>
        </h3>
    </div>

    
    <!-- Conversation -->
<div class="col-md-10">
    <div class="mb-4 card-body" id="messages">
        <?php 
        foreach ($messagesData as $msg) {
            $fromMe = ($msg['from'] ?? null) == ($_SESSION['user']['id_utilisateur'] ?? $_SESSION['user']['id']);
            $toRecipient = ($msg['to'] ?? null) == $recipientId;
            $fromRecipient = ($msg['from'] ?? null) == $recipientId;
            $toMe = ($msg['to'] ?? null) == ($_SESSION['user']['id_utilisateur'] ?? $_SESSION['user']['id']);

            if (($fromMe && $toRecipient) || ($fromRecipient && $toMe)) {
                $msgClass = $fromMe ? 'sent' : 'received';
                $senderName = $fromMe ? 'Vous' : htmlspecialchars($recipient['nom']);
                $senderAvatar = $fromMe ? '' : $recipientAvatar; // <-- avatar uniquement si ce n'est pas toi

                echo "<div class='message $msgClass'>";
                if (!$fromMe) {
                    echo "<div class='avatar mr-2'><img src='$senderAvatar' alt='avatar' class='img-fluid rounded-circle' style='width:50px;height:50px;object-fit:cover;'></div>";
                }
                echo "<div class='text'>
                        <strong>$senderName</strong><br>
                        " . htmlspecialchars($msg['message']) . "
                        <small>{$msg['date']}</small>
                      </div>
                    </div>";
                
            }
        }
        ?>
    </div>


    <!-- Formulaire -->
    <form method="post" class="mb-3">
        <div class="input-group">
            <input type="text" name="message" class="form-control" placeholder="Tapez votre message..." required>
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary" onclick="locaion.reload()">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>
        </div>
    </form>
    <a href="index.php?page=communaute" class="btn btn-secondary mt-3">
        <i class="fas fa-arrow-left"></i> Retour Communauté
    </a>
</div>
<script>
    // Scroll automatique vers le bas
    var messagesDiv = document.getElementById('messages');
    messagesDiv.scrollTop = messagesDiv.scrollHeight;
</script>
</body>
</html>

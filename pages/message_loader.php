<?php
session_start();

$messagesFile = __DIR__ . '/../data/messages.json';
$usersFile = __DIR__ . '/../auth/utilisateur.json';

$messagesData = json_decode(file_get_contents($messagesFile), true);
$usersData = json_decode(file_get_contents($usersFile), true);

$currentUserId = $_SESSION['user']['id_utilisateur'];
$recipientId = $_GET['recipient'] ?? null;

$recipient = null;
foreach ($usersData['utilisateurs'] as $u) {
    if ($u['id_utilisateur'] == $recipientId) {
        $recipient = $u;
        break;
    }
}
$recipientAvatar = !empty($recipient['avatar']) ? "uploads/avatars/{$recipient['avatar']}" : "https://via.placeholder.com/40";

foreach ($messagesData as $msg) {
    if ((($msg['from'] ?? null) == $currentUserId && ($msg['to'] ?? null) == $recipientId) ||
        (($msg['from'] ?? null) == $recipientId && ($msg['to'] ?? null) == $currentUserId)):

        $fromMe = ($msg['from'] ?? null) == $currentUserId;
        $bubbleClass = $fromMe ? 'bg-sent text-white ml-auto' : 'bg-received text-dark mr-auto';
        $avatar = !$fromMe ? $recipientAvatar : '';
        $alignClass = $fromMe ? 'd-flex justify-content-end mb-2' : 'd-flex justify-content-start mb-2';
?>
<div class="<?= $alignClass ?>">
    <?php if (!$fromMe): ?>
        <img src="<?= $avatar ?>" alt="Avatar" class="rounded-circle mr-2" style="width:40px;height:40px;object-fit:cover;">
    <?php endif; ?>
    <div class="d-flex flex-column align-items-end">
        <div class="bubble <?= $bubbleClass ?>">
            <?= htmlspecialchars($msg['message']) ?>
            <small class="d-block text-muted" style="font-size:10px;"><?= $msg['date'] ?></small>
        </div>
        <div class="mt-1 text-right">
            <button class="btn btn-sm btn-outline-primary"><i class="fas fa-reply"></i></button>
            <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
        </div>
    </div>
</div>
<?php 
endif; 
}
?>

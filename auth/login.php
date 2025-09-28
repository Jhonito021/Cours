<?php
    session_start();
    require_once '../config/database.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $db = new Database();
        $user = $db -> findUserEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = [
                'id' => $user ['id_utilisateur'],
                'nom' => $user ['nom'],
                'email'=> $user ['email']
            ];
            header('Location: ../index.php');
            exit;
        } else {
            $error = "Email ou mot de passe incorrect";
        }
    }

    include 'include/header.php';
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                
            </div>
        </div>
    </div>
</div>
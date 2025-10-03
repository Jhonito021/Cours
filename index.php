<?php
    session_start();
    $cours_data = json_decode(file_get_contents('data/cours.json'), true);
    if (isset($_GET['page']) && !empty(trim($_GET['page']))) {
        $page = trim($_GET['page']);
    } else {
        $page = 'home';
    }

    switch ($page) {
        case 'cours':
            require 'include/header.php';
            include 'pages/cours.php';
            require 'include/footer.php';
            break;

        case 'profil':
            require 'include/header.php';
            include 'pages/profil.php';
            require 'include/footer.php';
            break;

        case 'connexion':
            require 'auth/navLog.php';
            require 'auth/login.php';
            break;
        
        case 'inscription':
            require 'auth/navLog.php';
            require 'auth/register.php';
            break;

        case 'deconnexion':
            require 'auth/logout.php';
            require 'pages/acceuil.php';
        
        case 'cours_detail':
            require 'include/header.php';
            include 'pages/cours_detail.php';
            include 'include/footer.php';
            break;

        case 'modification':
            require 'include/header.php';
            include 'pages/modif_profil.php';
            require 'include/footer.php';
            break;

        case 'suppression':
            require 'include/header.php';
            include 'pages/supprim_profil.php';
            include 'include/footer.php';
            break;
        
        default:
            require 'include/header.php';
            require  'pages/acceuil.php';
            include 'include/footer.php';
            break;
         }
?>


<?php
    $cours_data = json_decode(file_get_contents('data/cours.json'), true);
    session_start();
    if (isset($_GET['page']) && !empty(trim($_GET['page']))) {
        $page = trim($_GET['page']);
    } else {
        $page = 'home';
    }

    switch ($page) {
        case 'cours':
            require 'include/header.php';
            include 'pages/cours.php';
            break;

        case 'profil':
            require 'include/header.php';
            include 'pages/profil.php';
            break;
        
        default:
            require 'include/header.php';
            require  'pages/acceuil.php';
            break;
         }
?>


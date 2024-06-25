<?php
session_start();

$url = $_SERVER['REQUEST_URI'];
$url = str_replace('/Portfolio/', '', $url);
$get = parse_url($url, PHP_URL_QUERY); 
$get = str_replace('id=','', $get);
$url = parse_url($url, PHP_URL_PATH);
include_once './portfolio\projetNodevo\views\translate\langues.php';
$langue = $_COOKIE['langue'] ?? 'fr';

switch ($url) {
    case '':
        include './home.php';
        break;
    case '/index':
        include './home.php';
        break;
    case '/':
        include './home.php';
        break;
    case '/home':
        include "home.php";
        break;
    case '/portfolio/':
        include "/portfolio/index.php";
        break;
    case '/portfolio/admin/':
        include "/portfolio/admin/index.php";
        break;
    case '/portfolio/maintenance':
        include "./portfolio/maintenance.html";
        break;
    case "/portfolio/admin.php":
        include "./portfolio/admin/index.php";
        break;
    case "/maintenance":
        include "portfolio/ProjetNodevo/views/404.php";
        break;
    //partie ProjetNodevo
    case '/ProjetNodevo/':
        include "portfolio/ProjetNodevo/views/home.php";
        break;
    case '/ProjetNodevo/login':
        include "portfolio/ProjetNodevo/views/login.php";
        break;
    case '/ProjetNodevo/admin':
        include "portfolio/ProjetNodevo/views/admin.php";
        break;

    case '/ProjetNodevo/randomMannequin':
        include "portfolio/ProjetNodevo/views/randomMannequin.php";
        break;

    case "/ProjetNodevo/add":
        include "portfolio/ProjetNodevo/views/add.php";
        break;
    case "/ProjetNodevo/listeMannequin":
        include "portfolio/ProjetNodevo/views/listeMannequin.php";
        break;
    case "/ProjetNodevo/contact":
        include "portfolio/ProjetNodevo/views/contact.php";
        break;
    case "/ProjetNodevo/404":
        include "portfolio/ProjetNodevo/views/404.php";
        break;
    case "/ProjetNodevo/modif":
        include "portfolio/ProjetNodevo/views/modif.php";
        break;
    case "/ProjetNodevo/delete":
        include "portfolio/ProjetNodevo/views/delete.php";
        break;
    case "/ProjetNodevo/postuler":
        include "portfolio/ProjetNodevo/views/postuler.php";
        break;
    case "/ProjetNodevo/demandes":
        include "portfolio/ProjetNodevo/views/demandes.php";
        break;
    case "/ProjetNodevo/home":
        include "portfolio/ProjetNodevo/views/home.php";
        break;











    case '/ProjetNodevo/en':
        setcookie('langue', 'en', time() + 365 * 24 * 3600, null, null, false, true);
        header('Location: /ProjetNodevo/');
        break;
    case '/ProjetNodevo/fr':
        setcookie('langue', 'fr', time() + 365 * 24 * 3600, null, null, false, true);
        header('Location: /ProjetNodevo/');
        break;
    case '/ProjetNodevo/de':
        setcookie('langue', 'de', time() + 365 * 24 * 3600, null, null, false, true);
        header('Location: /ProjetNodevo/');
        break;
    case '/ProjetNodevo/es':
        setcookie('langue', 'es', time() + 365 * 24 * 3600, null, null, false, true);
        header('Location: /ProjetNodevo/');
        break;
    case '/ProjetNodevo/it':
        setcookie('langue', 'it', time() + 365 * 24 * 3600, null, null, false, true);
        header('Location: /ProjetNodevo/');
        break;
    case '/ProjetNodevo/ru':
        setcookie('langue', 'ru', time() + 365 * 24 * 3600, null, null, false, true);
        header('Location: /ProjetNodevo/');
        break;




    default:
        include "portfolio/ProjetNodevo/views/404.php";
        var_dump($url);
        break;
}


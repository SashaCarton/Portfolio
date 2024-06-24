<?php

$url = $_SERVER['REQUEST_URI'];
$url = str_replace('/Portfolio/', '', $url);


switch ($url) {
    case '':
        include './home.php';
        break;
    case '/home':
        include "home.php";
        break;
    case '/portfolio/':
        include "./portfolio/index.php";
        break;
    case '/portfolio/admin/':
        include "/portfolio/admin/index.php";
        break;
    case '/portfolio/maintenance':
        include "./portfolio/maintenance.html";
        break;
    //partie ProjetNodevo
    case '/projetNodevo/':
        var_dump($url);
        die;
        include "./ProjetNodevo/views/home.php";
        break;
    case '/projetNodevo':
        include "/ProjetNodevo/views/home.php";
        break;
        case '/projetNodevo/index':
            include "/ProjetNodevo/views/home.php";
            break;
    case '/ProjetNodevo/admin':
        include "/ProjetNodevo/views/admin.php";
        break;
    case '/ProjetNodevo/login':
        include "/ProjetNodevo/login.php";
        break;
    default:
        include "./ProjetNodevo/views/404.php";
        break;
}
var_dump($url);

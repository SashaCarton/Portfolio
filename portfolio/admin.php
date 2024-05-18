<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="styleadmin.css" />
    </head>
    <body>
        
        <?php
        // Démarrage de la session
        session_start();
      

        // Permet d'appeler la fonction de connexion à la BD
        require('connexion.php');
        
        // Connexion à la BD
        $co = connexionBdd();

        if (isset($_POST['submit'])){
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Préparation de la requête
            $query = $co->prepare('SELECT * FROM users_portfolio WHERE username=:login');

            // Association des paramètres aux variables/valeurs
            $query->bindParam(':login', $username);

            // Execution de la requête
            $query->execute();    

            // Récupération dans la variable $result de toutes les lignes que retourne la requête
            $result = $query->fetch();

            if (empty($result)) {
                // Si la requête ne retourne rien, alors l'utilisateur n'existe pas dans la BD, on lui
                // affiche un message d'erreur
                $message = "Le nom d'utilisateur ou le mot de passe est incorrect.";
            }
            else {
                $password_hash = $result["password"];
                if (password_verify($password, $password_hash)) {
                    // On définit la variable de session username avec la valeur saisie par l'utilisateur
                    $_SESSION['username'] = $username;
                    // On lance la page bdd.php à la place de la page actuelle
                    $_SESSION['connected'] = true;
                    header("Location: bdd.php");
                    exit();
                }
                else {
                    $message = "Le nom d'utilisateur ou le mot de passe est incorrect.";
                }
            }
        }
        if (isset($_POST['remember'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            setcookie('username', $username, time() + (86400 * 30), '/');
            setcookie('password', $password, time() + (86400 * 30), '/');
        } else {
            setcookie('username', '', time() - 3600, '/');
            setcookie('password', '', time() - 3600, '/');
        }
        ?>
        <?php
        // Vérifier si les cookies existent et sont valides
        if (isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
            $username = $_COOKIE['username'];
            $password = $_COOKIE['password'];
            
            // Préparation de la requête
            $query = $co->prepare('SELECT * FROM users_portfolio WHERE username=:login');
            // Association des paramètres aux variables/valeurs
            $query->bindParam(':login', $username);
            // Execution de la requête
            $query->execute();    
            // Récupération dans la variable $result de toutes les lignes que retourne la requête
            $result = $query->fetch();
            
            if (!empty($result)) {
                $password_hash = $result["password"];
                if (password_verify($password, $password_hash)) {
                    // On définit la variable de session username avec la valeur saisie par l'utilisateur
                    $_SESSION['username'] = $username;
                    // On lance la page bdd.php à la place de la page actuelle
                    $_SESSION['connected'] = true;
                    header("Location: bdd.php");
                    exit();
                }
            }
        }
        ?>
        
        <form class="box" action="" method="post" name="login">
            <h1 class="box-title">Connexion Admin</h1>
            <input type="text" class="box-input" name="username" placeholder="Nom d'utilisateur">
            <input type="password" class="box-input" name="password" placeholder="Mot de passe">
            <input type="submit" value="Connexion" name="submit" class="box-button">
            <input type="checkbox" name="remember" id="remember" <?php if (isset($_COOKIE['username'])) { ?>checked<?php } ?>>
            <label for="remember">Se souvenir de moi</label>
            <?php if (!empty($message)) { ?>
                <p class="errorMessage"><?php echo $message; ?></p>
            <?php } ?>
        </form>
        <button class="box-button" onclick="window.location.href = 'https://scarton.lyceestvincent.fr/Portfolio/index.html';">Retour vers Portfolio</button>
    </body>
</html>

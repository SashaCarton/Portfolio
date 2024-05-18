<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="styleadmin.css" />
    </head>
    <body>
        
        <?php
			// Permet d'appeler la fonction de connexion à la BD
            require('connexion.php');
			
			// Démarrage d'une session
            session_start();

            // Connexion à la BD
            $co = connexionBdd();

            if (isset($_POST['submit'])){
                $username = $_POST['username'];

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
                    $valid = password_verify($_POST["password"], $password_hash);
                    if ($valid) {
                        // On définit la variable de session username avec la valeur saisie par l'utilisateur
                        $_SESSION['username'] = $username;
                        // On lance la page bdd.php à la place de la page actuelle
                        header("Location: bdd.php");
                    }
                    else {
                        $message = "Le nom d'utilisateur ou le mot de passe est incorrect.";
                    }
                }
            }
        ?>
        
        <form class="box" action="" method="post" name="login">
            <h1 class="box-title">Connexion Admin</h1>
            <input type="text" class="box-input" name="username" placeholder="Nom d'utilisateur">
            <input type="password" class="box-input" name="password" placeholder="Mot de passe">
            <input type="submit" value="Connexion " name="submit" class="box-button">
            <?php if (! empty($message)) { ?>
                <p class="errorMessage"><?php echo $message; ?></p>
            <?php } ?>
        </form>
        <button class="box-button" onclick="window.location.href = 'https://scarton.lyceestvincent.fr/Portfolio/index.html';">Retour vers Portfolio</button>
    </body>
</html>
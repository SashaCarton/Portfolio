<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Affichage BDD</title>
    <link href="stylebdd.css" rel="stylesheet">
</head>
<body>
    <a href="../Portfolio/index.html" class="button">Retour</a> <br>
    <a href="https://phpmyadmin.alwaysdata.com" class="button">Connexion mysql</a>
    <a href='deconnexion.php' class='button'>Déconnexion</a>
    <?php

        session_start();
        if (!isset($_SESSION['connected']) || $_SESSION['connected'] != true) {
            header("Location: admin.php");
            exit();
        }

    
    
    $servername = "mysql-lyceestvincent.alwaysdata.net";
    $username = "116313_scarton";
    $password = "94g4tM96TeFCva.";
    $dbname = "lyceestvincent_scarton";
        // Connexion à la base de données
      $con = mysqli_connect($servername, $username, $password, $dbname);
        mysqli_set_charset($con, "utf8");

        
        // Vérification de la connexion
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit();
        }

        // Exécution de la requête SQL
        $query = "SELECT * FROM contact_portfolio ORDER BY id DESC";
        $result = mysqli_query($con, $query);

        // Vérification de l'exécution de la requête
        if ($result) {
            // Vérification du nombre de lignes retournées
            if (mysqli_num_rows($result) > 0) {
                echo "<table>";
                echo "<tr><th>ID</th><th>Date</th><th>Nom</th><th>Email</th><th>Message</th></tr>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>"; 
                    echo "<td>" . $row['date'] . "</td>";
                    echo "<td>" . $row['nom'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['message'] . "</td>";
                    echo "<td>";
                    if (isset($row['id'])) {
                        echo "<a href='modifier.php?id=" . $row['id'] . "'>Modifier</a>";
                        echo " | ";
                        echo "<a href='supprimer.php?id=" . $row['id'] . "'>Supprimer</a>";
                    } else {
                        echo "N/A";
                    }
                    echo "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "Aucune demande de contact trouvée.";
            }
        } else {
            // Gestion de l'erreur de requête
            echo "Erreur de requête : " . mysqli_error($con);
        }

        // Fermeture de la connexion à la base de données
        mysqli_close($con);
        // Déconnexion de la session
        
    ?>
</body>
</html>
		
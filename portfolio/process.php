<link href="styleprocess.css" rel="stylesheet">
<?php
// Assurez-vous que le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assurez-vous que les champs requis sont remplis
    if (isset($_POST['nom']) && isset($_POST['email']) && isset($_POST['message'])) {
        // Connexion à la base de données 
        $servername = "mysql-lyceestvincent.alwaysdata.net";
        $username = "116313_scarton";
        $password = "94g4tM96TeFCva.";
        $dbname = "lyceestvincent_scarton";

        // Création de la connexion
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Vérification de la connexion
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Récupération des données du formulaire et échappement des caractères spéciaux pour éviter les injections SQL
        $nom = mysqli_real_escape_string($conn, $_POST['nom']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);

        // Préparation de la requête SQL pour insérer les données dans la base de données
        $sql = "INSERT INTO contact_portfolio (nom, email, message) VALUES ('$nom', '$email', '$message')";

        // Exécution de la requête
        if ($conn->query($sql) === TRUE) {
            echo "<h1>Message transmis avec succès.</h1>";
        } else {
            echo "Erreur: " . $sql . "<br>" . $conn->error;
        }

        // Fermeture de la connexion à la base de données
        $conn->close();
    } else {
        echo "Tous les champs doivent être remplis.";
    }
} else {
    echo "Accès refusé.";
}

?>
<a href="https://scarton.lyceestvincent.fr/Portfolio/index.html">Retour</a>
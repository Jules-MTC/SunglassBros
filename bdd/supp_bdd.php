<html>

<head>
    <title>Suppression de la bdd</title>
    <link rel="icon" type="image/png" href="db_logo.png">
</head>

<body>
    <?php
    // Connection a phpmyadmin
    $serveurname = "localhost";
    $username = "root";
    $password = "";
    $dbname = "tsb_bd";

    $conn = new mysqli($serveurname, $username, $password, $dbname);
    if ($conn->connect_error) {
        echo "Erreur de connection<br>";
    } else {
        echo "Connection réusssite<br>";
    }
    $sql = "DROP DATABASE $dbname";

    if ($conn->query($sql) === TRUE) {
        echo "La base de données a été supprimée avec succès";
    } else {
        echo "Erreur lors de la suppression de la base de données : " . $conn->error;
    }
    $conn->close();
    ?>
</body>

</html>
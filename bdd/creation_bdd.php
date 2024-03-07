<html>

<head>
    <title>Création de la bdd</title>
    <link rel="icon" type="image/png" href="db_logo.png">
</head>

<body>

    <?php

    // Connection a phpmyadmin
    $serveurname = "localhost";
    $username = "root";
    $password = "";
    $dbname = "tsb_bd";

    $conn = new mysqli($serveurname, $username, $password);
    if ($conn->connect_error) {
        echo "Erreur de connection<br>";
    } else {
        echo "Connection réusssite<br>";
    }

    // creation d une base de donnee

    $db = "CREATE DATABASE $dbname";
    if ($conn->query($db) == true) {
        echo "La base de donnee a ete cree<br>";
    } else {
        echo "Erreur de creation<br>";
    }

    $conn->close();
    ?>

</body>

</html>
<html>

<head>
    <title>Déconnexion</title>
    <link rel="stylesheet" href="./style/login.jpg">
</head>

</html>

<?php
session_start();

if (empty($_SESSION['email']) && empty($_SESSION['user'])) {
    header('Location: connection.php');
    exit();
} else {
    // Connexion à la base de données
    $servername = "localhost";
    $username_bdd = "root";
    $password_bdd = "";
    $dbname = "tsb_bd";

    $conn = new mysqli($servername, $username_bdd, $password_bdd, $dbname);

    foreach ($_SESSION['panier'] as $key => $value) {
        $sql = "UPDATE produits SET quantite ='" . $_SESSION['panier'][$key]['quantite'] . "' WHERE id_produit = '" . $_SESSION['panier'][$key]['id_produit'] . "'";
        $result = mysqli_query($conn, $sql);
    }
    $conn->close();
    session_unset();
    session_destroy();
    header('Location: connection.php');
    exit();
}
?>
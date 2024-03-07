<?php
if (session_status() == PHP_SESSION_NONE) {
    // la session n'est pas active
    session_start();
}

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

unset($_SESSION['panier']);
if (!empty($_GET)) {

    $conn->close();
    $loc = $_GET['loc'];
    // Rediriger l'utilisateur vers une page de confirmation
    header('Location: ../' . $loc);
    exit;
}

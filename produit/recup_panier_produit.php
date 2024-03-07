<?php

// Connexion à la base de données
$servername = "localhost";
$username_bdd = "root";
$password_bdd = "";
$dbname = "tsb_bd";

$conn = new mysqli($servername, $username_bdd, $password_bdd, $dbname);

$i = 0;
$max = 0;
foreach ($_SESSION['panier'] as $key => $value) {
    $sql_1 = "SELECT * FROM produits WHERE id_produit = '$j'";
    $result = mysqli_query($conn, $sql_1);
}
$j = rand(0, $max_id);
while ($i < 8) {
    $sql_1 = "SELECT * FROM produits WHERE id_produit = '$j'";
    $result = mysqli_query($conn, $sql_1);
    while (mysqli_num_rows($result) == 0 || in_array($j, $id_use)) {
        $j = rand(0, $max_id);
        $sql_1 = "SELECT * FROM produits WHERE id_produit = '$j'";
        $result = mysqli_query($conn, $sql_1);
    }
    $row = "row" . $i;
    $$row = mysqli_fetch_assoc($result);
    array_push($id_use, $j);
    $i++;
    $j = rand(0, $max_id);
}
$conn->close();

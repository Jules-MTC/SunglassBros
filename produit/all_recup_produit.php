<?php

// Connexion à la base de données
$servername = "localhost";
$username_bdd = "root";
$password_bdd = "";
$dbname = "tsb_bd";

$conn = new mysqli($servername, $username_bdd, $password_bdd, $dbname);

$i = 0;
$sql_0 = "SELECT MAX(id_produit) as max_id FROM produits";
$result_max = mysqli_query($conn, $sql_0);
$max_id = mysqli_fetch_assoc($result_max)['max_id'];
$sql = "SELECT COUNT(*) FROM produits";
$result_nbr_max = mysqli_query($conn, $sql);
$row_nbr_max = mysqli_fetch_row($result_nbr_max);
$nbr_max = $row_nbr_max[0];
$j = 0;
while ($i < intval($nbr_max)) {
    $sql_1 = "SELECT * FROM produits WHERE id_produit = '$j'";
    $result = mysqli_query($conn, $sql_1);
    while (mysqli_num_rows($result) == 0 || in_array($j, $id_use)) {
        $j++;
        $sql_1 = "SELECT * FROM produits WHERE id_produit = '$j'";
        $result = mysqli_query($conn, $sql_1);
    }
    $row = "row" . $i;
    $$row = mysqli_fetch_assoc($result);
    array_push($id_use, $j);
    $i++;
    $j++;
}
$conn->close();
$nbr_pages = ceil($nbr_max / 8);

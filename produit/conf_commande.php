<?php
require_once '../compte/verif_connexion.php';
require_once './ajout_panier.php';

// Connexion à la base de données
$servername = "localhost";
$username_bdd = "root";
$password_bdd = "";
$dbname = "tsb_bd";

$conn = new mysqli($servername, $username_bdd, $password_bdd, $dbname);
$date = date("Y-m-d");
var_dump($_SESSION['panier']);
foreach ($_SESSION['panier'] as $key => $value) {
  $sql = "INSERT INTO mouvements_stock (id_produit,quantite,date_mouvement,type_mouvement) VALUES ('{$_SESSION["panier"][$key]["id_produit"]}','{$_SESSION["panier"][$key]["quantite"]}','{$date}','out')";
  mysqli_query($conn, $sql);
}
$sql = "INSERT INTO commandes (id_fournisseur,date_commande,date_livraison,statue) VALUES ('1','$date','1','En cours de traitement')";
mysqli_query($conn, $sql);

$conn->close();

unset($_SESSION['panier']);

header('Location: ../accueil.php');
?>

<html>

<head>
  <link rel="stylesheet" href="../style/style.css">
  <link rel="icon" type="image/jpg" href="../login.jpg">
  <title>Confirmation...</title>
</head>

<body>
  <div class="load_box">
    <div class="spinner"></div>
    <div class="load-text center">Vous avez bien passé commande !<br>Vous allez être redigé sur la page d'accueil</div>
  </div>
</body>

</html>
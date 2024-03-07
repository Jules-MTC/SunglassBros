<?php
// Ajoute un produit au panier

/* require_once '../compte/verif_connexion.php'; */
// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_produit = $_POST['id_produit'];
    $nom_produit = $_POST['nom_produit'];
    $prix_unitaire = $_POST['prix_unitaire'];
    $quantite = $_POST['quantite'];
    $image = $_POST['image'];

    $i = 0;
    $row = 'row' . $i;
    while ($id_produit != $$row['id_produit']) {
        $i += 1;
        $row = 'row' . $i;
    }
    $$row['quantite'] = intval($$row['quantite']) - intval($quantite);
    // Connexion à la base de données
    $servername = "localhost";
    $username_bdd = "root";
    $password_bdd = "";
    $dbname = "tsb_bd";

    $conn = new mysqli($servername, $username_bdd, $password_bdd, $dbname);

    $sql = "UPDATE produits SET quantite ='" . $$row['quantite'] . "' WHERE id_produit = '$id_produit'";
    $result = mysqli_query($conn, $sql);
    $conn->close();


    $item_array = array(
        'id_produit' => $id_produit,
        'nom_produit' => $nom_produit,
        'prix_unitaire' => $prix_unitaire,
        'quantite' => $quantite,
        'image' => $image,
    );

    // Vérifie si le panier existe
    if (!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = array();
    }

    // Ajoute le produit au panier
    $panier_array_id = array_column($_SESSION['panier'], 'id_produit');
    if (!in_array($id_produit, $panier_array_id)) {
        array_push($_SESSION['panier'], $item_array);
    } else {
        foreach ($_SESSION['panier'] as $key => $value) {
            if ($value['id_produit'] == $id_produit) {
                $_SESSION['panier'][$key]['quantite'] += $quantite;
            }
        }
    }
}

// Calcule la quantité totale des produits dans le panier
$quantite_tot = 0;
if (isset($_SESSION['panier'])) {
    foreach ($_SESSION['panier'] as $item) {
        $quantite_tot += $item['quantite'];
    }
}

<?php
require_once '../compte/verif_connexion.php';
require_once './ajout_panier.php';
if (empty($user['num_carte'])) {
  echo '<script>window.location.replace(\'http://localhost/SunglassBros/compte/ajout_info.php\');</script>';
}
var_dump($_SESSION['panier']);

?>

<html lang="fr">

<head>
  <script src="https://accounts.google.com/gsi/client" async defer></script>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Panier - The Sunglass Bros</title>
  <!-- Favicon-->
  <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
  <link href="../style/panier.css" rel="stylesheet" />
</head>

<body>
  <div class="master-container">
    <div class="card cart">
      <label class="title">Votre panier</label>
      <div class="products">
        <div class="product">
          <?php
          $prix_tot = 0;
          foreach ($_SESSION['panier'] as $key => $value) {
            $prix_tot += $_SESSION['panier'][$key]['prix_unitaire'] * $_SESSION['panier'][$key]['quantite'];
          ?>

            <img class="card-img-top" src="./image/<?php echo $_SESSION['panier'][$key]['image']; ?>" alt="<?php echo $_SESSION['panier'][$key]['image']; ?>" /></a></li>
            <div>
              <span>Nom : <?php echo $_SESSION['panier'][$key]['nom_produit']; ?></span>
              <p>Quantite : <?php echo $_SESSION['panier'][$key]['quantite']; ?></p>
              <p>Prix unitaire : <?php echo $_SESSION['panier'][$key]['prix_unitaire']; ?>€</p>
            </div>
            <div class="quantity">
              <button>
              </button>
              <label><?php echo $_SESSION['panier'][$key]['quantite']; ?></label>
              <button>
              </button>
            </div>
            <label class="price small"><?php echo $_SESSION['panier'][$key]['prix_unitaire'] * $_SESSION['panier'][$key]['quantite']; ?>€</label>

          <?php } ?>
        </div>
      </div>
    </div>
    <div class="card checkout">
      <label class="title">Vérification</label>
      <div class="details">
        <span>Total panier :</span>
        <span><?php echo $prix_tot; ?>€</span>
      </div>
      <div class="checkout--footer">
        <a class="no-style" href="../accueil.php"><button class="checkout-btn">Accueil</button></a>
        <label class="price"><?php echo $prix_tot; ?><sup>€</sup></label>
        <a class="no-style" href="./conf_commande.php"><button class="checkout-btn">Payer</button></a>
      </div>
    </div>
  </div>
</body>

</html>
<?php
require_once '../compte/verif_connexion.php';
$id_produit = $_GET['id'];
$id_use = array();
array_push($id_use, $id_produit);
// Connexion à la base de données
$servername = "localhost";
$username_bdd = "root";
$password_bdd = "";
$dbname = "tsb_bd";

$conn = new mysqli($servername, $username_bdd, $password_bdd, $dbname);

$sql_1 = "SELECT * FROM produits WHERE id_produit = '$id_produit'";
$result = mysqli_query($conn, $sql_1);

$row0 = mysqli_fetch_assoc($result);

$conn->close();
require_once 'recup_produit.php';
require_once './ajout_panier.php';
?>

<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Produit - The Sunglass Bros</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="../style/affiche_produit.css" rel="stylesheet" />
</head>

<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="../accueil.php">The Sunglass Bros</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="../accueil.php">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="#!">A propos</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Boutique</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="./all_produit.php">Tout les produits</a></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li><a class="dropdown-item" href="#!">Produits populaire</a></li>
                            <li><a class="dropdown-item" href="#!">Nouvelle arrivage</a></li>
                        </ul>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Mon compte</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="../compte/voir_compte.php">Voir mon compte</a></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li><a class="dropdown-item" href="../compte/deconnexion.php">Déconnexion</a></li>
                        </ul>

                        <?php
                        if ($user['droits'] == 'admin') {
                        ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Gestion</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="../admin/ajout_admin.php">Ajouter un administrateur</a></li>
                            <li><a class="dropdown-item" href="../admin/supp_admin.php">Supprimer un administrateur</a></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li><a class="dropdown-item" href="./ajout_produit.php">Ajouter un produit</a></li>
                            <li><a class="dropdown-item" href="./modif_produit.php">Modifier un produit</a></li>
                            <li><a class="dropdown-item" href="./supp_produit.php">Supprimer un produit</a></li>
                        <?php }
                        ?>
                        </ul>
                    </li>
                </ul>
                <form class="d-flex">
                    <button class="btn btn-outline-dark" type="button">
                        <i class="bi-cart-fill me-1"></i>
                        <li class="nav-item dropdown">
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown" <?php if (!empty($_SESSION['panier'])) {
                                                                                            $prix_tot = 0;
                                                                                            foreach ($_SESSION['panier'] as $key => $value) {
                                                                                                $prix_tot += $_SESSION['panier'][$key]['prix_unitaire'] * $_SESSION['panier'][$key]['quantite'];
                                                                                        ?> <li><a class="dropdown-item" href="./affiche_produit.php?id=<?php echo $_SESSION['panier'][$key]['id_produit']; ?>"><img class="card-img-top" src="./image/<?php echo $_SESSION['panier'][$key]['image']; ?>" alt="<?php echo $_SESSION['panier'][$key]['image']; ?>" /></a>
                        </li>
                        <li><a class="dropdown-item" href="./affiche_produit.php?id=<?php echo $_SESSION['panier'][$key]['id_produit']; ?>">Nom : <?php echo $_SESSION['panier'][$key]['nom_produit']; ?></a></li>
                        <li><a class="dropdown-item" href="./affiche_produit.php?id=<?php echo $_SESSION['panier'][$key]['id_produit']; ?>">Quantite : <?php echo $_SESSION['panier'][$key]['quantite']; ?></a></li>
                        <li><a class="dropdown-item" href="./affiche_produit.php?id=<?php echo $_SESSION['panier'][$key]['id_produit']; ?>">Prix unitaire : <?php echo $_SESSION['panier'][$key]['prix_unitaire']; ?>€</a></li>
                        <li><a class="dropdown-item" href="./affiche_produit.php?id=<?php echo $_SESSION['panier'][$key]['id_produit']; ?>">Prix total : <?php echo $_SESSION['panier'][$key]['prix_unitaire'] * $_SESSION['panier'][$key]['quantite']; ?>€</a></li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                    <?php }
                    ?> <li><a class="dropdown-item" href="#!">Total panier : <?php echo $prix_tot; ?>€</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="./supp_panier.php?loc=/produit/affiche_produit?id=<?php echo $id_produit; ?>">Vider panier</a></li>
                    <li><a class="dropdown-item" href="./affiche_panier.php">Passer commande</a></li>
                <?php
                                                                                        } else {
                ?> <li><a class="dropdown-item" href="#!">Votre panier est vide !</a></li>
                <?php }   ?>
                </ul>
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Panier</a>
                <span class="badge bg-dark text-white ms-1 rounded-pill"><?php echo $quantite_tot; ?></span>
                    </button>
                </form>
            </div>
        </div>
    </nav>
    <!-- Product section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <!-- Sale badge-->
                <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="./image/<?php echo $row0['image_produit']; ?>" alt="<?php echo $row0['image_produit']; ?>" /></div>
                <div class="col-md-6">
                    <div class="small mb-1">Code produit : <?php echo $row0['code_produit']; ?></div>
                    <h1 class="display-5 fw-bolder"><?php echo $row0['nom_produit']; ?></h1>
                    <div class="fs-5 mb-5">
                        <span><?php echo $row0['prix_unitaire']; ?>€</span>
                    </div>
                    <p class="lead"><?php echo file_get_contents('./description/' . $row0['description']); ?></p>
                    <div class="d-flex">
                        <center>
                            <?php if (intval($row0['quantite']) != 0) { ?>
                                <form method="post" name="ajout_panier" action="affiche_produit.php?id=<?php echo $id_produit; ?>">
                                    <input type="hidden" name="id_produit" value="<?php echo $row0['id_produit'] ?>">
                                    <input type="hidden" name="nom_produit" value="<?php echo $row0['nom_produit'] ?>">
                                    <input type="hidden" name="prix_unitaire" value="<?php echo $row0['prix_unitaire'] ?>">
                                    <input type="hidden" name="image" value="<?php echo $row0['image_produit'] ?>">
                                    </a><input class="form-control text-center me-3" id="quantite" type="number" name="quantite" value="1" max="<?php echo intval($row0['quantite']); ?>" style="max-width: 3rem" />
                                    <a class="no-style" href="./produit/affiche_produit.php?id=<?php echo $row0['id_produit']; ?>">
                                        <button class="btn btn-outline-dark flex-shrink-0" type="submit">
                                            <i class="bi-cart-fill me-1"></i>
                                            Ajouter au pranier
                                        </button>
                                </form>
                            <?php } ?>
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <?php if ($user['droits'] == 'admin') {
                                ?>
                                    <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="./produit/modif_produit?id=<?php echo $row0['id_produit']; ?>.php">Modifier</a></div>
                                <?php } ?>
                            </div>
                        </center>
                    </div>
                    </a>
                </div>
            </div>
    </section>
    <!-- Related items section-->
    <section class="py-5 bg-light">
        <div class="container px-4 px-lg-5 mt-5">
            <h2 class="fw-bolder mb-4">Les autres ont aussi achété :</h2>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php for ($i = 1; $i < 5; $i++) {
                    $row = 'row' . $i;
                ?>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Sale badge-->
                            <?php if ($$row['quantite'] == 0) {
                            ?>
                                <div class="badge bg-dark text-white position-absolute">Vendu</div>
                            <?php } ?>
                            <!-- Sale badge-->
                            <!--  <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div> -->
                            <a class="no-style" href="./affiche_produit.php?id=<?php echo $$row['id_produit']; ?>">
                                <!-- Product image-->
                                <img class="card-img-top" src="./image/<?php echo $$row['image_produit']; ?>" alt="<?php echo $$row['image_produit']; ?>" />
                                <!-- Product details-->
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <!-- Product name-->
                                        <h5 class="fw-bolder"><?php echo $$row['nom_produit']; ?></h5>
                                        <?php echo $$row['prix_unitaire']; ?>€
                                    </div>
                                </div>
                                <!-- Product actions-->
                                <center>
                                    <?php if ($$row['quantite'] != 0) {
                                    ?>
                                        <form method="post" name="ajout_panier" action="affiche_produit.php?id=<?php echo $id_produit; ?>">
                                            <input type="hidden" name="id_produit" value="<?php echo $$row['id_produit'] ?>">
                                            <input type="hidden" name="nom_produit" value="<?php echo $$row['nom_produit'] ?>">
                                            <input type="hidden" name="prix_unitaire" value="<?php echo $$row['prix_unitaire'] ?>">
                                            <input type="hidden" name="image" value="<?php echo $$row['image_produit'] ?>">
                            </a><input class="form-control text-center me-3" id="quantite" type="number" name="quantite" value="1" min="1" max="<?php echo intval($$row['quantite']); ?>" style="max-width: 3rem" />
                            <a class="no-style" href="./affiche_produit.php?id=<?php echo $$row['id_produit']; ?>">
                                <button class="btn btn-outline-dark flex-shrink-0" type="submit">
                                    <i class="bi-cart-fill me-1"></i>
                                    Ajouter au pranier
                                </button>
                                </form>
                            <?php } ?>
                            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="./affiche_produit.php?id=<?php echo $$row['id_produit']; ?>">Afficher</a></div>
                            </center>
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <?php if ($user['droits'] == 'admin') {
                                ?>
                                    <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="./modif_produit.php?id=<?php echo $$row['id_produit']; ?>">Modifier</a></div>
                                <?php } ?>
                            </div>
                        </div>
                        </a>
                    </div>
                <?php }
                ?>
            </div>
    </section>
    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; The Sunglass Bros 2023</p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>
</body>

</html>
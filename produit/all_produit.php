<?php

$id_use = array();
include '../compte/verif_connexion.php';
include './all_recup_produit.php';
require './ajout_panier.php';
if (empty($_GET)) {
    $page = 0;
} else {
    $page = intval($_GET['page']);
}
?>


<html lang="fr">

<head>
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Tout les produits - The Sunglass Bros</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="../style/general.css" rel="stylesheet" />
</head>

<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="../accueil_test2">The Sunglass Bros</a>
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
                                                                                        ?> <li><a class="dropdown-item" href="./produit/affiche_produit.php?id=<?php echo $_SESSION['panier'][$key]['id_produit']; ?>"><img class="card-img-top" src="./image/<?php echo $_SESSION['panier'][$key]['image']; ?>" alt="<?php echo $_SESSION['panier'][$key]['image']; ?>" /></a>
                        </li>
                        <li><a class="dropdown-item" href="./produit/affiche_produit.php?id=<?php echo $_SESSION['panier'][$key]['id_produit']; ?>">Nom : <?php echo $_SESSION['panier'][$key]['nom_produit']; ?></a></li>
                        <li><a class="dropdown-item" href="./produit/affiche_produit.php?id=<?php echo $_SESSION['panier'][$key]['id_produit']; ?>">Quantite : <?php echo $_SESSION['panier'][$key]['quantite']; ?></a></li>
                        <li><a class="dropdown-item" href="./produit/affiche_produit.php?id=<?php echo $_SESSION['panier'][$key]['id_produit']; ?>">Prix unitaire : <?php echo $_SESSION['panier'][$key]['prix_unitaire']; ?>€</a></li>
                        <li><a class="dropdown-item" href="./produit/affiche_produit.php?id=<?php echo $_SESSION['panier'][$key]['id_produit']; ?>">Prix total : <?php echo $_SESSION['panier'][$key]['prix_unitaire'] * $_SESSION['panier'][$key]['quantite']; ?>€</a></li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                    <?php }
                    ?> <li><a class="dropdown-item" href="#!">Total panier : <?php echo $prix_tot; ?>€</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="./supp_panier.php?loc=produit/all_produit.php">Vider panier</a></li>
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
                </li>
            </div>
        </div>
    </nav>
    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Toutes les lunettes ultra stylé <img src="../style/emoji_l_soleil.png"></h1> <!-- ajouter un smiley ? -->
                <p class="lead fw-normal text-white-50 mb-0">Faut que je mettes un truc ici</p> <!-- Description ? -->
            </div>
        </div>
    </header>
    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php
                if ($nbr_max - $page * 8 > 8) {
                    $x = ($page * 8);
                    $y = ($nbr_max - ($page * 8)) - 1;
                } else {
                    $x = ($page * 8);
                    $y = $nbr_max;
                }
                for ($i = $x; $i < $y; $i++) {
                    $row = 'row' . $i;
                ?>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <?php if ($$row['quantite'] == 0) {
                            ?>
                                <!-- Sale badge-->
                                <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Vendu</div>
                            <?php } ?>
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
                                        <form method="post" name="ajout_panier" action="all_produit.php">
                                            <input type="hidden" name="id_produit" value="<?php echo $$row['id_produit'] ?>">
                                            <input type="hidden" name="nom_produit" value="<?php echo $$row['nom_produit'] ?>">
                                            <input type="hidden" name="prix_unitaire" value="<?php echo $$row['prix_unitaire'] ?>">
                                            <input type="hidden" name="image" value="<?php echo $$row['image_produit'] ?>">
                            </a><input class="form-control text-center me-3" id="quantite" type="number" name="quantite" min="1" max="<?php echo intval($$row['quantite']); ?>" value="1" style="max-width: 3rem" />
                            <a class="no-style" href="./produit/affiche_produit.php?id=<?php echo $$row['id_produit']; ?>">
                                <button class="btn btn-outline-dark flex-shrink-0" type="submit">
                                    <i class="bi-cart-fill me-1"></i>
                                    Ajouter au pranier
                                </button>
                                </form>
                            <?php } ?>
                            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="./affiche_produit?id=<?php echo $$row['id_produit']; ?>.php">Afficher</a></div>
                            </center>
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <?php if ($user['droits'] == 'admin') {
                                ?>
                                    <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="./modif_produit?id=<?php echo $$row['id_produit']; ?>.php">Modifier</a></div>
                                <?php } ?>
                            </div>
                        </div>
                        </a>
                    </div>
                <?php }
                ?>
            </div>
            <center>
                <?php
                if ($nbr_pages > 1) {
                    if ($page > 0) {
                ?>
                        <a class="btn btn-outline-dark mt-auto" href="./all_produit.php?page=<?php echo $page - 1; ?>.php">
                            << /a>
                            <?php
                        }
                        for ($i = 0; $i < $nbr_pages; $i++) {
                            ?>
                                <a class="btn btn-outline-dark mt-auto" href="./all_produit.php?page=<?php echo $i; ?>.php"><?php echo $i; ?></a><!-- </div> -->
                            <?php
                        }
                        if ($page < $nbr_pages - 1) {
                            ?>
                                <a class="btn btn-outline-dark mt-auto" href="./all_produit.php?page=<?php echo $page + 1; ?>.php">></a>
                        <?php
                        }
                    }
                        ?>
            </center>
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
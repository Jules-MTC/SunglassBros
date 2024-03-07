<?php

$id_use = array(0);
include '../compte/verif_connexion.php';
include './all_recup_produit.php';
var_dump($nrb_pages);
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
                            <li><a class="dropdown-item" href="..   /admin/supp_admin.php">Supprimer un administrateur</a></li>
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
                    <button class="btn btn-outline-dark" type="submit">
                        <i class="bi-cart-fill me-1"></i>
                        Panier
                        <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                    </button>
                </form>
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
                <div class="col mb-5">
                    <div class="card h-100">
                        <a class="no-style" href="affiche_produit.php?id=<?php echo $row0['id_produit']; ?>">
                            <!-- Product image-->
                            <img class="card-img-top" src="./image/<?php echo $row0['image_produit']; ?>" alt="<?php echo $row0['image_produit']; ?>" />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder"><?php echo $row0['nom_produit']; ?></h5>
                                    <!-- Product price-->
                                    <?php echo $row0['prix_unitaire']; ?>€
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <?php if ($user['droits'] == 'admin') {
                                ?>
                                    <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="./modif_produit?id=<?php echo $row0['id_produit']; ?>.php">Modifier</a></div>
                                <?php } ?>
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="./afficher_produit?id_produit=<?php echo $row0['id_produit']; ?>.php">View options</a></div>
                            </div>
                    </div>
                    </a>
                </div>
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Sale badge-->
                        <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                        <a class="no-style" href="./affiche_produit.php?id=<?php echo $row1['id_produit']; ?>">
                            <!-- Product image-->
                            <img class="card-img-top" src="./image/<?php echo $row1['image_produit']; ?>" alt="<?php echo $row1['image_produit']; ?>" />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder"><?php echo $row1['nom_produit']; ?></h5>
                                    <?php echo $row1['prix_unitaire']; ?>€
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <?php if ($user['droits'] == 'admin') {
                                ?>
                                    <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="./modif_produit?id=<?php echo $row1['id_produit']; ?>.php">Modifier</a></div>
                                <?php } ?>
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Ajouter au panier</a></div>
                            </div>
                    </div>
                    </a>
                </div>
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Sale badge-->
                        <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                        <!-- Product image-->
                        <a class="no-style" href="./affiche_produit.php?id=<?php echo $row2['id_produit']; ?>">
                            <img class="card-img-top" src="./image/<?php echo $row2['image_produit']; ?>" alt="<?php echo $row2['image_produit']; ?>" />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder"><?php echo $row2['nom_produit']; ?></h5>
                                    <!-- Product price-->
                                    <?php echo $row2['prix_unitaire']; ?>€
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <?php if ($user['droits'] == 'admin') {
                                ?>
                                    <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="./modif_produit?id=<?php echo $row2['id_produit']; ?>.php">Modifier</a></div>
                                <?php } ?>
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Ajouter au panier</a></div>
                            </div>
                    </div>
                    </a>
                </div>
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Product image-->
                        <a class="no-style" href="./affiche_produit.php?id=<?php echo $row3['id_produit']; ?>">
                            <img class="card-img-top" src="./image/<?php echo $row3['image_produit']; ?>" alt="<?php echo $row3['image_produit']; ?>" />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder"><?php echo $row3['nom_produit']; ?></h5>
                                    <!-- Product price-->
                                    <?php echo $row3['prix_unitaire']; ?>€
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <?php if ($user['droits'] == 'admin') {
                                ?>
                                    <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="./modif_produit?id=<?php echo $row3['id_produit']; ?>.php">Modifier</a></div>
                                <?php } ?>
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Ajouter au panier</a></div>
                            </div>
                    </div>
                    </a>
                </div>
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Sale badge-->
                        <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                        <!-- Product image-->
                        <a class="no-style" href="./affiche_produit.php?id=<?php echo $row4['id_produit']; ?>">
                            <img class="card-img-top" src="./image/<?php echo $row4['image_produit']; ?>" alt="<?php echo $row4['image_produit']; ?>" />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder"><?php echo $row4['nom_produit']; ?></h5>
                                    <!-- Product price-->
                                    <?php echo $row4['prix_unitaire']; ?>€
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <?php if ($user['droits'] == 'admin') {
                                ?>
                                    <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="./modif_produit?id=<?php echo $row4['id_produit']; ?>.php">Modifier</a></div>
                                <?php } ?>
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Ajouter au panier</a></div>
                            </div>
                    </div>
                    </a>
                </div>
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Product image-->
                        <a class="no-style" href="./affiche_produit.php?id=<?php echo $row5['id_produit']; ?>">
                            <img class="card-img-top" src="./image/<?php echo $row5['image_produit']; ?>" alt="<?php echo $row5['image_produit']; ?>" />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder"><?php echo $row5['nom_produit']; ?></h5>
                                    <!-- Product price-->
                                    <?php echo $row5['prix_unitaire']; ?>€
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <?php if ($user['droits'] == 'admin') {
                                ?>
                                    <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="./modif_produit?id=<?php echo $row5['id_produit']; ?>.php">Modifier</a></div>
                                <?php } ?>
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">View options</a></div>
                            </div>
                    </div>
                    </a>
                </div>
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Sale badge-->
                        <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                        <!-- Product image-->
                        <a class="no-style" href="./affiche_produit.php?id=<?php echo $row6['id_produit']; ?>">
                            <img class="card-img-top" src="./image/<?php echo $row6['image_produit']; ?>" alt="<?php echo $row6['image_produit']; ?>" />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder"><?php echo $row6['nom_produit']; ?></h5>
                                    <!-- Product price-->
                                    <?php echo $row6['prix_unitaire']; ?>€
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <?php if ($user['droits'] == 'admin') {
                                ?>
                                    <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="./modif_produit?id=<?php echo $row6['id_produit']; ?>.php">Modifier</a></div>
                                <?php } ?>
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Ajouter au panier</a></div>
                            </div>
                    </div>
                    </a>
                </div>
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Product image-->
                        <a class="no-style" href="./affiche_produit.php?id=<?php echo $row7['id_produit']; ?>">
                            <img class="card-img-top" src="./image/<?php echo $row7['image_produit']; ?>" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder"><?php echo $row7['nom_produit']; ?></h5>
                                    <!-- Product price-->
                                    <?php echo $row7['prix_unitaire']; ?>€
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <?php if ($user['droits'] == 'admin') {
                                ?>
                                    <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="./modif_produit?id=<?php echo $row7['id_produit']; ?>.php">Modifier</a></div>
                                <?php } ?>
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Ajouter au panier</a></div>
                            </div>
                    </div>
                </div>
            </div>
            </a>
        </div>
        <center>
            <?php
            if ($nrb_pages > 1) {
                if ($page > 0) {
            ?>
                    <a class="btn btn-outline-dark mt-auto" href="./all_produit.php?page=<?php echo $page - 1; ?>.php">
                        << /a>
                        <?php
                    }
                    for ($i = $page; $i < $nrb_pages; $i++) {
                        ?>
                            <a class="btn btn-outline-dark mt-auto" href="./all_produit.php?page=<?php echo $i; ?>.php"><?php echo $i; ?></a><!-- </div> -->
                        <?php
                    }
                    if ($page < $nrb_pages) {
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
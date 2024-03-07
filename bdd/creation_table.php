<html>

<head>
    <title>Création de tables</title>
    <link rel="icon" type="image/png" href="db_logo.png">
</head>

<body>
    <?php
    // Connection a phpmyadmin
    $serveurname = "localhost";
    $username = "root";
    $password = "";
    $dbname = "tsb_bd";

    $conn = new mysqli($serveurname, $username, $password, $dbname);
    if ($conn->connect_error) {
        echo "Erreur de connection<br>";
    } else {
        echo "Connection réusssite<br>";
    }

    // creation d une table

    $tab_0 = "CREATE TABLE usertb (email VARCHAR(50) PRIMARY KEY,
    nom VARCHAR(10) NOT NULL,
    prenom VARCHAR(10) NOT NULL,
    mdp VARCHAR(500) NOT NULL,
    droits VARCHAR(11) NOT NULL DEFAULT 'utilisateur',
    code INT UNIQUE,
    ville VARCHAR(30),
    cp INT,
    num_rue INT,
    rue VARCHAR(30),
    num_carte INT UNIQUE,
    CONSTRAINT cp_positif CHECK (cp > 0),
    CONSTRAINT num_rue_positif CHECK (num_rue >= 0))";

    $tab_1 = "CREATE TABLE produits (id_produit INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nom_produit VARCHAR(20) NOT NULL UNIQUE,
    description VARCHAR(200),
    prix_unitaire FLOAT NOT NULL,
    quantite INT,
    code_produit VARCHAR(30),
    image_produit VARCHAR(30),
    modif VARCHAR(30),
    CONSTRAINT prix_positive CHECK (prix_unitaire >= 0.0))";

    $tab_2 = "CREATE TABLE fournisseurs (id_fournisseurs INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nom_fournisseur VARCHAR(20) NOT NULL,
    email_fournisseur VARCHAR(50),
    telephone INT(20),
    ville_fournisseur VARCHAR(30),
    cp_fournisseur INT,
    num_rue_fournisseur INT,
    rue_fournisseur VARCHAR(30),
    CONSTRAINT cp_positif_fourn CHECK (cp_fournisseur > 0),
    CONSTRAINT num_rue_positif_fourn CHECK (num_rue_fournisseur >= 0))";

    $tab_3 = "CREATE TABLE commandes (id_commande INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_fournisseur INT(10),
    date_commande DATE,
    date_livraison DATE,
    statue VARCHAR(30))";

    $tab_4 = "CREATE TABLE mouvements_stock (id_mouvement INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_produit INT(10),
    quantite INT,
    date_mouvement DATETIME,
    type_mouvement VARCHAR(10))";

    $n = 5;
    for ($i = 0; $i < $n; $i++) {
        $tab = 'tab_' . $i;
        if ($conn->query($$tab) == true) {
            echo 'La table a ete creation ' . $i . '<br>';
        } else {
            echo 'Erreur de creation ' . $i . '<br>';
        }
    }
    $conn->close();
    ?>

</body>

</html>
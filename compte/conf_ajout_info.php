<?php
require_once './verif_connexion.php';
?>

<html>

<head>
    <title>Confirmation d'ajout</title>
    <link rel="icon" type="image/jpg" href="../style/login.jpg">
    <link rel="stylesheet" href="../style/login.css">
    <center>
        <h1>
            <?php

            $num_rue = $_POST["num_rue"];
            $nom_rue = $_POST["nom_rue"];
            $ville = $_POST["ville"];
            $cp = $_POST["cp"];
            $num_carte = $_POST["num_carte"];

            // Connection a php my admin

            $serveurname = "localhost";
            $username_bdd = "root";
            $password = "";
            $dbname = "tsb_bd";

            $conn = new mysqli($serveurname, $username_bdd, $password, $dbname);

            $sql = "UPDATE usertb SET num_rue = '$num_rue', rue = '$nom_rue', ville = '$ville', cp = '$cp', num_carte = '$num_carte' WHERE email = ?
            ";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $user['email']);
            $stmt->execute();
            $result = $stmt->get_result();
            if (!$result) {
                echo "Vos informations on bien étés ajoutés <br>Bravo !<br>";
            } else {
                echo "Aie vous avez du faire une erreur !<br>";
            }
            $conn->close();
            ?>


        </h1>
        <h3>
            <div class="white">
                Vous pouvez revenir à votre panier en cliquant sur ce lien :<br>
                <a href='../produit/affiche_panier.php' id="link" style="color:blue;">Panier</a>
            </div>
        </h3>
</head>

<body>
</body>

</html>
<?php

include '../compte/verif_connexion_admin.php';
$error_msg = "";

// Connexion à la base de données
$servername = "localhost";
$username_bdd = "root";
$password_bdd = "";
$dbname = "tsb_bd";

$conn = new mysqli($servername, $username_bdd, $password_bdd, $dbname);

if (!empty($_GET)) {
    $id_produit = $_GET['id'];


    $sql_1 = "SELECT * FROM produits WHERE id_produit = '$id_produit'";
    $result = mysqli_query($conn, $sql_1);

    $row_produit = mysqli_fetch_assoc($result);
}
$date = date("Y-m-d");
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id_produit = $_POST['id_produit'];
    $nom_produit = $_POST['nom_produit'];
    $prix_unitaire = $_POST['prix_unitaire'];
    $quantite = $_POST['quantite'];
    $code_produit = $_POST['code_produit'];
    $image_produit = $_FILES['image_produit'];
    $fichier = $_FILES["description"];
    $nomFichier = $fichier["name"]; // Récupère le nom du fichier

    $sql = "SELECT * FROM produits WHERE id_produit = '$id_produit'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 0) {
        $error_msg = "Ce produit n'exite pas, vous ne pouvons donc pas le modifier<br>";
    } else {

        if (!$nom_produit == NULL) {
            $sql = "UPDATE produits SET nom_produit = '$nom_produit' WHERE id_produit = '$id_produit'";
            if (!$conn->query($sql)) {
                echo '<script>alert("Fatal error sql nom_produit !")</script>';
            }
        }
        if (!$prix_unitaire == NULL) {
            $sql = "UPDATE produits SET prix_unitaire = '$prix_unitaire' WHERE id_produit = '$id_produit'";
            if (!$conn->query($sql)) {
                echo '<script>alert("Fatal error sql prix unitaire !")</script>';
            }
        }
        if (!$quantite == NULL) {
            $sql = "UPDATE produits SET quantite = '$quantite' WHERE id_produit = '$id_produit'";
            $sql_1 = "INSERT INTO mouvements_stock (id_produit,quantite,date_mouvement,type_mouvement) VALUES ('$id_produit','$quantite','{$date}','in')";
            mysqli_query($conn, $sql_1);
            if (!$conn->query($sql)) {
                echo '<script>alert("Fatal error sql quantite !")</script>';
            }
        }
        if (!$code_produit == NULL) {
            $sql = "UPDATE produits SET code_produit = '$code_produit' WHERE id_produit = '$id_produit'";
            if (!$conn->query($sql)) {
                echo '<script>alert("Fatal error sql code produit !")</script>';
            }
        }
        if (!empty($image_produit) && isset($_FILES['image_produit']) && $_FILES['image_produit']['error'] == 0) {
            $filename = $_FILES['image_produit']['name'];
            $tempname = $_FILES['image_produit']['tmp_name'];
            $folder = "./image/" . $filename;
            move_uploaded_file($tempname, $folder);
            $sql = "UPDATE produits SET image_produit = '$filename' WHERE id_produit = '$id_produit'";
            if (!$conn->query($sql)) {
                echo '<script>alert("Fatal error sql image produit !")</script>';
            }
        }
        if (!empty($nomFichier)) {
            $cheminTemporaire = $fichier["tmp_name"]; // Récupère le chemin du fichier temporaire
            $cheminDestination = "./description/" . $nomFichier; // Définit le chemin de destination
            move_uploaded_file($cheminTemporaire, $cheminDestination);
            $sql = "UPDATE produit SET description = '$nomFichier' WHERE id_produit = '$id_produit'";
            if (!$conn->query($sql)) {
                echo '<script>alert("Fatal error sql desciription !")</script>';
            }
        }
        $conn->close();
        header('Location: ../accueil.php');
        exit();
    }
}
?>

<html>

<head>
    <title>Modification produit</title>
    <link rel="stylesheet" href="../style/login.css">
    <center>
</head>

<body>
    <div class="login-box">
        <h1>Modification du produit</h1>
        <form name="modif" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <?php if (!empty($id_produit)) { ?>
                <input type="hidden" name="id_produit" value="<?php echo $id_produit; ?>">
            <?php } ?>
            <div class="user-box">
                <input type="number" min="1" name="id_produit" value="<?php if (!empty($id_produit)) {
                                                                            echo $id_produit;
                                                                        } ?>" <?php if (!empty($id_produit)) { ?> readonly <?php
                                                                                                                        } ?>>
                <label>ID du produit :</label>
            </div>
            <div class="user-box">
                <br>
                <div class="user-box">
                    <input type="text" name="nom_produit" value="<?php if (!empty($id_produit)) {
                                                                        $row_produit['nom_produit'];
                                                                    } ?>">
                    <label>Nom du produit :</label>
                </div>
                <div class="user-box">
                    <br>
                    <input type="file" name="description" id="description" accept=".txt">
                    <label>Description :</label>
                </div>
                <div class="user-box">
                    <input type="number" min="0" name="prix_unitaire" value="<?php if (!empty($id_produit)) {
                                                                                    echo $row_produit['prix_unitaire'];
                                                                                } ?>">
                    <label>Prix unitaire :</label>
                </div>
                <div class="user-box">
                    <input type="number" min="0" name="quantite" value="<?php if (!empty($id_produit)) {
                                                                            echo $row_produit['quantite'];
                                                                        } ?>">
                    <label>Quantité :</label>
                </div>
                <div class="user-box">
                    <input type="number" min="0" name="code_produit" value="<?php if (!empty($id_produit)) {
                                                                                $row_produit['code_produit'];
                                                                            } ?>">
                    <label>Code produit</label> <!-- modifier avec des catégories ? -->
                    <div class="user-box">
                        <br>
                        <input type="file" name="image_produit" id="image_produit" accept=".jpg, .jpeg, .png">
                        <label>Image du produit :</label>
                    </div>
                    <span id="auth_error"><?php echo $error_msg; ?></span>
                    <a id="reset" href="javascript:document.forms['modif'].reset()">Tout effacer</a>
                    <span id="reset_anim"></span>
                    <a id="send" href="javascript:document.forms['modif'].submit()">Modifier</a>
                    <span id="send_anim"></span>
                    <?php if (!empty($id_produit)) { ?>
                        <a id="reset" href="./supp_produit.php?id=<?php echo $id_produit; ?>">Supprimer</a>
                        <span id="send_anim"></span>
                    <?php } ?>
        </form>
    </div>
    </center>
</body>

</html>
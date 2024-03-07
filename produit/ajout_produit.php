<?php
include '../compte/verif_connexion_admin.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connexion à la base de données
    $servername = "localhost";
    $username_bdd = "root";
    $password_bdd = "";
    $dbname = "tsb_bd";

    $conn = new mysqli($servername, $username_bdd, $password_bdd, $dbname);

    $date = date("Y-m-d");
    $nom_produit = $_POST['nom_produit'];
    $prix_unitaire = $_POST['prix_unitaire'];
    $quantite = $_POST['quantite'];
    $code_produit = $_POST['code_produit'];
    $image_produit = $_FILES['image_produit'];
    $fichier = $_FILES["description"];
    $nomFichier = $fichier["name"]; // Récupère le nom du fichier
    $cheminTemporaire = $fichier["tmp_name"]; // Récupère le chemin du fichier temporaire
    $cheminDestination = "./description/" . $nomFichier; // Définit le chemin de destination
    move_uploaded_file($cheminTemporaire, $cheminDestination);

    $filename_image = $_FILES['image_produit']['name'];
    $tempname = $_FILES['image_produit']['tmp_name'];
    $folder = "./image/" . $filename_image;
    move_uploaded_file($tempname, $folder);

    $sql = "INSERT INTO produits (nom_produit,description,prix_unitaire,quantite,code_produit,image_produit) VALUES ('$nom_produit','$nomFichier','$prix_unitaire','$quantite','$code_produit','$filename_image')";
    if (!$conn->query($sql)) {
        echo '<script>alert("Fatal error sql !")</script>';
    }
    $sql_1 = "SELECT * FROM produits WHERE code_produit = '$code_produit'";
    $result = mysqli_query($conn, $sql_1);
    $row = mysqli_fetch_assoc($result);
    $id = $row['id_produit'];
    $sql_2 = "UPDATE produits SET modif = 'modif_produit.php?id=" . $id . "' WHERE id_produit = " . $id;
    $sql_3 = "INSERT INTO mouvements_stock (id_produit,quantite,date_mouvement,type_mouvement) VALUES ('$id','$quantite','{$date}','in')";
    mysqli_query($conn, $sql_3);
    if (!$conn->query($sql_2)) {
        echo '<csript>alter("Fatal error sql 2 !")</script>';
    }
    $conn->close();
    include 'ajout_fait.php';
    exit();
}
?>

<html>

<head>
    <title>Ajout produit</title>
    <link rel="stylesheet" href="../style/login.css">
    <center>
</head>

<body>
    <div class="login-box">
        <h1>Ajout produit</h1>
        <form name="ajout" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <div class="user-box">
                <input type="text" name="nom_produit" required>
                <label>Nom du produit :</label>
            </div>
            <div class="user-box">
                <br>
                <input type="file" name="description" id="description" accept=".txt" required>
                <label>Description :</label>
            </div>
            <div class="user-box">
                <input type="number" min="0" name="prix_unitaire" required>
                <label>Prix unitaire :</label>
            </div>
            <div class="user-box">
                <input type="number" min="0" name="quantite" required>
                <label>Quantité :</label>
            </div>
            <div class="user-box">
                <input type="number" min="0" name="code_produit" required>
                <label>Code produit</label> <!-- modifier avec des catégories ? -->
                <div class="user-box">
                    <br>
                    <input type="file" name="image_produit" id="image_produit" accept=".jpg, .jpeg, .png" required>
                    <label>Image du produit :</label>
                </div>
                <a id="reset" href="javascript:document.forms['ajout'].reset()">Tout effacer</a>
                <span id="reset_anim"></span>
                <a id="send" href="javascript:document.forms['ajout'].submit()">Ajouter</a>
                <span id="send_anim"></span>
        </form>
    </div>
    </center>
</body>

</html>
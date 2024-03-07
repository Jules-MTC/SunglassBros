<script>
    function chargement() {
        window.open('http://localhost/SunglassBros/produit/conf_supp.php');
        setTimeout(function() {
            window.close();
            window.location.replace('http://localhost/SunglassBros/accueil.php');
        }, 4500);
    }
</script>

<?php

include '../compte/verif_connexion_admin.php';
if (!empty($_GET)) {
    $id_produit = $_GET['id'];

    // Connexion à la base de données
    $servername = "localhost";
    $username_bdd = "root";
    $password_bdd = "";
    $dbname = "tsb_bd";

    $conn = new mysqli($servername, $username_bdd, $password_bdd, $dbname);

    $sql_1 = "DELETE FROM produits WHERE id_produit='$id_produit'";
    if (!$conn->query($sql_1)) {
        echo '<script>alert("fatal error sql supp !")</script>';
        $conn->close();
    } else {
        echo '<script>chargement();</script>';
        $conn->close();
        exit();
    }
} else {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_produit = $_POST['id_produit'];

        // Connexion à la base de données
        $servername = "localhost";
        $username_bdd = "root";
        $password_bdd = "";
        $dbname = "tsb_bd";

        $conn = new mysqli($servername, $username_bdd, $password_bdd, $dbname);

        $sql_1 = "DELETE FROM produits WHERE id_produit='$id_produit'";
        if (!$conn->query($sql_1)) {
            echo '<script>alert("fatal error sql supp !")</script>';
            $conn->close();
        } else {
            echo '<script>chargement();</script>';
            $conn->close();
        }
    }
}
?>

<html>

<head>
    <title>Suppression produit</title>
    <link rel="stylesheet" href="../style/login.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<center>

    <body>
        <div class="login-box">
            <h1>Supprimer un produit :</h1>
            <form name="supp_produit" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="user-box">
                    <input type="number" name="id_produit" required>
                    <label>ID du produit :</label>
                </div>
                <a id="reset" href="javascript:document.forms['supp_produit'].submit()">Supprimer</a>
            </form>
        </div>
    </body>
</center>

</html>
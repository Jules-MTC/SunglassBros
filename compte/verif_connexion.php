
<?php
session_start();
if (empty($_SESSION['email']) && empty($_SESSION['user'])) {
    echo '<script>window.location.replace(\'http://localhost/SunglassBros/compte/connection.php\');</script>';
    exit();
}
if (empty($_SESSION['user'])) {
    $email = $_SESSION['email'];
    // Connexion à la base de données
    $servername = "localhost";
    $username_bdd = "root";
    $password_bdd = "";
    $dbname = "tsb_bd";

    $conn = new mysqli($servername, $username_bdd, $password_bdd, $dbname);

    $sql = "SELECT * FROM usertb WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $conn->close();

    if (mysqli_num_rows($result) == 0) {
        include 'deconnexion.php';
        include 'pas_de_compte.php';
        exit();
    }

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $user = array(
            "email" => $email,
            "given_name" => $row['nom'],
            "prenom" => $row['prenom'],
            "ville" => $row['ville'],
            "cp" => $row['cp'],
            "num_rue" => $row['num_rue'],
            "rue" => $row['rue'],
            "num_carte" => $row['num_carte'],
            "droits" => $row['droits'],
        );
    }
} else {
    $user = $_SESSION['user'];
    $email = $user['email'];
    // Connexion à la base de données
    $servername = "localhost";
    $username_bdd = "root";
    $password_bdd = "";
    $dbname = "tsb_bd";

    $conn = new mysqli($servername, $username_bdd, $password_bdd, $dbname);
    $sql = "SELECT * FROM usertb WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if (mysqli_num_rows($result) == 0) {
        include 'deconnexion.php';
        include 'pas_de_compte.php';
        exit();
    }
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $user = array(
            "email" => $email,
            "given_name" => $row['nom'],
            "prenom" => $row['prenom'],
            "ville" => $row['ville'],
            "cp" => $row['cp'],
            "num_rue" => $row['num_rue'],
            "rue" => $row['rue'],
            "num_carte" => $row['num_carte'],
            "droits" => $row['droits'],
        );
    }
}

?>
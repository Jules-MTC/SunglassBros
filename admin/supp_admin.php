<script>
    function chargement() {
        window.open('http://localhost/SunglassBros/admin/conf_supp_admin.php');
        setTimeout(function() {
            window.close();
            window.location.replace('http://localhost/SunglassBros/accueil.php');
        }, 4500);
    }
</script>

<?php

include('../config.php');

$google_api_token = $config['google_api_token'];

$error_msg = "";
include '../compte/verif_connexion_admin.php';
$recaptcha_secret_key = $google_api_token;
$error_msg = "";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Vérifier le reCAPTCHA
    if (isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {
        $captcha = $_POST['g-recaptcha-response'];
        $ip = $_SERVER['REMOTE_ADDR'];
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$recaptcha_secret_key&response=$captcha&remoteip=$ip");
        $result = json_decode($response);

        if ($result->success == true) {

            $email = $_POST['email'];

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

            if ($result && mysqli_num_rows($result) > 0) {
                var_dump($email);
                $sql = "UPDATE usertb SET droits = 'utilisateur' WHERE email = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $email);
                /*  $stmt->execute();
                $result = $stmt->get_result(); */

                if ($stmt->execute()) {
                    echo '<script>chargement();</script>';
                } else {
                    $error_msg = "Impossible de supprimer l'admin";
                }
            } else {
                $conn->close();
                $error_msg = "Aucun compte avec cette addresse mail à été trouvé !";
            }
        } else {
            $error_msg = "reCAPTCHA invalide !";
        }
    } else {
        $error_msg = "Veuillez cocher le reCAPTCHA !";
    }
}


?>

<html>

<head>
    <title>Suppression admin</title>
    <link rel="stylesheet" href="../style/login.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<center>

    <body>
        <div class="login-box">
            <h1>Suppression admin :</h1>
            <form name="supp_admin" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="user-box">
                    <input type="email" name="email" required>
                    <label>Email de l'ancien admin :</label>
                    <span id="auth_error"><?php echo $error_msg; ?></span>
                </div>
                <!-- <input type="hidden" name="email_admin" value="<?php /* echo $user['email'] */; ?>"> -->
                <div class="g-recaptcha" data-sitekey="6LdT0DIlAAAAAH0G-RfdumjMjY1SVI8twmXPqzwS"></div>
                <a id="reset" href="javascript:document.forms['supp_admin'].submit()">Supprimer</a>
            </form>
        </div>
    </body>
</center>

</html>
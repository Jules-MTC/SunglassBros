<?php
require_once '../vendor/autoload.php';

include('../config.php');

$google_api_token = $config['google_api_token'];

session_start();
$error_msg = "";
$recaptcha_secret_key = $google_api_token;

if (!empty($_POST['credential'])) {
    if (empty($_COOKIE['g_csrf_token']) || empty($_POST['g_csrf_token']) || $_COOKIE['g_csrf_token'] != $_POST['g_csrf_token']) {
        $error_msg = "Erreur de verification";
        exit();
    }

    $client = new Google_Client(['client_id' => "260166673041-2aerrfcaaids9glnmm2tipt19a7jvqen.apps.googleusercontent.com"]);  // Specify the CLIENT_ID of the app that accesses the backend
    $IdToken = $_POST['credential'];
    $user = $client->verifyIdToken($IdToken);

    if ($user) {
        $_SESSION['user'] = $user;
        header("Location: ../accueil.php");
    } else {
        // Invalid ID token
        $error_msg = "error invalid ID token";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier le reCAPTCHA
    if (isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {
        $captcha = $_POST['g-recaptcha-response'];
        $ip = $_SERVER['REMOTE_ADDR'];
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$recaptcha_secret_key&response=$captcha&remoteip=$ip");
        $result = json_decode($response);

        if ($result->success == true) {
            $email = $_POST["mail"];
            $password = $_POST["mdp"];

            // Connexion à la base de données
            $servername = "localhost";
            $username_bdd = "root";
            $password_bdd = "";
            $dbname = "tsb_bd";

            $conn = new mysqli($servername, $username_bdd, $password_bdd, $dbname);

            $sql = "SELECT mdp FROM usertb WHERE email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result && mysqli_num_rows($result) > 0) {
                // Comparaison du mot de passe entré avec le mot de passe haché
                $row = mysqli_fetch_assoc($result);
                $hashed_password = $row['mdp'];
                if (password_verify($password, $hashed_password)) {
                    $_SESSION['email'] = $email;
                    header('Location: ../accueil.php');
                    exit();
                } else {
                    $error_msg = "Email ou mot de passe incorrect !";
                }
            } else {
                // Aucun utilisateur trouvé avec ce nom d'utilisateur
                include 'pas_de_compte.php';
            }

            $conn->close();
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
    <title>Connection</title>
    <link rel="stylesheet" href="../style/login.css">
    <link rel="icon" type="icon" href="../style/login.ico">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://accounts.google.com/gsi/client" async defer></script>

</head>

<body>
    <div class="login-box">
        <form name="connection" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="user-box">
                <input type="text" name="mail" required>
                <label>Email</label>
            </div>
            <div class="user-box">
                <input type="password" name="mdp" required>
                <label>Mot de passe</label>
                <span id="auth_error"><?php echo $error_msg; ?></span>
            </div>
            <div class="g-recaptcha" data-sitekey="6LdT0DIlAAAAAH0G-RfdumjMjY1SVI8twmXPqzwS"></div>
            <center>
                <!-- debut bouton de connection google -->
                <div id="g_id_onload" data-client_id="260166673041-2aerrfcaaids9glnmm2tipt19a7jvqen.apps.googleusercontent.com" data-context="signin" data-ux_mode="popup" data-login_uri="http://localhost/SunglassBros/accueil.php" data-auto_prompt="false">
                </div>
                <div class="g_id_signin" data-type="standard" data-shape="pill" data-theme="filled_black" data-text="signin_with" data-size="large" data-logo_alignment="left">
                </div>
                <!-- fin bouton de connection google -->
                <a id="send" href="javascript:document.forms['connection'].submit()">Connexion</a>
                <span></span>
                <a href="http://localhost/SunglassBros/mdp/dmd_chgt_mdp.php" class="button-mdp-forget">Mot de passe oublié ?</a>
                <span></sapn>
            </center>
        </form>
    </div>
</body>

</html>
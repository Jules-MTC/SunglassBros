<?php
session_start();
$error_msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $code = $_POST['code'];
    $mdp  = $_POST['mdp'];

    // Connexion à la base de données
    $servername = "localhost";
    $username_bdd = "root";
    $password_bdd = "";
    $dbname = "tsb_bd";

    $conn = new mysqli($servername, $username_bdd, $password_bdd, $dbname);

    $sql_1 = "SELECT code FROM usertb WHERE code='$code'";

    $result_1 = mysqli_query($conn, $sql_1);
    if ($result_1 && mysqli_num_rows($result_1) > 0) {
        $hash = password_hash($mdp, PASSWORD_DEFAULT);
        $sql_2 = "UPDATE usertb SET mdp = '$hash' WHERE code = '$code'";
        if ($conn->query($sql_2) == true) {
            // Fermeture de la connexion
            $sql_3 = "UPDATE usertb SET code = NULL WHERE code = '$code'";
            $conn->query($sql_3);
            mysqli_close($conn);
            header('Location: ../compte/connection.php');
        } else {
            $error_msg = "Erreur de modification de mot de passe, veuillez vérifer que vous déjà un compte :(";
        }
    } else {
        $error_msg = "Mauvais code, veuillez réessayer !";
    }
}
?>

<html>

<head>
    <title>Modification mot de passe</title>
    <link rel="stylesheet" href="../style/login.css">
    <link rel="icon" type="icon" href="../style/login.ico">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>
    <div class="login-box">
        <h1>Modification mot de passe :</h1>
        <form name="modif_mdp" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return verif_mdp() && verif_code() && onSubmit(event)">
            <div class="user-box">
                <label>Code reçu par mail :</label>
                <input type="number" name="code" min="0" max="999999" required />
            </div>
            <div class="user-box">
                <label>Votre nouveau mot de passe : </label>
                <input type="password" name="mdp" id="pwd" minlength="8" required />
                <span id="mdp_error"></span>
            </div>
            <div class="user-box">
                <label>Confirmer votre nouveau mot de passe : </label>
                <input type="password" name="conf_mdp" id="conf_mdp" minlength="8" required />
                <span id="conf_mdp_error"></span>
            </div>
            <center>
                <div class="g-recaptcha" data-sitekey="6LdT0DIlAAAAAH0G-RfdumjMjY1SVI8twmXPqzwS"></div>
                <a id="send" href="javascript:document.forms['modif_mdp'].submit()">Modifier</a>
                <span id="send-anim"></span>
                <a id="reset" href="javascript:document.forms['modif_mdp'].reset()">Effacer</a>
                <span id="reset-anim"></span>
            </center>
        </form>
    </div>
    <script>
        function verif_mdp() {
            document.getElementById("conf_mdp_error").innerHTML = "";
            document.getElementById("mdp_error").innerHTML = "";
            var pwd = document.getElementById("pwd").value;
            var conf_mdp = document.getElementById("conf_mdp").value;
            let carcSp = "!\"#$%&'()*+,-./:;<=>?@[\\]^_`{|}~";
            if (pwd != conf_mdp) {
                document.getElementById("conf_mdp_error").innerHTML = "Les deux mots de passe ne sont pas identiques";
                return false;
            } else {
                var foundSpecialChar = false;
                for (var i = 0; i < pwd.length; i++) {
                    if (carcSp.indexOf(pwd[i]) !== -1) {
                        foundSpecialChar = true;
                        break;
                    }
                }
                if (foundSpecialChar) {
                    document.getElementById("conf_mdp_error").innerHTML = "";
                    document.getElementById("mdp_error").innerHTML = "";
                    return true;
                } else {
                    document.getElementById("mdp_error").innerHTML = "Le mot de passe ne contient pas de caractère spécial";
                    return false;
                }
            }
        }

        function onSubmit(event) {
            var response = grecaptcha.getResponse();
            if (response.length === 0) {
                event.preventDefault();
                document.getElementById("conf_mdp_error").innerHTML = "Veuillez cocher le reCAPTCHA !";;
                return false;
            }
            return true;
        }
    </script>
    </center>
</body>

</html>
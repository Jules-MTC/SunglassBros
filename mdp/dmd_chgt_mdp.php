<?php

include('../config.php');

$host_stmp = $config['host_stmp'];
$username_stmp = $config['username_stmp'];
$password_stmp = $config['password_stmp'];
$port_stmp = $config['port'];

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();
$error_msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["mail"];
    // Connexion à la base de données
    $servername = "localhost";
    $username_bdd = "root";
    $password_bdd = "";
    $dbname = "tsb_bd";

    $conn = new mysqli($servername, $username_bdd, $password_bdd, $dbname);

    do {
        $random_number = rand(100000, 999999);
        $sql = "SELECT code FROM usertb WHERE code = '$random_number'";
        $result = mysqli_query($conn, $sql);
        if ($conn->query($sql) != true) {
            echo "Fatal error";
            exit();
        }
    } while (mysqli_num_rows($result) > 0);

    $sql_1 = "UPDATE usertb SET code = '$random_number' WHERE email = '$email'";

    if ($conn->query($sql_1) == true) {
        require '../vendor/autoload.php';
        $result_1 = mysqli_query($conn, "SELECT * FROM usertb WHERE email = '$email'");
        if ($result_1) {
            $row = mysqli_fetch_assoc($result_1);
            $prenom = $row['prenom'];
            $nom = $row['nom'];

            // Create a new PHPMailer instance
            $mail = new PHPMailer;

            // Configure SMTP
            $mail->isSMTP();
            $mail->Host = $host_stmp;
            $mail->SMTPAuth = true;
            $mail->Username = $username_stmp;
            $mail->Password = $password_stmp;
            $mail->SMTPSecure = 'tls';
            $mail->Port = $port_stmp;

            // Configure email content
            $mail->setFrom('sunglassbros@outlook.com', 'Sunglass Bros');
            $mail->addAddress($email, $prenom . " " . $nom);
            $mail->Subject = 'Voici votre code ' . $random_number;
            $mail->Body = file_get_contents('..\mail\mail_chgt_mdp.html');
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            // Try to send the email
            try {
                $mail->send();
                echo 'Email sent successfully';
            } catch (Exception $e) {
                echo 'Email could not be sent. Error: ', $mail->ErrorInfo;
            }

            echo '<script>alert("Vous avez recu un code par mail avec les instructions pour changer votre mot de passe !")</script>';
            header("Location: modif_mdp.php");
            $conn->close();
        } else {
            echo "Fatal error";
        }
    }
}
?>

<!--    $result_1 = mysqli_query($conn, $sql_1);
    if ($result_1 && mysqli_num_rows($result_1) > 0) {
        $hash=password_hash($mdp, PASSWORD_DEFAULT);
        $sql_2 = "UPDATE usertb SET mdp = '$hash' WHERE code = '$code'";
        $result_2 = mysqli_query($conn,$result_2);
        if($result_2->succes == true){
            header('Location: modif_mdp_conf.php');
        }
        else{
            $error_msg = "Erreur de modification de mot de passe, veuillez vérifer que vous déjà un compte :(";
        }
    }else{
        $error_msg = "Mauvais code, veuillez réessayer !";
    }
}
?>*/-->

<html>

<head>
    <title>Demande de changement de mot de passe</title>
    <link rel="stylesheet" href="../style/login.css">
    <link rel="icon" type="icon" href="../style/login.ico">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>
    <div class="login-box">
        <h1>Voulez-vous modifier votre mot de passe ?</h1>
        <form name="dmd_mdp" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return onSubmit(event)">
            <div class="user-box">
                <label>Votre addresse mail :</label>
                <input type="text" name="mail" required>

            </div>
            <center>
                <div class="g-recaptcha" data-sitekey="6LdT0DIlAAAAAH0G-RfdumjMjY1SVI8twmXPqzwS"></div>
                <a id="send" href="javascript:document.forms['dmd_mdp'].submit()">Oui</a>
                <span id="send_anim"></span>
            </center>
        </form>
    </div>
    <script>
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
<html>

<head>
    <title>Confirmation de Création</title>
    <link rel="icon" type="image/jpg" href="../style/login.jpg">
    <link rel="stylesheet" href="../style/login.css">
    <center>
        <h1>
            <?php

include('../config.php');

$host_stmp = $config['host_stmp'];
$username_stmp = $config['username_stmp'];
$password_stmp = $config['password_stmp'];
$port_stmp = $config['port'];

            use PHPMailer\PHPMailer\PHPMailer;
            use PHPMailer\PHPMailer\Exception;

            $nom = $_POST["nom"];
            $prenom = $_POST["prenom"];
            $email = $_POST["email"];
            $mdp = $_POST["mdp"];

            // Connection a php my admin

            $serveurname = "localhost";
            $username_bdd = "root";
            $password = "";
            $dbname = "tsb_bd";

            $conn = new mysqli($serveurname, $username_bdd, $password, $dbname);

            $hash = password_hash($mdp, PASSWORD_DEFAULT);
            $sql = "INSERT INTO usertb (nom,prenom,email,mdp) VALUES('$nom','$prenom','$email','$hash')";
            if ($conn->query($sql) == true) {
                echo "Votre compte a bien été créé et mail de confirmation vient de vous etre envoyé<br>Bienvenue !<br>";

                require '../vendor/autoload.php';

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
                $mail->Subject = 'Vous nous avez enfin rejoints !';
                $mail->Body = file_get_contents('..\mail\mail_conf_crea.html');
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                // Try to send the email
                try {
                    $mail->send();
                    echo 'Un mail vous a bien été envoyé !';
                } catch (Exception $e) {
                    echo 'Email could not be sent. Error: ', $mail->ErrorInfo;
                }
            } else {
                echo "Impossible de vous créer un compte car vous en avez déjà un !<br>";
            }
            $conn->close();
            ?>

        </h1>
        <h3>
            Vous pouvez vous connecter en cliquant sur ce lien :<br>
            <a href='connection.php' id="link" style="color:blue;">Connexion</a>
        </h3>

</head>

<body>
</body>

</html>
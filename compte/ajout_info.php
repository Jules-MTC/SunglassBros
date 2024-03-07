<?php
require_once './verif_connexion.php';
?>

<html>

<head>
    <title>Ajout d'information</title>
    <link rel="stylesheet" href="../style/login.css">
    <link rel="icon" href="../style/login.ico">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>
    <center>
        <div class="login-box">
            <h1>Ajout d'informations</h1>
            <form name="ajout_info" action="conf_ajout_info.php" method="post" onsubmit="return onSubmit(event)">
                <div class="user-box">
                    <input type="number" name="num_rue" required />
                    <label>Votre numéro de rue : </label>
                </div>
                <div class="user-box">
                    <input type="text" name="nom_rue" required />
                    <label>Votre nom de rue : </label>
                </div>
                <div class="user-box">
                    <input type="text" name="ville" required />
                    <label>Votre ville : </label>
                </div>
                <div class="user-box">
                    <input type="text" name="cp" required />
                    <label>Votre code postal : </label>
                </div>
                <div class="user-box">
                    <input type="number" name="num_carte" required />
                    <label>Votre numéro de carte bancaire : </label>
                </div>
                <div class="g-recaptcha" data-sitekey="6LdT0DIlAAAAAH0G-RfdumjMjY1SVI8twmXPqzwS"></div>
                <center>
                    <a id="reset" href="javascript:document.forms['ajout_info'].reset()">Tout effacer</a>
                    <span id="reset_anim"></span>

                    <a id="send" href="javascript:document.forms['ajout_info'].submit()">Ajouter</a>
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
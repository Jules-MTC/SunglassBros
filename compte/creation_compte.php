<html>

<head>
    <title>Création d'un compte</title>
    <link rel="stylesheet" href="../style/login.css">
    <link rel="icon" href="../style/login.ico">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>
    <div class="login-box">
        <h1>Incription</h1>
        <form name="creation_compte" action="conf_crea.php" method="post" onsubmit="return verif_mdp() && onSubmit(event)">
            <div class="user-box">
                <input type="text" name="nom" required />
                <label>Votre nom : </label>
            </div>
            <div class="user-box">
                <input type="text" name="prenom" required />
                <label>Votre prénom : </label>
            </div>
            <div class="user-box">
                <input type="email" name="email" required />
                <label>Votre adresse mail : </label>
            </div>
            <div class="user-box">
                <input type="password" name="mdp" id="pwd" minlength="8" required />
                <label>Votre mot de passe : </label>
                <span id="mdp_error"></span>
            </div>
            <div class="user-box">
                <input type="password" name="conf_mdp" id="conf_mdp" minlength="8" required />
                <label>Confirmer votre mot de passe : </label>
                <span id="conf_mdp_error"></span>
            </div>
            <div class="g-recaptcha" data-sitekey="6LdT0DIlAAAAAH0G-RfdumjMjY1SVI8twmXPqzwS"></div>
            <center>
                <a id="reset" href="javascript:document.forms['creation_compte'].reset()">Tout effacer</a>
                <span id="reset_anim"></span>

                <a id="send" href="javascript:document.forms['creation_compte'].submit()">Inscription</a>
                <span id="send_anim"></span>
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
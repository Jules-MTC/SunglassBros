 <?php
    require_once './verif_connexion.php';
    ?>
 <html>

 <head>
     <link href="../style/login.css" rel="stylesheet">
     <link href="../style/login.ico" type="icon" rel="icon">
     <title>Information compte</title>
 </head>

 <body>
     <center>
         <h1>Vos informations de compte :<br></h1>
         <h2>
             <div class="white">
                 <?php
                    echo "Prénom : " . $user['prenom'];
                    echo "<br>Nom : " . $user['given_name'];
                    echo "<br>Adresse mail : " . $email;
                    if (!empty($user['ville'])) {
                        echo "<br>Numéro de rue : " . $user['num_rue'];
                        echo "<br>Rue : " . $user['rue'];
                        echo "<br>Ville : " . $user['ville'];
                        echo "<br>Code postale : " . $user['cp'];
                    }
                    echo "<br>\"Droit\" : " . $user['droits'];
                    ?>
             </div>
         </h2>
         <a href="../accueil.php">Pour revenir à la page d'accueil c'est ici</a>
     </center>
 </body>

 </html>
<script>
  function chargement() {
    window.open('http://localhost/SunglassBros/produit/conf_ajout.php');
    setTimeout(function() {
      window.close();
      window.location.replace('http://localhost/SunglassBros/accueil.php');
    }, 4500);
  }
</script>

<?php

echo '<script>chargement();</script>';

?>
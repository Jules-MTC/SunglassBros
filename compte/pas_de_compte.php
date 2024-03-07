<script>
  function chargement() {
    window.open('http://localhost/SunglassBros/compte/charg_connection.php');
    setTimeout(function() {
      window.close();
      window.location.replace('http://localhost/SunglassBros/compte/creation_compte.php');
    }, 4500);
  }
</script>

<?php
session_start();
echo '<script>chargement();</script>';
?>
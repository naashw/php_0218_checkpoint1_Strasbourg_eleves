<?php
    include 'connect.php';
    $bdd = mysqli_connect(SERVER, USER, PASS, DB);

      mysqli_query($bdd, " SELECT * FROM contact ( civility_id, name, lastname )");

      $resultat = mysqli_query($bdd, 'SELECT * FROM contact ');

      while($donnees = mysqli_fetch_assoc($resultat))
    {

      echo "<br>" ;
      echo $donnees['id']." ". $donnees['civility_id']. " ".$donnees['firstname']. " ". $donnees['lastname'];
      echo "<br>" ;
    }
    echo "fait chier";

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

    <table class="table table-bordered">
      <tr>
          <th><p class="">id</p></th>
          <th><p class="">civilité</p></th>
          <th><p class="">Nom Prénom</p></th>
          </tr>
      <tr>
    </table>

  </body>
</html>

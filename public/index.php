<?php
    require 'connect.php';
    require 'src/functions.php';
    //connexion à la base
    $pdo = new PDO(DSN, USER, PASS);
    // requêtre de lecture de la base de donnée

    if ($_SERVER["REQUEST_METHOD"]==='POST')
    {
          //Prépare la requête d'insertion sql
          $queryInsert="INSERT INTO contact (lastname, firstname, civility_id)    VALUES (:lastname, :firstname, :civility);";
          $prep = $pdo->prepare($queryInsert);
          //analyse des données reçues en post
          //si une donnée est reçue, on la lie à la préparation de l'Insertion
          //sinon on incrémente un compteur d'erreur
          $errorcount=0;
          if(!isset($_POST['civility']) || empty($_POST['civility']))
          {
            $errorcount++;
          }else {
              if ($_POST['civility']=='M.')
              {
                  $prep->bindValue(':civility',1, PDO::PARAM_INT);
              }
              else {
                  $prep->bindValue(':civility',2, PDO::PARAM_INT);
              }

          }

          if(!isset($_POST['lastname']) || empty($_POST['lastname']))
          {
            $errorcount++;
          }else {
            $prep->bindValue(':lastname',$_POST['lastname'], PDO::PARAM_STR);
          }

          if(!isset($_POST['firstname']) || empty($_POST['firstname']))
          {
            $errorcount++;
          }else {
            $prep->bindValue(':firstname',$_POST['firstname'], PDO::PARAM_STR);
          }

          //si il n'y a pas d'erreur, on execute la requete d'insertion préparée
          if(empty($error))
          {
            $prep->execute();
          }
          else
            echo "une erreur s'est glissée, veuillez saisir votre contact à nouveau en s'assurant de remplir tout les champs";
    }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>checkpoint1</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
  <body>
    <div class="container col-md-offset-1 col-md-5">

      <h1>Insertion d'un nouveau contact</h1>

      <form action="index.php" method="post">
          <label for="civility"> Civilité</label>
          <select name="civility">
              <option value='M.' name='M.'>M.</option>
              <option value="Mme." name='Mme.'>Mme.</option>
          </select><br>
          <label for="lastname"> Nom du contact</label><br>
          <input type="text" name="lastname" placeholder="Le nom de votre contact" value=""><br>
          <label for="firstname"> Prénom du contact</label><br>
          <input type="text" name="firstname" placeholder="Le prénom de votre contact" value=""><br>
          <button type="submit" name="button">Envoyer</button><br>
      </form>
    </div>
    <div class="container col-md-5">
        <h1>Liste des contacts</h1>
        <table class="table table-bordered">
            <thead>
              <tr>
                <th>Civilité</th>
                <th>NOM Prénom</th>
            </thead>
            <tbody>
              <?php
              $query = 'SELECT civility, lastname, firstname FROM contact JOIN civility ON civility.id=contact.civility_id ORDER BY lastname ASC, firstname ASC;';
              $res = $pdo->query($query);
              $resAll=$res->fetchAll();
              foreach($resAll as $data)
                        {
                            echo "<tr><td>".$data['civility']."</td>";
                            echo "<td>".fullname($data['lastname'],$data['firstname'])."</td>";
                        }
              ?>
            </tbody>
      </table>
    </div>
  </body>
</html>

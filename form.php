<?php
    include 'connect.php';
    $bdd = mysqli_connect(SERVER, USER, PASS, DB);

    if ($_SERVER["REQUEST_METHOD"]==='POST') {

      if(!isset($_POST['civility']) || empty($_POST['civility']))
      {
        $error['civility'] = "Vous n'avez pas entré le civility.";
      }

      if(!isset($_POST['firstname']) || empty($_POST['firstname']))
      {
        $error['firstname'] = "Vous n'avez pas entré firstname.";
      }

      if(!isset($_POST['lastname']) || empty($_POST['lastname']))
      {
        $error['lastname'] = "Vous n'avez pas entré lastname.";
      }

      if(empty($error))
      {
        $civility = $_POST['civility'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];

        mysqli_query($bdd, "INSERT INTO contact (civility, firstname, lastname)    VALUES ('$civility', '$firstname', '$lastname')");
      }
    }

    $resultat = mysqli_query($bdd, 'SELECT * FROM contact');

?>
 ?>

 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width intitial-scale=1">
     <title>grid</title>
   </head>
     <body>
       <form action="form.php" method="post">

         <p>
             <label for="civility">M/Mme :</label>
             <input type="civility" name="civility" id="civility" value=""/>
         </p>

           <p>
             <label for="name">nom :</label>
             <input type="name" name="name" id="name" value=""/>
           </p>

           <p>
               <label for="lastname">prenom :</label>
               <input type="lastname" name="lastname" id="lastname" value=""/>
           </p>

           <p class="button">
               <button type="submit">Envoyer votre message</button>
           </p>

       </form>
     </body>
 </html>

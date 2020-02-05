<?php


session_start();
if (empty($_SESSION['email'])) {
   header("location:login.php");
}
if (isset($_GET['quit'])) {
   header("Location:gerer_adherents.php");
}


?>

<!DOCTYPE html>
<html>

<head>
   <title>MODIFIER adhérent</title>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
   <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
   <style type="text/css">
      body {
         background-color: #304352;
         /* fallback for old browsers */
         background-color: -webkit-linear-gradient(to right, #304352, #d7d2cc);
         /* Chrome 10-25, Safari 5.1-6 */
         background-color: linear-gradient(to right, #304352, #d7d2cc);
         font-family: Arial, Helvetica, sans-serif;
         /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
      }

      * {
         box-sizing: border-box;
      }

      input[type=text],
      input[type=password],
      textarea,
      input[type=date],
      input[type=number] {
         width: 100%;
         padding: 15px;
         font-size: 15px;
         margin: 5px 0 22px 0;
         display: inline-block;
         border: none;
         background: #f1f1f1;
      }

      #dialog {
         position: fixed;
         left: 0px;
         top: 0px;
         width: 100%;
         height: 100%;
         z-index: 9999;
         text-align: center;
         display: none;
         background-color: white;
      }

      /* Add a background color when the inputs get focus */
      input[type=text]:focus,
      input[type=password]:focus {
         background-color: #ddd;
         outline: none;
      }

      /* Set a style for all buttons */
      button {

         color: black;
         padding: 14px 20px;
         margin: 8px 0;
         border: none;
         cursor: pointer;
         width: 100%;
         opacity: 0.9;
      }

      #login {
         background: #304352;
         /* fallback for old browsers */
         background: -webkit-linear-gradient(to right, #304352, #d7d2cc);
         /* Chrome 10-25, Safari 5.1-6 */
         background: linear-gradient(to right, #304352, #d7d2cc);
         /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
         color: white;
         padding: 14px 20px;
         margin: 8px 0;
         border: none;
         cursor: pointer;
         width: 100%;
         opacity: 0.9;
      }

      button:hover {
         opacity: 1;
      }


      .container {
         padding: 16px;
      }

      glyphicon-remove,
      button {
         position: absolute;
         top: 0%;
         right: 0%;
      }

      .modal {
         display: block;
         position: fixed;
         z-index: 1;
         left: 0;
         top: 0;
         width: 100%;
         height: 100%;
         overflow: auto;
         padding-top: 50px;
         background: #304352;
         background: -webkit-linear-gradient(to right, #304352, #d7d2cc);
         background: linear-gradient(to right, #304352, #d7d2cc);
      }

      /* Modal Content/Box */
      .modal-content {
         background-color: #fefefe;
         margin: 2% auto 15% auto;
         width: 80%;
         /* Could be more or less, depending on screen size */
      }

      hr {
         border: 1px solid #f1f1f1;
         margin-bottom: 25px;
      }
   </style>


</head>



<body>
   <?php
   $nom_value = "";
   $code_value = "";
   $prenom_value = "";
   $add_value = "";
   $tel_value = "";
   $date_value = "";

   include_once('db-config.php');
   $connect = connection();
   if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search']) && isset($_POST['adherent_nom']) && isset($_POST['adherent_prenom'])) {
      $nom_safe = htmlspecialchars(stripslashes($_POST['adherent_nom']));
      $prenom_safe = htmlspecialchars(stripslashes($_POST['adherent_prenom']));
      try {
         $request = $connect->prepare("SELECT * from adherents where nom = ? and prenom = ? or nom = ? and prenom = ?");
         $request->execute(array($nom_safe, $prenom_safe, $prenom_safe, $nom_safe));
         $res = $request->fetch();

         if (empty($res['nom']) ||  empty($res['prenom'])) {
            $request1 = $connect->prepare("SELECT * from owners where nom = ? and prenom = ? or nom = ? and prenom =?");
            $request1->execute(array($nom_safe, $prenom_safe, $prenom_safe, $nom_safe));
            $res1 = $request1->fetch();
         }
      } catch (Exception $e) {
         $e->getMessage();
      }
      if (empty($res['nom'])  &&  empty($res1['nom'])) {
         $src = "../images/sad.png";
         $message = "IL N'EXISTE AUCUN ADHÉRENT OU PROPRIETAIRE AVEC CE NOM ET PRÉNOM";
         echo ('<script>  
            $(document).ready(function(){
            $("#dialog").css("display","block"); 
             
          });=
      </script>');
      }

      if (!empty($res['nom']) && empty($res1['nom'])) {
         $nom_value = $res['nom'];
         $prenom_value = $res['prenom'];
         $tel_value = $res['telephone'];
         $add_value = $res['adresse'];
         $code_value = $res['adherent_code'];
         $date_value = $res['date_naissance'];
         $inscription_value = $res['date_inscription'];
         $frere_value = $res['code_famille'];
         $description_value = $res['description'];
         echo ('<script>
                  $(document).ready(function(){
                    $("#code").css("color","green");
                   $("#nom").css("color","green");
                   $("#prenom").css("color","green");
                   $("#adresse").css("color","green");
                   $("#tel").css("color","green");
                   $("#date").css("color","green");
                   $("#date_inscription").css("color","green");
                   $("#code_frere").css("color","green");
                   $("#description").css("color","green");});
        </script>');
      }

      if (!empty($res1['nom']) && empty($res['nom'])) {
         $nom_value = $res1['nom'];
         $prenom_value = $res1['prenom'];
         $tel_value = $res1['telephone'];
         $add_value = $res1['adresse'];
         $code_value = $res1['owner_code'];
         $date_value = $res1['date_naissance'];
         $inscription_value = $res1['date_inscription'];
         $frere_value = $res1['code_famille'];
         $description_value = $res1['description'];
         echo ('<script>
                $(document).ready(function(){
                  $("#code").css("color","green");
                 $("#nom").css("color","green");
                 $("#prenom").css("color","green");
                 $("#adresse").css("color","green");
                 $("#tel").css("color","green");
                 $("#date").css("color","green");
                 $("#date_inscription").css("color","green");
                 $("#code_frere").css("color","green");
                 $("#description").css("color","green");
  });
      </script>');
      }
   }
   
 ?>

<?php


if ($_SERVER["REQUEST_METHOD"] == "POST"  && isset($_POST['modifier']) && !empty($_POST['tel'] && !empty($_POST['date_inscription'])) && !empty($_POST['age']) && !empty($_POST['adresse']) && !empty($_POST['nom']) && !empty($_POST['prenom'])) {
      try {
       
            $request = $connect->prepare("SELECT * from adherents where nom = ? and prenom = ? or nom = ? and prenom = ?");
            $request->execute(array($_POST['nom'], $_POST['prenom'],$_POST['prenom'],$_POST['nom']));
            $res = $request->fetch();   
   
            if (empty($res['nom']) ||  empty($res['prenom'])) {
               $request1 = $connect->prepare("SELECT * from owners where nom = ? and prenom = ? or nom = ? and prenom =?");
               $request1->execute(array($_POST['nom'],$_POST['prenom'],$_POST['prenom'],$_POST['nom']));
               $res1 = $request1->fetch();
            }
         $code_safe = htmlspecialchars(stripslashes($_POST['code_frere']));
         $tel_safe = htmlspecialchars(stripslashes($_POST['tel']));
         $insc_safe = htmlspecialchars(stripslashes($_POST['date_inscription']));
         $desc_safe = htmlspecialchars(stripslashes($_POST['description']));
         $adresse_safe = htmlspecialchars(stripslashes($_POST['adresse']));
         $nom_safe = htmlspecialchars(stripslashes($_POST['nom']));
         $prenom_safe = htmlspecialchars(stripslashes($_POST['prenom']));

         if (!empty($res['nom'])) {

            $request = $connect->prepare("update adherents set adresse = ? , telephone = ? , description = ? , code_famille = ? , date_inscription = ? where nom = ? and prenom= ?");
            $request->execute(array($adresse_safe, $tel_safe, $desc_safe, $code_safe, $insc_safe, $nom_safe, $prenom_safe));

            $src = "../images/smile.png";
            $message = "L'ADHÉRENT A ÉTÉ BIEN MODIFIER";
            echo ('<script>  
      $(document).ready(function(){
      $("#dialog").css("display","block");
      
    });
    </script>');
         } else if (!empty($res1['nom'])) {
            $request1 = $connect->prepare("update owners set adresse = ? , telephone = ? , description = ? , code_famille = ? , date_inscription = ? where nom = ? and prenom= ?");
            $request1->execute(array($adresse_safe, $tel_safe, $desc_safe, $code_safe, $insc_safe, $nom_safe, $prenom_safe));

            $src = "../images/smile.png";
            $message = "LE PROPRIETAIRE A ÉTÉ BIEN MODIFIER";
            echo ('<script>  
        $(document).ready(function(){
        $("#dialog").css("display","block");
        
      });
      </script>');
         }
      } catch (Exception $e) {
         $e->getMessage();
      }
   }

   if ($_SERVER["REQUEST_METHOD"] == "POST"  && isset($_POST['modifier']) && (empty($_POST['tel']) || empty($_POST['adresse']) || empty($_POST['age']) || empty($_POST['nom']) || empty($_POST['prenom'])  || empty($_POST['code']))) {
      $message = "L'ADHÉRENT N'A PAS PU ÊTRE MODIFIER VEUILLEZ REÉSSAYER ULTERIEUREMENT OU VÉRIFIER LES INFORMATIONS QUE VOUS AVEZ INTRODUIT";

      $src = "../images/sad.png";
      echo ('<script>  
      $(document).ready(function(){
      $("#dialog").css("display","block");
      
    });
    </script>');
   }?>

   <div id="id01" class="modal">
      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
         <div class="container modal-content">
            <div class="row" style="text-align: center;">
               <h1>Modifier/Chercher un adhérent</h1>
            </div>
            <hr>
            <div class="input-group mb-3">
               <input type="text" class="form-control" name="adherent_nom" placeholder="NOM">
               <input type="text" class="form-control" name="adherent_prenom" placeholder="PRENOM">
               <input type="submit" name="search" id="login" style="font-size: 20px;color:black; " value="CHERCHER">

            </div>
            <hr>
            <label for="nom"><b>CODE ADHÉRENT</b></label>
            <input type="text" placeholder="CODE" name="code" id="code" value="<?php echo $code_value; ?>" class="nochange">
            <label for="nom"><b>NOM</b></label>
            <input type="text" placeholder="NOM" name="nom" id="nom" value="<?php echo $nom_value; ?>" class="nochange">
            <label for="prn"><b>PRÉNOM</b></label>
            <input type="text" placeholder="PRENOM" name="prenom" id="prenom" value="<?php echo $prenom_value; ?>" class="nochange"><br>
            <label for="age"><b>DATE DE NAISSANCE</b></label>
            <input type="date" name="age" placeholder="DATE DE NAISSANCE" id="date" value="<?php echo $date_value; ?>">
            <label for="tel"><b>TÉLÉPHONE</b></label>
            <input type="text" name="tel" placeholder="0645643554" id="tel" value="<?php echo $tel_value; ?>">
            <label for="adresse"><b>ADRESSE</b></label>
            <input type="text" name="adresse" placeholder="ADRESSE" id="adresse" value="<?php echo $add_value; ?>">
            <label for="date_inscription"><b>DATE INSCRIPTION</b></label>
            <input type="text" placeholder="DATE INSCRIPTION" name="date_inscription" id="date_inscription" value="<?php echo $inscription_value; ?>">
            <label for="code_frere"><b>CODE FAMILLE</b></label>
            <input type="text" placeholder="CODE FAMILLE" name="code_frere" id="code_frere" value="<?php echo $frere_value; ?>">
            <label for="description"><b>DESCRIPTION</b></label>
            <input type="text" placeholder="DESCRIPTION" name="description" id="description" value="<?php echo $description_value; ?>">
            <input type="submit" name="modifier" id="login" value="MODIFIER" style="font-size: 20px;color:black; " />
      </form>

      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="get">
         <input type="submit" name="quit" id="login" value="QUITTER" style="font-size: 20px;color:black; " />
      </form>
   </div>

   </div>
   <div id="dialog" title="Basic dialog">
      <p style="margin-top:360px;font-size:25px"> <?php echo $message; ?> </p><span><img src="<?php echo $src; ?>" alt="sad" style="width:100px;height: 100px;"> </span>
      <button name="close" id="close"><span class="glyphicon glyphicon-remove"></span></button>

   </div>
</body>
<script>
   $("#close").click(function() {
      $("#dialog").css("display", "none");

   });
</script>

</html>
<?php
include_once('db-config.php');
session_start();
if(empty($_SESSION['email'])){
  
   header("location:login.php");

}
if(isset($_GET['quit'])){
 header("Location:gerer_adherents.php");
 
}
$connect = connection();
?>

<!DOCTYPE html>
<html>
<head>
<title>Ajout adhérent</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1"><link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<style type="text/css">
    body { 
     background-color: #304352; /* fallback for old browsers */
  background-color: -webkit-linear-gradient(to right, #304352, #d7d2cc); /* Chrome 10-25, Safari 5.1-6 */
  background-color: linear-gradient(to right, #304352, #d7d2cc); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
  font-family: Arial, Helvetica, sans-serif; 
  }
* {box-sizing: border-box;}

input[type=text], input[type=password],textarea,input[type=date]{
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
input[type=text]:focus, input[type=password]:focus {
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
  background-color: white;
  
}
#login{
  background: #304352; /* fallback for old browsers */
  background: -webkit-linear-gradient(to right, #304352, #d7d2cc); /* Chrome 10-25, Safari 5.1-6 */
  background: linear-gradient(to right, #304352, #d7d2cc); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

button:hover {
  opacity:1;
}


.container {
  padding: 16px;
}

glyphicon-remove,button{
  position: absolute;
  top:0%;
  right: 0%;
}

/* The Modal (background) */
.modal {
  display:block; 
  position: fixed; 
  z-index: 0; 
  left: 0;
  top: 0;
  width: 100%; 
  height: 100%; 
  overflow: auto; 
  padding-top: 50px;background: #ad5389; /* fallback for old browsers */
  background: #304352; /* fallback for old browsers */
  background: -webkit-linear-gradient(to right, #304352, #d7d2cc); /* Chrome 10-25, Safari 5.1-6 */
  background: linear-gradient(to right, #304352, #d7d2cc); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 2% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  /*border: 1px solid #888;*/
  width: 80%; 
}

/* Style the horizontal ruler */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}
</style>

</head>
<body>
<?php 
if( $_SERVER["REQUEST_METHOD"] == "POST"  && isset($_POST['nom']) && isset($_POST['prenom'])&& isset($_POST['age']) && isset($_POST['tel']) && isset($_POST['adresse'])&& isset($_POST['inscription'])){
  try {
    $code_safe =htmlspecialchars(stripslashes($_POST['code']));
    $nom_safe =htmlspecialchars(stripslashes($_POST['nom']));
    $prenom_safe =htmlspecialchars(stripslashes($_POST['prenom'])); 
    $age_safe =htmlspecialchars(stripslashes($_POST['age']));
    $tel_safe =htmlspecialchars(stripslashes($_POST['tel']));
    $adresse_safe =htmlspecialchars(stripslashes($_POST['adresse'])); 
    $inscription_safe =htmlspecialchars(stripslashes($_POST['inscription'])); 
    $frere_safe =htmlspecialchars(stripslashes($_POST['code_famille']));
    $description_safe =htmlspecialchars(stripslashes($_POST['description']));
    
   
    $request = $connect->prepare("insert into adherents(adherent_code,nom,prenom,date_naissance,adresse,telephone,date_inscription,description , code_famille) values (?,?,?,?,?,?,?,?,?)"); 
    $request->execute(array($code_safe,$nom_safe,$prenom_safe,$age_safe,$adresse_safe,$tel_safe,$inscription_safe,$description_safe,$frere_safe));
    $request = $connect->prepare("insert into adherent_payment(adherent_code) values (?)"); 
    $request->execute(array($code_safe));
        $src="../images/smile.png";
      $message="L'ADHÉRENT A ÉTÉ BIEN AJOUTER" ; 
      echo ('<script>  
      $(document).ready(function(){
      $("#dialog").css("display","block");
      
    });
    </script>');
    
  
      

}
  catch (Exception $e) {
    $e->getMessage();
    
}
        
      
  
}
 if($_SERVER["REQUEST_METHOD"] == "POST"  && (empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['age']) || empty($_POST['tel']) || empty($_POST['adresse']) || empty($_POST['inscription']))){

  $message="VEUILLEZ REMPLIR TOUS LES CHAMPS" ;
  $src="../images/sad.png";
  echo ('<script>  
  $(document).ready(function(){
  $("#dialog").css("display","block");
  
});
</script>');

}
?>


     
     
<div id="id01" class="modal">
  <form  action= "<?php $_SERVER['PHP_SELF'] ?>"  method= "POST" >
    <div class="container modal-content">
      <div class="row" style="text-align: center;">
        <h1>AJOUTER UN ADHÉRENT</h1> 
      </div>
      <hr>
      <label for="nom"><b>CODE ADHÉRENT</b></label>
       <input type="text" placeholder="CODE"  name="code" id="nom">
       <label for="nom"><b>NOM</b></label>
       <input type="text" placeholder="NOM"  name="nom" id="nom">
       <label for="prn"><b>PRÉNOM</b></label>
       <input type="text" placeholder="PRENOM"  name="prenom" id="prenom"><br>
       <label for="age"><b>DATE DE NAISSANCE</b></label>
       <input type="date" name="age"  placeholder="DATE DE NAISSANCE" id="date">
       <label for="tel"><b>TÉLÉPHONE</b></label>
       <input type="text" name="tel"   placeholder="0645643554" id="tel">
       <label for="adresse"><b>ADRESSE</b></label>
       <input type="text" name="adresse"  placeholder="ADRESSE" id="adresse">
       <label for="inscription"><b>DATE D'INSCRIPTION</b></label>
       <input type="date" name="inscription"  placeholder="DATE D'INSCRIPTION" id="date">
       <label for="code_frere"><b>CODE FAMILLE</b></label>
       <input type="text" placeholder="CODE FAMILLE"  name="code_famille" id="code_frere">
       <label for="description"><b>DESCRIPTION</b></label>
       <input type="text" placeholder="DESCRIPTION"  name="description" id="description">
       <input type="submit" name="ajouter" id="login" value="AJOUTER" style="font-size: 20px;color:black; "/>
       </form>
     
       <form  action= "<?php $_SERVER['PHP_SELF'] ?>"  method= "get">
       <input type="submit" name="quit" id="login" value="QUITTER" style="font-size: 20px;color:black; "/>
       </form>
      </div>
      </div>
</div>
</div>
<div id="dialog" title="Basic dialog">      
    <p style="margin-top:360px;font-size:25px"> <?php echo $message; ?> </p><span><img src="<?php  echo $src; ?>" alt="sad" style="width:100px;height: 100px;"> </span>
    <button name="close" id="close"><span class="glyphicon glyphicon-remove" ></span></button>

</div>
<div>
        <img src="images/logo.png" alt="" id="logo">
  </div>
</body>
<script>
$("#close").click(function(){
       $("#dialog").css("display","none");

});

</script>
</body>
</html>

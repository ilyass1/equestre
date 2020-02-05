<?php
include_once('db-config.php');
session_start();
if(empty($_SESSION['email'])){
  
   header("location:login.php");

}
if(isset($_POST['quit'])){
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

input[type=text], input[type=password],textarea,input[type=date],input[type=number],input[type=color]{
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
.next{
  position: fixed;
  right:1%;
  top: 50%; 
  cursor: pointer;
}
.back{
  position: fixed;
  left:1%;
  top: 50%; 
  display: none;
  cursor: pointer;
}

.container {
  
  padding: 16px;
  position: absolute;
  

}

glyphicon-remove,button{
  position: absolute;
  top:0%;
  right: 0%;
}

/* The Modal (background) */
#form_cheval {
  display: none;
}


/* Modal Content/Box */
.modal-content {
  
  position: absolute;
  background-color: #fefefe;
  /* 5% from the top, 15% from the bottom and centered */
  /*border: 1px solid #888;*/
  width: 80%; 
  margin-left: 150px;
  margin-top: 50px;
}

/* Style the horizontal ruler */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}
</style>

</head>
<body >
<?php 
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ajouter_proprietaire']) && isset($_POST['nom']) && isset($_POST['prenom'])&& isset($_POST['age']) && isset($_POST['tel']) && isset($_POST['adresse']) && isset($_POST['inscription'])){
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
    
   
    $request = $connect->prepare("insert into owners(owner_code,nom,prenom,date_naissance,adresse,telephone,date_inscription,description,code_famille) values (?,?,?,?,?,?,?,?,?)"); 
    $request->execute(array($code_safe,$nom_safe,$prenom_safe,$age_safe,$adresse_safe,$tel_safe,$inscription_safe,$description_safe,$frere_safe));
    $request = $connect->prepare("insert into owners_payment(owner_code) values (?)"); 
    $request->execute(array($code_safe));
        $src="../images/smile.png";
      $message="LE PROPRIETAIRE A ÉTÉ BIEN AJOUTER" ; 
      echo ('<script>  
      $(document).ready(function(){
      $("#dialog").css("display","block");
           setTimeout(() => {
        $("#form_cheval").fadeIn(1000);
      $("#form_proprietaire").fadeOut(500);},1500 );

           

    });
    </script>');
    $_POST = null;
      

}
  catch (Exception $e) {
    $e->getMessage();
    
}
        
      
  
}
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ajouter_cheval']) && isset($_POST['code_cheval']) && isset($_POST['nom_pro']) && isset($_POST['prenom_pro']) && isset($_POST['nom_cheval'])  && isset($_POST['date_n']) && isset($_POST['box']) && isset($_POST['couleur'])){
 
  try {
    $code_safe =htmlspecialchars(stripslashes($_POST['code_cheval']));
    $nom_safe =htmlspecialchars(stripslashes($_POST['nom_pro']));
    $prenom_safe =htmlspecialchars(stripslashes($_POST['prenom_pro'])); 
    $cheval_safe =htmlspecialchars(stripslashes($_POST['nom_cheval'])); 
    $date_safe =htmlspecialchars(stripslashes($_POST['date_n']));
    $box_safe =htmlspecialchars(stripslashes($_POST['box']));
    $couleur_safe =htmlspecialchars(stripslashes($_POST['couleur'])); 
     $request1 = $connect->prepare("select owner_code from owners where nom = ? and prenom = ?");
     $request1->execute(array($nom_safe,$prenom_safe));
     $res = $request1->fetch(); 
      if($res['owner_code'] == null){
        $message="LE PROPRIÉTAIRE N'EXISTE PAS" ;
  $src="../images/sad.png";
  echo ('<script>  
  $(document).ready(function(){
  $("#dialog").css("display","block");
  

});
</script>');

      }
    
   
    $request = $connect->prepare("insert into horses(horse_code,owner_code,horse_name,date_naissance,coat_color,box_number) values (?,?,?,?,?,?)"); 
    $request->execute(array($code_safe,$res['owner_code'],$cheval_safe,$date_safe,$couleur_safe,$box_safe));
    
        $src="../images/smile.png";
      $message="LE CHAVAL A ÉTÉ BIEN AJOUTER" ; 
      echo ('<script>  
      $(document).ready(function(){
      $("#dialog").css("display","block");
      $("#form_cheval").css("display","none");
      $("#form_proprietaire").css("display","block");
      
    });
    </script>');
    unset($_POST);
  
      

}
  catch (Exception $e) {
    $e->getMessage();
    
}
        
      
  
}
 if($_SERVER["REQUEST_METHOD"] == "POST"  && isset($_POST['ajouter_proprietaire'])  && (empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['age']) || empty($_POST['tel']) || empty($_POST['adresse'] || empty($_POST['inscription'])))){

  $message="VEUILLEZ REMPLIR TOUS LES CHAMPS" ;
  $src="../images/sad.png";
  echo ('<script>  
  $(document).ready(function(){
  $("#dialog").css("display","block");
  

});
</script>');
unset($_POST);

}
if($_SERVER["REQUEST_METHOD"] == "POST"  && isset($_POST['ajouter_cheval'])  && (empty($_POST['code_cheval']) || empty($_POST['prenom_pro']) || empty($_POST['nom_pro']) || empty($_POST['nom_cheval']) || empty($_POST['date_n'] || empty($_POST['box'])))){

  $message="VEUILLEZ REMPLIR TOUS LES CHAMPS" ;
  $src="../images/sad.png";
  echo ('<script>  
  $(document).ready(function(){
  $("#dialog").css("display","block");
     
      $("#form_cheval").css("display","block");
      $("#form_proprietaire").css("display","none");
      
   

  

});
</script>');
unset($_POST);

}
?>


<div class="container modal-content" id="form_proprietaire">
  <form  action= "<?php $_SERVER['PHP_SELF'] ?>"  method= "POST" name="form1">
   
    
      <div class="row" style="text-align: center;">
        <h1>AJOUTER UN PROPRIÉTAIRE </h1> 
      </div>
      <hr>
      <label for="nom"><b>CODE PROPRIÉTAIRE</b></label>
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
       <input type="submit" name="ajouter_proprietaire" id="login" value="AJOUTER" style="font-size: 20px;color:black; "/>
       <input type="submit" name="quit" id="login" value="QUITTER" style="font-size: 20px;color:black; "/>
       </form>
</div>
       <div class="container modal-content" id="form_cheval">
     <form  action= "<?php $_SERVER['PHP_SELF'] ?>"  method= "POST" >
      <div class="row" style="text-align: center;">
        <h1>AJOUTER UN CHEVAL </h1> 
      </div>
      <hr>
      <label><b>CODE CHEVAL</b></label>
       <input type="text" placeholder="CODE CHEVAL"  name="code_cheval" id="code_cheval">
       <label ><b>NOM DU PROPRIÉTAIRE</b></label>
       <input type="text" placeholder="NOM PROPRIÉTAIRE"  name="nom_pro" >
       <label><b>PRÉNOM DU PREPRIÉTAIRE</b></label>
       <input type="text" placeholder="PRENOM PROPRIÉTAIRE"  name="prenom_pro" ><br>
       <label><b>NOM DU CHEVAL</b></label>
       <input type="text" placeholder="NON DU CHEVAL"  name="nom_cheval" ><br>
       <label ><b>DATE DE NAISSANCE</b></label>
       <input type="date" name="date_n"  placeholder="DATE DE NAISSANCE" id="date">
       <label ><b>NUMERO DE BOX</b></label> 
       <input type="number" placeholder="NUMERO DE BOX" name="box" max="15" min="1">
       <label ><b>COULEUR DE LA ROBE</b></label> 
       <input type="text"  placeholder="COULEUR DE LA ROBE" name="couleur"> 
       <input type="submit" name="ajouter_cheval" id="login" value="AJOUTER" style="font-size: 20px;color:black; "/>
       <input type="submit" name="quit" id="login" value="QUITTER" style="font-size: 20px;color:black; "/>

       </form></div>

  
  
    


<div class="next">
  <span style="font-size: 25px;color:#d7d2cc" ><img src="../images/next.png"></span><span><img src="" alt=""></span>
</div>
<div class="back">
  <span style="font-size: 25px;color:#d7d2cc" ><img src="../images/back.png"></span><span><img src="" alt=""></span>
</div>

       <div id="dialog" title="Basic dialog">      
    <p style="margin-top:360px;font-size:25px"> <?php echo $message; ?> </p><span><img src="<?php  echo $src; ?>" alt="sad" style="width:100px;height: 100px;"> </span>
    <button name="close" id="close"><span class="glyphicon glyphicon-remove" ></span></button>

</div>
</body>
<script>
$("#close").click(function(){
       $("#dialog").css("display","none");

});

</script>
<script>
$(document).ready(()=>{
  $(".next").click(()=>{
    setTimeout(() => {
      $("#form_cheval").fadeIn(1000);
      $("#form_proprietaire").fadeOut(500);
      $(".next").fadeOut(500);
      $(".back").fadeIn(500);
      },500 );

  });
  $(".back").click(()=>{
    setTimeout(() => {
      $("#form_cheval").fadeOut(500);
      $("#form_proprietaire").fadeIn(1000);
      $(".next").fadeIn(500);
      $(".back").fadeOut(500);
      },500 );

  });


  });

</script>
</body>
</html>

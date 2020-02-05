<?php
include_once('db-config.php');
session_start();
if(empty($_SESSION['email'])){
  
   header("location:login.php");

}
if(isset($_GET['quit'])){
 header("Location:pay_add_pro.php");
 
}
$connect = connection();
$nom = $_GET['nom'];
$prenom = $_GET['prenom'];
$type = $_GET['type'];

?>

<!DOCTYPE html>
<html>
<head>
<title>FACTURATION</title>
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

input[type=text], input[type=password],textarea,input[type=date],select{
  width: 100%;
  padding: 15px;
  font-size: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}
.check{
   display: none;
}
input{
  color: green;
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

if($type == "proprietaire"){
    $reduction = 10; 
   
   try{
 $request = $connect->prepare('SELECT a.owner_code,nom,prenom,adresse,telephone,code_famille,cotisation,janvier,février,mars,avril,mai,juin,juillet,août,septembre,octobre,novembre,decembre FROM owners a , owners_payment ad WHERE a.owner_code = ad.owner_code and nom =? and prenom = ?'); 
 $request->execute(array($nom,$prenom));
 $data=$request->fetch();
 $request1 = $connect->prepare('select count(*) from horses h , owners o where o.owner_code = h.owner_code'); 
 $request1->execute();
 $data1=$request1->fetch();
 $horses_num = $data1['count(*)'];
 $tel = $data['telephone'];
 $adresse = $data['adresse'];
 $code_frere = $data['code_famille'];
 if($code_frere == null){
     $code_frere ="NON";
     $reduction = 0 ;
     echo("<script>
     $(document).ready(()=>{
       $('#code_frere').attr('disabled','disabled');
    })
     
     </script>");
 }
 else if($code_frere != null){
   switch($horses_num){
      case  $horses_num = 1 :   $montant = 600; break;
      case  $horses_num = 2 :   $montant = 1000; break;
      case  $horses_num > 2 :   $montant = $horses_num*400; break;

   }
    $montant -=  $montant*10/100 ;
 }
 $code = $data['owner_code'];
   }catch(Exception $e){
          $e->getMessage();
   }
   

}

if($type == "adherent"){
    $reduction = 10; 
    $montant = 400 ;
   try{
 $request = $connect->prepare('SELECT a.adherent_code,nom,prenom,adresse,telephone,code_famille,cotisation,janvier,février,mars,avril,mai,juin,juillet,août,septembre,octobre,novembre,decembre FROM adherents a , adherent_payment ad WHERE a.adherent_code = ad.adherent_code and nom =? and prenom = ?'); 
 $request->execute(array($nom,$prenom));
 $data=$request->fetch();
 $tel = $data['telephone'];
 $adresse = $data['adresse'];
 $code_frere = $data['code_famille'];
 if($code_frere == null){
     $code_frere ="NON";
     $reduction = 0 ;
     echo("<script>
     $(document).ready(()=>{
       $('#code_frere').attr('disabled','disabled');
    })
     
     </script>");
 }
 else if($code_frere != null){
    $montant -=  $montant*10/100 ;
 }
 $code = $data['adherent_code'];
   }catch(Exception $e){
          $e->getMessage();
   }
   

}




?>
<?php
if($type == "adherent"){
if( isset($_POST['payer']) ){
    if($_POST['mois']== "vide" || ( $_POST['type'] == "chèque" && empty($_POST['check']))  ){
  $message="VEUILLEZ REMPLIR TOUS LES CHAMPS" ;
  $src="../images/sad.png";
  echo ('<script>  
  $(document).ready(function(){
  $("#dialog").css("display","block");
  
});
</script>');

    }
 if ($_POST['mois'] != "vide"){
      try{
       $mois = htmlspecialchars($_POST['mois']);
       $sql = "update adherent_payment set $mois = ? where adherent_code = ?";
        $request = $connect->prepare($sql); 
         $request->execute(array("payé",$code));
      header("location:checkout.php");
      }catch( Exception $e){
        $message="VEUILLEZ RÉESSAYER ULTÉRIEUREMENT" ;
        $src="../images/sad.png";
        echo ('<script>  
        $(document).ready(function(){
        $("#dialog").css("display","block");
        
      });
      </script>');

      }
     
}


}}

if($type == "proprietaire"){
  if( isset($_POST['payer']) ){
      if($_POST['mois']== "vide" || ( $_POST['type'] == "chèque" && empty($_POST['check']))  ){
    $message="VEUILLEZ REMPLIR TOUS LES CHAMPS" ;
    $src="../images/sad.png";
    echo ('<script>  
    $(document).ready(function(){
    $("#dialog").css("display","block");
    
  });
  </script>');
  
      }
   if ($_POST['mois'] != "vide"){
        try{
         $mois = htmlspecialchars($_POST['mois']);
         $sql = "update owners_payment set $mois = ? where owner_code = ?";
          $request = $connect->prepare($sql); 
           $request->execute(array("payé",$code));
        header("location:checkout.php");
        }catch( Exception $e){
          $message="VEUILLEZ RÉESSAYER ULTÉRIEUREMENT" ;
          $src="../images/sad.png";
          echo ('<script>  
          $(document).ready(function(){
          $("#dialog").css("display","block");
          
        });
        </script>');
  
        }
       
  }
  
  
  }}
?>

     
<div id="id01" class="modal">
  <form  action= "<?php $_SERVER['PHP_SELF'] ?>"  method= "POST" >
    <div class="container modal-content">
      <div class="row" style="text-align: center;">
        <h1>FACTURATION</h1> 
      </div>
      <hr>
      <label for="nom"><b>CODE ADHÉRENT</b></label>
       <input type="text" placeholder="CODE"  name="code" value="<?php echo $code ;?>" disabled>
       <label for="nom"><b>NOM ET PRÉNOM</b></label>
       <input type="text" placeholder="NOM"  name="nom"  value="<?php echo $nom.' '.$prenom ;?> "  disabled>
       <label for="tel"><b>TÉLÉPHONE</b></label>
       <input type="text" name="tel"   placeholder="telephone" id="tel" value="<?php echo $tel ;?>" disabled >
       <label for="adresse"><b>ADRESSE</b></label>
       <input type="text" name="adresse"  placeholder="ADRESSE" id="adresse" value="<?php echo $adresse ;?>"  disabled>
       <label for="code_frere"><b>CODE FAMILLE</b></label>
       <input type="text" placeholder="CODE Famille"  name="code_famille" id="code_frere" value="<?php echo $code_frere ;?>">
       <?php
          if($type == "proprietaire"){?>
            <label for="code_frere"><b>NOMBRE DE CHEVAUX</b></label> 
            <input type="text" placeholder="nombre de chevaux"  name="horses_num"  value="<?php echo $horses_num ;?>" readonly>
         <?php }
       ?>
       <label for="description"><b>TYPE DE PAIEMENT</b></label>
        <select name="type" id="type">
         <option value="en espèces"> EN ESPÈCES</option>
         <option value="chèque"> CHÈQUE</option>
       </select>
       <div class="check">
       <label for="description" ><b>NUMÉRO DE CHÈQUE</b></label>
       <input type="text" name="check"  placeholder="numéro de chèque" > 
       </div>
       <label for="description"><b>MOIS</b></label>
        <select name="mois"  id="mois">
          <option value="vide"></option>
         <?php
         if($type == "adherent"){
         $request = $connect->prepare('SELECT a.adherent_code,nom,prenom,adresse,telephone,code_famille,cotisation,janvier,février,mars,avril,mai,juin,juillet,août,septembre,octobre,novembre,decembre FROM adherents a , adherent_payment ad WHERE a.adherent_code = ad.adherent_code and nom =? and prenom = ?'); 
          $request->execute(array($nom,$prenom));
             $data = $request->fetch(PDO::FETCH_ASSOC) ;
         }
         else if($type == "proprietaire"){
          $request = $connect->prepare('SELECT a.owner_code,nom,prenom,adresse,telephone,code_famille,cotisation,janvier,février,mars,avril,mai,juin,juillet,août,septembre,octobre,novembre,decembre FROM owners a , owners_payment ad WHERE a.owner_code = ad.owner_code and nom =? and prenom = ?'); 
          $request->execute(array($nom,$prenom));
             $data = $request->fetch(PDO::FETCH_ASSOC) ;
         }
                foreach( $data as $key => $value){
                    if( ($key == "janvier" || $key == "février" || $key == "mars"|| $key ==  "avril"|| $key == "mai"|| $key == "juin"|| $key == "juillet" || $key == "août"|| $key == "septembre"|| $key == "octobre"|| $key == "novembre"|| $key == "decembre" || $key == "cotisation")  && $value == "non payé"){
                     ?>
                     <option value="<?php echo $key; ?>"  style="color :green"> <?php echo $key; ?>  </option>
                    <?php 
                    }
                    else if( ($key == "janvier" || $key == "février" || $key == "mars"|| $key == "avril"|| $key == "mai"|| $key == "juin"|| $key == "juillet"|| $key == "août"|| $key == "septembre"|| $key == "octobre"|| $key == "novembre"|| $key == "decembre" || $key == "cotisation") && $value == "payé"){
                      ?>
                      <option value="<?php echo $key; ?>" disabled style="color :green"> <?php echo $key; ?>  </option>
                     <?php
                     }
                  
                    } 
         ?>
       </select>

       <label for="description"><b>RÉDUCTION</b></label>
       <input type="text" name="reduction" value="<?php  echo $reduction."%" ?>" id="reduction" readonly> 
       <label for="description"><b>MONTANT À PAYER</label>
       <input type="text" name="montant"  value="<?php  echo $montant."DH" ?>" id="montant" readonly> 
       <input type="submit" name="payer" id="login" value="PAYER" style="font-size: 20px;color:black; "/>
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
<script>
 $(document).ready(()=>{
  
   if($("#mois").val() == "vide"){
    $("#montant").val("");
    $("#montant").attr("readonly");
    }
   
  $("#type").change(()=>{
      if($("#type").val() == "chèque" ){
          $(".check").fadeIn("500");
      }
      else{
        $(".check").fadeOut("500");
      }

  });
  $("#mois").change(()=>{
    if( $("#mois").val() == "vide"){
       $("#montant").val("");
    }

    else if( $("#mois").val() == "cotisation"){
       $("#montant").val("1500DH");
       $("#reduction").val("0%");
    }
       else{
        $("#montant").val(<?php  echo $montant ?>);
        $("#montant").val($("#montant").val()+"DH");
        $("#reduction").val(<?php  echo $reduction ?>);
        $("#reduction").val($("#reduction").val()+"%");
       
       }
    

  });


 });

</script>
<?php
 $_SESSION['code']= $code;
 $_SESSION['nom']= $nom;
 $_SESSION['prenom']= $prenom;
 $_SESSION['tel']= $tel;
 $_SESSION['adresse']= $adresse;

 $_SESSION['type']= $_POST['type'];
$_SESSION['mois']= $_POST['mois'];
 $_SESSION['num_check']= $_POST['check'];
 $_SESSION['reduction']= $_POST['reduction'];
 $_SESSION['montant']= $_POST['montant'];







?>
</body>
</html>

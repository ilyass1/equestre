<?php
include_once('db-config.php');
 session_start();
 if(empty($_SESSION['email'])){
   
    header("location:login.php");

 }
 if(isset($_GET['quit'])){
  header("Location:action.php");
  
}
$connect = connection();

?>

<!DOCTYPE html>
<html>
<head>
<title>Evenements</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<style type="text/css">
    body {font-family: Arial, Helvetica, sans-serif; 
   background-color: #304352; /* fallback for old browsers */
  background-color: -webkit-linear-gradient(to right, #304352, #d7d2cc); /* Chrome 10-25, Safari 5.1-6 */
  background-color: linear-gradient(to right, #304352, #d7d2cc); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */ }
* {box-sizing: border-box;}

input[type=text], input[type=password],textarea,input[type=date],input[type=time],input[type=file]{
  width: 100%;
  padding: 15px;
  font-size: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}
#logo{
  position: absolute;
  top: 0%;
  left: 0%;
  width: 100px;
  height: 100px;
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
  z-index: 1; 
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
  width: 80%; /* Could be more or less, depending on screen size */
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

if($_SERVER["REQUEST_METHOD"] == "POST"  &&  isset($_POST['ajouter']) && isset($_POST['titre']) && isset($_POST['description'])&& isset($_POST['date']) && isset($_POST['temps']) && isset($_FILES['monfichier']) && $_FILES['monfichier']['error'] == 0){
  
       
        if ($_FILES['monfichier']['size'] <= 10000000)
        {
         
         
                $infosfichier = pathinfo($_FILES['monfichier']['name']);
                $extension_upload = $infosfichier['extension'];
                $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
                if (in_array($extension_upload, $extensions_autorisees))
                {
                        
                        
                        try { 
                          $image_safe = "asdfgh/uploads/".htmlspecialchars(stripslashes(basename($_FILES['monfichier']['name'])));
                          $title_safe =htmlspecialchars(stripslashes($_POST['titre']));
                          $description_safe =htmlspecialchars(stripslashes($_POST['description'])); 
                          $date_safe =htmlspecialchars(stripslashes($_POST['date']));
                          $time_safe =htmlspecialchars(stripslashes($_POST['temps']));
                          $date = date('Y-m-d');
                          $request = $connect->prepare("insert into events(title,description,event_date,temps,publication_date,event_image)  values (?,?,?,?,?,?)"); 
                           $request->execute(array($title_safe,$description_safe,$date_safe,$time_safe,$date,$image_safe));
                           $message="L'ÉVÉNEMENT A ÉTÉ BIEN AJOUTER" ;
                           $src="../images/smile.png";
                           echo ('<script>  
                           $(document).ready(function(){
                           $("#dialog").css("display","block");
                           
                         });
                         </script>');
                         move_uploaded_file($_FILES['monfichier']['tmp_name'], 'uploads/'. basename($_FILES['monfichier']['name']));

                              }

                        catch (Exception $e) {
                          $message="L'ÉVÉNEMENT N'A PAS PU ÊTRE AJOUTER" ;
                          $src="../images/sad.png";
                          echo ('<script>  
                          $(document).ready(function(){
                          $("#dialog").css("display","block");
                          
                        });
                        </script>');
                         
                          } 
                        
                }
        }

 
    

}
if($_SERVER["REQUEST_METHOD"] == "POST"  && (empty($_POST['titre']) || empty($_POST['description']) || empty($_POST['date']) || empty($_POST['temps']))){
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
  <form  action= "<?php $_SERVER['PHP_SELF'] ?>"  method= "POST"  enctype="multipart/form-data">
    <div class="container modal-content">
      <div class="row" style="text-align: center;">
        <h1>AJOUTER UN ÉVÉNEMENT</h1> 
      </div>
      <hr>
    
       <label for="nom"><b>TITRE</b></label>
       <input type="text" placeholder="TITRE"  name="titre" id="titre"  >
       <label for="prn"><b>DESCRIPTION</b></label>
      <textarea placeholder="DESCRIPTION DE L'ÉVÉNEMENT" name="description" row="5"></textarea>
       <label for="age"><b>DATE DE L'ÉVÉNEMENT</b></label>
       <input type="date" name="date" id="date">
       <label for="tel"><b>HEURE DE L'ÉVÉNEMENT</b></label>
       <input type="time"  name="temps">
       <label for="tel"><b>IMAGE DE L'ÉVÉNEMENT</b></label>
       <input type="file" name="monfichier"/>
       <input type="submit" name="ajouter" id="login" value="AJOUTER" style="font-size: 20px;color:black; "/>
       </form>
     
       <form  action= "<?php $_SERVER['PHP_SELF'] ?>"  method= "get">
       <input type="submit" name="quit" id="login" value="QUITTER" style="font-size: 20px;color:black; "/>
       </form>
      </div>
      
</div>
<div id="dialog" title="Basic dialog">      
    <p style="margin-top:360px;font-size:25px"> <?php echo $message; ?> <span><img src="<?php echo $src;?>" alt="sad" style="width:100px;height: 100px;"> </span></p> 
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

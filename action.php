
<?php
session_start();
if(empty($_SESSION['email'])){
     session_destroy();
     header("location:login.php");
}
if(isset($_GET['close'])){
   session_destroy();
   header("location:login.php");

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>ACTION</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style> 
body {font-family: Arial, Helvetica, sans-serif;
  background: #0F2027;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #2C5364, #203A43, #0F2027);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #2C5364, #203A43, #0F2027); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
}
#logo{
  position: absolute;
  top: 0%;
  left: 0%;
  width: 100px;
  height: 100px;
}
* {box-sizing: border-box;}


.container {
  padding: 16px;
  width: 70%;
}
.glyphicon-remove,button{
  position: absolute;
  top:0%;
  right: 0%;
}

.modal-content {
  background: #304352; /* fallback for old browsers */
  background: -webkit-linear-gradient(to right, #304352, #d7d2cc); /* Chrome 10-25, Safari 5.1-6 */
  background: linear-gradient(to right, #304352, #d7d2cc); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
  margin: 1% 0% 15% 3%; /* 5% from the top, 15% from the bottom and centered */
  height: 200px;
  
  
}
.row{
    margin: 7% 0% 0% 15%;
}
b{
    font-size: 30px;
    color: white;
    text-decoration: none;
}
@media screen and (max-width: 500px) {
    p{
      font-size: 1em;
    }
  }
  </style>
</head>
<body>
  
   
         <div class="row">
             <div class="col-sm-6 col-md-6" >
            
                    <div class="container modal-content text-center">
                 
                    <a href="add_event.php" target="_self">  <p> <b> AJOUTER UN ÉVÉNEMENT</b></p> </a>
                   
                 </div>
             
            </div>
            <div class="col-sm-6 col-md-6">
            <div class="container modal-content text-center">
                
                   
            <a href="gerer_adherents.php" > <p> <b> GÉRER LES <br> ADHÉRENTS</b></p></a>
                </div>
           </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-6">
               <div class="container modal-content text-center">
                
               <a href="adherents_proprietaire.php"> <p> <b> CONSULTER LA LISTE DES ADHÉRENTS  </b></p></a>
                  
                </div>
           </div>
           <div class="col-sm-6 col-md-6">
              <div class="container modal-content text-center">
              <a href="pay_add_pro.php" > <p> <b> GÉRER LA FACTURATION</b></p></a>
               </div>
          </div>
       </div>
      <div class="row">
      <div class="col-sm-12 col-md-12 text-center">
               <div class="container modal-content text-center">
                
               <a href="../index.php" target="_blank" > <p> <b> VISITER LE SITE WEB </b></p></a>
                  
                </div>
           </div>
           <div>
        <img src="../images/logo.png" alt="" id="logo">
  </div>

       </div>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="GET">
        <button name="close" > <span class="glyphicon glyphicon-remove" style="font-size: 50px;background-color:rgb(212,207,202)"></span></button>
      </form>
  
</body>
</html>

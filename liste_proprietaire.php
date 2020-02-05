<?php
include_once('db-config.php');
try {
    session_start();
 if(empty($_SESSION['email'])){
   
    header("location:login.php");

 }
 $connect = connection();
      $request = $connect->prepare('SELECT * FROM owners'); 
      $request->execute();
}
    catch (Exception $e) {
      $e->getMessage();
      } 
  
  if($_SERVER['REQUEST_METHOD'] == "GET" && !empty($_GET['search'])  && isset($_GET['search']) ){
   $request=$connect->prepare('SELECT * FROM owners where (nom = ? and prenom = ?) or (nom =? and prenom =?) or nom = ? or prenom = ?' ); 
   $tab = explode(" ",$_GET['search']);
   $request->execute(array($tab[0],$tab[1],$tab[1],$tab[0],$tab[0],$tab[0]));
   }
   if( isset($_GET['reset']) && (empty($_GET['search_btn']) || !empty($_GET['search']))){
    $request = $connect->prepare('SELECT * FROM owners'); 
    $request->execute();
  }

  if(isset($_GET['close'])){
    header("location:adherents_proprietaire.php");
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Liste des adhérents</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  

 <style type="text/css">
    body {font-family: Arial, Helvetica, sans-serif;   background-color: #304352; /* fallback for old browsers */
  background-color: -webkit-linear-gradient(to right, #304352, #d7d2cc); /* Chrome 10-25, Safari 5.1-6 */
  background-color: linear-gradient(to right, #304352, #d7d2cc); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */ }
* {box-sizing: border-box;}
.container {
  padding: 16px;
}
#logo{
  position: absolute;
  top: 0%;
  left: 0%;
  width: 100px;
  height: 100px;
}
.glyphicon-remove,#close{
  position: absolute;
  top:0%;
  right: 0%;
}
.modal {
  display:block; 
  position: fixed; 
  z-index: 1; 
  left: 0;
  top: 0;
  align-items: center;
  width: 100%; 
  height: 100%; 
  overflow: auto; 
  padding-top: 50px;
  background: #304352; /* fallback for old browsers */
  background: -webkit-linear-gradient(to right, #304352, #d7d2cc); /* Chrome 10-25, Safari 5.1-6 */
  background: linear-gradient(to right, #304352, #d7d2cc); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

}


table{
 
  margin: 2% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  width: 90%; 
  z-index: 9999;
  background-color: black;
  
  /* Could be more or less, depending on screen size */
}
th{
    text-align: center;
    color: grey;
  
}
tr{
    text-align: center;
    color:wheat;

}
#title{
  color: white;
}
.navbar{
  text-align: center;
}

</style>
</head>
<body>


<div id="id01" class="modal">
<nav class="navbar text-center">
  <div class="container-fluid" >
     <form class="navbar-form " action="<?php $_SERVER['PHP_SELF'] ?>" method="GET">
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Search" name="search" style="width: 400px;">
      </div>
      <button type="submit" class="btn btn-success " name="search_btn">CHERCHER</button>
      <button type="submit" class="btn  btn-danger" name="reset">RÉINITIALISER</button>
    </form>
  </div>
</nav>
  
    <div class="container text-center">
    
        <h1 id="title" >Liste des propriétaires</h1> 
      

    <table class="table ">   
    <thead>
      <tr>
       <th>CODE</th>
        <th>NOM</th>
        <th>PRENOM</th>
        <th>DATE DE NAISSANCE</th>
        <th>ADRESSE</th>
        <th>TELEPHONE</th>
        <th>DATE D'INSCRIPTION</th>
        <th>CODE FAMILLE</th>
      </tr>
    </thead>
    <tbody>
        <?php
         while($data=$request->fetch() ){
             ?>
             <tr>
        <td><?php echo $data['owner_code'];?></td>
        <td><?php echo $data['nom'];?></td>
        <td><?php echo $data['prenom'];?></td>
        <td><?php echo $data['date_naissance'];?></td>
        <td><?php echo $data['adresse'];?></td>
        <td><?php echo $data['telephone'];?></td>
        <td><?php echo $data['date_inscription'];?></td>
        <td><?php echo $data['code_famille'];?></td>
         </tr>

     <?php
         }

        ?>
      
      
       
    </tbody>
  </table>
  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="GET">
        <button name="close"  id="close"> <span class="glyphicon glyphicon-remove" style="font-size: 50px;background-color:rgb(212,207,202)"></span></button>
      </form>
      
      </div>
      
    
    </div>

      





    
</body>
</html>
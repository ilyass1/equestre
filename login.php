<?php
$error="";
include_once('db-config.php');
$connect = connection();
 
if($_SERVER["REQUEST_METHOD"] == "POST"  && isset($_POST['email']) && isset($_POST['psw'])){
  try {
   
    $error="";
    $request = $connect->prepare('SELECT user,pass FROM user WHERE user = ?'); 
    $request->execute(array(htmlspecialchars($_POST['email'])));
    $data = $request->fetch();
   if( $data == null ){ 
         $error="email ou mot de pass incorrectes";} 
  else if ($data['user'] !=  htmlspecialchars($_POST['email']) || !password_verify(htmlspecialchars($_POST['psw']),$data['pass'])) {
               $error="email ou mot de pass incorrectes";
}
  else {
    session_start(); 
    $_SESSION['email'] = $data['user'] ;
    header("location:action.php"); 
}
  }
  catch (Exception $e) {
    $e->getMessage();
    } 
    
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
 
  <style type="text/css">
    body {font-family: Arial, Helvetica, sans-serif; 
    
      background: #0F2027;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #2C5364, #203A43, #0F2027);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #2C5364, #203A43, #0F2027); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    }
* {box-sizing: border-box;}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  font-size: 16px;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

/* Add a background color when the inputs get focus */
input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}


button {
  
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
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
/* The Modal (background) */
.modal {
  display:block; 
  position: fixed; 
  z-index: 9999; 
  left: 0;
  top: 0;
  width: 100%; 
  height: 100%; 
  overflow: auto; 
  padding-top: 50px;
  
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  /*border: 1px solid #888;*/
  width: 80%; /* Could be more or less, depending on screen size */
}

/* Style the horizontal ruler */
hr {
  border: 3px solid #f1f1f1;
  margin-bottom: 25px;
}


  </style>

</head>
<body>

<h2></h2>


  <div id="id01" class="modal">
  <form class="modal-content" action= "<?php $_SERVER['PHP_SELF'] ?>"  method= "POST">
    <div class="container">
      <div class="row" style="text-align: center;">
     <span><img src="../images/admin.png" style="width:100px;"></span>
      </div>
      
      <hr>
       <label for="email"><b>EMAIL</b></label>
      <input type="text" placeholder="Enter votre email "  name="email" required>
      <label for="psw"><b>MOT DE PASSE</b></label>
      <input type="password" placeholder="Entrer votre mot de passe" name="psw" required><br>
      <input type="submit" name="login" id="login" value="se connecter" style="font-size: 20px;color:black; ">
       <p style="text-align: center;color:red">  <?php   echo $error;     ?> </p>
      </div>

      </form>

</div>
<div>
        <img src="images/logo.png" alt="" id="logo">
  </div>
</body>
</html>

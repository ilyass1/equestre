<?php

session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <title>FACTURE</title>
    <style>
       
    #facture{
     margin-top: 200px;
    }
    td{
        text-align:center;
        width: 300px;
    }
    th{
        font-size: 20px;
    }
    td,tr{
       
        line-height: 50px;
    }
    #signature{
        margin-top: 300px;
    }
   
    </style>
</head>
<body>
    <div class="container" style="margin-top: 3%">
        <div class="row">
           <div class="col-sm-3 text-left">
               <h1><img src="../images/logo.png" width="150" height="150"></h1>
           </div>
           <div class="col-sm-7 text-left">
               <h1> CLUB ÉQUESTRE MIMOSA</h1>
           </div>
           <div class="col-sm-2 text-right" style="font-size:1.5vw">
              <?php echo date("d-m-yy"); ?>
           </div>
        </div>
        <div class="row">
           <div class="col-sm-12 text-center">
              <h1>FACTURE</h1>
           </div>
        </div>
       
        <div class="row" id="facture">
           <div class="col-sm-6 " id="info">
             <table>
             <tr>
                    <th>CODE :</th>                                 
                    <td><?php echo $_SESSION['code'] ?></td>
                </tr>
                <tr>
                    <th>NOM :</th>
                    <td><?php  echo $_SESSION['nom']?></td>
                </tr>
                <tr>
                    <th>PRÉNOM:</th>
                    <td> <?php echo $_SESSION['prenom']?> </td>
                </tr>
                <tr>
                    <th>TÉLÉPHONE:</th>
                    <td> <?php echo $_SESSION['tel']?></td>
                </tr>
                <tr>
                    <th>ADRESSE:</th>
                    <td> <?php  echo  $_SESSION['adresse'] ?></td>
                </tr>


             </table>
           </div>
           <div class="col-sm-6 " id="pay">
           <table >
             <tr>
                    <th> PAIEMENT :</th>
                    <td> <?php echo  $_SESSION['type']?></td>
                </tr>
                <tr>
                    <th>CHÉQUE :</th>
                    <td> <?php echo $_SESSION['num_check'] ?></td>
                </tr>
                <tr>
                    <th>MOIS:</th>
                    <td><?php echo $_SESSION['mois'] ?></td>
                </tr>
                <tr>
                    <th>RÉDUCTION:</th>
                    <td><?php echo $_SESSION['reduction']?></td>
                </tr>
                <tr>
                    <th>MONTANT:</th>
                    <td><?php echo $_SESSION['montant']?></td>
                </tr>


             </table>
             
           </div>
        </div>
        
        <div class="row" id="signature">
        <div class="col-sm-6  text-left">
         <h4>signature responsable :</h4>
          </div>
          <div class="col-sm-6  text-center ">
         <h4>signature client:</h4>
          </div>
            
        </div>

</div>
<script>
   $(document).ready(()=>{
   window.print();


   });
</script>
    
</body>
</html>
<?php

include_once('asdfgh/db-config.php');
$connect = connection();


if($_SERVER["REQUEST_METHOD"] == "POST"  && isset($_POST['email']) && isset($_POST['name']) && $_POST['comments']){
  try {
    $request = $connect->prepare('INSERT INTO comments  VALUES (?,?,?)'); 
    $request->execute(array(htmlspecialchars(stripslashes($_POST['name'])),htmlspecialchars(stripslashes( $_POST['email'])),htmlspecialchars(stripslashes($_POST['comments']))));
   
  }
  catch (Exception $e) {
    $e->getMessage();
    } 
    
}

try{
 $tab=array();
 
 $request = $connect->prepare('SELECT * from events ORDER BY id_event desc limit 0,5'); 

  $request->execute();
   while( $data=$request->fetch()){
     array_push($tab,$data['event_image']);
   }
  
 
}
 catch (Exception $e) {
  $e->getMessage();
  } 





?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>MIMOSA ÉSQUERTE</title>
  <meta charset="utf-8">
  <meta name="description" content="CLUB ÉQUESTRE MIMOSA">
  <meta name="keywords" content="ÉQUITATION,MOMISA,CLUB,ÉQUESTRE,KENITRA,MAROC,ÉVÉNEMENT">
  <meta name="author" content="ILYASS JMYI">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="style2.css">
  <script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
  <link rel="stylesheet" href="style3.css">
  
  <script>
$(document).ready(function(){
  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {
   
    if (this.hash !== "") {
      event.preventDefault();
      var hash = this.hash;
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 900, function(){
        window.location.hash = hash;
      });
    } 
  });
});
 
  
  $(window).scroll(function() {
   

    if (document.body.scrollTop > 750 || document.documentElement.scrollTop > 750){
        $(".navbar").css({"background-color":"salmon","opacity":"1"});
        $(".logo").css({"height":"50","width":"50"});
        
    }
    else{
      $(".navbar").css({"background-color":"","opacity":"1"});
      $(".logo").css({"height":"70","width":"70"});
    
    }

    $(".slideanim").each(function(){
      var pos = $(this).offset().top;

      var winTop = $(window).scrollTop();
        if (pos < winTop + 600) {
          $(this).addClass("slide");
        }
    });
  });

</script>
<script>
$(document).ready(function(){
    $('.customer-logos').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        arrows: false,
        dots: false,
        pauseOnHover: false,
        responsive: [{
            breakpoint: 768,
            settings: {
                slidesToShow: 1
            }
        }, {
            breakpoint: 520,
            settings: {
                slidesToShow: 1
            }
        }]
    });
});
</script>
<script>
$(document).ready(function(){ 
var myIndex = 0;
carousel();
function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }  
  myIndex++;
  if (myIndex > x.length) {myIndex = 1}    
  x[myIndex-1].style.display = "block";  
  setTimeout(carousel, 4000); 
}
   
})
</script>
<script>
$(document).ready(function() {
   
    setTimeout(() => {
      $(".se-pre-con").fadeOut();
    },1000);
    $("#faris_hidden").click(function(){
      $("#faris").slideToggle("slow");
   });

   $('#contract,#planning').click(function(event){
      event.preventDefault();

   });

   });
  
  </script>
</head>

<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60" >
<div class="se-pre-con">
  
</div>
<div class="container-fluid" id="diaporama" >
<img src="images/image1_slider.jpg" class="mySlides w3-animate-fading" >   
<img src="images/image2_slider.jpg" class="mySlides w3-animate-fading" >   
<nav class="navbar  navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#myPage"><img src="images/logo.png" style="height:70px;width:70px;left:3%;top:0%;position:absolute " class="logo"></a><a class="navbar-brand cem" href="#myPage" style="left:9%;top:0%;position:absolute;font-size:20px;"><span style="color:green">Club</span><span style="color:red">Équestre</span><span style="color:green">Mimosa</span></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right" > 
        <li><a href="#About">Á PROPOS</a></li>
        <li><a href="#events">ÉVÉNEMENTS</a></li>
        <li><a href="#documents">DOCUMENTS UTILS</a></li>
        <li><a href="#tariffs">TARIFS</a></li>
        <li><a href="#contact">CONTACT</a></li>
      </ul>
    </div>
  </div>
</nav>
</div> 
<!-- Container (About Section) -->
<div id="About" class="container-fluid slideanim">
  <div class="row text-center">
    <div style="margin-top: 20px;">
   <h1> NOTRE CLUB </h1>
    <div class="col-sm-6">
      <h2>CLUB ÉQUESTRE MIMOSA</h2><br>
      <h4 style="line-height: 40px;" class="text-center">Située au cœur de la ville de Kénitra, le Club Equestre Mimosas vous propose différentes prestations dans le but de vous faire découvrir et aimer l’équitation. <br>
Vous y serez encadrés par une équipe de moniteurs qualifiés et expérimentés, dans une ambiance conviviale et une structure en plein rénovation. <br>
Du débutant au cavalier confirmé, tout le monde se retrouve au sein de notre école d’équitation pour partager son amour de l’équitation et profiter des joies de ce « sport nature » par excellence. <br>
Le Club Equestre Mimosas s’est donné pour objectif de faire partager notre amour envers la nature à tous et surtout aux générations montantes grâce aux activités autour du cheval
</h4>
   </div>
    </div>
    <div class="col-sm-6 text-center">
      <img src="images/logo.png" style="width: 440px;height:440px; margin-top:20px;">
     </div>
  </div>
</div>
<div id="events" class="container-fluid slideanim ">

<h1 class="text-center">NOS ÉVÉNEMENTS</h1>
<?php
   $request->execute() ;
   $data=$request->fetch();
   if(empty($data['title'])){?>
   <div id="myCarousel" class="carousel slide" data-ride="carousel">
   <ol class="carousel-indicators">
   <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
   </ol>
   <div class="carousel-inner">
   <div class="item active text-center">

<h4><span style="font-size: 30px; text-transform: uppercase">   Aucun événement pour le moment   </span></h4>
</div></div>
<a class="left carousel-control" href="#myCarousel" data-slide="prev" style="background: white">
      <span class="glyphicon glyphicon-chevron-left" ></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next" style="background: white">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>


  <?php } else{
?>
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <?php 
      $counte =0;
      $request->execute();   
          while($data=$request->fetch()){ ?>
           <li data-target="#myCarousel" data-slide-to="<?php echo $counte;?>" class="active"></li>
            <?php
            $counte++;
             }
            ?>
    </ol>
    <?php
    $i = 1;
         if($request->execute()){
        while($data=$request->fetch()){ ?>
    <div class="carousel-inner">
          
          <div class="item active" style="color:white;justify-items:center;">
        <img src="<?php echo $tab[0]; ?>" style="width:100%;height:500px;">
        <div class="carousel-caption">
          <h3 style="font-size: 30px;"><?php echo $data['title'] ;?></h3>
          <p style="font-size:18px; ">" <?php echo $data['description'] ;?>"</p>
          <p style="font-size:18px; ">DATE : <?php echo $data['event_date'] ;?> HEURE : <?php echo $data['temps'] ;?></p>
          <p style="font-size:18px; ">Publier le : <?php echo $data['publication_date'] ;?></p>
        </div>
            </div>
           <?php
           break;
             }
             try{
              $request = $connect->prepare('SELECT * from events ORDER BY id_event desc limit 1,5'); 
              
             }
              catch (Exception $e) {
               $e->getMessage();
               } 
               $request->execute();
         } 
         while($data=$request->fetch()){
          ?>
          <div class="item" style="color:white;justify-items:center;">
        <img src="<?php echo $tab[$i];  ?>"  style="width:100%;height:500px;">
        <div class="carousel-caption">
          <h3 style="font-size: 30px;"><?php echo $data['title'] ;?></h3>
          <p style="font-size:18px; ">" <?php echo $data['description'] ;?>"</p>
          <p style="font-size:18px; ">DATE : <?php echo $data['event_date'] ;?> HEURE : <?php echo $data['temps'] ;?></p>
          <p style="font-size:18px; ">Publier le : <?php echo $data['publication_date'] ;?></p>
        </div>
            </div>
        <?php $i++;
      }?>
      

   </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev" style="background: white">
      <span class="glyphicon glyphicon-chevron-left" ></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next" style="background: white">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a> 
    </div><?php }?>
</div>
<br><br>

<div id="documents" class="container-fluid text-center">
  <h1>DOCUMENTS UTILES</h1>
  <br>
  <div class="row slideanim">
    <a href="docs/planning.pdf" id="planning"> <div class="col-sm-4">
      <span><img src="images/planning.png"></span>
      <h4>PLANNING</h4>
     
    </div></a>
    <a href="docs/réglement interieur.pdf" target="_blank"><div class="col-sm-4">
      <span><img src="images/policy.png"></span>
      <h4>RÉGLEMENT INTÉRIEUR</h4>
     
    </div></a>
    <a href="docs/contrat.pdf" id="contract"> <div class="col-sm-4">
      <span><img src="images/contract.png"></span>
      <h4>CONTRAT DE PENSION</h4>
     
    </div></a>
  </div>
  <br><br>
  <a>
  <div class="row slideanim" >
    <div class="col-sm-6" id="faris_hidden">
      <span ><img src="images/manuel.png"></span>
      <h4>MANUEL OFFICIEL DE PRÉPARATION A L'EXAMEN FÉDÉRALE</h4>
    </div></a>
<a href="docs/Fiche inscription  2020.pdf" target="_blank">
    <div class="col-sm-6">  
      <span ><img src="images/inscription.png"></span>
      <h4 style="color:#303030;">FICHE D'INSCRIPTION</h4>
      </div>
    </a>
  </div>
<br>
<!-- partners hidden div -->
<div class="container-fluid" id="faris" >
<div class="row">
<a href="http://www.frmse.ma/pdf/manuels/faris1.pdf" target="_blank"><div class="col-sm-3">
      <span><img src="images/frmse.jpg" width="250" height="150" style="background: grey"></span>
      <h4>FARIS 1</h4>
     
    </div></a>
    <a href="http://www.frmse.ma/pdf/manuels/faris2.pdf" target="_blank"><div class="col-sm-3">
      <span><img src="images/frmse.jpg" width="250" height="150"></span>
      <h4>FARIS 2</h4>
     
    </div></a>
  <a href="http://www.frmse.ma/pdf/manuels/faris3.pdf" target="_blank"><div class="col-sm-3">
      <span><img src="images/frmse.jpg" width="250" height="150"></span>
      <h4>FARIS 3</h4>
     
    </div></a>
    <a href="http://www.frmse.ma/pdf/manuels/faris4.pdf" target="_blank"><div class="col-sm-3">
      <span><img src="images/frmse.jpg" width="250" height="150"></span>
      <h4>FARIS 4</h4>
     
    </div></a>
</div>

</div>

<!-- Container (Pricing Section) -->
<div id="tariffs" class="container-fluid" >
  <div class="text-center">
    <h2>TARIFS</h2>
    <h4>Choisissez le plan de paiement qui vous convient</h4>
  </div>
  <div class="row slideanim">
    <div class="col-sm-6 col-xs-12">
      <div class="panel panel-default text-center">
        <div class="panel-heading"style="background-color: salmon">
          <h2>PROPRIÉTAIRE DE CHEVAL </h2>
        </div>
        <div class="panel-body">
         <dl>
           <dt> - COTISATION ANNUELLE : 1500 DH</dt>
           <dd><b>IMPORTANT</b> : cette cotisation annuelle concerne un seul cavalier .</dd>
           <dt> - MENSUALITÉ :</dt>
           <dd> 1 CHEVAL : 600 DH</dd>
           <dd> 2 CHEVAUX : 1000 DH</dd>
           <dd> PLUS DE DEUX CHEVAUX : 400 DH PAR CHEVAL</dd>
          </dl>
        </div>
        <div class="panel-footer">
          <button class="btn btn-lg" style="background-color: salmon"><a href="docs/tarif_proprietaire.pdf" target="_blank">EN SAVOIR PLUS</a></button>
        </div>
      </div>      
    </div>     
    <div class="col-sm-6 col-xs-12">
      <div class="panel panel-default text-center">
        <div class="panel-heading" style="background-color: salmon">
          <h2>ADHÉRENT</h2>
        </div>
        <div class="panel-body">
        <dl>
           <dt> - COTISATION ANNUELLE : 1500 DH</dt>
           <dt> - MENSUALITÉ : 400 DH</dt>
           <dt> - PACK FAMILLE : </dt>
           <dd> UN RÉDUCTION DE 10% EST APPLIQUÉE</dd>
         </dl>
        </div>
        <div class="panel-footer" style="margin-top: 44px;">
          <button class="btn btn-lg" style="background-color: salmon"><a href="docs/tarif_adherent.pdf" target="_blank">EN SAVOIR PLUS</a></button>
        </div>
      </div>      
    </div>          
  </div>
</div>
<!-- partners-->

<div class="container">
  <h2>NOS PARTENAIRES</h2>
   <section class="customer-logos slider">
      <div class="slide"><img src="images/partner1.jpg" width="200" height="400"></div>
      <div class="slide"><img src="images/partner2.jpg" width="200" height="400"> </div>
      
   </section>
   
</div>


<!-- Container (Contact Section) -->
<div id="contact" class="container-fluid "> 
  <h2 class="text-center">CONTACT</h2>
  <div class="row text-center">
    <div class="col-sm-3 slideanim" style="font-style:bold;font-size:16px;margin-top:20%; ">
      <p><span><img src="images/adresse.png" style="width: 20px;"></span>   &nbsp; &nbsp;    KENITRA, MA</p>
      <p><span><img src="images/phone.png" style="width: 20px;"> </span>        &nbsp; &nbsp;    +212 53489343</p>
      <p><span><img src="images/email.png" style="width: 20px;"></span>     &nbsp; &nbsp;   dslkfndsngidg.com</p>
    </div>
    <div class="col-sm-9 slideanim" id="map" style="height:500px;margin-top:30px">
    </div>
  
</div>



<div class="col-sm-12 slideanim container-fluid">
          <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
      <div class="row" >
        
        <div class="col-sm-6 form-group">
          <input class="form-control" id="name" name="name" placeholder="Nom" type="text" required>
        </div>
        <div class="col-sm-6 form-group">
          <input class="form-control" id="email" name="email" placeholder="Email" type="email" required>
        </div>
      </div>
      <textarea class="form-control" id="comments" name="comments" placeholder="Commentaire" rows="5"></textarea><br>
      <div class="row text-center">
        <div class="col-sm-12 form-group"></div>
          <button class="btn text-center" type="submit" style="background: salmon">Envoyer</button>
        </div>
          </form>

         </div>
    </div>

    <footer>
  <div class="row" >
    <div class="col-sm-12">
  <a href="#myPage" title="To Top">
  <span ><img src="images/horse.png" alt=""> </span>
  </a>
  <br><br><br>
  <p> Made By  <a href="mailto:ilyassilyass007@gmail.com" title="email us"  target="_blank">ILYASS JMYI &amp; ALI BASSIM</a></p>
  </div>
  </div>
    </footer>

<script>
            
            function initMap() {
              
                var uluru = {
                    lat: 	34.249999,
                    lng: -6.583331
                };
                
                var map = new google.maps.Map(
                    document.getElementById('map'), {
                        zoom: 9,
                        center: uluru
                    });
               
                var marker = new google.maps.Marker({
                    position: uluru,
                    map: map
                });
                google.maps.event.addListener(map, 'click', function(event) {
                    placeMarker(event.latLng);
                });
            }
        </script>
        <script async defer
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDcIWMsAYtYdBw1k-hwcN71OpI041xmuIY&callback=initMap">
        </script>
</body>
</html> 
                                   <!-- this web site is made by ILYASS JMYI & ALI BASSIM -->
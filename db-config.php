<?php 
function connection(){
$DB_SERVER ='localhost';
$DB_USERNAME ='root' ;
$DB_PASSWORD = 'ilyass96';
$DB_NAME =  'equestre';
$connexion=null;
try{
    $connexion = new PDO("mysql:host=$DB_SERVER;dbname=$DB_NAME",$DB_USERNAME,$DB_PASSWORD,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    
}
catch (Exception $e ){
    $e->getMessage();
}
return $connexion;

}

?>
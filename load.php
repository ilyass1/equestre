<?php

include_once('asdfgh/db-config.php');
$connect = connection();
try{
$data = array();

$query = "SELECT * FROM events ORDER BY id_event";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach($result as $row)
{

 $data[] = array(
  'id'    => $row["id_event"],
  'title' => "HEURE : " .$row["temps"]."\n".$row["title"],
  'date'  => $row["event_date"],
  'end'   =>$row["event_date"],
  'description'=> "this is a description"
 );
}

echo  json_encode($data);
}
catch(Exception $e){}
?>
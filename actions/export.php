<?php require_once('../db/Database.php');
require_once('../models/User.php');
//get records from database
$database = new Database();
$db = $database->connect();
$User = new User($db);

$stmt = $User->getAllUsers();

$columnHeader ='';
$columnHeader = "ID"."\t"."Username"."\t"."localisation"."\t"."Interactions"."\t"."Mobile"."\t"."Avantages"."\t"."Cartes"."\t"."Ecoute"."\t"."Phone_Number"."\t";
                


$setData='';

while($rec =$stmt->FETCH(PDO::FETCH_ASSOC))
{
  $rowData = '';
  foreach($rec as $value)
  {
    $value = '"' . $value . '"' . "\t";
    $rowData .= $value;
  }
  $setData .= trim($rowData)."\n";
}


header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Book record users.xls");
header("Pragma: no-cache");
header("Expires: 0");

echo ucwords($columnHeader)."\n".$setData."\n";

?>
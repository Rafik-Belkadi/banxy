<?php require_once('../db/Database.php');
require_once('../models/Form.php');
//get records from database
$database = new Database();
$db = $database->connect();
$Form = new Form($db);

$stmt = $Form->getAllForms();

$columnHeader ='';
$columnHeader = "ID"."\t"."Tablette N°"."\t"."Email"."\t"."Prénom"."\t"."Nom"."\t"."Civilité"."\t"."Date Création"."\t"."Mobile"."\t";
                


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
header("Content-Disposition: attachment; filename=Bdd.xls");
header("Pragma: no-cache");
header("Expires: 0");

echo ucwords($columnHeader)."\n".$setData."\n";

?>
<?php

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../db/Database.php';
include_once '../../models/Form.php';

//  Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//  Instantiate form
$form = new Form($db);

//  Get Raw Posted Data
$data = json_decode(file_get_contents("php://input"));

$form->user_id  = $data->user_id;
$form->email    = $data->email;
$form->first_name   = $data->first_name;
$form->last_name    = $data->last_name;
$form->civilite = $data->civilite;
$form->mobile = $data->mobile;

//  Create Post
if($form->create())
{
    echo json_encode(
        array('message' => 'Form Created')
    );
}   else {
    echo json_encode(
        array('message' => 'Form Not Created')
    );
}

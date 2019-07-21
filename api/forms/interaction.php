<?php


//  Headers

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../db/Database.php';
include_once '../../models/User.php';

//  Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//  Instantiate form
$form = new User($db);

if ($form->interaction($_GET['user_id'])) {
    echo json_encode(
        array('message' => 'User Updated')
    );
} else {
    echo json_encode(
        array('message' => 'User Not Updated')
    );
}


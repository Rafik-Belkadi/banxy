<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");

require_once('../../models/User.php');
require_once('../../db/Database.php');

$id = $_GET['id'];

$database = new Database();
$db = $database->connect();

$user = new User($db);

$result = $user->getEachInteractionTime($id);

echo json_encode($result);

<?php header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");

require_once('../../models/User.php');
require_once('../../db/Database.php');


$database = new Database();
$db = $database->connect();

$user = new User($db);

$stmt = $user->getMaxInteraction();

if ($stmt->rowCount() > 0) {
    // CREATE POSTS ARRAY
    $row = $stmt->fetch();
        $post_data = [
            'maxed' => $row['maxed']
        ];
        // PUSH POST DATA IN OUR $posts_array ARRAY
    
    //SHOW POST/POSTS IN JSON FORMAT
    echo json_encode($post_data);
} else {
    //IF THER IS NO POST IN OUR DATABASE
    echo json_encode(['message' => 'No post found']);
}
<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");

require_once('../../models/User.php');
require_once('../../db/Database.php');


$database = new Database();
$db = $database->connect();

$user = new User($db);

$stmt = $user->getAllInteractionTime();

if ($stmt->rowCount() > 0) {
    // CREATE POSTS ARRAY
    $interactions_array = [];

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        $post_data = [
            'heure' => $row['hour'],
            'nombre' => $row['num_rows'],
        ];
        // PUSH POST DATA IN OUR $posts_array ARRAY
        array_push($interactions_array, $post_data);
    }
    //SHOW POST/POSTS IN JSON FORMAT
    echo json_encode($interactions_array);
} else {
    //IF THER IS NO POST IN OUR DATABASE
    echo json_encode(['message' => 'No post found']);
}
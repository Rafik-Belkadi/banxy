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

$stmt = $user->getAllUsers();


    // CREATE POSTS ARRAY
    $interactions_array = [];

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        $post_data = [
            'id' => $row['id'],
            'username' => $row['username'],
            'localisation' => $row['localisation'],
            'interacted' => $row['interacted']
        ];
        // PUSH POST DATA IN OUR $posts_array ARRAY
        array_push($interactions_array, $post_data);
    }
    echo json_encode($interactions_array);


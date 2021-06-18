<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
include_once '../../config/Database.php';
include_once '../../models/Post.php';

$database = new Database();
$db = $database->connect();

$post = new Post($db);

$result = $post->read();

echo "Good";
$num = $result->rowCount();

if ($num > 0) {
    $posts_arr = array();
    $posts_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

        array_push($posts_arr['data'], $row);
    }

    print_r($posts_arr);
    echo json_encode($posts_arr);

} else {
    echo json_encode(
        array('message' => 'No Posts Found')
    );
}
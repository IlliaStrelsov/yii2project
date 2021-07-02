<?php

/** @var $token */
/** @var $key */
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods, Authorization, X-Request-With');


ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
include_once '../config/core.php';
include_once '../lib-jwt/src/BeforeValidException.php';
include_once '../lib-jwt/src/ExpiredException.php';
include_once '../lib-jwt/src/SignatureInvalidException.php';
include_once '../lib-jwt/src/JWT.php';
use \Firebase\JWT\JWT;
include_once "../models/User.php";

$user = new User();

$data = json_decode(file_get_contents("php://input"));

$user->email = $data->email;
$user->password = $data->password;


if(!empty($user->email) && !empty($user->password)) {
    if ($user->signin()) {
        $token = array(

            "iss" => $iss,
            "aud" => $aud,
            "iat" => $iat,
            "nbf" => $nbf,
            "data" => array(
                "email" => $user->email,
                "password" => $user->password
            )
        );


        http_response_code(200);

        $jwt = JWT::encode($token,$key);
        echo json_encode(
            array('message' => 'Authorized',
                    'jwt' => $jwt
                )
        );
    } else {
        http_response_code(401);
        echo json_encode(
            array('message' => 'User was not found')
        );
    }
}
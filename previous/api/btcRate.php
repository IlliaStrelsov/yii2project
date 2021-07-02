<?php

header("Access-Control-Allow-Origin: http://localhost/rest-api-authentication-example/");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
include_once 'config/core.php';
include_once 'BtcCurrency.php';
include_once 'lib-jwt/src/BeforeValidException.php';
include_once 'lib-jwt/src/ExpiredException.php';
include_once 'lib-jwt/src/SignatureInvalidException.php';
include_once 'lib-jwt/src/JWT.php';
use \Firebase\JWT\JWT;

$data = json_decode(file_get_contents("php://input"));


$jwt = isset($data->jwt) ? $data->jwt : "";

if($jwt){

    try{

        $decode = JWT::decode($jwt,$key,array('HS256'));

        http_response_code(200);
        $btc = new BtcCurrency();

        $btcRateUA =  $btc->getBtncurrencyInGrivnas();

        echo json_encode(array(
            "message" => $btcRateUA,
        ));
    }catch (Exception $e){

        http_response_code(401);

        echo json_encode(array(
            "message" => "Access refused",
            "error" => $e->getMessage()
        ));
    }
}else{
    http_response_code(401);

    echo json_encode(array("message" => "Access refused"));
}

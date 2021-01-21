<?php
//  HTTP-headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


include_once '../config/database.php';
include_once '../objects/integer.php';

$database = new Database();
$db = $database->getConnection();

$intByID = new IntByID($db);
 
$data = random_int(-2147483648, 2147483647);
if ( !empty($data)) {
    $intByID->randomInt = $data;
    if($intByID->generate()){
        http_response_code(201);
        echo json_encode(array("message" => "New integer generated. Is " . $intByID->randomInt . ""), JSON_UNESCAPED_UNICODE);
    } else {
        http_response_code(503);
        echo json_encode(array("message" => "Ups."), JSON_UNESCAPED_UNICODE);
    }
} else {
    // Bad request
    http_response_code(400);

    // Message to user
    echo json_encode(array("message" => "Can't connect"), JSON_UNESCAPED_UNICODE);
}
?>
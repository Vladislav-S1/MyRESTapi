<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json");

include_once '../config/database.php';
include_once '../objects/integer.php';

$database = new Database();
$db = $database->getConnection();

$intByID = new IntByID($db);

// need ID by GET
$intByID->id = isset($_GET['id']) ? $_GET['id'] : die();
$intByID->retrieve();
if ($intByID != null) {

    $intByID_arr = array(
        "id" =>  $intByID->id,
        "randomInt" => $intByID->randomInt
    );
    http_response_code(200);

    echo json_encode($intByID_arr);
}

else {
    http_response_code(404);
    echo json_encode(array("message" => "Sorry, we are forgot your int."), JSON_UNESCAPED_UNICODE);
}
?>
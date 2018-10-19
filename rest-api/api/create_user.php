<?php
// required headers
header("Access-Control-Allow-Origin: http://localhost/api/");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// files needed to connect to database
include_once 'config/database.php';
include_once 'objects/user.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// instantiate product object
$user = new User($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// set product property values
$user->firstName = $data->firstName;
$user->lastName = $data->lastName;
$user->email = $data->email;
$user->password = $data->password;

$requiredFieldsProvided = $data->firstName && $data->lastName && $data->email && $data->password;

if (!$requiredFieldsProvided) {
    http_response_code(400);
    echo json_encode(array("message" => "One or more fields missing"));
} else {
    // Create the user
    $result = $user->create();
    // Send response based on result
    if ($result) {
        http_response_code(200);
        echo json_encode(array("message" => "User was created."));
    } else {
        http_response_code(400);
        echo json_encode(array("message" => "Unable to create user."));
    }
}

?>
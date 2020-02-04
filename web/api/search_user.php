<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// required to encode json web token
include_once 'config/core.php';
include_once 'libs/php-jwt-master/src/BeforeValidException.php';
include_once 'libs/php-jwt-master/src/ExpiredException.php';
include_once 'libs/php-jwt-master/src/SignatureInvalidException.php';
include_once 'libs/php-jwt-master/src/JWT.php';
use \Firebase\JWT\JWT;
 
// files needed to connect to database
include_once 'config/database.php';
include_once 'objects/user.php';
include_once 'shared/util.php';


// utilities
$util = new Util();
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// instantiate product object
$user = new User($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));


// get jwt
$jwt=isset($data->jwt) ? $data->jwt : "";
 
// if jwt is not empty
if($jwt){
 
    // if decode succeed, show user details
    try {
 
        // decode jwt
        $decoded = JWT::decode($jwt, $key, array('HS256'));

        $utilities->json_cached_api_results();
        
        $results = $user->search($data->keyword);
        $num = $results->rowCount();


        // check if more than 0 record found
        if($num>0){
         
            // products array
            $users=array();
           
            while ($row = $results->fetch(PDO::FETCH_ASSOC)){
                // extract row
                // this will make $row['name'] to
                // just $name only
                extract($row);
         
                array_push($users, $row);
            }
         
            // set response code - 200 OK
            http_response_code(200);
         
            // show products data
            echo json_encode($users);
        }
         
        else{
            // set response code - 404 Not found
            http_response_code(404);
         
            // tell the user no products found
            echo json_encode(
                array("message" => "No users found.")
            );
        }
    }
 
    // if decode fails, it means jwt is invalid
    catch (Exception $e){
     
        // set response code
        http_response_code(401);
     
        // show error message
        echo json_encode(array(
            "message" => "Access denied.",
            "error" => $e->getMessage()
        ));
    }
}
 
// show error message if jwt is empty
else{
 
    // set response code
    http_response_code(401);
 
    // tell the user access denied
    echo json_encode(array("message" => "Access denied."));
}

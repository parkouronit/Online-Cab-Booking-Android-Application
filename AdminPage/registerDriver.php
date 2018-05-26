<?php

require_once 'include/DB_Functions.php';
$db = new DB_Functions();

// json response array
$response = array("error" => FALSE);

if (isset($_POST['name']) && isset($_POST['email'])&& isset($_POST['contact']) && isset($_POST['password'])&& isset($_POST['car_name'])) {
    
    // receiving the post params
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $password = $_POST['password'];
    $cartype = $_POST['car_name'];
	
    // check if user is already existed with the same email
    if ($db->isDriverExisted($email)) {
        // user already existed
        
        $response["error"] = TRUE;
        $response["error_msg"] = "Driver already existed with " . $email;
        echo json_encode($response);
    } else {
        
        // create a new user
        $user = $db->storeDriver($name, $email,$contact,$cartype,$password);
        if ($user) {
            
            // user stored successfully
            $response["error"] = FALSE;
            $response["uid"] = $user["unique_id"];
            $response["user"]["name"] = $user["name"];
            $response["user"]["email"] = $user["email"];
            $response["user"]["contact"] = $user["contact"];
            $response["user"]["car_name"] = $user["car_name"];
            echo json_encode($response);
        } else {
            // user failed to store
            
            $response["error"] = TRUE;
            $response["error_msg"] = "Unknown error occurred in registration!";
            echo json_encode($response);
        }
    }
} else {
    
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameters (name, email, contact, password) is missing!";
    echo json_encode($response);
}
?>

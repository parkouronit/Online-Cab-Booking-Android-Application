<?php

	//Constants for database connection
	define('DB_HOST','localhost');
	define('DB_USER','id4173357_root');
	define('DB_PASS','');
	define('DB_NAME','id4173357_localhost');

	//We will upload files to this folder
	//So one thing don't forget, also create a folder named uploads inside your project folder i.e. MyApi folder
	define('UPLOAD_PATH', 'uploads/');

	//connecting to database
	$conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME) or die('Unable to connect');


	//An array to display the response
	$response = array();

	//if the call is an api call

      if(isset($_FILES['pic']['name']) && isset($_POST['email'])){

        //uploading file and storing it to database as well
        try{
          move_uploaded_file($_FILES['pic']['tmp_name'], UPLOAD_PATH . $_FILES['pic']['name']);
          $stmt = $conn->prepare("UPDATE driver SET insurance=? WHERE email=?");
          $stmt->bind_param("ss", $_FILES['pic']['name'],$_POST['email']);
          if($stmt->execute()){
            $response['error'] = false;
            $response['message'] = 'File uploaded successfully';
          }else{
            throw new Exception("Could not upload file");
          }
        }catch(Exception $e){
          $response['error'] = true;
          $response['message'] = 'Could not upload file';
        }

      }else{
        $response['error'] = true;
        $response['message'] = "Required params not available";
      }

header('Content-Type: application/json');
  echo json_encode($response);

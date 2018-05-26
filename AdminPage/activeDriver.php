<?php
    //connecting to database
	$con=mysqli_connect("localhost","id4173357_root","","id4173357_localhost");

	//An array to display the response
	$response = array("error" => FALSE);

    $email=$_POST['email'];

    $query="UPDATE driver set stat=1 where email='$email'";
    $res=mysqli_query($con,$query);
    if($res){
            $response["error"] = FALSE;
            $response["error_msg"] = "You're ready to take booking. . .";
            echo json_encode($response);
    }else{
        $response["error"] = TRUE;
        $response["error_msg"] = "Something went wrong. . . Try again!!";
        echo json_encode($response);
    }

?>

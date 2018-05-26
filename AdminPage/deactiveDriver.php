<?php
    //connecting to database
	$con=mysqli_connect("localhost","id4173357_root","","id4173357_localhost");

	//An array to display the response
	$response = array("error" => FALSE);

    $email=$_POST['email'];

    $query="UPDATE driver set stat=0 where email='$email'";
    $res=mysqli_query($con,$query);
    if($res){
            $response["error"] = FALSE;
            $response["error_msg"] = "You won't be getting any request till you switch on your status. . .";
            echo json_encode($response);
    }else{
        $response["error"] = TRUE;
        $response["error_msg"] = "Something went wrong. . . Try again!!";
        echo json_encode($response);
    }

?>

<?php
//connecting to database
	$con=mysqli_connect("localhost","id4173357_root","","id4173357_localhost");

	//An array to display the response
	$response = array("error" => FALSE);
	if(isset($_POST['ride_id'])&&isset($_POST['driver_email'])&&isset($_POST['user_email'])&&isset($_POST['rate'])){
	$driver_email=$_POST['driver_email'];
	$user_email=$_POST['user_email'];
	$rate=$_POST['rate'];
	$ride_id=$_POST['ride_id'];
	$query="INSERT INTO `feeback` (`id`, `r_id`, `driver_email`, `user_email`, `f_ponits`) VALUES (NULL, '$ride_id', '$driver_email', '$user_email', '$rate');";
	$res=mysqli_query($con,$query);
	if($res){
	    $response["error"] = FALSE;
        $response["error_msg"] = "Rating recieved sussessfully!!";
        echo json_encode($response);
	}else{
	    $response["error"] = TRUE;
        $response["error_msg"] = "Something went wrong!!";
        echo json_encode($response);
	}
	}else{
	    $response["error"] = TRUE;
        $response["error_msg"] = "Crediantials not recieved!!";
        echo json_encode($response);
	}

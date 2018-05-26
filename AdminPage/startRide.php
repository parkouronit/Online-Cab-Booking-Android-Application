<?php
	//connecting to database
	$con=mysqli_connect("localhost","id4173357_root","","id4173357_localhost");
	//An array to display the response
	$response = array("error" => FALSE);
		$ride_id=$_POST['ride_id'];
	if (!$con) {
		$response=array(
			"status"=>"0",
			"data"=>"Error Connecting to Database!"
			);
		die(json_encode($response));
	}
		$startRideQuery=mysqli_query($con,"UPDATE rides SET stats='started' WHERE rides.ride_id=$ride_id");
		if ($startRideQuery) {
				$response["error"] = FALSE;
            $response["error_msg"] = "Ride started Successfully";
            echo json_encode($response);
		}
		else{
				$response["error"] = TRUE;
            $response["error_msg"] = "Unable to start ride. . .";
            echo json_encode($response);
		}
?>

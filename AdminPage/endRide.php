<?php

	//connecting to database
	$con=mysqli_connect("localhost","id4173357_root","","id4173357_localhost");

	//An array to display the response
	$response = array("error" => FALSE);

		$ride_id=$_POST['ride_id'];
		$d_email=$_POST['driver_email'];

	if (!$con) {
		$response=array(
			"status"=>"0",
			"data"=>"Error Connecting to Database!"
			);
		die(json_encode($response));
	}

	$getRideStatus="SELECT * FROM rides WHERE rides.ride_id='$ride_id'";

	$result=mysqli_query($con, $getRideStatus);
	if ($result) {
		$cancelCabQuery="UPDATE `rides` SET `stats` = 'ended' WHERE `rides`.`ride_id` = '$ride_id'";
 		$cancelCabQuery2="UPDATE `driver` SET `ontrip` = '0' WHERE `driver`.`email` ='$d_email'";

 		$result2=mysqli_query($con, $cancelCabQuery);
 		$result3=mysqli_query($con, $cancelCabQuery2);

 		if ($result2 && $result3) {
			$response["error"] = FALSE;
            $response["error_msg"] = "You've completed your ride successfully and you're ready to take another ride...";
            echo json_encode($response);
		}
		else
		{
			$response["error"] = TRUE;
            $response["error_msg"] = "1: Unable to end ride!!";
            echo json_encode($response);
		}

	}
	else
	{
			$response["error"] = TRUE;
            $response["error_msg"] = "2: Unable to end ride!!";
            echo json_encode($response);
	}
?>

<?php
	//require('include/Config.php');

	$email=$_POST['email'];

	$lat=$_POST['latitude'];
	$lng=$_POST['longitude'];

	$con=mysqli_connect("localhost","id4173357_root","","id4173357_localhost");

	if (!$con) {
		$response=array(
			"status"=>"0",
			"data"=>"Error Connecting to Database!"
			);
		die(json_encode($response));
	}

	// $getRideStatus="SELECT status FROM rides WHERE ride_id='$ride_id' and (status=1 or status=2)";

	// $result=mysqli_query($con, $getRideStatus);
	// if (mysqli_num_rows($result)==0) {
		$updateUserLocationQuery="UPDATE users SET latitude='$lat', longitude='$lng' WHERE email='$email'";

		$result2=mysqli_query($con, $updateUserLocationQuery);

		if ($result2) {
				$response=array(
					"status"=>"1",
					"data"=>"Location updated"
					);
				die(json_encode($response));
		}
		else
		{
			$response=array(
				"status"=>"0",
				"data"=>"Unable to update location"
				);
			die(json_encode($response));
		}

	// }
	// else
	// {
	// 	$response=array(
	// 		"status"=>"0",
	// 		"data"=>"Unable to cancel ride"
	// 		);
	// 	die(json_encode($response));
	// }





?>

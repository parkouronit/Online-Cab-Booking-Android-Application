<?php


    //connecting to database
	$con=mysqli_connect("localhost","id4173357_root","","id4173357_localhost");

	//An array to display the response
	$response = array("error" => FALSE);

	$user_email=$_POST['email'];




	$getCurrentRide="SELECT ride_id, stats,rides.driver_email email, driver.name driver_name, driver.contact driver_phone,driver.latitude lati,driver.longitude longi from rides,driver WHERE rides.user_email='$user_email' and (stats = 'null' or stats = 'started')  LIMIT 1";

	$result=mysqli_query($con, $getCurrentRide);
	if (mysqli_num_rows($result)) {
		$r=mysqli_fetch_assoc($result);
		        $response["error"] = FALSE;
				$response["ride_id"] = $r["ride_id"];
				$response["status"] = $r["status"];
				$response["email"] = $r["email"];
				$response["driverrr"]["driver_name"] = $r["driver_name"];
				$response["driverrr"]["driver_phone"] = $r["driver_phone"];
                $response["driverrr"]["lati"] = $r["lati"];
		        $response["driverrr"]["longi"] = $r["longi"];

				echo json_encode($response);
	}
	else
	{

            $response["error"] = TRUE;
            $response["error_msg"] = "No current Bookings. . . ";
            echo json_encode($response);
	}





?>

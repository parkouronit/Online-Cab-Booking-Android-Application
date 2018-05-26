<?php

	//connecting to database
	$con=mysqli_connect("localhost","id4173357_root","","id4173357_localhost");

	//An array to display the response
	$response = array("error" => FALSE);

	$src_lat=$_POST['src_lat'];
	$src_lng=$_POST['src_lng'];
	$dest_lat=$_POST['dest_lat'];
	$dest_lng=$_POST['dest_lng'];
	$date=$_POST['date'];
	$time=$_POST['time'];
	$carType=$_POST['carType'];
	$user_email=$_POST['user_email'];

    $getUserNamePhoneQuery="SELECT name, contact FROM users WHERE email='$user_email'";

	$userNamePhone=mysqli_query($con, $getUserNamePhoneQuery);
	$customer=mysqli_fetch_assoc($userNamePhone);
	$customer_name=$customer['name'];
    $customer_phone=$customer['contact'];

    $getNearbyCabs="SELECT email, name, contact, latitude, longitude from driver WHERE car_name='$carType' and verified=1 and stat = 1 and ontrip=0  LIMIT 1";

    $result=mysqli_query($con, $getNearbyCabs);

	if (mysqli_num_rows($result)>0) {

		$r=mysqli_fetch_assoc($result);
        $d_id=$r['driver_id'];
	    $driver_email=$r['email'];
	    $d_con=$r['contact'];
	    $d_lon=$r['longitude'];
	    $d_lat=$r['latitude'];


        $book_ride_query="INSERT INTO rides (driver_email, user_email, src_lat, src_lng, dest_lat, dest_lng, date, time,carType) values ('$driver_email', '$user_email', '$src_lat', '$src_lng', '$dest_lat', '$dest_lng',  '$date' ,'$time','$carType')";
        $change_on_trip_query="UPDATE driver SET ontrip=1 WHERE email='$driver_email'";

		$book_ride_result=mysqli_query($con, $book_ride_query);
		$change_on_trip_result=mysqli_query($con, $change_on_trip_query);




		if ($book_ride_result && $change_on_trip_result) {
			$get_ride_id="SELECT ride_id FROM rides WHERE driver_email='$driver_email' and user_email='$user_email' and time='$time'";

			$get_ride_id_result=mysqli_query($con, $get_ride_id);

			if ($get_ride_id_result) {
				$r2=mysqli_fetch_assoc($get_ride_id_result);
				$response["error"] = FALSE;
				$response["ride_id"] = $r2["ride_id"];
				$response["stats"] = $r2["stats"];
				$response["driverrr"]["email"] = $r["email"];
				$response["driverrr"]["name"] = $r["name"];
				$response["driverrr"]["contact"] = $r["contact"];
                $response["driverrr"]["latitude"] = $r["latitude"];
		        $response["driverrr"]["longitude"] = $r["longitude"];

				echo json_encode($response);

			}
			else
			{
			$response["error"] = TRUE;
            $response["error_msg"] = "Unknown error occurred!! Try again later. . .";
            echo json_encode($response);
			}
		}
		else
		{
			$response["error"] = TRUE;
            $response["error_msg"] = "Something went wrong while fetching driver. . . try again!!";
            echo json_encode($response);
		}
	}else{
		    $response["error"] = TRUE;
            $response["error_msg"] = "Driver's not available at the moment. Try again later";
            echo json_encode($response);
	}
?>

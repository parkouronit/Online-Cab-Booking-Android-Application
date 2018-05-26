<?php


    //connecting to database
	$con=mysqli_connect("localhost","id4173357_root","","id4173357_localhost");

	//An array to display the response
	$response = array("error" => FALSE);

	$driver_email=$_POST['driver_email'];




	$getCurrentRide="SELECT ride_id, stat,stats, src_lat, src_lng, dest_lat, dest_lng,driver.stat statt,rides.stats sstatu, users.name user_name, users.contact user_phone,users.latitude lati,users.longitude longi from rides,users,driver WHERE rides.driver_email='$driver_email' and (stats = 'null' or stats = 'started')  LIMIT 1";
		$result=mysqli_query($con, $getCurrentRide);
	if (mysqli_num_rows($result)) {
		$r=mysqli_fetch_assoc($result);

	}
	$result=mysqli_query($con, $getCurrentRide);
	if (mysqli_num_rows($result)) {
		$r=mysqli_fetch_assoc($result);
		        $sl=$r['src_lat'];
	            $sln=$r['src_lng'];
	            $dl=$r['dest_lat'];
	            $dln=$r['dest_lng'];
	            $srcc = getAddress($sl,$sln);
                $dest=  getAddress($dl,$dln);
		$response["error"] = FALSE;
		        $response["ride_id"] = $r["ride_id"];
		        $response["statt"]=$r["statt"];
		        $response["sstatu"]=$r["sstatu"];
				$response["user"]["user_name"] = $r["user_name"];
				$response["user"]["user_phone"] = $r["user_phone"];

				$response["user"]["source"] = $srcc;
                $response["user"]["destination"] = $dest;

				echo json_encode($response);
	}
	else
	{

            $response["error"] = TRUE;
            $response["error_msg"] = "No current Bookings. . . ";
            echo json_encode($response);
	}







function getAddress($latitude,$longitude){
    if(!empty($latitude) && !empty($longitude)){
        //Send request and receive json data by address
        $geocodeFromLatLong = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($latitude).','.trim($longitude).'&sensor=false');
        $output = json_decode($geocodeFromLatLong);
        $status = $output->status;
        //Get address from json data
        $address = ($status=="OK")?$output->results[1]->formatted_address:'';
        //Return address of the given latitude and longitude
        if(!empty($address)){
            return $address;
        }else{
            return false;
        }
    }else{
        return false;
    }
}

?>

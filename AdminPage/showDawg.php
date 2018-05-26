<?php
	define('DB_HOST','localhost');
	define('DB_USER','id4173357_root');
	define('DB_PASS','');
	define('DB_NAME','id4173357_localhost');
// json response array
$response = array("error" => FALSE);
    $con = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME) or die('Unable to connect');
	$email=$_POST['email'];
	$query=mysqli_query($con,"select * from driver where email='$email' ");
			$row=mysqli_fetch_assoc($query);
				$tag=$row['dawg_tag'];


         //creating a query
 $stmt = $con->prepare("SELECT name,longitude,latitude FROM driver where $tag=dawg_tag;");

 //executing the query
 $stmt->execute();

 //binding results to the query
 $stmt->bind_result($name,$lon,$lat);

 $dawg = array();

 //traversing through all the result
 while($stmt->fetch()){
 $temp = array();
 $temp['name'] = $name;
 $temp['longitude'] = $lon;
 $temp['latitude'] = $lat;
 array_push($dawg, $temp);
 }

 //displaying the result in json format
 echo json_encode($dawg);

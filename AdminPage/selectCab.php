<?php

 /*
 * Created by Belal Khan
 * website: www.simplifiedcoding.net
 * Retrieve Data From MySQL Database in Android
 */

 //database constants
 define('DB_HOST', 'localhost');
 define('DB_USER', 'id4173357_root');
 define('DB_PASS', '');
 define('DB_NAME', 'id4173357_localhost');

 //connecting to database and getting the connection object
 $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

 //Checking if any error occured while connecting
 if (mysqli_connect_errno()) {
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
 die();
 }

 //creating a query
 $stmt = $conn->prepare("SELECT car_name FROM carselect;");

 //executing the query
 $stmt->execute();

 //binding results to the query
 $stmt->bind_result($car_name);

 $cars = array();

 //traversing through all the result
 while($stmt->fetch()){
 $temp = array();
 $temp['car_name'] = $car_name;
 array_push($cars, $temp);
 }

 //displaying the result in json format
 echo json_encode($cars);

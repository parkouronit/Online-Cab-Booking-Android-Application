
<?php
	define('DB_HOST','localhost');
	define('DB_USER','id4173357_root');
	define('DB_PASS','');
	define('DB_NAME','id4173357_localhost');
// json response array
$response = array("error" => FALSE);
    $con = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME) or die('Unable to connect');
	$email=$_POST['email'];


         //creating a query
 $stmt = $con->prepare("SELECT ride_id,driver_email,user_email,src_lat,src_lng,dest_lat,dest_lng,date,time,carType,stats FROM rides where user_email='$email'");

 //executing the query
 $stmt->execute();

 //binding results to the query
 $stmt->bind_result($r_id,$d_email,$u_email,$srclat,$srclon,$destlat,$destlon,$date,$time,$cartype,$stat);
 $srcc = getaddress($srclat,$srclon);
 $dest=  getaddress($destlat,$destlon);
 $dawg = array();

 //traversing through all the result
 while($stmt->fetch()){
 $temp = array();
 $temp['ride_id'] = $r_id;
 $temp['driver_email'] = $d_email;
 $temp['user_email'] = $u_email;
 $temp['Source'] = $srcc;
 //$temp['src_lng'] = $srclon;
 $temp['Destination'] = $dest;
 //$temp['dest_lng'] = $destlon;
 $temp['date'] = $date;
 $temp['time'] = $time;
 $temp['carType'] = $cartype;
 $temp['stats'] = $stat;
 array_push($dawg, $temp);
 }

 //displaying the result in json format
 echo json_encode($dawg);


 function getaddress($lat,$lng)
{
$url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($lat).','.trim($lng).'&sensor=false';
$json = @file_get_contents($url);
$data=json_decode($json);
$status = $data->status;
if($status=="OK")
return $data->results[0]->formatted_address;
else
return false;
}
?>

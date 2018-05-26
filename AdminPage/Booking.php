<?php
  session_start();
  require_once 'include/DB_Functions.php';
  $users=new DB_Functions();
  if (!$users->isUserLoggedIn() == true) {
  		header("Location:index.php");
  		exit();
  	}
    if(isset($_POST['logout'])){

    	$user->doLogout();
    }
?>
<html>
<head>
  <title>Admin</title>

  <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
<div id="header">
  <div class="logo">
  <a href="#">Ad<span>Min</span></a>
</div>
</div>


<div id="container">
  <div class="sidebar">
    <ul id="nav">
      <li><a href="#">User : <?php echo $_SESSION['a_name']; ?> </a></li>
      <li><a href="dashboard.php">Users Details</a></li>
      <li><a href="VerifyDri.php">Verify Drivers</a></li>
      <li><a href="Bookings.php">Bookings</a></li>
      <li><a href="Cabs.php">Add Cabs</a></li>
      <li><a href="Driverfeedback.php">Users' Feedback</a></li>
      <li><a href="logout.php">Logout</a></li>
    </ul>
  </div>

  <div class="content">
    <div class="card">
    <div class="card-header">
	    <h4 class="title">Users Table</h4>
	   </div>
      <div class="card-content table-responsive">
        <table>
          <tr>
            <th>Ride ID</th>
            <th>Driver Email</th>
            <th>User Email</th>
			<th>Source</th>
			<th>Destination</th>
			<th>Date</th>
			<th>Time</th>
		    <th>Car Type</th>
          </tr>
          <?php
                      $con=mysqli_connect("localhost","id4173357_root","","id4173357_localhost");
          		    $query=mysqli_query($con,"select * from rides");
          				while($row = mysqli_fetch_array($query)) {
          					$id=$row['ride_id'];
          					$d_email=$row['driver_email'];
          					$u_email=$row['user_email'];
          					$src_lat=$row['src_lat'];
          					$src_lng=$row['src_lng'];
          					$dest_lat=$row['dest_lat'];
          					$dest_lng=$row['dest_lng'];
          					$date=$row['date'];
          					$time=$row['time'];
          					$car=$row['carType'];
          		 			$src = getAddress($src_lat,$src_lng);
          		 			$dest=getAddress($dest_lat,$dest_lng);
                            $src = $src?$src:'Not found';
                            $dest = $dest?$dest:'Not found';
          					echo "<tr><td>$id</td>";
          					echo "<td>$d_email</td>";
          					echo "<td>$u_email</td>";
          		 			echo "<td>$src</td>";
          		 			echo "<td>$dest</td>";
          					echo "<td>$date</td>";
          					echo "<td>$time</td>";
          					echo "<td>$car</td>";
          			}
          			echo "</tr>";

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
		  </table>
      </div>
  </div>
</div>
</div>

</body>
</html>

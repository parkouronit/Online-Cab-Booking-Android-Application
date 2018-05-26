<?php
  session_start();
  require_once 'include/DB_Functions.php';
  $users=new DB_Functions();
  $con=mysqli_connect("localhost","id4173357_root","","id4173357_localhost");
  if (!$users->isUserLoggedIn() == true) {
  		header("Location:index.php");
  		exit();
  	}
  if(isset($_POST['add'])){
      if(empty($_POST['cabs'])){
  echo "<script typr='text/javascript'>alert('car name missing!!');</script>";
      }elseif(empty($_POST['cabseats'])){
          echo "<script typr='text/javascript'>alert('number of seats missing!!');</script>";
      }else{
          $name=$_POST['cabs'];
      $seats=$_POST['cabseats'];
        $users->addCabs($name,$seats);
      }
    }
?>
<html>
<head>
  <title>Admin</title>
  <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
    <form action='Cabs.php' method='POST'>
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
      <li><a href="Booking.php">Bookings</a></li>
      <li><a href="Cabs.php">Add Cabs</a></li>
      <li><a href="Driverfeedback.php">Users' Feedback</a></li>
      <li><a href="logout.php">Logout</a></li>
    </ul>
  </div>
  <div class="content">
    <div class="card">
    <div class="card-header">
	    <h4 class="title">Add Cabs</h4>
	  </div>
    <div class="card-content">
	    <input type="text" name="cabs" placeholder="Enter cab to add. . ">
	    <input type="text" name="cabseats" placeholder="Enter maximum number of seats. . ">
      <input type="submit" value="Add Cab" name="add" >
	  </div>
    <div class="card-content table-responsive">
      <table>
        <tr>
          <th>Car Name</th>
          <th>Number of Seats</th>
        </tr>
        <?php
                    $con=mysqli_connect("localhost","id4173357_root","","id4173357_localhost");
					$query=mysqli_query($con,"select * from carselect");
					while($row = mysqli_fetch_array($query)) {
					$name=$row['car_name'];
					$setas=$row['max_seats'];
					echo "<tr><td>$name</td>";
					echo "<td>$setas</td>";
              }
              echo "</tr>"
          ?>
      </div>
  </div>
</div>
</div>
</form>
</body>
</html>

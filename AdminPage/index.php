<?php
session_start();
require_once 'include/DB_Functions.php';
$users=new DB_Functions();
if ($users->isUserLoggedIn() == true) {
		header("Location:dashboard.php");
		exit();
	}if ($users->isUserLoggedIn() == true) {
		header("Location:dashboard.php");
		exit();
	}else{
if(isset($_POST['register'])){
  if(empty($_POST['username'])){
      echo "<script typr='text/javascript'>alert('username missing!!');</script>";
  }elseif(empty($_POST['email'])){
      echo "<script typr='text/javascript'>alert('email missing!!');</script>";
  }elseif(empty($_POST['contact'])){
      echo "<script typr='text/javascript'>alert('contact missing!!');</script>";
  }elseif(empty($_POST['password'])){
      echo "<script typr='text/javascript'>alert('password missing!!');</script>";
  }else{
    $username=$_POST['username'];
    $email=$_POST['email'];
    $contact=$_POST['contact'];
    $pass=$_POST['password'];
    $user=new DB_Functions();
	if($user->isAdminExisted($email)){
        echo "<script type='text/javascript'>alert('user exist');</script>";
      }else{
            if($user->storeAdmin($username, $email,$contact, $pass)){
                echo "<script type='text/javascript'>alert('user registered successfully');</script>";
				exit;
				header("Location:index.php");
            }else{
              echo "<script type='text/javascript'>alert('user regstration failed. Something wet wrong');</script>";
            }
      }
}
}
if(isset($_POST['login'])){
	if(empty($_POST['email'])){
      echo "<script type='text/javascript'>alert('email missing!!');</script>";
  }elseif(empty($_POST['password'])){
      echo "<script type='text/javascript'>alert('password missing!!');</script>";
  }else{

	$email=$_POST['email'];
	$password=$_POST['password'];
    $log=$users->getAdmin($email, $password);
	if ($log) {
		header("location:dashboard.php");
		echo "<script type='text/javascript'>alert('welcome');</script>";
		exit();
	}else{
		echo "<script type='text/javascript'>alert('Something went wrong. Try again');</script>";
		header("location:index.php");
	}
}
}
}
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
  <div class="hid">
    <input type="checkbox" name="flipper__checkbox" id="flipper__checkbox"
    hidden class="flipper__checkbox"  />
      <div class="form__container">
        <div class="form__login">
			<h1>Login</h1>
			<form id="loginForm" action="#" method="post" class="form">
            <div class="field-wrap">
            <input type="email" required autocomplete="off" placeholder="email" name="email"/>
          </div>
          <div class="field-wrap">
            <input type="password" required autocomplete="off" placeholder="password" name="password"/>
          </div>
          <p class="forgot"><a href="forgot.php">Forgot Password?</a></p>
          <button class="button button-block" name="login" />Log In</button>
            <small>Not a member yet? <label for="flipper__checkbox">Create your account</label>.</small>
          </form>
        </div>
        <div class="form__signup">
         <h1>Sign Up</h1>
          <form id="signupForm" action="#" method="post" class="form">
            <div class="top-row">
            <div class="field-wrap">
              <input type="text" required autocomplete="off" placeholder='firstname' name="username" />
            </div>
            <div class="field-wrap">
              <input type="text" required autocomplete="off" placeholder='contact'name="contact" />
            </div>
          </div>
          <div class="field-wrap">
            <input type="email" required autocomplete="off" placeholder='email' name="email"/>
          </div>
          <div class="field-wrap">
            <input type="password" required autocomplete="off" placeholder='password' name="password"/>
          </div>
          <button type="submit" class="button button-block" name="register" />Register</button>
            <small>Are you a member? <label for="flipper__checkbox">Click here to login</label>.</small>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>

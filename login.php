<html>
<head>
<title>Login Page</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body background="bbb.jpg">
<div class="header">
<div class="logo"><h2>Blood Bank</h2></div>
</div>
<form method="POST" action="login.php">
<nav>
	<ul class="input-group">
	<!--li><a href="login.php">Login</a></li-->
	<li><a href="About.php">About</a></li>
	<!--li><a href="wtd.php">wtd</a></li-->
	<li><a href="ds.php">Search Donor</a></li>
	<li><a href="contact.php">contact</a></li>

</ul>
</nav>
</form>

<div class="aaa">
	<h2>If you want to donate fill the login form</h2>
</div>

<div class="header">
	<h2>Login</h2>
</div>
<form method="post" action="login.php">
<div class="input-group">
	<label>Username
	<input type="text" name="username">
<!--/div>
<div class="input-group"-->
	<label>Password
	<input type="password" name="password"><br><br>
<!--/div>
<div class="input-group"-->
	<button type="submit" class="btn" name="login_user">Login</button>
</div>
	<p style="color:white">
		Not yet a member?<a href="registration.php">Sign up</a>	
	</p>
</form>
</body>
</html>
<?php
session_start();
include("dbconnect.php");
$username=$_POST['username'];
$password=$_POST['password'];
/*$result1=pg_query("SELECT ADMIN_NAME,ADMIN_PASSWORD FROM admin;")or die("Error occurred");
$row1=pg_fetch_row($result1);*/
$result=pg_query("SELECT DNAME,PASS FROM donor_reg WHERE DNAME='$username' AND PASS='$password';")or die("Error occurred");
$row=pg_fetch_row($result);
if(isset($_POST['login_user']))
{
	/*if($username==$row1[0] && $password==$row1[1])
	{
		echo "<script>alert('Login Successful!!');</script>";
		header("location:admin.php");
	}*/
	if($username==$row[0] && $password==$row[1])
	{
		echo "<script>alert('Login Successful!!');</script>";
		header("location:wtd.php");
	}
}
?>

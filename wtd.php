<html>
<head>
<title>Login Page</title>
<link rel="stylesheet" type="text/css" href="wtd.css">
</head>
<body background="ddd.jpg">
<font color="red"><h1>Welcome</h1></font>
<div class="header">
<div class="logo"><h2>Blood Bank<h2></div>
</div>
<form>
<nav>
	<ul class="input-group">
	<li><a href="login.php">Login</a></li>
	<li><a href="About.php">About</a></li>
	<li><a href="wtd.php">Want to donate</a></li>
	<li><a href="ds.php">Donor search</a></li>
	<li><a href="contact.php">contact</a></li>
	
</ul>
</nav>
</form>

<div class="header">
	<h2>donor<h2>
</div>

<form method="post" action="">
<div class="input-group">
	<label>Name</lable>
	<input type="text" name="username">
</div>
<div class="input-group">
	<label>Your gender</lable>
	<input type="radio" name="g1" value="male">male</input>
	<input type="radio" name="g1" value="female">female</input><br>
	<input type="radio" name="g1" value="other">other</input>
</div>

<div class="input-group">
	<label>By blood group</lable>
	<select name="blood_group">
	<option value="">select</option>
	<option value="A+">A+</option>
	<option value="A-">A-</option>
	<option value="B+">B+</option>
	<option value="B-">B-</option>
	<option value="O+">O+</option>
	<option value="O-">0-</option>
	<option value="AB+">AB+</option>
	<option value="AB-">AB-</option>
	</select>
</div>

<div class="input-group">
	<label>Weight</lable>
	<input type="number" name="wt">Kg
</div>
<div class="input-group">
	<label>Age</lable>
	<input type="number" name="age">
</div>
<div class="input-group">
	<label>	Select Center</lable>
	<select name="Location">
	<option value="S2">select</option>
	<option value="abc">sancheti hospital</option>
	<option value="qwe">ruby hospital</option>
	<option value="asd">jehangir hospital</option>
	<option value="zxc">Military hospital</option>
	<option value="rty">sayadri hospital</option>
	<option value="fgh">Dinanath mangeskar hospital</option>
	<option value="vbn">D.Y.Patil hospital</option>
	</select></br></br>

	<div class="input-group">
	<button type="submit" class="btn" name="donor">submit</button>
</div>

<input type=button class="btn" onClick="location.href='login.php'" value="log out">
		
	
	
</form>
</body>
</html>
<?php
	session_start();
	include("dbconnect.php");
	$flag=0;
	$name=$_POST['username'];
	$bg=$_POST['blood_group'];
	$weight=$_POST['wt'];	
	$age=$_POST['age'];	
	$gender=$_POST['g1'];
	$center=$_POST['Location'];
	if(isset($_POST['donor']))
	{
		//Name Validation
		if(!preg_match("/^[a-zA-Z]+$/",$name) && $name!="")
		{
			echo "<script>alert('Invalid Username!!');</script>";
			$flag=1;
		}	
			//Body Weight Validation
		if($weight<=0 && $weight!="")		
		{
			echo "<script>alert('Please enter a Valid Body Weight!!');</script>";
			$flag=1;	
		}
		if($weight>0 && $weight<50 && $weight!="")
		{
			echo "<script>alert('Body Weight does not fit in the given criteria!!');</script>";
			$flag=1;
		}
		//Age  Validation
		if($age<=0 && $age!="")		
		{
			echo "<script>alert('Please enter a Valid Age!!');</script>";
			$flag=1;	
		}
		if($age>0 && ($age<18 || $age>65) && $age!="")
		{
			echo "<script>alert('Age does not fit the given criteria!!');</script>";
			$flag=1;
		}
		if($flag==0)
		{
			pg_query("INSERT INTO don(user_name,blood_group,g_1,age,weight,center) VALUES ('".$name."','".$bg."','".$gender."','".$age."','".$weight."','".$center."');")or die("ERROR");
		}
	}
?>


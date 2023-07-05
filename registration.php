<html>
<head>
	<title>Registration</title>
	<link rel="stylesheet" type="text/css" href="style.css">
<head>
<body background="bbb.jpg" style="margin-top:right">
	<div class="header">
	<h2>Registration<h2>
	</div>
	
<form method="post" action="registration.php">
<div class="input-group">
	<label><font size=2 style="color:red"></font>Full Name:</label>
	<input type="text" name="username">
</div>
<div class="input-group">
	<label>Email</lable>
	<input type="email" name="email">
</div>
<!--div class="input-group">
	<label>Age</lable>
	<input type="number" name="age">
</div-->
<!--div class="input-group">
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
</div-->
<div class="input-group">
	<label>Address</lable>
	<input type="text" name="add">
</div>
<div class="input-group">
	<label>Contact</lable>
	<input type="number" name="con">
</div>

<div class="input-group">
	<label>Password</label>
	<input type="password" name="password_1">
</div>
<div class="input-group">
	<label>Confirm Password</label>
	<input type="password" name="password_2">
</div>
<div class="input-group">
	<button type="submit" class="btn" name="reg_user">Registration</button>
</div>
	<p>
		Already a member? <a href="login.php">Sign in</a>
	</p>
</form>
</body>
</html>
<?php
	session_start();
	include("dbconnect.php");
	$flag=0;
	$name=$_POST['username'];
	$email=$_POST['email'];
	//$age=$_POST['age'];
	//$bg=$_POST['bg'];
	//$weight=$_POST['wt'];
	$add=$_POST['add'];
	$con=$_POST['con'];
	$password1=$_POST['password_1'];
	$password2=$_POST['password_2'];	
	if(isset($_POST['reg_user']))
	{
		if($email==""||$password1==""||$password2==""||$add==""||$con==""||$name=="")
		{
			echo "<script>alert('Please fill in all the fields!!');</script>";
			$flag=1;
		}

		//Name Validation
		if(!preg_match("/^[a-zA-Z]+$/",$name) && $name!="")
		{
			echo "<script>alert('Invalid Username!!');</script>";
			$flag=1;
		}			
	
		//Email Validation
		$echeck=htmlspecialchars(stripslashes(strip_tags($email)));
		if(!ereg("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z0-9]+)*(\.[a-z]{2,3})$",$echeck)&& $email!="")
		{
			echo "<script>alert('Invalid EmailId!!');</script>";
			$flag=1;
		}
		if($password1!=$password2 && $password1!="" && $password2!="")
		{
			echo "<script>alert('The Two Passwords don't match!!');</script>";
			$flag=1;
		}

		/*//Age  Validation
		if($age<=0 && $age!="")		
		{
			echo "<script>alert('Please enter a Valid Age!!');</script>";
			$flag=1;	
		}
		if($age>0 && ($age<18 || $age>65) && $age!="")
		{
			echo "<script>alert('Age does not fit the given criteria!!');</script>";
			$flag=1;
		}*/

		/*//Blood Group Valiadtion
		if((!preg_match("/^(A|B|O|AB)[+-]?$/",$bg)) && $bg!="")
		{
			echo "<script>alert('Your blood group is Invalid!!');</script>";
			$flag=1;
		}*/

		//Body Weight Valiadtion
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
		
		//Contact Validation
		if((!preg_match("/^[0-9]{10}$/",$con)) && $con!="")
		{
			echo "<script>alert('Your Contact number is Invalid!!');</script>";
			$flag=1;
		}
		if($flag==0)
		{
			pg_query("INSERT INTO donor_reg(DNAME,EMAIL,ADDR,CON,PASS)VALUES('$name','$email','$add','$con','$password1');");
			header("refresh:3;url=login.php");
		}
	}
?>

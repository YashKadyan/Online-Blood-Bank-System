<html>
<head>
<title>Donor search</title>
<link rel="stylesheet" type="text/css" href="ds.css">
</head>
<body background="eee.jpg">

<div class="header">
<div class="logo"><h2>Donor Search<h2></div>
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
	<h2>Select Donor<h2>
</div>


<form method="POST" action="ds.php">



<div class="input-group">
	<label>By Blood Group</lable>
	<select name="blood_group">
	<option value="S1">select</option>
	<option value="A+">A+</option>
	<option value="A-">A-</option>
	<option value="B+">B+</option>
	<option value="B-">B-</option>
	<option value="O+">O+</option>
	<option value="O-">O-</option>
	<option value="AB+">AB+</option>
	<option value="AB-">AB-</option>
	</select>	
</div>
<div class="input-group">
	<label>By Center</lable>
	<select name="Location">
	<option value="S2">select</option>
	<option value="sancheti hospital">sancheti hospital</option>
	<option value="ruby hospital">ruby hospital</option>
	<option value="jehangir hospital">jehangir hospital</option>
	<option value="Military hospital">Military hospital</option>
	<option value="sayadri hospital">sayadri hospital</option>
	<option value="Dinanath mangeshkar hospital">Dinanath mangeskar hospital</option>
	<option value="D.Y.Patl hospital">D.Y.Patil hospital</option>
	</select></br></br>

	<button type="submit" class="btn" name="login_user">Submit</button>
</div>
</form>
</body>
</html>
<?php
	session_start();
	include("dbconnect.php");
	$count=0;
	if(isset($_POST['login_user']))
	{
		if($_POST['blood_group']!='S1' && $_POST['Location']=='S2')
		{			
			$count=1;
		}
		if($_POST['blood_group']=='S1' && $_POST['Location']!='S2')
		{			
			$count=3;
		}
		if($_POST['blood_group']!='S1' && $_POST['Location']!='S2')
		{			
			$count=2;
		}
		
		if($count==1)
		{ 
			$result1=pg_query("SELECT * FROM don where blood_group='".$_POST['blood_group']."';")or die("Error occurred");
			$rows1=pg_num_rows($result1);
			if($rows1==0)
			{
				echo "<font style=color:red>No record found with the ".$_POST['blood_group']." Blood Group!!</font>";
				exit;
			}
			echo "<center><font><table border=1 cellpadding=0 cellspacing=0 style='color: red;'>";
			echo "<th>Donor-id</th><th>Username</th><th>Blood Group</th><th>Gender</th><th>Age</th><th>Weight</th><th>Center</th>";
			while($row1=pg_fetch_row($result1))
			{
				echo "<tr>";
				echo "<td>$row1[0]</td><td>$row1[1]</td><td>$row1[2]</td><td>$row1[3]</td><td>$row1[4]</td><td>$row1[5]</td><td>$row1[6]</td>";
				echo "</tr>";
			}
			echo "</table></font></center>";
		}
		if($count==2)
		{ 
			$result2=pg_query("SELECT * FROM don where center='".$_POST['Location']."' and blood_group='".$_POST['blood_group']."';")or die("Error occurred");
			$rows2=pg_num_rows($result2);
			if($rows2==0)
			{
				echo "<font style=color:red>No record found with the center ".$_POST['Location']." and Blood Group ".$_POST['blood_group']."!!</font>";
				exit;
			}
			echo "<center><font><table border=1 cellpadding=0 cellspacing=0 style='color: red;'>";
			echo "<th>Donor-id</th><th>Username</th><th>Blood Group</th><th>Gender</th><th>Age</th><th>Weight</th><th>Center</th>";
			while($row2=pg_fetch_row($result2))
			{
				echo "<tr>";
				echo "<td>$row2[0]</td><td>$row2[1]</td><td>$row2[2]</td><td>$row2[3]</td><td>$row2[4]</td><td>$row2[5]</td><td>$row2[6]</td>";
				echo "</tr>";
			}
			echo "</table></font></center>";
		}
		if($count==3)
		{ 
			$result3=pg_query("SELECT * FROM don where center='".$_POST['Location']."';")or die("Error occurred");
			$rows3=pg_num_rows($result3);
			if($rows3==0)
			{
				echo "<font style=color:red>No record found with the center ".$_POST['Location']." !!</font>";
				exit;
			}
			echo "<center><font><table border=1 cellpadding=0 cellspacing=0 style='color: red;'>";
			echo "<th>Donor-id</th><th>Username</th><th>Blood Group</th><th>Gender</th><th>Age</th><th>Weight</th><th>Center</th>";
			while($row3=pg_fetch_row($result3))
			{
				echo "<tr>";
				echo "<td>$row3[0]</td><td>$row3[1]</td><td>$row3[2]</td><td>$row3[3]</td><td>$row3[4]</td><td>$row3[5]</td><td>$row3[6]</td>";
				echo "</tr>";
			}
			echo "</table></font></center>";
		}
	}
	pg_close();
?>

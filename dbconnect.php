<?php
	$conn=pg_connect("host=192.168.16.1 user=AG6");
	if(!$conn)
	{
		echo "<font style=color:red>Database Failed to Connect!</font>";
	}
	else
	{
		echo "<font style=color:red>Database Connected!</font>";
	}
?>

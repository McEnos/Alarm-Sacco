<?php
 $servername = "localhost";
$dbusername = "root";
$dbpassword = "collonel";
$db = "Alarm_sacco";

		// Create connection
		$conn = mysqli_connect($servername, $dbusername, $dbpassword,$db);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
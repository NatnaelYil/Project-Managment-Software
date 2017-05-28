<?php

$fName = $_POST['fName'];
$lName = $_POST['lName'];
$uName = $_POST['uName'];
$pWord = $_POST['pWord'];
$job = $_POST['job'];
$uType = "e7e02872-a87b-11e6-baa0-5254005b5605"; //defaults as employee

echo $fName;

$servername = "localhost";
$username = "root";
$password = "4password";
$dbname = "Manage";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


if ($job == "Field Manager")
{
	$uType = "215cccba-a87c-11e6-baa0-5254005b5605"; //fm usertype
}
elseif ($job == "Project Manager")
{
	$uType = "10f5933f-a87c-11e6-baa0-5254005b5605"; //pm user type
}
else
{
	$uType = "e7e02872-a87b-11e6-baa0-5254005b5605"; //emp user type
}

//Create query
$query = "INSERT INTO User (name, password, userName, jobTitleID, userTypeID, isActive)";
$query = $query . " VALUES ('$fName $lName', '$pWord', '$uName', '$job', '$uType', 'ACTIVE') ";

echo $query;

//Issue query
//$result = mysql_query($query, $mysql_access);
mysqli_query($conn, $query)

$conn->close();
	//Redirect back to the cUser.php
	//header("Location: cUser.php");
?>

<script type="text/javascript">
    window.location = "uAdded.php";
</script>


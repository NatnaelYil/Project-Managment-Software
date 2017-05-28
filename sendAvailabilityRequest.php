<?php
  include("config.php");
  session_start();

  $userID = $_SESSION['userID'];

  $from = $_GET['from'];

  $to = $_GET['to'];

  $userSql = "SELECT userName FROM User WHERE userID = '$userID'";

  $userResults = mysqli_query($db,$userSql);
  $username = mysqli_fetch_all($userResults,MYSQLI_ASSOC)[0]['userName'];

  /*
  $username = '';
  while($userrow = mysql_fetch_assoc($userRows)) {

	$username = $userrow['userName'];

  } */




  $projectSql = "SELECT fieldManagerID FROM FieldManagerUser WHERE userID = '$userID'";

  $projectResults = mysqli_query($db,$projectSql);
  $projectRows = mysqli_fetch_all($projectResults,MYSQLI_ASSOC);

  foreach($projectRows as $row) {

	$fmID = $row['fieldManagerID'];

	$sql = "INSERT INTO UserNotification VALUES(UUID(), '$fmID', 'Availability Request from $username', '$username is requesting off work between $from and $to', 0)";
	mysqli_query($db,$sql);
	header("location: requestAvailability.php");

  }

?>

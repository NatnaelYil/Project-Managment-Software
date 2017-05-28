<?php
  include("config.php");
  session_start();

  $userID = $_SESSION['userID'];

  if(isset($_POST['skillID'])) {
    $skillID = $_POST['skillID'];

	$skillSql = "INSERT INTO UserSkill VALUES('$userID', '$skillID')";

	echo $skillSql;
  $skillResults = mysqli_query($db,$skillSql);
  }

?>
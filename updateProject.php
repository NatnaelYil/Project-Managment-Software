<?php
  include("config.php");
  session_start();

  $userID = $_SESSION['userID'];
  

  if(isset($_POST['projectID'])) {
    $description = $_POST['description'];
	$projectID = $_POST['projectID'];
	$userIDs = $_POST['userIDs'];
	$projectTitle = $_POST['projectTitle'];
	$isActive = '0';
	
	if($_POST['isActive'] === "true")
	{
	  $isActive = '1';
	}
	else
	{
	  $isActive = '0';
	}
	
	$projectSql = "UPDATE Project SET description = '$description', isActive = '$isActive' WHERE projectID = '$projectID'";
	
	
   $projectResults = mysqli_query($db,$projectSql);
  
  
	$projectSql = "Delete from UserProject where projectID = '$projectID' and userID <> '$userID'";

    $projectResults = mysqli_query($db,$projectSql);
	
	foreach ($userIDs as $id) {
		$projectSql = "INSERT INTO UserProject VALUES('$id', '$projectID')";

		$projectResults = mysqli_query($db,$projectSql);
		
		if($id != $userID)
		{
			$sql = "INSERT INTO UserNotification VALUES(UUID(), '$id', 'Project Request', 'You are requested to work on $projectTitle', 0)";
			mysqli_query($db,$sql);
		}
	  }
	
  }

?>
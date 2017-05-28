<?php
  include("config.php");
  session_start();

  $userID = $_SESSION['userID'];

  if(isset($_POST['name'])) {
      $name = $_POST['name'];
	  $projectSql = "SELECT projectID, title  FROM Project WHERE title LIKE '%{$name}%'";
  
	  $projectResults = mysqli_query($db,$projectSql);
	  $projectRows = mysqli_fetch_all($projectResults,MYSQLI_ASSOC);
	  
	  $emparray = array();
	  
	  foreach ($projectRows as $value) {
		$emparray[] = $value;
	  }
		
	 echo(json_encode($emparray));
  }

?>
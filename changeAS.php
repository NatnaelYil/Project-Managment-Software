<?php

	include("config.php");
	  session_start();

        $userID = $_POST['userID'];

		$projectSql = "UPDATE User SET isActive=
					CASE
					WHEN isActive = 0 THEN 1
					ELSE 0
					END 
					WHERE userID='" . $userID . "'";
		  $projectResults = mysqli_query($db,$projectSql);
		  $projectRows = mysqli_fetch_all($projectResults,MYSQLI_ASSOC);


?>

<script type="text/javascript">
   window.location = "aStatus1.php";
</script>

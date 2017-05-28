<?php
   include("config.php");
   session_start();

  $userID = $_SESSION['userID'];
	//Get the variables for new project
	$projTitle = $_POST['projTitle'];
    $projDesc = $_POST['projDesc'];
    $startD = $_POST['startD'];
    $projEnd = $_POST['projEnd'];
    $pActive = $_POST['pActive'];
	
	if($pActive == 'on')
	{
		$pActive = 1;
	}
	else
	{
		$pActive = 0;
	}

?>
  <?php
	function generate_uuid() {
	return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
		mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
		mt_rand( 0, 0xffff ),
		mt_rand( 0, 0x0fff ) | 0x4000,
		mt_rand( 0, 0x3fff ) | 0x8000,
		mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
	);
}

	$id = generate_uuid();
	//Create query
	$query = "INSERT INTO Project (projectID, title, description, startDate, endDate, isActive)";
	$query = $query . " VALUES ('$id', '$projTitle', '$projDesc', '$startD', '$projEnd', '$pActive') ";

	echo $query;

	//Issue query
	//$result = mysql_query($query, $mysql_access);
	
	if (mysqli_query($db, $query)) {
    echo "<br/>New record created successfully!";
} else {
    echo "<br/>Error: " . mysqli_error($db);
}
	$query = " INSERT INTO UserProject VALUES ('$userID', '$id') ";
	mysqli_query($db, $query);
	//Close connection
	//mysql_close($mysql_access);

	//Redirect back to the cUser.php
	//header("Location: cUser.php");
	header('Location: /pAdded.php');
?>
<script type="text/javascript">
    window.location = 'cUser.php';
</script>
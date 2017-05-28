<?php
   include("config.php");

   function generate_uuid() {
 	return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
 		mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
 		mt_rand( 0, 0xffff ),
 		mt_rand( 0, 0x0fff ) | 0x4000,
 		mt_rand( 0, 0x3fff ) | 0x8000,
 		mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
 	);
 }

	//Get the variables for new user
	      $fName = $_POST['fName'];
        $lName = $_POST['lName'];
        $uName = $_POST['uName'];
        $pWord = $_POST['pWord'];
        $job = $_POST['job'];
        $uType = "e7e02872-a87b-11e6-baa0-5254005b5605"; //defaults as employee
        $userID = generate_uuid();
	      $fManager = "0";




  //identify userTypeID
  if ($job == "3")
  {
    $uType = "215cccba-a87c-11e6-baa0-5254005b5605"; //fm usertype
  }
  elseif ($job == "5")
  {
    $uType = "10f5933f-a87c-11e6-baa0-5254005b5605"; //pm user type
  }
  else
  {
    $uType = "e7e02872-a87b-11e6-baa0-5254005b5605"; //emp user type
  }

	//Create query
	$query = "INSERT INTO User (userID, name, password, userName, jobTitleID, userTypeID, isActive)";
	$query = $query . " VALUES ('$userID', '$fName $lName', '$pWord', '$uName', '$job', '$uType', 1);";

  //START SECOND QUERY!!!!

  //check the field manager bassed off job
  if ($job == "1")
  {
    $fManager = "c5167cf0-b5c3-11e6-baa0-5254005b5605";
  }
  elseif ($job == "2")
  {
    $fManager = "2e515c3f-b5c4-11e6-baa0-5254005b5605";
  }
  elseif ($job == "4")
  {
    $fManager = "979e6754-b5c3-11e6-baa0-5254005b5605";
  }
  elseif ($job == "6")
  {
    $fManager = "87718143-b5c3-11e6-baa0-5254005b5605";
  }
  else
  {
    $fManager = "1";
  }

  //ADD TO QUERY
  //if ($fManager != "0")
  //{
    $query .= "INSERT INTO FieldManagerUser (fieldManagerID, userID)";
  	$query = $query . " VALUES ('$fManager', '$userID')";
  //}

	echo $query;
  echo $fManager;

if (mysqli_multi_query($db, $query)) {
    echo "<br/>New record created successfully!";
} else {
    echo "<br/>Error: " . mysqli_error($db);
}

        //Close connection
     //   mysql_close($db);

        //Redirect back to the cUser.php
        header("Location: uAdded.php");
?>
<!--script type="text/javascript">location.href = 'uAdded.php';</script>

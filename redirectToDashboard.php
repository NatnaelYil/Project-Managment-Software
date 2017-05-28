<?php
  include("config.php");
  session_start();

  $userID = $_SESSION['userID'];

  $sql = "SELECT userID, userTypeID FROM User WHERE userID = '$userID'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $userTypeID = $row['userTypeID'];
	  
      $count = mysqli_num_rows($result);
      // If result matched $myusername and $mypassword, table row must be 1 row
      if($count == 1) {
         $_SESSION['userID'] = $row['userID'];
         //add user 
		 if($userTypeID == 'e7e02872-a87b-11e6-baa0-5254005b5605') //Employee
		 {
			 header("location: empDash.php");
		 }
        else if($userTypeID == '10f5933f-a87c-11e6-baa0-5254005b5605') //pm
		 {
			 header("location: pmDash.php");
		 }
		 else if($userTypeID == '215cccba-a87c-11e6-baa0-5254005b5605') //fm
				  {
						  header("location: fmDash.php");
				  }
		 else if($userTypeID == '50be560a-a87c-11e6-baa0-5254005b5605') //admin
				  {
						  header("location: admin.php");
				  }
        else{
            header("location: welcome.php");
         }
      }else {
         header("location: login.php");
      }

?>
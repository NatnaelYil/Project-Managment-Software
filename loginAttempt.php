<?php
   include("config.php");
   session_start();

   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form

      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']);

      $sql = "SELECT userID, userTypeID FROM User WHERE userName = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
      $userTypeID = $row['userTypeID'];

      $count = mysqli_num_rows($result);
      // If result matched $myusername and $mypassword, table row must be 1 row
      if($count == 1) {
         $_SESSION['userID'] = $row['userID'];
         //add user
         $_SESSION['canEdit'] = '0';
		 if($userTypeID == 'e7e02872-a87b-11e6-baa0-5254005b5605') //Employee
		 {
			 header("location: empDash.php");
		 }
        else if($userTypeID == '10f5933f-a87c-11e6-baa0-5254005b5605') //pm
		 {
       $_SESSION['canEdit'] = '1';
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
   }
?>


<?php
/*
   include('config.php');
   session_start();

   $user_check = $_SESSION['login_user'];

   $ses_sql = mysqli_query($db,"select username from admin where username = '$user_check' ");

   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);

   $login_session = $row['username'];

   if(!isset($_SESSION['login_user'])){
      header("location:login.php");
   }
?>

<?php
   session_start();

   if(session_destroy()) {
      header("Location: login.php");
   }
?>

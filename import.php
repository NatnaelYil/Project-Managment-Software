<?php 
  include("config.php");
  session_start();
    
  $info = $_GET['info'];
  $data = json_decode($info, true);

  foreach ($data["users"] as &$user) {
    $name = $user["name"];
    $password = $user["password"];
    $userName = $user["userName"];
    $jobTitleID = $user["jobTitleID"];
    $userTypeID = $user["userTypeID"];
    $isActive = $user["isActive"];
      
    $sql = "INSERT INTO User VALUES(UUID(), '$name', '$password', '$userName', '$jobTitleID', '$userTypeID', $isActive)";
      
     mysqli_query($db,$sql);
    
  }
    header('location: admin.php');
?>
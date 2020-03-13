<?php

session_start();

include "DatabaseAdapter.php";
$theDB = new DatabaseAdaptor();
$_SESSION['profile_type'] = 'login';

  
  
$loginUsername = $_POST["loginUsername"];
$_SESSION['user_name']= $loginUsername;
$loginPwd = $_POST["loginPwd"];
echo json_encode($theDB ->userLogin($loginUsername,$loginPwd));

?>  
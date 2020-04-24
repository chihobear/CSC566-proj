<?php

session_start();

$_SESSION['profile_type'] = 'display';
  
$username = $_POST["user"];
$_SESSION['cur_user_name']= $username;

?>  
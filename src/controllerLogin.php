<?php

include "DatabaseAdapter.php";
$theDB = new DatabaseAdaptor();


  
  
$loginUsername = $_POST["loginUsername"];
$loginPwd = $_POST["loginPwd"];
echo json_encode($theDB ->userLogin($loginUsername,$loginPwd));

?>  
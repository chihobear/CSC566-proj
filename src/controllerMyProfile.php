<?php

include "DatabaseAdapter.php";
$theDB = new DatabaseAdaptor();



$user_name = $_POST["user_name"];

echo json_encode($theDB ->userInfo($user_name)); 
			   
?>  
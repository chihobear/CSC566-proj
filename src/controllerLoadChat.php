<?php

session_start();

include "DatabaseAdapter.php";
$theDB = new DatabaseAdaptor();



$user = $_SESSION['user_name'];
echo json_encode($theDB ->loadChat($user)); 
			   
?>  
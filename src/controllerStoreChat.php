<?php

session_start();

include "DatabaseAdapter.php";
$theDB = new DatabaseAdaptor();



$from_user = $_SESSION['user_name'];
$to_user = $_POST["to_user"];
$message = $_POST["message"];
$parent_ID = $_POST["parent_ID"];
echo json_encode($theDB ->insertChat($from_user, $to_user, $message, $parent_ID)); 
			   
?>  
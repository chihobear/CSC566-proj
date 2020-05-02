<?php

include "DatabaseAdapter.php";
$theDB = new DatabaseAdaptor();

if(isset($_POST["user"])){
	$user_name = $_POST["user"];
	unset($_POST["user"]);
	echo json_encode(($theDB->userInfoFromSignUp($user_name)));
}

if(isset($_POST["user_name"])){
	$user_name = $_POST["user_name"];
	unset($_POST["user_name"]);
	echo json_encode($theDB ->userInfo($user_name)); 
}

if(isset($_POST["location_str"])){
	$location_str = $_POST["location_str"];
	unset($_POST["location_str"]);
	$state = $_POST["state"];
	unset($_POST["state"]);
	echo json_encode($theDB->getLocation($location_str, $state));
}

if(isset($_POST["states"])){
	unset($_POST["states"]);
	echo json_encode($theDB->getStates());
}
		   
?>  
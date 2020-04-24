<?php

include "DatabaseAdapter.php";
$theDB = new DatabaseAdaptor();

if(isset($_POST["user"])){
	$user_name = $_POST["user"];
	$owner = $_POST["owner"];
	unset($_POST["user"]);
	echo json_encode(($theDB->deleteFavorite($user_name, $owner)));
}

if(isset($_POST["username"])){
	$user_name = $_POST["username"];
	$owner = $_POST["owner"];
	unset($_POST["user_name"]);
	echo json_encode($theDB ->addFavorite($user_name, $owner)); 
}
?> 
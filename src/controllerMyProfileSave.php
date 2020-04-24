<?php

include "DatabaseAdapter.php";
$theDB = new DatabaseAdaptor();


$user_name = $_POST["user_name"];
$role = $_POST["role"];
$name = $_POST["name"];
$age = $_POST["age"];
$location = $_POST["location"];
$contact = $_POST["contact"];
$self_intro = $_POST["self_intro"];
$pet_name = $_POST["pet_name"];
$pet_age = $_POST["pet_age"];
$pet_type = $_POST["pet_type"];
$pet_gender = $_POST["pet_gender"];
$pet_images = $_POST["pet_images"];
$pet_introduction = $_POST["pet_introduction"];

// $theDB ->myProfileSave($user_name); 
echo $pet_images
?>  
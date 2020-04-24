<?php

session_start();
$_SESSION['profile_type']= 'sign up' ;

include "DatabaseAdapter.php";
$theDB = new DatabaseAdaptor();



$firstName = $_POST["firstName"];
$lastName = $_POST["lastName"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$userName = $_POST["userName"];
$_SESSION['user_name']= $userName ;
$_SESSION['cur_user_name'] = $userName;
$pwd = $_POST["pwd"];
$adopter = $_POST["adopter"];
$sender = $_POST["sender"];
echo json_encode($theDB ->insertUser( $firstName,$lastName,
                   $phone, $email, $userName, $pwd, $adopter, $sender)); 
			   
?>  
<?php

include "DatabaseAdapter.php";
$theDB = new DatabaseAdaptor();

$loginUsername = $_GET["account"];
$loginPwd = $_GET["pwd"];
echo json_encode($theDB ->userLogin($loginUsername, $loginPwd)); 



$firstName = $_GET["firstName"];
$lastName = $_GET["lastName"];
$email = $_GET["email"];
$phone = $_GET["phone"];
$userName = $_GET["userName"];
$pwd = $_GET["pwd"];
echo json_encode($theDB ->insertUser($id, $first_name,$last_name,
                   $phone, $email, $username, $pwd)); 



?>  
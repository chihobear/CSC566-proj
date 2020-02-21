<?php

include "DatabaseAdapter.php";
$theDB = new DatabaseAdaptor();

$loginUsername = $_POST["account"];
$loginPwd = $_POST["pwd"];
echo json_encode($theDB ->userLogin($loginUsername, $loginPwd));



$firstName = $_POST["firstName"];
$lastName = $_POST["lastName"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$userName = $_POST["userName"];
$pwd = $_POST["pwd"];
echo json_encode($theDB ->insertUser($first_name,$last_name,
    $phone, $email, $username, $pwd));



?>  
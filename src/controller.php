<?php

include "DatabaseAdapter.php";
$theDB = new DatabaseAdaptor();

<<<<<<< HEAD
=======
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
>>>>>>> 14e77f8828205dc50df3a230faf9043d07e91f02

$firstName = $_POST["firstName"];
$lastName = $_POST["lastName"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$userName = $_POST["userName"];
$pwd = $_POST["pwd"];
echo json_encode($theDB ->insertUser( $firstName,$lastName,
                   $phone, $email, $userName, $pwd)); 


?>  
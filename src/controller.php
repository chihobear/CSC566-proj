<?php

include "DatabaseAdapter.php";
$theDB = new DatabaseAdaptor();


$firstName = $_POST["firstName"];
$lastName = $_POST["lastName"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$userName = $_POST["userName"];
$pwd = $_POST["pwd"];
echo json_encode($theDB ->insertUser( $firstName,$lastName,
                   $phone, $email, $userName, $pwd)); 


?>  
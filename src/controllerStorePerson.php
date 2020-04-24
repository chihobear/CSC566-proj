<?php

include "DatabaseAdapter.php";
$theDB = new DatabaseAdaptor();	   
$role = $_POST["role"];
$userName = $_POST["userName"];
$firstName = $_POST["firstName"];
$lastName = $_POST["lastName"];
$age = $_POST["age"];
$location = $_POST["location"];
$contact = $_POST["contact"];
$person_intro = $_POST["person_intro"];
$theDB ->storePerson($role, $userName, $firstName, $lastName, $age, $location, $contact, $person_intro);
?>  
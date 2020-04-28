<?php

session_start();

include "DatabaseAdapter.php";
$theDB = new DatabaseAdaptor();

$from_user = $_POST["from_user"];


echo json_encode($theDB ->userType($from_user));

?>  
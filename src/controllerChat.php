<?php

session_start();

include "DatabaseAdapter.php";
$theDB = new DatabaseAdaptor();

$from_user = $_POST["from_user"];
$to_user = $_POST["to_user"];
$message = $_POST["message"];
$messID = $_POST["messID"];
echo json_encode($theDB ->chat($from_user,$to_user,$message,$messID));

?>  
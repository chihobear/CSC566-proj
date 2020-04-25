<?php

session_start();

include "DatabaseAdapter.php";
$theDB = new DatabaseAdaptor();

$from_user = $_POST["from_user"];
$to_user = $_POST["to_user"];

echo json_encode($theDB ->chatDisplay($from_user,$to_user));

?>  
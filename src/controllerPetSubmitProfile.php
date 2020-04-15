<?php



include "DatabaseAdapter.php";
$theDB = new DatabaseAdaptor();



$petName = $_POST["petName"];
$petType = $_POST["petType"];
$petBreed = $_POST["petBreed"];
$petAge = $_POST["petAge"];
$petGender = $_POST["petGender"];
$petInfo = $_POST["petInfo"];
$petImage =  json_decode( $_POST['petImage'], true );
$petOwner = $_POST["petOwner"];

echo json_encode($theDB ->insertPet( $petName,$petType,
                   $petBreed,$petAge, $petGender, $petInfo, $petImage, $petOwner)); 
			   
?>  
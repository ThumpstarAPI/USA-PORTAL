<?php

session_start();
require_once("../DealerController.php");
// if($_SERVER['REQUEST_METHOD'] !== "POST")header("Location:../logout.php");

$dealerID = $_SESSION['dealerID'];
$controller = new DealerController();
$controller->setDealerID($dealerID);
$controller->setContact($_POST['contact_number']);
$controller->setAddress($_POST['address']);
$controller->setRegion($_POST['region']);
$controller->setTown($_POST['town']);
$controller->setZipCode($_POST['zip']);
$validations = $controller->validateInfoEntry();

if(count($validations) === 0){
   $updateInfo = $controller->updateDealerInfo();
   echo json_encode($updateInfo);
   exit();
}else{
    echo json_encode($validations);
    exit();
}

?>
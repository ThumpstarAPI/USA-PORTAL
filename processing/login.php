<?php
session_start();
require_once("../DealerController.php");
// if($_SERVER['REQUEST_METHOD'] !== "POST")header("Location:../logout.php");

$controller = new DealerController();
$controller->setEmail($_POST['email']);
$controller->setPassword($_POST['password']);
$response = $controller->login();
$_SESSION['dealerID'] = $controller->getDealerID();

echo json_encode($response); 
?>
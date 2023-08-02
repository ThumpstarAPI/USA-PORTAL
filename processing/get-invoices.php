<?php

session_start();
require_once("../DealerController.php");
// if($_SERVER['REQUEST_METHOD'] !== "POST")header("Location:../logout.php");
$dealerID = $_SESSION['dealerID'];
$controller = new DealerController();
$controller->setDealerID($dealerID);
$inventory = $controller->getInvoice();

echo json_encode($inventory);

?>
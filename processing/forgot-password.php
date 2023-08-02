<?php
session_start();
require_once("../DealerController.php");

$controller = new DealerController;
$controller->setEmail($_POST['email']);
$resetPassword = $controller->forgotPassword();
$_SESSION['dealerID'] = $controller->getDealerID();

echo json_encode($resetPassword);

?>
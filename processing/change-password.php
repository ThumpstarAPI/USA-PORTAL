<?php
session_start();
require_once("../DealerController.php");

if($_SERVER['REQUEST_METHOD'] !== "POST")header("Location:../logout.php");
$controller = new DealerController();
$password = $controller->setPassword($_POST['password']);
$confPassword = $controller->setConfPassword($_POST['conf_password']);
$controller->setDealerID($_SESSION['dealerID']);    
$password = $_POST['password'];
$confPassword = $_POST['conf_password'];
$validate = $controller->validatePassword();

if(count($validate) > 0){
    echo json_encode($validate);
    exit();
}

$changePass = $controller->changePassword();

if($changePass){
    $toNonDefault = $controller->updateToNonDefault();
    echo json_encode($toNonDefault);
    exit();
}

echo json_encode($changePass);

?>

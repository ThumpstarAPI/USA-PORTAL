<?php
    session_start();
    require_once("../DealerController.php");
    // if($_SERVER['REQUEST_METHOD'] !== "POST")header("Location:../logout.php");

    $dealerID = $_SESSION['dealerID'];
    
    $controller = new DealerController();
    $controller->setVINNumber($_POST['vin_number']);
    $controller->setOrderNumber($_POST['order_number']);
    $controller->setModel($_POST['model']);
    $controller->setType($_POST['type']);
    $controller->setDateOfPurchase($_POST['date_purchased']);
    $controller->setCustomerName($_POST['customer_name']);
    $refNumber = $controller->generateRefNumber();
    $controller->setVINRefNumber($refNumber);
    $controller->setDealerID($dealerID);
    $controller->setVINReceipt($_FILES['supporting_file']);
    $controller->setEmail($_POST['email']);
    $controller->setCompanyName($_POST['dealership']);


   $validation =  $controller->validateVINEntry();
   if(count($validation) === 0){
    $saveVINRegistration = $controller->saveVINRegistration();
    echo json_encode($saveVINRegistration);
    exit();
   }else{
    echo json_encode($validation);
    exit();
   }

?>

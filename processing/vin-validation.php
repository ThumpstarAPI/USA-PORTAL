<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
include '../api-calls.php';
$vin_validation = new ThumpstarApiCalls;


//Hold success or error message in saving vin-validation
$_SESSION['message'] = '';

//Syntax for saving the form.
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $vin = strtoupper($_POST['vin_number']);
    $company = $_POST['company'];
    $country = $_POST['country'];
    $email = $_POST['email'];
    $order_number = $_POST['order_number'];
    $model = $_POST['model'];
    $purchase_date = $_POST['date_purchased'];
    $customer = strtoupper($_POST['customer_name']);
    $type = $_POST['type'];


    $values = [
        ['',$vin,$company,$customer,$email,'','','',$purchase_date,$country,$model,$order_number,'',$type]
    ];
    print_r($values);   
    $validate = $vin_validation->insertSheetData("1x7igPtF6lNNsqN8eF4fzj7yXwhjuRSRBGan2YOfyuhs","DASHBOARD!A:M",$values,"vin-credentials.json");

    if($validate){
        $_SESSION['message'] =  "save";
        header('Location:../vin-validation.php');
    
//     //Sends an email to Thumpstar
//     $mail = new PHPMailer();
//     $mail->setFrom('warranty@thumpstar.com', 'Thumpstar Motorcycles'); //Sender of email
//     $mail->addAddress('contact@thumpstar.com.au', '');     // Recipients of the mail.
//     // $mail->addAddress('thumpstarapi@gmail.com', ''); // Test email by Mike
//     $mail->IsHTML(true);  // Set email format to HTML
//     $mail->Subject = 'VIN Validation';
//     $mail->Body .= '<p style="letter-spacing: 1px;margin-bottom: 10px;">A VIN Validation has been submitted.</p>';
//     $mail->Body .= '<br style="margin:0">';
//     $mail->Body .= '<hr style="margin:0">';
//     $mail->Body .= '<br style="margin:0">';
//     $mail->Body .= '<p style="letter-spacing: 1px;margin-bottom: 10px;"><b>BIKE MODEL: </b>' . $model . '</p>';
//     $mail->Body .= '<p style="letter-spacing: 1px;margin-bottom: 10px;"><b>PURCHASE DATE: </b>' . $purchase_date . '</p>';
//     // $mail->Body .= '<p style="letter-spacing: 1px;margin-bottom: 10px;"><b>REFERENCE: </b>' . $ref_no . '</p>';
//     $mail->Body .= '<p style="letter-spacing: 1px;margin-bottom: 10px;"><b>ORDER NUMBER: </b>' . $order_number . '</p>';
//     $mail->Body .= '<p style="letter-spacing: 1px;margin-bottom: 10px;"><b>VIN : </b>' . $vin . '</p>';
//     $mail->Body .= '<br style="margin:0">';
//     $mail->Body .= '<hr style="margin:0">';
//     $mail->Body .= '<br style="margin:0">';
//     $mail->Body .= '<p style="letter-spacing: 1px;margin-bottom: 10px;"><b>CUSTOMER NAME: </b>' . $fullname . '</p>';
//     $mail->Body .= '<p style="letter-spacing: 1px;margin-bottom: 10px;"><b>EMAIL ADDRESS: </b>' . $email . '</p>';
//     // $mail->Body .= '<p style="letter-spacing: 1px;margin-bottom: 10px;"><b>TELEPHONE: </b>' . $telephone . '</p>';
//     // $mail->Body .= '<p style="letter-spacing: 1px;margin-bottom: 10px;"><b>CELLPHONE: </b>' . $cellphone . '</p>';
//     // $mail->Body .= '<p style="letter-spacing: 1px;margin-bottom: 10px;"><b>CUSTOMER ADDRESS: </b>' . $address . '</p>';
//     $mail->Body .= '<p style="letter-spacing: 1px;margin-bottom: 10px;"><b>COUNTRY: </b>' . $country . '</p>';
//     $mail->Body .= '<br style="margin:0">';
//     $mail->Body .= '<hr style="margin:0">';
//     $mail->Body .= '<br style="margin:0">';
    
//    //Checks if there is an uploaded image.
//     if(array_key_exists('supporting_file', $_FILES)){
//         for ($i = 0; $i < count($_FILES['supporting_file']['tmp_name']); $i++) {
//             $uploadfile = tempnam(sys_get_temp_dir(), hash('sha256', $_FILES['supporting_file']['name'][$i]));
//             $filename = $_FILES['supporting_file']['name'][$i];

//                 if (move_uploaded_file($_FILES['supporting_file']['tmp_name'][$i], $uploadfile)) {
//                     $mail->addAttachment($uploadfile, $filename);
//                 } else {
//                     $msg .= 'Failed to move file to ' . $uploadfile;
//                 }
//         }
//     }
    
//     $send_thumpstar_mail = $mail->send();


//     //Send an email to the customers or dealers
//     $customer_mail = new PHPMailer();
//     $customer_mail->setFrom('noreply@thumpstar.com', 'Thumpstar Warranty');
//     $customer_mail->addAddress($email);
//     $customer_mail->Subject = "Thumpstar Warranty";
//     $customer_mail->IsHTML(true);
//     $customer_mail->Body = "Dear ". "" . $fullname . ",";
//     $customer_mail->Body .= '<p style="letter-spacing: 1px;margin-bottom: 10px;"> This is to confirm that your <b>WARRANTY VALIDATION </b> request has been received. </p>';
//     $customer_mail->Body .= '<br style="margin:0">';
//     $customer_mail->Body .= '<hr style="margin:0">';
//     $customer_mail->Body .= '<br style="margin:0">';
//     $customer_mail->Body .= '<p style="letter-spacing: 1px;margin-bottom: 10px;"> Our team needs to check if the details that were submitted is valid and once accepted will be a credit of $25 to your parts account </p>';
//     $customer_mail->Body .= '<br style="margin:0">';
//     $customer_mail->Body .= '<hr style="margin:0">';
//     $customer_mail->Body .= '<br style="margin:0">';
//     $customer_mail->Body .= '<p style="letter-spacing: 1px;margin-bottom: 10px;"> Please check the details below are correct, if the VIN number does not match exactly then the credit will not be added</p>';
//     $customer_mail->Body .= '<br style="margin:0">';
//     $customer_mail->Body .= '<hr style="margin:0">';
//     $customer_mail->Body .= '<br style="margin:0">';
//     $customer_mail->Body .= '<p style="letter-spacing: 1px;margin-bottom: 10px;"> Please resubmit if there is a mistake below</p>';
//     $customer_mail->Body .= '<br style="margin:0">';
//     $customer_mail->Body .= '<hr style="margin:0">';
//     $customer_mail->Body .= '<br style="margin:0">';
//     $customer_mail->Body .= '<p style="letter-spacing: 1px;margin-bottom: 10px;"> ORDER NUMBER: <b>' .$order_number . '<b></p>';
//     $customer_mail->Body .= '<p style="letter-spacing: 1px;margin-bottom: 10px;"> Model: <b>'.$model . '</b></p>';
//     $customer_mail->Body .= '<p style="letter-spacing: 1px;margin-bottom: 10px;"> VIN Number: <b>'.$vin . '</b></p>';
//     $customer_mail->Body .= '<br style="margin:0">';
//     $customer_mail->Body .= '<hr style="margin:0">';
//     $customer_mail->Body .= '<br style="margin:0">';
//     $send_customer_mail = $customer_mail->send();

//         if($send_customer_mail && $send_thumpstar_mail){
//             $_SESION['message'] = "save";
//             header('Location:../vin-validation.php');
//         }else{
//             $_SESION['message'] = "error";
//             header('Location:../vin-validation.php');

//         }
        
    }else{
        $_SESION['message'] = "error";
        header('Location:../vin-validation.php');
    }

}


?>

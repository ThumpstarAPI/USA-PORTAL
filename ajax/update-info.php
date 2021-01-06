<?php

include '../api-calls.php';

$msg = '';
$update_info = new ThumpstarApiCalls();
/**
 * Updates dealer information
 * 
 */
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $id = $_POST['id'] + 2;
    
    $range = "dealersUS!E".$id .":J" .$id ; 
    $postal = $_POST['postal'];
    $billing = $_POST['billing'];
    $town = $_POST['town'];
    $contact = $_POST['contact'];

    $values = [
        [$contact,$billing,'','',$postal,$town]
    ];

    $update = $update_info->updateSheetData("1TQNxvzCS2itSJMyfdDUWF0vGASzmeQk4l2CXwgCvB58",$range,$values,"portal-credentials.json");

    if($update){
    $current_info = $update_info->viewSheetData("1TQNxvzCS2itSJMyfdDUWF0vGASzmeQk4l2CXwgCvB58",$range,"portal-credentials.json");    

        //SEND EMAIL TO THUMPSTAR

        $mail = new PHPMailer();
        $mail->setFrom('warranty@thumpstar.com', 'Thumpstar Motorcycles'); //Sender of email
        // $mail->addAddress('contact@thumpstar.com.au', '');     // Recipients of the mail.
        $mail->addAddress('thumpstarapi@gmail.com', ''); 
        $mail->IsHTML(true);  // Set email format to HTML
        $mail->Subject = "Dealer Information Update";
        $mail->Body = ' <p style="letter-spacing: 1px;margin-bottom: 10px;">' . $current_info[0][0] . " " . $current_info[0][1]. " from ". "<b>" .$current_info[0][3]. "</b>".' has updated their contact and billing information. </p>';
        $mail->Body .= '<br style="margin:0">';
        $mail->Body .= '<hr style="margin:0">';
        $mail->Body .= '<br style="margin:0">';
        $mail->Body .= '<p style="letter-spacing: 1px;margin-bottom: 10px;"> From: </p>';
        $mail->Body .= '<p style="letter-spacing: 1px;margin-bottom: 10px;"><b>Contact Number: </b>' .  $current_info[0][4] . '</p>';
        $mail->Body .= '<p style="letter-spacing: 1px;margin-bottom: 10px;"><b>Billing Address: </b>' . $current_info[0][5] . '</p>';
        $mail->Body .= '<p style="letter-spacing: 1px;margin-bottom: 10px;"><b>Postal Code: </b>' . $current_info[0][8] . '</p>';
        $mail->Body .= '<p style="letter-spacing: 1px;margin-bottom: 10px;"><b>Town/City: </b>' . $current_info[0][9] . '</p>';

        $mail->Body .= '<br style="margin:0">';
        $mail->Body .= '<hr style="margin:0">';
        $mail->Body .= '<br style="margin:0">';
        $mail->Body .= '<p style="letter-spacing: 1px;margin-bottom: 10px;"> To: </p>';
        $mail->Body .= '<p style="letter-spacing: 1px;margin-bottom: 10px;"><b>Contact Number: </b>' . $contact . '</p>';
        $mail->Body .= '<p style="letter-spacing: 1px;margin-bottom: 10px;"><b>Billing Addres: </b>' . $billing . '</p>';
        $mail->Body .= '<p style="letter-spacing: 1px;margin-bottom: 10px;"><b>Postal Code: </b>' .$postal . '</p>';
        $mail->Body .= '<p style="letter-spacing: 1px;margin-bottom: 10px;"><b>Town/City: </b>' . $town . '</p>';
        $mail->Body .= '<br style="margin:0">';
        $mail->Body .= '<hr style="margin:0">';
        $mail->Body .= '<br style="margin:0">';
        $send_thumpstar_mail = $mail->send();

        if($send_thumpstar_mail){
            $msg = 'saved';
        }else{
            $msg = 'error';

        }
    }
    $send_msg = array("message"=> $msg);
    echo json_encode($send_msg);
}



?>
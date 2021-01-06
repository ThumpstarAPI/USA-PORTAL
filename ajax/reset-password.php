<?php
use PHPMailer\PHPMailer\PHPMailer;
include '../api-calls.php';

$msg = '';
// if($_SERVER['REQUEST_METHOD'] == "POST"){
    $reset_password = new ThumpstarApiCalls;
    $row_number = $_POST['dealer_id']+2;
    $email = $_POST['email'];
    $password = randomPassword();
    $hashed_password = sha1($password);
    $range = "dealersUS!L".$row_number;
    $values = [ [$hashed_password] ];
    $reset = $reset_password->updateSheetData("1TQNxvzCS2itSJMyfdDUWF0vGASzmeQk4l2CXwgCvB58",$range,$values,"portal-credentials.json");
    
    if($reset){
        $customer_mail = new PHPMailer();
        $customer_mail->setFrom('noreply@thumpstar.com', 'Thumpstar Warranty');
        $customer_mail->addAddress($email);
        $customer_mail->Subject = "Thumpstar Dealer Password Reset";
        $customer_mail->IsHTML(true);
        $customer_mail->Body = "Hello ". "" . $email . ",";
        $customer_mail->Body .= '<p style="letter-spacing: 1px;margin-bottom: 10px;">We have reset your password. </p>';
        $customer_mail->Body .= '<br style="margin:0">';
        $customer_mail->Body .= '<p style="letter-spacing: 1px;margin-bottom: 10px;">Your new password is: <b>' . $password .'</b>. </p>';
        $customer_mail->Body .= '<br style="margin:0">';
        $customer_mail->Body .= '<br style="margin:0">';
        $customer_mail->Body .= '<p style="letter-spacing: 1px;margin-bottom: 10px;">Please do change your password after logging in.</p>';
        $send_customer_mail = $customer_mail->send();

        if($send_customer_mail){
            $msg ='saved';
        }
    }
// }
$send_msg = array("message"=>$msg);
echo json_encode($send_msg);

/**
 * This function generates random string when reseting the password of the dealer.
 *
 * @return void
 */
function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

?>

<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
include '../api-calls.php';
$customer_warranty = new ThumpstarApiCalls;


$_SESSION['message'] = '';
$_SESSION['captacha_message'] = '';
$msg = '';
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $engine_number = $_POST['engine_number'];
    $vin_number = $_POST['vin_number'];
    $order_number = $_POST['order_number'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $model = $_POST['model'];
    $date_purchased = $_POST['date_purchased'];
    $curr_date = date("Ymd");
    $refrence_number = "AUCW-" .$curr_date . "-".rand(pow(10, 5-1), pow(10, 5)-1);

    $values = [
        [$refrence_number,$vin_number,$engine_number,$order_number,$model,$fullname,$email,$date_purchased]
    ];
    print_r($values);   



    if(empty($_POST['g-recaptcha-response'])){
        $_SESSION['captacha_message'] = 'empty';
        header("Location:../customer-warranty-au.php");
    }else{
        $secret_key = '6LdhSvsZAAAAALQ2m3TvQZF7eje2UNcbVVcCEMvM';
        $response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret_key.'&response='.$_POST['g-recaptcha-response']);
        $response_data = json_decode($response);

        $register = $customer_warranty->insertSheetData("1x7igPtF6lNNsqN8eF4fzj7yXwhjuRSRBGan2YOfyuhs","DASHBOARD AU!A2:G",$values,'vin-credentials.json');

            if($register){

            //Sends an email to Thumpstar
            $mail = new PHPMailer();
            $mail->setFrom('warranty@thumpstar.com', 'Thumpstar Motorcycles'); //Sender of email
            $mail->addAddress('contact@thumpstar.com.au', '');     // Recipients of the mail.
            // $mail->addAddress('thumpstarapi@gmail.com', ''); // Test email by Mike
            $mail->IsHTML(true); 
            $mail->Subject = 'AU-CUSTOMER WARRANTY REGISTRATION';
            $mail->Body .= '<p style="letter-spacing: 1px;margin-bottom: 10px;">A customer warranty registration was submitted.</p>';
            $mail->Body .= '<br style="margin:0">';
            $mail->Body .= '<hr style="margin:0">';
            $mail->Body .= '<br style="margin:0">';
            $mail->Body .= '<p style="letter-spacing: 1px;margin-bottom: 10px;"><b>BIKE MODEL: </b>' . $model . '</p>';
            $mail->Body .= '<p style="letter-spacing: 1px;margin-bottom: 10px;"><b>VIN : </b>' . $vin_number . '</p>';
            $mail->Body .= '<p style="letter-spacing: 1px;margin-bottom: 10px;"><b>ORDER NUMBER: </b>' . $order_number . '</p>';
            $mail->Body .= '<p style="letter-spacing: 1px;margin-bottom: 10px;"><b>PURCHASE DATE: </b>' . $date_purchased . '</p>';
            $mail->Body .= '<br style="margin:0">';
            $mail->Body .= '<hr style="margin:0">';
            $mail->Body .= '<br style="margin:0">';
            $mail->Body .= '<p style="letter-spacing: 1px;margin-bottom: 10px;"><b>CUSTOMER NAME: </b>' . $fullname . '</p>';
            $mail->Body .= '<p style="letter-spacing: 1px;margin-bottom: 10px;"><b>EMAIL ADDRESS: </b>' . $email . '</p>';
            $mail->Body .= '<p style="letter-spacing: 1px;margin-bottom: 10px;"><b>COUNTRY: </b> AUSTRALIA </p>';
            $mail->Body .= '<br style="margin:0">';
            $mail->Body .= '<hr style="margin:0">';
            $mail->Body .= '<br style="margin:0">';
            
        //Checks if there is an uploaded image.
            if(array_key_exists('supporting_file', $_FILES)){
                for ($i = 0; $i < count($_FILES['supporting_file']['tmp_name']); $i++) {
                    $uploadfile = tempnam(sys_get_temp_dir(), hash('sha256', $_FILES['supporting_file']['name'][$i]));
                    $filename = $_FILES['supporting_file']['name'][$i];

                        if (move_uploaded_file($_FILES['supporting_file']['tmp_name'][$i], $uploadfile)) {
                            $mail->addAttachment($uploadfile, $filename);
                        } else {
                            $msg .= 'Failed to move file to ' . $uploadfile;
                        }
                }
            }
            
            $send_thumpstar_mail = $mail->send();    

            if( $send_thumpstar_mail){
                $_SESSION['message'] = "save";
                header("Location:../customer-warranty-au.php");
            }else{
                $_SESSION['message'] = "error";
                header("Location:../customer-warranty-au.php");
            }
                
            }else{
                $_SESSION['message'] = "error";
                header("Location:../customer-warranty-au.php");
            }
        if(!$response_data->success){
            $captcha_error = 'CAPTCHA VERIFICATION FAILED!';
        }
    }

    echo $_SESSION['message'] .'<br>';
    echo $_SESSION['captacha_message'] .'<br>';

}

?>
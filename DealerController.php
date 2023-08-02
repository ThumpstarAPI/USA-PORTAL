<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

class DealerController{
    
    private $dbUsername = "root";
    private $dbPassword = "";
    private $dbHost = "localhost";
    private $dbSchema = "thumpstar_us";
    private $dbConnect;
    private $email;
    private $password;
    private $firstname;
    private $lastname;
    private $contact;
    private $address;
    private $town;
    private $region;
    private $zipCode;
    private $vinNumber;
    private $orderNumber;
    private $model;
    private $type;
    private $customerName;
    private $dateOfPurchase;
    private $dealerID;
    private $vinRefNumber;
    private $vinReceipt;
    private $confPassword;
    private $companyName;



    public function __construct(){
        $this->dbConnect = new mysqli($this->dbHost,$this->dbUsername,$this->dbPassword,$this->dbSchema);
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function setPassword($password){
        $this->password = $password;
    }

    public function setConfPassword($confPassword){
         $this->confPassword = $confPassword;
    }

    public function setDealerID($dealerID){
        $this->dealerID = $dealerID;
    }

    public function setVINNumber($vinNumber){
        $this->vinNumber = $vinNumber;
    }

    public function setOrderNumber($orderNumber){
        $this->orderNumber = $orderNumber;
    }

    public function setModel($model){
        $this->model = $model;
    }

    public function setType($type){
        $this->type = $type;
    }

    public function setCustomerName($customerName){
        $this->customerName = $customerName;

    }
    
    public function setDateOfPurchase($dateOfPurchase){
        $this->dateOfPurchase = $dateOfPurchase;

    }

    public function setVINRefNumber($vinRefNumber){
        $this->vinRefNumber = $vinRefNumber;
    }

    public function setVINReceipt($vinReceipt){
        $this->vinReceipt = $vinReceipt;
    }

    public function setFirstname($firstname){
        $this->firstname = $firstname;
    }
    
    public function setLastname($lastname){
        $this->lastname = $lastname;
    }

    public function setRegion($region){
        $this->region = $region;
    }

    public function setTown($town){
        $this->town = $town;
    }

    public function setContact($contact){
        $this->contact = $contact;
    }

    public function setAddress($address){
        $this->address = $address;
    }

    public function setZipCode($zipCode){
        $this->zipCode = $zipCode;
    }

    public function setCompanyName($companyName){
        $this->companyName = $companyName;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getPassword(){
        return $this->password;
    }

    public function getConfPassword(){
        return $this->confPassword;
    }

    public function getDealerID(){
        return $this->dealerID;
    }

    public function getVINNumber(){
        return $this->vinNumber;
    }

    public function getOrderNumber(){
        return $this->orderNumber;
    }

    public function getModel(){
        return $this->model;
    }

    public function getType(){
        return $this->type;
    }

    public function getCustomerName(){
        return $this->customerName;

    }
    
    public function getDateOfPurchase(){
        return $this->dateOfPurchase;

    }

    public function getVINRefNumber(){
        return $this->vinRefNumber;
    }

    public function getVINReceipt(){
        return $this->vinReceipt;
    }

    public function getFirstname(){
       return $this->firstname;
    }
    
    public function getLastname(){
        return $this->lastname;
    }

    public function getRegion(){
        return $this->region;
    }

    public function getTown(){
        return $this->town;
    }

    public function getContact(){
       return $this->contact;
    }

    public function getAddress(){
       return $this->address;
    }

    public function getZipCode(){
        return $this->zipCode;
    }

    public function getCompanyName(){
        return $this->companyName;
    }



    public function checkConnection(){
        if(!$this->dbConnect){
            return header("HTTP/1.1 404 Not Found");
        }

        return true;
    }

    public function login(){
       $email = $this->getEmail();
       $password = $this->getPassword();
     
       $query = $this->dbConnect->prepare("call client_login(?)");
       $query->bind_param("s",$email);
       $query->execute();
       $result = $query->get_result();
       $rs = $result->fetch_assoc();

       if($result->num_rows == 0) return false;
       if(!password_verify($password,$rs['password'])) return false;
       
       $this->setDealerID($rs['dealerID']);
       return $rs['isDefault'];

    }


    public function viewDealerDetail(){
        $dealerID = $this->getDealerID();
        $query = $this->dbConnect->prepare("call get_dealer_info(?)");
        $query->bind_param("s",$dealerID);
        $query->execute();
        $result = $query->get_result();
        $rs = $result->fetch_array();
        $response = array(
            "firstname" => $rs['firstname'],
            "lastname" => $rs['lastname'],
            "contactNumber" => $rs['contactNumber'],
            "address" => $rs['address'],
            "region" => $rs['region'],
            "town" => $rs['town'],
            "zipCode" => $rs['zipCode'],
            "email" => $rs['email'],
            "company" => $rs['companyName']
        );

        return $response;


    }

    public function viewInventory(){
        $dealerID = $this->getDealerID();
        $query = $this->dbConnect->prepare("call get_dealer_inventory(?)");
        $query->bind_param("s",$dealerID);
        $query->execute();
        $result = $query->get_result();
        $response =array();
        

        while($row =$result->fetch_array()){
            $stock = 1;

            if($row['isSold'] === "Y"){
                $stock = 0;
            }

            $res = array(
                "vinNumber" => $row['vinNumber'],
                "engineNumber" => $row['engineNumber'],
                "model" => $row['model'],
                "shipment" => $row["shipment"],
                "stock" => $stock
            );

            array_push($response,$res);

        }
        return $response;
    }

    public function viewCreditOwing(){

    }

    public function getInvoice(){
        $dealerID = $this->getDealerID();
        $query = $this->dbConnect->prepare("call get_invoices(?)");
        $query->bind_param("s",$dealerID);
        $query->execute();
        $result = $query->get_result();
        $response =array();
        

        while($row =$result->fetch_array()){

            $res = array(
                "date" => $row['date'],
                "invoiceNumber" => $row['invoiceNumber'],
                "amount" => $row['amount']
            );

            array_push($response,$res);

        }
        return $response;
    }

    public function viewCreditEarned(){
        $dealerID = $this->getDealerID();
        $query = $this->dbConnect->prepare("call get_credit_earned(?)");
        $query->bind_param("s",$dealerID);
        $query->execute();
        $result = $query->get_result();
        $rs = $result->fetch_assoc();

        $credit = $rs['sold'] * 25.00;
        return number_format((float)$credit, 2, '.', '');
    }

    public function viewCreditBalance(){
        $totalInvoice = $this->getSumInvoice();
        $totalEarned =$this->viewCreditEarned();

        $diff = $totalEarned - $totalInvoice;
        return number_format((float)$diff, 2, '.', '');
    }

    public function getSumInvoice(){
        $dealerID = $this->getDealerID();
        $query = $this->dbConnect->prepare("call get_sum_invoice(?)");
        $query->bind_param("s",$dealerID);
        $query->execute();
        $result = $query->get_result();
        $rs = $result->fetch_assoc();
        $total = $rs['amount'];

        return number_format((float)$total, 2, '.', '');
    }

    public function saveVINRegistration(){
        $vinNumber = $this->getVINNumber();
        $orderNumber = $this->getOrderNumber();
        $model = $this->getModel();
        $type = $this->getType();
        $dateOfPurchase = $this->getDateOfPurchase();
        $customerName = $this->getCustomerName();
        $dealerID = $this->getDealerID();
        $refNumber = $this->getVINRefNumber();
        $uploadPath = $this->saveVINReceipt();

        $inputs = array(gettype($dealerID),$refNumber,$vinNumber,$orderNumber,$customerName,$model,$type,$dateOfPurchase,$uploadPath);

        if(!$uploadPath) return false;


        $query = $this->dbConnect->prepare('call save_vin_registration(?,?,?,?,?,?,?,?,?)');
        $query->bind_param("sssssssss",$dealerID,$refNumber,$vinNumber,$orderNumber,$customerName,$model,$type,$dateOfPurchase,$uploadPath);
        $query->execute();

        if($query->affected_rows > 0){
            $toAdmin = $this->mailToAdmin();
            $toClient = $this->mailToCustomer();

            if($toAdmin && $toClient){
                return true;
            }
        } 

        return false;


    }

    public function updateDealerInfo(){
        $contact = $this->getContact();
        $address = $this->getAddress();
        $town = $this->getTown();
        $region = $this->getRegion();
        $zipCode = $this->getZipCode();
        $dealerID = $this->getDealerID();

        $query = $this->dbConnect->prepare("call update_dealer_info(?,?,?,?,?,?)");
        $query->bind_param("ssssss",$dealerID,$contact,$address,$town,$region,$zipCode);
        $query->execute();

        if($query->affected_rows > 0) return true;

        return false;


    }

    /**
     * reference number
     */
    public function generateRefNumber(){
        $maxRegID = $this->getMaxRegID();
        $date = date("mdy");
        $refNumber = "USAVIN-{$maxRegID}-{$date}";

        return $refNumber;

    }


    public function getMaxRegID(){
        $query = $this->dbConnect->prepare("call getMaxRegID()");
        $query->execute();
        $rs = $query->get_result();
        $result = $rs->fetch_assoc();
        $maxRegID = $result['v_id'] + 1;

        return $maxRegID;
    }

    /**
     * Save uploaded receipts to a folder and to database
     */
    public function saveVINReceipt(){
        $refNumber = $this->getVINRefNumber();
        $receipt = $this->getVINReceipt();
        $filename = explode(".",$receipt['name'][0]);
        $tmpFile = $receipt['tmp_name'][0];
        $extensionFile = end($filename);
        $newFilename = "{$refNumber}.{$extensionFile}";
        $uploadPath = "../uploads/{$newFilename}";

        if(move_uploaded_file($tmpFile,$uploadPath)){
            return $newFilename;
        }

        return false;
    }

    public function viewSoldUnit(){
        $dealerID = $this->getDealerID();
        $query = $this->dbConnect->prepare("call get_sold_units(?)");
        $query->bind_param("i",$dealerID);
        $query->execute();
        $result = $query->get_result();
        $response =array();

        while($row = $result->fetch_assoc()){
            $res = array(
                "vinNumber" => $row['vinNumber'],
                "engineNumber" => $row['engineNumber'],
                "model" => $row['model'],
                "shipment" => $row["shipment"]
            );

            array_push($response,$res);
        }

        return $response;
    }


    public function mailToAdmin(){
        $model = $this->getModel();
        $purchaseDate = $this->getDateOfPurchase();
        $orderNumber = $this->getOrderNumber();
        $vinNumber = $this->getVINNumber();
        $email = $this->getEmail();
        $customerName = $this->getCustomerName();
        $receipt = $this->getVINReceipt();

        $mailer = new PHPMailer();  
        $mailer->setFrom('warranty@thumpstar.com', 'Thumpstar Motorcycles');
        // $mail->addAddress('contact@thumpstar.com.au','');
        // $mail->addAddress('ejabraha@gmail.com','');
        // $mail->addAddress('ride@thumpstarusa.com','');
        // $mail->addAddress('bravcodistribution@gmail.com');
        $mailer->addAddress('thumpstarapi@gmail.com', ''); // Test email by Mike
        $mailer->isHTML(true);
        $mailer->Subject = "AU Vin Validation";
        '<p style="letter-spacing: 1px; margin-bottom-10px;"> A VIN Validation has been submitted.</p>';
        $mailer->Body = "<br style = 'margin:0'>
                        <hr style = 'margin:0'>
                        <br style = 'margin:0'>
                        <p  style = 'letter-spacing: 1px; margin-bottom-10px;'> <b> Bike Model: </b>  {$model} </p>
                        <p  style = 'letter-spacing: 1px; margin-bottom-10px;'> <b> Purchase Date: </b>  {$purchaseDate} </p>
                        <p  style = 'letter-spacing: 1px; margin-bottom-10px;'> <b> Order Number: </b>  {$orderNumber} </p>
                        <p  style = 'letter-spacing: 1px; margin-bottom-10px;'> <b> VIN Number: </b>  {$vinNumber} </p>
                        <br style = 'margin:0'>
                        <hr style = 'margin:0'>
                        <br style = 'margin:0'>
                        <p  style = 'letter-spacing: 1px; margin-bottom-10px;'> <b> Customer Name: </b>  {$customerName} </p>
                        <p  style = 'letter-spacing: 1px; margin-bottom-10px;'> <b> Email Address: </b>  {$email} </p>
                        <p  style = 'letter-spacing: 1px; margin-bottom-10px;'> <b> Country: </b>  Australia </p>
                        <br style = 'margin:0'>
                        <hr style = 'margin:0'>
                        <br style = 'margin:0'>";

                if(array_key_exists('supporting_file',$_FILES)){
                    for($i = 0; $i < count($receipt['tmp_name']); $i++){
                        $uploadFile = tempnam(sys_get_temp_dir(), hash('sha256', $receipt['name'][$i]));
                        $filename = $receipt['name'][$i];

                        if(move_uploaded_file($receipt['tmp_name'][$i],$uploadFile)){
                            $mailer->addAttachment($uploadFile,$filename);
                        }else{
                            $msg = 'Failed to movefile to '. $uploadFile;
                        }
                    }
                }
            if(!$mailer->send()) return false;
                        return true;


    }

    public function mailToCustomer(){
        $email = $this->getEmail();
        $company = $this->getCompanyName();
        $orderNumber = $this->getOrderNumber();
        $vinNumber = $this->getVINNumber();
        $model = $this->getModel();

        $mail = new PHPMailer();
        $mail->setFrom('noreply@thumpstar.com','Thumpstar Warranty');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = "Thumpstar Warranty Validation";
        $mail->Body = "Dear {$company},
                               <p style = 'letter-spacing:1px; margin-bottom:10px;'>This is to confirm that your <b>WARRANTY VALIDATION </b> request has been received.</p>
                               <br style = 'margin:0'>
                               <hr style = 'margin:0'>
                               <br style = 'margin:0'>
                               <p style = 'letter-spacing:1px; margin-bottom:10px;'>Our team need to check if the detail that were submitted is valid, and once accepted a $25 will be credited to your parts account.</p>
                               <br style = 'margin:0'>
                               <hr style = 'margin:0'>
                               <br style = 'margin:0'>
                               <p style = 'letter-spacing:1px; margin-bottom:10px;'>Please check the details below, if the VIN number does not match then the credit will not be added.</p>
                               <br style = 'margin:0'>
                               <hr style = 'margin:0'>
                               <br style = 'margin:0'>
                               <p  style = 'letter-spacing: 1px; margin-bottom-10px;'> <b> Order Number: </b>  {$orderNumber} </p>
                               <p  style = 'letter-spacing: 1px; margin-bottom-10px;'> <b> VIN Number: </b>  {$vinNumber} </p>
                               <p  style = 'letter-spacing: 1px; margin-bottom-10px;'> <b> Bike Model: </b>  {$model} </p>
                               <br style = 'margin:0'>
                               <hr style = 'margin:0'>
                               <br style = 'margin:0'>
                               <p style = 'letter-spacing:1px; margin-bottom:10px;'>Please resubmit if there is a mistake with the details above.</p>";
        if(!$mail->send()) return false;
        return true;
    }

    public function validateVINEntry(){
        $response = array();
        $vinNumber = $this->getVINNumber();
        $orderNumber = $this->getOrderNumber();
        $model = $this->getModel();
        $type = $this->getType();
        $customerName = $this->getCustomerName();
        $dateOfPurchase = $this->getDateOfPurchase();
        $receipt = $this->getVINReceipt();
        $allowedFile = array("JPEG","PNG","JPG");
        $filename = $receipt['name'][0];
        $extensionFile = pathinfo($filename,PATHINFO_EXTENSION);
        $response = array();

        if(empty($vinNumber) || $vinNumber === " "){
            $res = array("key"=> "vinNumber", "message"=>"Input field is empty.");
            array_push($response,$res);
        }

        if(empty($orderNumber) || $orderNumber === " "){
            $res = array("key"=> "orderNumber", "message"=>"Input field is empty.");
            array_push($response,$res);
        }

        if(empty($customerName) || $customerName === " "){
            $res = array("key"=> "err_customerName", "message"=>"Input field is empty.");
            array_push($response,$res);
        }

        if(empty($dateOfPurchase) || $dateOfPurchase === " "){
            $res = array("key"=> "dateOfPurchase", "message"=>"Input field is empty.");
            array_push($response,$res);
        }
        if($model === ""){
            $res = array("key"=> "err_model", "message"=>"Model is required.");
            array_push($response,$res);
        }

        if($type === ""){
            $res = array("key"=> "err_type", "message"=>"Type is required.");
            array_push($response,$res);
        }

        if(!preg_match("/[a-zA-Z0-9]/i",$vinNumber)){
            $res = array("key"=> "vinNumber", "message"=>"Input contains invalid characters.");
            array_push($response,$res);
        }

        if(!preg_match("/[a-zA-Z0-9]/i",$orderNumber)){
            $res = array("key"=> "orderNumber", "message"=>"Input contains invalid characters.");
            array_push($response,$res);
        }

        if($receipt['size'] === 0){
            $res = array("key"=> "err_receipt", "message"=>"Please upload receipt.");
            array_push($response,$res);
        }

        if(!in_array(strtoupper($extensionFile),$allowedFile)){
            $res = array("key"=> "err_receipt", "message"=>"Invalid file extension.");
            array_push($response,$res);
        }

        return $response;
    }


    public function validateInfoEntry(){
        $contact = $this->getContact();
        $address = $this->getAddress();
        $town = $this->getTown();
        $region = $this->getRegion();
        $zipCode = $this->getZipCode();
        $response = array();

        if(empty($contact) || $contact === " "){
            $res = array("key"=> "err_contact", "message"=>"Input field is empty.");
            array_push($response,$res);
        }


        if(empty($address) || $address === " "){
            $res = array("key"=> "err_address", "message"=>"Input field is empty.");
            array_push($response,$res);
        }

        if(empty($town) || $town === " "){
            $res = array("key"=> "err_town", "message"=>"Input field is empty.");
            array_push($response,$res);
        }

        if(empty($region) || $region === " "){
            $res = array("key"=> "err_region", "message"=>"Input field is empty.");
            array_push($response,$res);
        }

        if(empty($zipCode) || $zipCode === " "){
            $res = array("key"=> "err_zip", "message"=>"Input field is empty.");
            array_push($response,$res);
        }

        if(!preg_match("/[0-9]/i",$contact)){
            $res = array("key"=> "err_contact", "message"=>"Input contains invalid characters.");
            array_push($response,$res);
        }

        if(!preg_match("/[0-9]/i",$zipCode)){
            $res = array("key"=> "err_zip", "message"=>"Input contains invalid characters.");
            array_push($response,$res);
        }

        if(!preg_match("/[a-zA-Z]/i",$town)){
            $res = array("key"=> "err_town", "message"=>"Input contains invalid characters.");
            array_push($response,$res);
        }

        if(!preg_match("/[a-zA-Z]/i",$region)){
            $res = array("key"=> "err_region", "message"=>"Input contains invalid characters.");
            array_push($response,$res);
        }

        return $response;
    }

    public function changePassword(){
        $confPassword = $this->getConfPassword();
        $dealerID = $this->getDealerID();
        $hash = password_hash($confPassword,PASSWORD_DEFAULT);
       
        
        $query = $this->dbConnect->prepare("call change_password(?,?)");
        $query->bind_param("is",$dealerID,$hash);
        $query->execute();

        if($query->affected_rows > 0) return true;

        return false;
    }

    public function updateToNonDefault(){
        $dealerID = $this->getDealerID();

        $query = $this->dbConnect->prepare("call update_to_non_default(?)");
        $query->bind_param("i",$dealerID);
        $query->execute();

        if($query->affected_rows > 0) return true;
        return false;
    }

     public function validatePassword(){
        $password = $this->getPassword();
        $confPassword = $this->getConfPassword();
        $response = array();

        if(empty($password) || $password === " "){
            $res = array("key"=> "password_err", "message"=>"Input field is empty.");
            array_push($response,$res);

        }

        if(empty($confPassword) || $confPassword === " "){
            $res = array("key"=> "conf_password_err", "message"=>"Input field is empty.");
            array_push($response,$res);

        }

        if($confPassword !== $password){
            $res = array("key"=> "pass_err_main", "message"=>"Password does not match. Please try again.");
            array_push($response,$res);
            
        }
        return $response;
     }   


     public function forgotPassword(){
        $email = $this->getEmail();

        $query = $this->dbConnect->prepare("call client_login(?)");
        $query->bind_param("s",$email);
        $query->execute();
        $result = $query->get_result();
        $rs = $result->fetch_assoc();
        if($result->num_rows == 0) return false;
        
        $this->setDealerID($rs['dealerID']);
        return true;
     }



    

}

?>

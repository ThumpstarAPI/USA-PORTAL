<?php
//Changes the password of the dealer.

if($_SERVER['REQUEST_METHOD'] == "POST"){
    include '../api-calls.php';

    $id = $_POST['id'] + 2;
    $range = "dealersUS!L".$id;
    $password = sha1($_POST['password']);
    $msg='';

    $update = new ThumpstarApiCalls();
    $values = [
        [$password]
    ];

    $change_password = $update->updateSheetData("1TQNxvzCS2itSJMyfdDUWF0vGASzmeQk4l2CXwgCvB58",$range,$values,"portal-credentials.json");

    if($change_password){
        $msg = "saved";
    }

    $send_msg = array("message"=>$msg);
    echo json_encode($send_msg);
}

?>
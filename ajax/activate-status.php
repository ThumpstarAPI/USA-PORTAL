<?php
include '../api-calls.php';

$msg = '';
$update_info = new ThumpstarApiCalls();
 if($_POST['status'] == strcasecmp("Inactive","INACTIVE")){
    $id = $_POST['id'] + 2;
    $range = "dealersUS!M".$id;
    $values = [
        ['Active']
    ];

    $update = $update_info->updateSheetData("1TQNxvzCS2itSJMyfdDUWF0vGASzmeQk4l2CXwgCvB58",$range,$values,"portal-credentials.json");

    if($update){
        $msg = 'changed';
    }else{
        $msg = 'error';
    }
    $send_msg = array("message"=> $msg);
    echo json_encode($send_msg);
}
?>
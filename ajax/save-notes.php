<?php
/**
 * This code is for saving a note created by the dealer
 */
include '../api-calls.php';
$update_note = new ThumpstarApiCalls();
$msg = '';
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $id = $_POST['row'] + 2; // Added 2 to have the exact row number in the google sheet.
    $values = [ [ $_POST['note'] ] ];

    $add_note = $update_note->insertSheetData("10Lf-CEqSCJpq4RKSj_VZemhFvuFQAsWyteePGNcz94k","MASTER2!R". $id,$values);

    if($add_note){
        $msg = 'added';
    }
    $send_message = array("message"=> $msg);
    echo json_encode($send_message);
}

?>
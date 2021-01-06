<?php
error_reporting(0);
use PHPMailer\PHPMailer\PHPMailer;
include 'api-calls.php';
// include 'session-checker.php';
session_start();
$id = $_SESSION['id'] +2 ;
$range = "dealersUS!A" .$id . ":B" .$id;
$vin_validation = new ThumpstarApiCalls;

$fullname = $vin_validation->viewSheetData("1TQNxvzCS2itSJMyfdDUWF0vGASzmeQk4l2CXwgCvB58",$range,"portal-credentials.json");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thumpstar USA |VIN VALIDATION.</title>
<?php include 'includes/header.php'; ?>
<style>
    label{
        color:#fff;
        text-transform:uppercase;
        letter-spacing: 1px;
    }
    .vin-validation-form input[type="submit"], #upload input[type="submit"]{
        background: #bf0;
        color: #000;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 600;
        border: 2px solid #bf0;
    }

    #success{
        display:none;
    }

    .vin-validation-form{
        display:inline;
    }

    #mode button{
    background: #bf0; margin:0; padding-top: 0; border: 2px solid #bf0; height:35px; color:#000;
    }

    #mode a{
        color:#000;
    }

    #color-moded{
        background:#ffff;
    }

    #color-moded p, #color-moded label{
        color:#000;
    }

    #text-area{
        font-size:20px;
        width:510px;
        height:130px;
    }


</style>

<section class="pages-banner py-5">
    <div class="container py-5">
        <div class="row">
            <div class="col-12">
                <?php if($_SESSION['message']=="error" ){ ?>
                    <h1 class="text-center text-lg-left text-uppercase">AN ERROR HAS OCCURED!</h1>
                    <p class="text-center text-lg-left">Please try again.</p>
                <?php  }elseif($_SESSION['message']=="save"){ ?>
                    <h1 class="text-center text-lg-left text-uppercase">Thank You!</h1>
                    <p class="text-center text-lg-left">Your VIN VALIDATION claim has been submitted. Please check your email.</p>
                <?php  }else{ ?>
                    <h1 class="text-center text-lg-left text-uppercase">VIN VALIDATION</h1>
                    <p class="text-center text-lg-left">Fill up form and earn $25 credit. </p>
                <?php } ?>
            </div>
        </div>
    </div>
</section>

<section class="moded pages-content py-5" >
    <div class="container py-5">
        <div class="row" style="border: 5px solid red;">
            <div class="col-12 p-md-4">
                <h2 class="text-uppercase" style="color:red;">Important!</h2>
                <p style = "font-size: 20px;">Please ensure that your <strong>VIN NUMBER</strong> is entered correctly, or your credit will not be valid.</p>
                <p style = "font-size: 20px;">Upload sales receipt from your dealership to the customer.</p>
            </div>


            <div class="col-12 p-md-4" >
            
                    <form id="upload" method='POST' action='#' enctype="multipart/form-data">
                        <div class="col-md-6 mb-4">
                            <label for ="receipt">Upload image to be converted</label>
                            <input type = "file" name = "attachment" id="attachment" class="form-control" required>
                        </div>  

                        <div class="col-md-6 mb-4">
                            <label>&nbsp;</label>
                            <input type="submit" class="form-control" value="Convert" name="submit" >
                        </div> 
                    </form>

                    <div class="col-md-6 mb-4">
                        <textarea name="" id="text-area" cols="30" rows="10">
                        <?php
                            //Image to text conversion syntax
if(isset($_POST['submit']) && isset($_FILES)) {
    require __DIR__ . '/vendor/autoload.php';
    $target_dir = "uploads/";
    $uploadOk = 1;
    $FileType = strtolower(pathinfo($_FILES["attachment"]["name"],PATHINFO_EXTENSION));
    $target_file = $target_dir . generateRandomString() .'.'.$FileType;
    // Check file size
    if ($_FILES["attachment"]["size"] > 5000000) {
        header('HTTP/1.0 403 Forbidden');
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    if($FileType != "pdf" && $FileType != "png" && $FileType != "jpg") {
        header('HTTP/1.0 403 Forbidden');
        echo "Sorry, please upload a pdf file";
        $uploadOk = 0;
    }
    if ($uploadOk == 1) {
   
        if (move_uploaded_file($_FILES["attachment"]["tmp_name"], $target_file)) {
            uploadToApi($target_file);
        } else {
            header('HTTP/1.0 403 Forbidden');
            echo "Sorry, there was an error uploading your file.";
        }
    } 
}
                        ?>
                        </textarea>

                        
                    </div> 

            </div>

            
        </div>
        </div>
    </div>
</section>

<section class ="moded pages-content py-5" id = "">
<div class="container">
     <div class="row">
        <div class="col-12" id="mode">
            <button type="button" id= "home-btn" class="btn btn-primary btn-lg">
                <a href="dealer-task.php" > Home </a>
            </button>
            <button type="button" class="btn btn-primary btn-lg" id="bgColor" name="dark">Light Mode</button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-12 my-4" id="form-content">
            <form action = "processing/vin-validation.php"method ="POST" id="" class="vin-validation-form" enctype="multipart/form-data" >
                <div class="row">
                    
                    <div class="col-md-6 mb-4">
                        <label for="vin_number">VIN Number</label>
                        <input type="text" name="vin_number" class="form-control" id="" placeholder ="VIN Number" autofocus  >
                    </div>
                    
                    <div class="col-md-6 mb-4">
                        <label for="order_number">Order Number</label>
                        <input type="text" name="order_number" class="form-control" id="tel_no" placeholder ="Order Number" required >
                    </div>
                    
                    <div class="col-md-6 mb-4">
                        <label for="company">Dealership Company Name</label>
                        <input type="text" name="company" class="form-control" id="dealership" placeholder ="Company Name"  value = "" readonly>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label for="country">Country </label>
                        <!-- <select id="country" name="country" class="form-control">
                            <option value="Australia">AUSTRALIA</option>
                            <option value="New Zealand">NEW ZEALAND</option>
                            <option value="USA">UNITED STATES</option>
                            <option value="Canada">CANADA</option>
                        </select> -->
                        <input type="text" name="country" class="form-control" id="address" value = "USA" readonly >

                    </div>

                    <div class="col-md-6 mb-4">
                        <label for="email">Email Address </label>
                        <input type="email" name="email" class="form-control" id="email" placeholder ="Email Address" value ="" readonly>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label for="model">Model</label>
                            <select id="model" name="model" class="form-control" required>
                                <option selected>Select Model</option>
                                <option value="TSK 70-C">TSK 70-C</option>
                                <option value="TSB 110-C">TSB 110-C</option>
                                <option value="TSK 110-C">TSK 110-C</option>
                                <option value="TSX 125-C">TSX 125-C</option>
                                <option value="TSX 140-C">TSX 140-C</option>
                                <option value="TSR 140-C">TSR 140-C</option>
                                <option value="TSX 212-C">TSX 212-C</option>
                                <option value="MX 50 JR">MX 50 JR</option>
                                <option value="MX 50 SR">MX 50 SR</option>
                                <option value="MX 85">MX 85</option>
                                <option value="MX 125">MX 125</option>
                                <option value="MX 150">MX 150</option>
                                <option value="TSE 12">TSE 12</option>
                                <option value="TSE 16">TSE 16</option>
                            </select>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label for="type"> Type </label>
                        <select name = "type" id = "type" class = "form-control" required>
                            <option selected>Select Type</option>
                            <option value="Assembled">Assembled</option>
                            <option value="Sold In Crate">Sold In Crate</option>
                        </select>
                        
                    </div>  

                    <div class="col-md-6 mb-4">
                        <label for ="date_purchased">Date of Sale</label>
                        <input type = "date" name = "date_purchased" id="date" class="form-control" required >
                    </div>  

                    <div class="col-md-6 mb-4">
                        <label for ="receipt">Photo of Receipt</label>
                        <input type = "file" name = "supporting_file[]" id="receipt" class="form-control" required>
                    </div>  
                    
                    <div class="col-md-6 mb-4">
                        <label for="customer_name">Customer Name</label>
                        <input type="text" name="customer_name" class="form-control" id="customer_name" placeholder ="Customer Name" required >
                    </div>

                    <div class="col-md-6 mx-auto d-block mb-4">
                        <label>&nbsp;</label>
                        <input type="submit" class="form-control" value="Submit">
                    </div>  
                </div>
            </form>
        </div>
    </div>
</div>
</section>


<script type="text/javascript">
const dealer_id = sessionStorage.getItem("id");
const dealership = sessionStorage.getItem("dealership");

function getDealerInfo(){
    let jsonSource = "https://spreadsheets.google.com/feeds/list/10Lf-CEqSCJpq4RKSj_VZemhFvuFQAsWyteePGNcz94k/2/public/values?alt=json";
        $.getJSON( jsonSource, function() {
        //
        })
        .done(
            function(data) {
            let email = data.feed.entry[dealer_id].gsx$email.$t 
            $("#email").val(email);
            $("#dealership").val(dealership);
        });
}
    //Changes the background color.
    $(document).ready(function(){
        $("#bgColor").click(function(){
        let $name = $("#bgColor").attr('name');
            if($name === "dark"){
                $(".moded").attr('id','color-moded');
                $('#bgColor').attr('name','light');
                $("table").removeClass("text-light");
                $("#bgColor").text("Dark Mode")
                localStorage.setItem("btn-color-name", "light");
            }else{
                $(".moded").removeAttr('id');
                $('#bgColor').attr('name','dark');
                $("table").addClass("text-light");
                $("#bgColor").text("Light Mode")
                localStorage.setItem("btn-color-name", "dark");

            }
         });
    });

    //Gets the value of localstorage and change the background accordingly.
    let bgColor = localStorage.getItem("btn-color-name");

    if(bgColor == "light"){
        $(".moded").attr('id','color-moded');
        $('#bgColor').attr('name','light');
        $("table").removeClass("text-light");
        $("#bgColor").text("Dark Mode")
    }else{
        $(".moded").removeAttr('id');
        $('#bgColor').attr('name','dark');
        $("table").addClass("text-light");
        $("#bgColor").text("Light Mode")
    }

window.onload = function(){
    getDealerInfo();
}
</script>
<?php include 'includes/footer.php';?>  

<?php
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function uploadToApi($target_file){
    require __DIR__ . '../vendor/autoload.php';
    $fileData = fopen($target_file, 'r');
    $client = new \GuzzleHttp\Client();
    try {
    $r = $client->request('POST', 'https://api.ocr.space/parse/image',[
        'headers' => ['apiKey' => 'bccc8f688888957', 'OCREngine' => '2'],
        'multipart' => [
            [
                'name' => 'file',
                'contents' => $fileData
            ]
        ]
    ], ['file' => $fileData]);
    $response =  json_decode($r->getBody(),true);
    if($response['ErrorMessage'] == "") {
    
        foreach($response['ParsedResults'] as $pareValue) {
           echo $pareValue['ParsedText'];
        }
  
    } else {
        header('HTTP/1.0 400 Forbidden');
        echo $response['ErrorMessage'];
    }
    } catch(Exception $err) {
        header('HTTP/1.0 403 Forbidden');
        echo $err->getMessage();
    }
}  
?>

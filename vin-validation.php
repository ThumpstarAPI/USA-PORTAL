<?php
session_start();
if(!isset($_SESSION['dealerID'])) header("Location:logout.php"); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thumpstar AU |VIN VALIDATION.</title>
<?php require_once('../includes/header.php'); ?>
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
                <?php 
                    if(isset($_SESSION['message'])){
                        echo '<h1 class="text-center text-lg-left text-uppercase">' . $_SESSION['message'] . '</p>';
                        unset($_SESSION['message']);
                    }elseif(isset($_SESSION['error'])){ //error message if validation entry is not saved.
                        echo '<h1 class="text-center text-lg-left text-uppercase">' . $_SESSION['error'] . '</p>';
                        unset($_SESSION['error']);
                    }else{
                        echo'  <h1 class="text-center text-lg-left text-uppercase">VIN VALIDATION</h1>';
                        echo' <p class="text-center text-lg-left">Fill up form and earn $25 credit. </p>';
                    }
                ?>
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
        </div>
        </div>
    </div>
</section>

<section class ="moded pages-content py-5" id = "">
<div class="container">
     <div class="row">
        <div class="col-12 mb-3" id="mode">
            <button type="button" id= "home-btn" class="btn btn-primary btn-lg" onclick="location.href = 'dealer-task.php';">Home
            </button>
            <button type="button" class="btn btn-primary btn-lg" id="bgColor" name="dark">Light Mode</button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-12 my-4" id="form-content">
            <form method="POST" id="vin-validation-form" class="vin-validation-form" enctype="multipart/form-data" >
                <div class="row">
                    
                    <div class="col-md-6 mb-4">
                        <label for="vin_number">VIN Number</label>
                        <input type="text" name="vin_number" class="form-control" id="vin_number" placeholder ="VIN Number"    >
                        <p id='vinNumber' style="color:red"></p>
                    </div>
                    
                    <div class="col-md-6 mb-4">
                        <label for="order_number">Order Number</label>
                        <input type="text" name="order_number" class="form-control" id="order_number" placeholder ="Order Number"  >
                        <p id='orderNumber' style="color:red"></p>
                    </div>
                    
                    <div class="col-md-6 mb-4">
                        <label for="company">Dealership Company Name</label>
                        <input type="text" name="dealership" class="form-control" id="dealership" placeholder = "" value=""   readonly>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label for="country">Country </label>
                        <input type="text" name="country" class="form-control" id="address" value = "Australia" readonly >

                    </div>

                    <div class="col-md-6 mb-4">
                        <label for="email">Email Address </label>
                        <input type="email" name="email" class="form-control" id="email" placeholder = ""   value =""   readonly>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label for="model">Model</label>
                            <select id="model" name="model" class="form-control" >
                                <option value="">Select Model</option>
                                <option value="TSK 70-C">TSK 70-C</option>
                                <option value="TSB 110-C">TSB 110-C</option>
                                <option value="TSK 110-C">TSK 110-C</option>
                                <option value="TSB 125-E">TSB 125-E</option>
                                <option value="TSX 125-C">TSX 125-C</option>
                                <option value="TSX 140-C">TSX 140-C</option>
                                <option value="TSR 140-C">TSR 140-C</option>
                                <option value="TSK 141-E">TSK 141-E</option>
                                <option value="TSX 212-C">TSX 212-C</option>
                                <option value="TSX 230-C">TSX 230-C</option>
                                <option value="MX 50 JR">MX 50 JR</option>
                                <option value="MX 50 SR">MX 50 SR</option>
                                <option value="MX 85">MX 85</option>
                                <option value="MX 85R">MX 85 R</option>
                                <option value="MX 125">MX 125</option>
                                <option value="MX 150">MX 150</option>
                                <option value="TSE 12">TSE 12</option>
                                <option value="TSE 16">TSE 16</option>
                            </select>
                            <p id='err_model' style="color:red"></p>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label for="type"> Type </label>
                        <select name = "type" id = "type" class = "form-control" >
                            <option value="">Select Type</option>
                            <option value="Assembled">Assembled</option>
                            <option value="Sold In Crate">Sold In Crate</option>
                        </select>
                        <p id='err_type' style="color:red"></p>
                    </div>  

                    <div class="col-md-6 mb-4">
                        <label for ="date_purchased">Date of Sale</label>
                        <input type = "date" name = "date_purchased" id="date" class="form-control"  >
                        <p id='dateOfPurchase' style="color:red"></p>
                    </div>  

                    <div class="col-md-6 mb-4">
                        <label for ="receipt">Photo of Receipt (Required)</label>
                        <input type = "file" name = "supporting_file[]" id="receipt" class="form-control" >
                        <p id='err_receipt' style="color:red"></p>
                    </div>  
                    
                    <div class="col-md-6 mb-4">
                        <label for="customer_name">Customer Name</label>
                        <input type="text" name="customer_name" class="form-control" id="customer_name" placeholder ="Customer Name"  >
                        <p id='err_customerName' style="color:red"></p>
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


<div class="modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p id = "error-success-msg"></p>
      </div>
      <div class="modal-footer">
        <button type="button" id="close-btn" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript" src="scripts/vin-validation.js"></script>
<?php require_once('../includes/footer.php'); ?>



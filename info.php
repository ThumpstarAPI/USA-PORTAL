<?php
session_start();
if(!isset($_SESSION['dealerID'])) header("Location:logout.php"); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Information</title>
<?php require_once('../includes/header.php');?>
<style>
    th{
        color:#bf0;
    }
    label{
        color:#fff;
        text-transform:uppercase;
        letter-spacing: 1px;
    }
    .update_information input[type="submit"]{
        background: #bf0;
        color: #000;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 600;
        border: 2px solid #bf0;
    }

    #mode button{
    background: #bf0; margin:0; padding-top: 0; border: 2px solid #bf0; height:35px; color:#000;
    }

    #mode a, #color-moded th{
        color:#000;
    }

    #color-moded{
        background:#ffff;
    }

    #edit-btn,#save-btn{
        background: #bf0;
        color: #000;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 600;
        border: 2px solid #bf0;
    }

    table{
        font-size:20px;
    }

    #home_link,#change_pass_link{
      text-decoration: none;
      color:#bf0;
    }

    
</style>

<section class="pages-banner py-5">
    <div class="container py-5">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center text-lg-left text-uppercase" id="banner-text"> <a href= "dealer-task.php" id = "home_link">HOME </a> / Update Information</h1>
                <a href="change-password.php" id="change_pass_link">Change Password</a>
            </div>
        </div>
    </div>
</section>

<section class ="pages-content py-5" >
  <div class="container">
 


    <form method = "POST" id = "info-form">
        <div class="row">
        <div class="col">
            <label for="firstname">Firstname</label>
            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First name" readonly> 
        </div>
        <div class="col">
            <label for="lastname">Lastname</label>
            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last name" readonly>
        </div>
        <div class="col">
            <label for="contact_number">Contact Number</label>
            <input type="text" class="form-control" id="contact_number" name="contact_number"placeholder="Contact Number ">
            <p id="err_contact" style="color:red"></p>
        </div>
        </div>

        <br><br>
        <div class="row">
            <div class="col">
                <label for="Address">Address</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="Address" > 
            </div>
        </div>
        <br><br>
        <div class="row">
    
        <div class="col">
            <label for="town">Town</label>
            <input type="text" class="form-control" id="town" name="town" placeholder="Town" > 
            <p id="err_town" style="color:red"></p>
        </div>
        <div class="col">
            <label for="region">Region</label>
            <input type="text" class="form-control" id="region" name="region" placeholder="Region" >
            <p id="err_region" style="color:red"></p>
        </div>
        <div class="col">
            <label for="zip">ZIP Code</label>
            <input type="text" class="form-control" id="zip" name="zip"placeholder="ZIP Code " maxlength="4">
            <p id="err_zip" style="color:red"></p>
        </div>
        </div>

        <div class="col-md-6 mx-auto d-block mb-4">
                        <label>&nbsp;</label>
                        <input type="submit" id="save-btn" class="form-control" value="Submit">
                    </div>  
    </form>

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
<script type='text/javascript' src = 'scripts/info.js'></script>

<?php require_once("../includes/footer.php");
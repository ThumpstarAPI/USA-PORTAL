<?php
session_start();    
require_once("DealerController.php");
$dealer = new DealerController();
$dealer->setDealerID($_SESSION['dealerID']);
$dealerID = $dealer->getDealerID();
$connection = $dealer->checkConnection();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dealer Login</title>
<?php require_once("../includes/header.php")?>

<style>
#login{
        color:#fff;
        text-transform:uppercase;
        letter-spacing: 1px;
}

#login h1{
    color:#bf0;
}

#login-btn {
        background: #bf0;
        color: #000;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 600;
        border: 2px solid #bf0;
        width:100%;
    }

#error_msg{
    display:none;
}

#email,#password{
    height: 50px;
}
</style>

<section class ="pages-content py-5" id = "login">
<div class="container">
    <div class="row">
        <h1 class="text-center text-lg-left text-uppercase">Change Password</h1>

        <div class="col-md-12 col-12 my-4" id="form-content">
        <div class="row">
            <div class="col-md-6 mb-4 style='color:#bf0"><p id="pass_error_main"></p>
            </div>
        </div>
            <form method = "POST" id="change_pass_form" class="change_pass_form" >
                <div class="row">
                     <div class="col-md-6 mb-4">
                        <label for="password">Password</label>
                        <input type="password" name="password"  class="form-control" id="password" placeholder ="Password" required>
                        <p id="pass_err" style="color:red"></p>

                        <br>

                        <label for="conf_password">Confrim Password</label>
                        <input type="password" name="conf_password" class="form-control" id="conf_password" placeholder ="Confirm Password" required>
                        <p id="conf_pass_err" style="color:red"></p>
                        <br>

                    <button id="login-btn" class="form-control text-uppercase" >Save Password</button>
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

<script src="scripts/change-password.js"></script>
<?php require_once("../includes/footer.php")?>
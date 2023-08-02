<?php

require_once("DealerController.php");

$dealer = new DealerController();
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
        <h1 class="text-center text-lg-left text-uppercase">Dealer Login</h1>

        <div class="col-md-12 col-12 my-4" id="form-content">
        <div class="row">
            <div class="col-md-6 mb-4 style='color:#bf0"><p id="error"></p>
            </div>
        </div>
            <form method = "POST" id="login_form" class="login_form" >
                <div class="row">
                     <div class="col-md-6 mb-4">
                        <label for="email">Email Address </label>
                        <input type="email" name="email"  class="form-control" id="email" placeholder ="Email Address" required>
                    

                        <br>

                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder ="Password" required>

                        <br>

                    <button id="login-btn" class="form-control text-uppercase" >Login</button>
                    </div>
                   
                </div>
            </form>

            <div class="row">
                    <div class="col-md-6 mb-4">
                    <a href="forgot-password.php">Forgot Password?</a> <br>
                    <a href="https://www.thumpstar.com.au">Go back.</a>
                    </div>
            </div>
        </div>
    </div>
</div>
</section>

<script src="scripts/login.js"></script>
<?php require_once("../includes/footer.php")?>
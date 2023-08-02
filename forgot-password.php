<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
<?php include 'includes/header.php';?>

<style>
#login{
    color:#fff;
    text-transform:uppercase;
    letter-spacing: 1px;
}


#submit-btn{
    background: #bf0;
    color: #000;
    text-transform: uppercase;
    letter-spacing: 1px;
    font-weight: 600;
    border: 2px solid #bf0;
}


#try-again{
    background: #bf0;
    color: #000;
    text-transform: uppercase;
    letter-spacing: 1px;
    font-weight: 600;
    border: 2px solid #bf0;
    width:450px;
}


#input_form label{
    color:#bf0;
}
</style>


<section class="pages-banner py-5" id="main_banner">
    <div class="container py-5">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center text-lg-left text-uppercase">Reset Password</h1>
            </div>
        </div>
    </div>
</section>

<section class="pages-banner py-5" id="response" style="display:none;">
    <div class="container py-5  ">
        <div class="row">
            <div class="col-12 text-center ">
                <h1 class="text-uppercase"> <p id="response_message"></p></h1>
                <button id="try-again" >Try Again</button>
            </div>           
        </div>
    </div>
</section>

<section class="pages-banner py-5" id="success" style="display:none;">
    <div class="container py-5">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center text-lg-left text-uppercase">A reset link has been sent to your email.</h1>;
            </div>
        </div>
    </div>
</section>

<section class="pages-banner py-5" id="error" style="display:none;">
    <div class="container py-5">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center text-lg-left text-uppercase">There was an error in sending the reset link to your email. Please contact our support team.</h1>;
            </div>
        </div>
    </div>
</section>

<section class="pages-content py-5" id="input_form">
    <div class="container py-5">
        <div class="row">
            <div class="col-md-6 mb-4" >
                <form id="email-verification-form">
                <input type="email" name="email" class="form-control mb-2" id="email" placeholder ="Email Address" required>
                <input type="submit" class="form-control"  id="submit-btn">
                </form>
            </div>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script type="text/javascript" src="scripts/forgot-password.js"></script>
<?php include 'includes/footer.php';?>
<?php
session_start();
include 'api-calls.php';
$msg= '';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashed_password = sha1($password);
    $accounts = new ThumpstarApiCalls;
    $dealer_account = $accounts->viewSheetData("1TQNxvzCS2itSJMyfdDUWF0vGASzmeQk4l2CXwgCvB58","dealersUS!A2:Q","portal-credentials.json");
    $dealer_count = count($dealer_account);

    for($i=0; $i < $dealer_count; $i++){
        if($dealer_account[$i][2] == $email  && $dealer_account[$i][11] == $hashed_password ){
            if($dealer_account[$i][11] == sha1("password")){
                $_SESSION["id"] = $i;
                $_SESSION['dealership'] = $dealer_account[$i][3];
                $_SESSION['ca_id'] = $dealer_account[$i][16];
                header("Location:change-default.php");
            }else{
                $_SESSION["id"] = $i;
                $_SESSION['dealership'] = $dealer_account[$i][3];
                $_SESSION['ca_id'] = $dealer_account[$i][16];
                header('Location:dealer-task.php');
            }
        }elseif($dealer_account[$i][2] == $email && $dealer_account[$i][15]== $hashed_password){
            $_SESSION["id"] = $i ;
            // echo $_SESSION["id"];
            $_SESSION['dealership'] = $dealer_account[$i][3];
            $_SESSION['ca_id'] = $dealer_account[$i][16];
            header('Location:dealer-task.php');
        }else{
            $msg = "Invalid Credentails, Please Try Again.";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dealer Login</title>
<?php include 'includes/header.php';?>

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
            <div class="col-md-6 mb-4 style='color:#bf0">
                <?php echo $msg; ?>
            </div>
        </div>
            <form action="#" method = "POST" id="login_form" class="login_form" >
                <div class="row">
                     <div class="col-md-6 mb-4">
                        <label for="email">Email Address </label>
                        <input type="email" name="email" class="form-control" id="email" placeholder ="Email Address" required>
                    

                        <br>

                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder ="Password" required>

                        <br>

                        <label>&nbsp;</label>
                        <input type="submit"name="login" class="form-control text-uppercase" value = "Sign-in"id="login-btn" > 
                        
                    </div>
                   
                </div>
                <div class="row">
                    
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-4">
                        
                    </div>
                </div>
            </form>

            <div class="row">
                    <div class="col-md-6 mb-4">
                    <a href="forgot-password.php">Forgot Password?</a> <br>
                    <a href="">Become a dealer</a><br>
                    <a href="">Go back.</a>
                    </div>
            </div>
        </div>
    </div>
</div>
</section>

<?php include 'includes/footer.php';?>  
<!-- 
    The system will force the dealer to change its password if they are using the default password.
-->
<?php 
session_start();

echo $_SESSION['id'] ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
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

#error_msg,#success{
    display:none;
}

#email,#password{
    height: 50px;
}
</style>

<section class="pages-banner py-5" id="success">
    <div class="container py-5">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center text-uppercase"> Change Password Success</h1>
                <a href="dealer-task.php"><button type="button" class="form-control" id="login-btn">Procced To Portal</button> </a>
            </div>
        </div>
    </div>
</section>

<section class ="pages-content py-5" id = "login">
<div class="container">
    <div class="row">
        <h1 class="text-center text-lg-left text-uppercase">Change Password</h1>
        <p>We highly recommend for you to change your password from the password we gave.</p>

        <div class="col-md-12 col-12 my-4" id="form-content">
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <table>
                            <tr>Enter New Password:</tr>
                            <tr><input type="password" class="form-control" name = "new_pass" id="new_pass" maxlength="10"></tr>     
                            <tr><input type="checkbox" onclick="showPassword()">Show Password</tr>       
                        </table>
                        <br>

                        <button type="button" class="form-control" onclick ="change_pass()" id="login-btn">Enter</button>     
                    </div>
                </div>
        </div>
    </div>
</div>
</section>


<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

<script>
const dealer_id = <?php echo $_SESSION["id"]; ?>;

function change_pass(){
    let password = $("#new_pass").val();
    console.log(password);

    $.ajax({
        url:"ajax/change-password.php",
        type:"POST",
        data:{"id":dealer_id, "password":password},
        success:function(response){
            let parsed = JSON.parse(response);
                if(parsed.message ==  "saved"){
                    $("#login").hide();
                    $("#success").show();
                }else{
                    console.log("change error");
                }
        }
    });
    // $.ajax({
    //     url: "ajax/change-password.php",
    //     type: "POST",
    //     data: {"id":dealer_id, "password":new_pass},
    //     success:function(response){
    //         parsed = JSON.parse(response);
    //         if(parsed.message == "saved"){
    //             $("#login").hide();
    //             $("#success").show();
    //         }else{
    //             console.log("Changing error");
    //         }
    //     }
    // });
}

function showPassword(){
    let password = document.getElementById("new_pass");

    if(password.type==="password"){
        password.type = "text";
    }else{
        password.type = "password";
    }
}
</script>

<?php include 'includes/footer.php';?>  
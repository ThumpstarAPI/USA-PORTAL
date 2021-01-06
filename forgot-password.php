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

#success a{
    color:#bf0;
    text-decoration:underline;
}


#submit-btn {
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

#input_form label{
    color:#bf0;
}

#unknown, #success,#error{
    display:none;
}
</style>

<!-- Success Message  -->
<section class="pages-banner py-5" id="success">
    <div class="container py-5">
        <div class="row">
            <div class="col-12">
                <h1 class="text-uppercase"> Reset Password Completed</h1>
                <p class="text-uppercase"> Please check your email to see for the new password given. </p> 
                <p class="text-uppercase"> <a href ="https://www.thumpstarusa.com/dealer-portal/"> Proceed to portal </a></p> 
            </div>
        </div>
    </div>
</section>


<!-- Email Unknown Message  -->
<section class="pages-banner py-5" id="unknown">
    <div class="container py-5">
        <div class="row">
            <div class="col-12">
                <h1 class="text-uppercase"> Email Address Does not exsist.</h1>
                <p class="text-uppercase">Please try again, make sure email address is correct.</p>
            </div>
        </div>
    </div>
</section>

<!-- Error Message  -->
<section class="pages-banner py-5" id="error">
    <div class="container py-5">
        <div class="row">
            <div class="col-12">
                <h1 class="text-uppercase"> An error has occured.</h1>
                <p class="text-uppercase">Please try again. </p>
            </div>
        </div>
    </div>
</section>


<section class="pages-banner py-5" id="main_banner">
    <div class="container py-5">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center text-lg-left text-uppercase">Reset Password</h1>
            </div>
        </div>
    </div>
</section>


<section class="pages-content py-5" id="input_form">
    <div class="container py-5">
        <div class="row">
            <div class="col-md-6 mb-4" >
                <input type="email" name="email" class="form-control" id="email" placeholder ="Email Address" required>
                <br>
                <button type="button" class="form-control"  id="submit-btn">Enter</button>
            </div>
        </div>
        
    </div>
</section>


<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

<script>

/**
 * Checks if email exsist in the google sheet.
 */
$(function(){
    $("#submit-btn").on('click', function(e){
        e.preventDefault();

        let dealer_email = $("#email").val();
        let dealer_id = 0;
        console.log(dealer_email);

    var jsonSource = "https://spreadsheets.google.com/feeds/list/10Lf-CEqSCJpq4RKSj_VZemhFvuFQAsWyteePGNcz94k/2/public/values?alt=json";
    $.getJSON( jsonSource, function() {
        //
    })
    .done(
        function(data) {
            $.each(data.feed.entry, function(i, item){
                let email = item.gsx$email.$t;

                if( email !=dealer_email){
                    $('#unknown').show();
                    $('#main_banner').hide();
                    
                }else{
                    
                    dealer_id = i++;
                    resetPassword(dealer_id,dealer_email);
                }
            })             
        });


    });
});

/**
* Passes dealer_id to reset the password of the dealer
*/
function resetPassword(id,email){
        $.ajax({
            url: 'ajax/reset-password.php',
            data: {'dealer_id': id, 'email':email},
            type: 'POST',
            success:function(response){
               let parsed = JSON.parse(response);
               if(parsed.message == "saved"){
                $('#main_banner').hide();
                $('#error').hide();
                $('#success').show();
               }
            }
            
         });
}
</script>

<?php include 'includes/footer.php';?>  
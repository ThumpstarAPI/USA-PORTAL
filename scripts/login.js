$("#login_form").submit(function(e){
    e.preventDefault();
    let formData = new FormData(this);

   $.ajax({
    type: 'POST',
        url: 'processing/login.php',
        data: new FormData(this),
        dataType: 'json',
        contentType: false,
        cache: false,
        processData:false,
        beforeSend: function(){
        },
    success:function(response){
        if(response === false){
            $("#error").text("Invalid Credentials. Please Try Again");
            return false;
            
        }
        if(response === "Y"){
            document.location.replace("change-password.php");
            return false;
        }

        if(response === "N"){
            document.location.replace("dealer-task.php");
            return false;
        }

    }
   })
});


$(document).ready(function(){

    $.ajax({
        type: 'POST',
        url: 'processing/info.php',
        dataType:'json',
        success:function(response){
         $("#dealership").val(response.company);
         $("#email").val(response.email);
        }
    });

}
);
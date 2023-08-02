$("#email-verification-form").on('submit', function(e){
    e.preventDefault();
    $.ajax({
        type: 'POST',
        url: 'processing/forgot-password.php',
        data: new FormData(this),
        dataType: 'json',
        contentType: false,
        cache: false,
        processData:false,
        beforeSend: function(){
        },
        success: function(response){
            console.log(response);


            if(response){
                window.location.replace("./change-password.php");
            }
        }
    });
});
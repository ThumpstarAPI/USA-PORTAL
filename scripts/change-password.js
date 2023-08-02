$("#change_pass_form").submit(function(e){
    e.preventDefault();
    clearError();

   $.ajax({
    type: 'POST',
        url: 'processing/change-password.php',
        data: new FormData(this),
        type:"POST",
        dataType: 'json',
        contentType: false,
        cache: false,
        processData:false,
        beforeSend: function(){
        },
    success:function(response){
        if(response.length > 0){
            $.each(response,function(key,value){
                console.log(`${value.key} ${value.message}`) ;
                $(`#${value.key}`).text(value.message);
            });
            return false;
        }

        if(response){
            window.location.replace("../client/dealer-task.php");
        }

        if(!response){
            $(`.modal`).modal('show');
            $("#error-success-msg").text("An error has occured upon updating your password.Please try again.");

            return false;
        }


    }
   })
});

function clearError(){
    $("#conf_pass_err").text("");
    $("#pass_err_main").text("");
    $("#pass_err").text("");
}
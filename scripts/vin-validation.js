$("#vin-validation-form").on('submit', function(e){
    e.preventDefault();
    clearError();
    $.ajax({
        type: 'POST',
        url: 'processing/vin-validation.php',
        data: new FormData(this),
        dataType: 'json',
        contentType: false,
        cache: false,
        processData:false,
        beforeSend: function(){
        },
        success: function(response){

            if(response.length > 0){
                $.each(response,function(key,value){
                    console.log(`${value.key} ${value.message}`) ;
                    $(`#${value.key}`).text(value.message);
                });
                return false;
            }



            if(response){
                $(`.modal`).modal('show');
                $("#error-success-msg").text("VIN registration has been sent.");

                return false;
            }

            if(!response){
                $(`.modal`).modal('show');
                $("#error-success-msg").text("An error has occured upon saving VIN registration.");

                return false;
            }
        }
    });
});

function clearError(){
    $("#vinNumber").text("");
    $("#orderNumber").text("");
    $("#err_model").text("");
    $("#err_type").text("");
    $("#dateOfPurchase").text("");
    $("#err_customerName").text("");
}

$("#close-btn").on('click',function(){
    location.reload(true);
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
$("#info-form").on('submit', function(e){
    e.preventDefault();
    clearError();
    $.ajax({
        type: 'POST',
        url: 'processing/update-info.php',
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
                $("#error-success-msg").text("Dealer information updated.");

                return false;
            }

            if(!response){
                $(`.modal`).modal('show');
                $("#error-success-msg").text("An error has occured upon updating your information. Please try again");

                return false;
            }
        }
    });
});

function clearError(){
    $("#err_contact").text("");
    $("#err_town").text("");
    $("#err_region").text("");
    $("#err_zip").text("");

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
           $("#firstname").val(response.firstname);
           $("#lastname").val(response.lastname);
           $("#contact_number").val(response.contactNumber);
           $("#address").val(response.address);
           $("#town").val(response.town);
           $("#region").val(response.region);
           $("#zip").val(response.zipCode);

              
        }
    });

}
);
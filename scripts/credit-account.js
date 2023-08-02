$(document).ready(function(){
    $.ajax({
        url:"process/credit-computation.php",
        type:"POST",
        dataType:'json',
        success:function(response){
            $("#creditEarned").text(response.totalCredit);
            $("#total-earned").text(response.totalCredit);
            $("#creditPaid").text(response.totalPaid);
            $("#creditPaidFooter").text(response.totalPaid);
            $("#creditOwing").text(response.balance);

        }
    });
});
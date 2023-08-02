$(document).ready(function(){
    $.ajax({
        url:"processing/get-invoices.php",
        dataType:'json',
        async:false,
        type:"POST",
        success:function(response){
            $.each(response,function(index,row){
                let rows = `<tr>
                <td class="text-center">${row.date}</td>
                <td class="text-center">${row.invoiceNumber}</td>
                <td class="text-center">${row.amount}</td>
                </tr>`;

                $("#invoices").append(rows);
              
           });
        }
    });
});

$(document).ready(function(){
    $.ajax({
        url:"processing/credit-earned.php",
        type:"POST",
        async:false,
        dataType:'json',
        success:function(response){
            $("#creditEarned").text(response);

        }
    });
});

$(document).ready(function(){
    $.ajax({
        url:"processing/total-invoice.php",
        async:false,
        type:"POST",
        dataType:'json',
        success:function(response){
            $("#creditPaid").text(response);
            $("#creditPaidFooter").text(response);

        }
    });
});

$(document).ready(function(){
    $.ajax({
        url:"processing/credit-balance.php",
        type:"POST",
        async:false,
        dataType:'json',
        success:function(response){
            $("#creditOwing").text(response);
            $("#creditOwingBanner").text(response);
        }
    });
});
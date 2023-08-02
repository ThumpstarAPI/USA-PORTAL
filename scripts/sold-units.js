$(document).ready(function(){
    $.ajax({
        url:"processing/sold-units.php",
        type:"POST",
        async:false,
        dataType:'json',
        success:function(response){
           $.each(response,function(index,row){
                let rows = `<tr>
                <td class="text-center">${row.vinNumber}</td>
                <td class="text-center">${row.engineNumber}</td>
                <td class="text-center">${row.model}</td>
                <td class="text-center">${row.shipment}</td>
                <td class="text-center"></td>
                </tr>`;

                $("#sold-units").append(rows);

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
            $("#total-earned").text(response);
        }
    });
});
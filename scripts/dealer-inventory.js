$(document).ready(function(){
    $.ajax({
        url:"processing/dealer-inventory.php",
        async:false,
        type:"POST",
        dataType:'json',
        success:function(response){
           $.each(response,function(index,row){
                let rows = `<tr>
                <td class="text-center">${row.shipment}</td>
                <td class="text-center"></td>
                <td class="text-center">${row.model}</td>
                <td class="text-center">${row.vinNumber}</td>
                <td class="text-center">${row.engineNumber}</td>
                <td class="text-center">${row.stock}</td>
                </tr>`;

                $("#dealer-inventory").append(rows);

           });
        }
    });
});
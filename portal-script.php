<script>
let status = "<?php echo $status[0][0]; ?>";
const dealer_id = <?php echo $_SESSION['id']; ?>;
const dealership = "<?php echo $shop_name;?>" ;
const ca_id = "<?php echo $_SESSION['ca_id'];?>";

function showDealerInfo(){
    let jsonSource = "https://spreadsheets.google.com/feeds/list/10Lf-CEqSCJpq4RKSj_VZemhFvuFQAsWyteePGNcz94k/2/public/values?alt=json";
    $.getJSON( jsonSource, function() {
        //
    })
    .done(
        function(data) {
            let dealer_name = data.feed.entry[dealer_id].gsx$firstname.$t + " " + data.feed.entry[dealer_id].gsx$lastname.$t;
            $("#dealer_name").text(dealer_name);
  
        });
}

function getGasBikes(){
    let jsonSource = "https://spreadsheets.google.com/feeds/list/10Lf-CEqSCJpq4RKSj_VZemhFvuFQAsWyteePGNcz94k/3/public/values?alt=json";
    $.getJSON( jsonSource, function() {
        //
    })
    .done(
        function(data) {
            $.each(data.feed.entry, function(i, item){
                let model = item.gsx$model.$t;
                let quantity = item.gsx$qty.$t;
                
                let elements = `<tr>
                                    <td class="text-uppercase text-center">${model}</td>
                                    <td class="text-uppercase text-center">${quantity}</td>
                                </tr>`

                $("#gas_bikes").append(elements);               
            })
    });

}

function getTwoStrokes(){
    let jsonSource = "https://spreadsheets.google.com/feeds/list/10Lf-CEqSCJpq4RKSj_VZemhFvuFQAsWyteePGNcz94k/4/public/values?alt=json";
    $.getJSON( jsonSource, function() {
        //
    })
    .done(
        function(data) {
            $.each(data.feed.entry, function(i, item){
                let model = item.gsx$model.$t;
                let quantity = item.gsx$qty.$t;
                
                let elements = `<tr>
                                    <td class="text-uppercase text-center">${model}</td>
                                    <td class="text-uppercase text-center">${quantity}</td>
                                </tr>`

                $("#two_strokes").append(elements);               
            })
    });

}

function getElectricBikes(){
    let jsonSource = "https://spreadsheets.google.com/feeds/list/10Lf-CEqSCJpq4RKSj_VZemhFvuFQAsWyteePGNcz94k/5/public/values?alt=json";
    $.getJSON( jsonSource, function() {
        //
    })
    .done(
        function(data) {
            $.each(data.feed.entry, function(i, item){
                let model = item.gsx$model.$t;
                let quantity = item.gsx$qty.$t;
                
                let elements = `<tr>
                                    <td class="text-uppercase text-center">${model}</td>
                                    <td class="text-uppercase text-center">${quantity}</td>
                                </tr>`

                $("#electric_bikes").append(elements);               
            })
    });

}

function getDealerInventory(){
    let jsonSource = "https://spreadsheets.google.com/feeds/list/10Lf-CEqSCJpq4RKSj_VZemhFvuFQAsWyteePGNcz94k/1/public/values?alt=json";
    $.getJSON( jsonSource, function() {
        //
    })
    .done(
        function(data) {
            $.each(data.feed.entry, function(i, item){
                let year = item.gsx$my.$t;
                let order_number = item.gsx$order.$t;
                let model = item.gsx$model.$t;
                let vin_number = item.gsx$vin.$t;
                let engine_number = item.gsx$engine.$t;
                let stock = item.gsx$stock.$t;
                let credit = item.gsx$credit.$t;
                let dealer = item.gsx$dealer.$t;
                
                if(credit == "IN STOCK" && dealer == dealership){
                    let table_elements = `<tr>
                                    <td class="text-uppercase text-center">${year}</td>
                                    <td class="text-uppercase text-center">${order_number}</td>
                                    <td class="text-uppercase text-center">${model}</td>
                                    <td class="text-uppercase text-center">${vin_number}</td>
                                    <td class="text-uppercase text-center">${engine_number}</td>
                                    <td class="text-uppercase text-center">${stock}</td>
                                </tr>`;

                    let option_elements = `<option value=${i++}>${vin_number} </option>`;
                
                    $("#print_moded").append(table_elements);
                    $("#vin_numbers").append(option_elements);
                 
                }
            
            })
    });
}

function getDealerNotes(){
    let jsonSource = "https://spreadsheets.google.com/feeds/list/10Lf-CEqSCJpq4RKSj_VZemhFvuFQAsWyteePGNcz94k/1/public/values?alt=json";
    $.getJSON( jsonSource, function() {
        //
    })
    .done(
        function(data) {
            $.each(data.feed.entry, function(i, item){
                let model = item.gsx$model.$t;
                let vin_number = item.gsx$vin.$t;
                let notes = item.gsx$dealernotes.$t;
                let credit = item.gsx$credit.$t;
                let dealer = item.gsx$dealer.$t;
                // let count = 0;
                
                if(credit == "IN STOCK" && dealer == dealership && notes != ''){
                    let count = i;
                    let elements = `<tr>
                                    <td class="text-uppercase text-center">${model}</td>
                                    <td class="text-uppercase text-center">${vin_number}</td>
                                    <td class="text-uppercase text-center">${notes}</td>
                                    <td><button type="button" class="btn btn-danger" id="delete-row" onclick="deleteNote(${count++})">Delete  </button> </td>
                                </tr>`
                $("#display_notes tbody").append(elements);   
                }
            
            })
    });

}

function getCreditAccounts(){
    let jsonSource = `https://spreadsheets.google.com/feeds/list/1OfhCJ_yIMgAyFIONSsU6WnnBatpvmmCa7sU__SmK5t0/${ca_id}/public/values?alt=json`;
    $.getJSON( jsonSource, function() {
        //
    })
    .done(
        function(data) {
            $.each(data.feed.entry, function(i, item){
               let date = item.gsx$date.$t;
               let invoice = item.gsx$invoicecredited.$t;
               let amount = item.gsx$amount.$t;

               let elements = `<tr>
                                    <td class="text-uppercase text-center">${date}</td>
                                    <td class="text-uppercase text-center">${invoice}</td>
                                    <td class="text-uppercase text-center">${amount}</td>
                                </tr>`
                $("#dealer-table-credit table").append(elements);
            })

            $("#credit-earned").text(data.feed.entry[0].gsx$creditearned.$t);
            $("#credit-paid").text(data.feed.entry[0].gsx$creditpaid.$t);
            $("#credit-owing").text(data.feed.entry[0].gsx$creditowing.$t);
            $("#credit-paid-p").text(data.feed.entry[0].gsx$creditowing.$t);
            $("#parts-owing-header").text(data.feed.entry[0].gsx$creditowing.$t);



    });

}

/**
 * This function will show all neccessary pages, if the 
 * dealer is ACTIVE or INACTIVE
 */
function checkStatusToDisplay(){
    if(status.toUpperCase() == "INACTIVE"){
        $("#menus").hide();
        $("#warehouse_stock").hide();
        $("#dealer_inventory").hide();
        $("#credit-accounts").hide();
        $("#dealer_status").html("Inactive");
        $("#status-btn").html("ACTIVATE");
    }else{
        $("#dealer_status").html("Active");
        $("#status-btn").html("DEACTIVATE");
    }
}

/**
 * This function will execute the following functions if 
 * the dealer status is active:
 * getGasBikes();
 * getTwoStrokes();
 * getElectricBikes();
 * getDealerInventory();
 */
function executeViewFunctions(){
    if(status.toUpperCase() == "ACTIVE" ){
        getGasBikes();
        getTwoStrokes();
        getElectricBikes();
        getDealerInventory();
        getDealerNotes();
    }
}

$("#status-btn").click(function(){
    if(status == "ACTIVE"){
        $("#change_status_conf").text("Are you sure to deactivate your account?");
        $("#change_status_header").text("Account deactivation confirmation");
    }else{
        $("#change_status_conf").text("Do you accept the terms and conditions upon activating your dealership?");
        $("#change_status_header").text("Account activation confirmation");
    }
});

$("#change_status").click(function(){
    // let url = `ajax/update-info.php?status="${status}"&id=${dealer_id}`;
    // console.log(url);
    if(status.toUpperCase() == "ACTIVE"){
        console.log(status);
        console.log(dealer_id);
        $.ajax({
                url:"ajax/deactivate-status.php" ,
                data: {"status": status, "id":dealer_id},
                type:"POST",
                success:function(response){
                    let parsed = JSON.parse(response);

                    if(parsed.message == 'changed'){
                        location.reload();
                    }
                }
            });
    }else if(status.toUpperCase() == "INACTIVE") {
        $.ajax({
                url:"ajax/activate-status.php" ,
                data: {"status": status, "id":dealer_id},
                type:"POST",
                success:function(response){
                    let parsed = JSON.parse(response);

                    if(parsed.message == 'changed'){
                        location.reload();
                    }
                }
            });
    }
});

/**
 * Set session values to be used in other pages
 */
function setSessionValues(){
    sessionStorage.setItem("id",dealer_id);
    sessionStorage.setItem("dealership",dealership);
}

/**
 * Reloads the current page
 */
function refreshPage(){
    location.reload();
}

/**
 * Changes the background when button in clicked
 */
$(document).ready(function(){
        $("#bgColor").click(function(){
        let $name = $("#bgColor").attr('name');
            if($name === "dark"){
                $(".moded").attr('id','color-moded');
                $('#bgColor').attr('name','light');
                $("table").removeClass("text-light");
                $("#owing-banner h3").removeClass("text-light");
                $("#bgColor").text("Dark Mode")
                localStorage.setItem("btn-color-name", "light");
            }else{
                $(".moded").removeAttr('id');
                $('#bgColor').attr('name','dark');
                $("table").addClass("text-light");
                $("#owing-banner h3").addClass("text-light");
                $("#bgColor").text("Light Mode")
                localStorage.setItem("btn-color-name", "dark");

            }
         });
});

/**
 * Changes the background color if it was set before
 */
function getBackgroundAttrib(){
    let bgColor = localStorage.getItem("btn-color-name");
    if(bgColor == "light"){
        $(".moded").attr('id','color-moded');
        $('#bgColor').attr('name','light');
        $("table").removeClass("text-light");
        $("#owing-banner h3").removeClass("text-light");
        $("#bgColor").text("Dark Mode")
    }else{
        $(".moded").removeAttr('id');
        $('#bgColor').attr('name','dark');
        $("table").addClass("text-light");
        $("#owing-banner h3").addClass("text-light");
        $("#bgColor").text("Light Mode")
    }
}

/**
 * Fetches data from either dealer-inventory or credit-accounts section,
 * then creates a printable document view.
 */
function printSection(id){
    var contents = document.getElementById(id).innerHTML;
    var a = window.open('','','width=1500,height=1500');
    a.document.write('<html>');
    a.document.write(`<style>
                h1, button, a, #credit-paid-p{
                    display:none;
                }
                table{
                    border-collapse:collapse;
                    width:100%;
                    heigh:auto;  
                }
                table th, table td{
                    color:black;
                    text-align:center;
                    padding:5px;
                    border:1px solid black;
                }
    </style>`);
    a.document.write('<body> ');
    if(id === 'dealer-table-data'){
        a.document.write('<h2 style="text-align:center";> Your Inventory </h2>');
    }else{
        a.document.write('<h2 style="text-align:center";> Your Credit Account </h2>');
    }
    a.document.write(contents);
    a.document.write('</body></html>');
    a.document.close();
    a.print();
    location.reload();
}

/**
 * Saves note created by the dealer.
 */
function saveNote(){
    let option_id = $("#vin_numbers").val();
    let note_per_engine = $("#noteArea").val();

    $.ajax({
        url: "ajax/save-notes.php",
        type: "POST",
        data: {"row" : option_id, "note": note_per_engine},
        success:function(response){
            let parsed = JSON.parse(response);

            if(parsed.message == "added"){
                $("#addNotes").hide();
                $("#notesModal").hide();
                alert("A note was successfully added!");
                location.reload();
            }else{
                $("#addNotes").hide();
                $("#notesModal").hide();
                alert("There was an error!");
                location.reload();
            }
        }
    });
}

/**
 * Deletes the note created
 */
function deleteNote(id){
    $.ajax({
        url: "ajax/delete-note.php",
        data: {"row":id},
        type: "POST",
        success:function(response){
            let parsed = JSON.parse(response);
            if(parsed.message == "changed"){
                alert("A note was delete!")
                location.reload();
            }
        }
    });
}

// window.onload = function(){
    showDealerInfo();
    checkStatusToDisplay();
    executeViewFunctions();
    setSessionValues();
    getBackgroundAttrib();
    getCreditAccounts();
// }
</script>
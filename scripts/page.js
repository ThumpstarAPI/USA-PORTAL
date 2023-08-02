/**
 * This file is for changing the color of the background, printing the dealer inventory 
 * sold units and credit account.
 * 
 */


//Changes the color of the background when the button is clicked.
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

//Changes the backgroud to the color that was set.
$(document).ready(function(){
    let bgColor = localStorage.getItem("btn-color-name");
    if(bgColor === "light"){
        $(".moded").attr('id','color-moded');
        $("#bgColor").attr('name','light');
        $("table").removeClass("text-light");
        $("#bgColor").text("Dark Mode");
    }else{
        $(".moded").removeAttr('id');
        $('#bgColor').attr('name','dark');
        $("table").addClass("text-light");
        $("#owing-banner h3").addClass("text-light");
        $("#bgColor").text("Light Mode");
    }
});

/**
 * Fetches data from either dealer invetory or credit account section of the dealer portal
 * and creates a printable document file.
 */
function printSection(id){
    var contents = document.getElementById(id).innerHTML;
    var a = window.open('','','width=1500,height=1500');
    a.document.write('<html>');
    a.document.write(`<style>
                        h1,button a, #credit-pain-p{
                            display:none;
                        }

                        table{
                            border-collapse:collapse;
                            width:100%;
                            height:auto;
                        }

                        table th, table td{
                            color:black;
                            text-align:center;
                            padding:5px;
                            border:1px solid black;
                        }
                    </style>
    `);
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


$(document).ready(function(){

    $.ajax({
        type: 'POST',
        url: 'processing/info.php',
        dataType:'json',
        success:function(response){
           let name;
            if(response.firstname != null && response.lastname == null){
                name = `${response.firstname}`;
                // return false;
            }else if(response.firstname == null && response.lastname != null){
                name = `${response.lastname}`;
            }else{
                name = `${response.firstname} ${response.lastname}`;
            }
            
         $("#dealership").text(response.company);
         $("#dealerName").text(name);

         
        }
    });

}
);
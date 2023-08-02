<?php
    session_start();
    if(!isset($_SESSION['dealerID'])) header("Location:logout.php"); 
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Thumpstar USA | Dealer Section</title>

<style>
a.task-btn {
    border: 1px solid #bf0;
    border-radius: 5px;
    color: #bf0;
    font-family: 'Impact';
    font-size: 40px;
    transition: .5s ease;
}
a.task-btn:hover {
    background: #bf0;
    color: #000;
}
a.task-btn.highlight {
    animation: bounce 2s infinite;
    -webkit-animation: bounce 2s infinite;
    -moz-animation: bounce 2s infinite;
    -o-animation: bounce 2s infinite;
}


@-webkit-keyframes bounce {
	0%, 20%, 50%, 80%, 100% {-webkit-transform: translateY(0);}	
	40% {-webkit-transform: translateY(-30px);}
	60% {-webkit-transform: translateY(-15px);}
}
 
@-moz-keyframes bounce {
	0%, 20%, 50%, 80%, 100% {-moz-transform: translateY(0);}
	40% {-moz-transform: translateY(-30px);}
	60% {-moz-transform: translateY(-15px);}
}
 
@-o-keyframes bounce {
	0%, 20%, 50%, 80%, 100% {-o-transform: translateY(0);}
	40% {-o-transform: translateY(-30px);}
	60% {-o-transform: translateY(-15px);}
}
@keyframes bounce {
	0%, 20%, 50%, 80%, 100% {transform: translateY(0);}
	40% {transform: translateY(-30px);}
	60% {transform: translateY(-15px);}
}

#status{
        background: #bf0;
        color: #000;
        text-transform: uppercase;
        border: 2px solid #bf0;
        height:50px;
}
#mode button{
    background: #bf0; margin:0; padding-top: 0; border: 2px solid #bf0; height:35px; color:#000;
}

#mode a{
    color:#000;
}

#color-moded{
    background:#ffff;
}

#color-moded h1, #color-moded h2 ,#color-moded p{
    color:#000;

}

#color-moded a.task-btn{
    border: 1px solid #000;
    background: #fff;
    color:#000;
}

#color-moded a.task-btn:hover{
    background: #bf0;
}

h1,h2,h3{
    color:#bf0;
}
</style>
<?php include 'includes/header.php'; ?>



<!-- Content Goes Here -->
<section class="pages-banner py-5">
    <div class="container py-5">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center text-lg-left text-uppercase">Sold Units</h1>
                <p>Credit Earned</p>
            </div>
        </div>
    </div>
</section>

<section class="moded pages-content py-5" >
<div class="container py-5">
    <div class="row">
    <div class="col-12" id="mode">
                        <button type="button" id= "home-btn" class="btn btn-primary btn-lg" onclick="location.href = 'dealer-task.php';">
                            Home
                        </button>

                         <button type="button" class="btn btn-info btn-lg" onclick = "window.location.reload();"> Reload </button>
                         <button type="button" class="btn btn-primary btn-lg" id="bgColor" name="dark">Light Mode</button>
                         <button type="button" style="float:right" class="btn btn-primary btn-lg" id="" onclick="printSection('sold-units-table')" >Print A Copy</button>


                    </div>
        <div class="col-12">
        <br>
        <br>
        <p> Total Credit Earned: <span id="total-earned"> </span> </p>
        <h1 class="text-center text-lg-left text-uppercase" style="color:#bf0"></h1>
            <div class="table-responsive" style="height:600px;" id="sold-units-table">
                <table class="table table-striped text-light">
                    <thead>
                        <th class='text-center'> VIN </th>
                        <th class='text-center'> Engine Number </th>
                        <th class='text-center'> Model </th>
                        <th class='text-center'> Shipment</th>
                        <th class='text-center'> Order Number</th>

                    </thead>

                    <tbody id="sold-units">
                  
                    </tbody>
                </table>    
        </div>
    </div>
</div>
</section>


<script type="text/javascript" src="scripts/sold-units.js"> </script>
<script type="text/javascript" src="scripts/page.js"> </script>
<?php include 'includes/footer.php'; ?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Thumpstar AU | Dealer Section</title>

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


#status,#reload{
        background: #bf0;
        color: #000;
        text-transform: uppercase;
        border: 2px solid #bf0;
        height:50px;
}

#mode{
    height:10px;
    padding:0;
    margin:0;
}

#mode button{
    float:right;
    color:#000;
    background: #bf0;
    margin:0;
    padding-top: 0;
    border: 2px solid #bf0;
    height:35px;
}

#color-moded{
    background:#ffff;
}

#color-moded h1, #color-moded h2 ,#color-moded h3,#color-moded p{
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

#default, #mode{
    background:#000;
}
span a{
    color:#bf0;
}
span a:hover{
    color:#fff;
}

#color-moded span a{
    color:#808080;
}
#color-moded span a:hover{
    color:#000;
}

#print-btn, #notes-btn{
    float:right;
    color:#000;
    background: #bf0;
    margin:3px ;
    padding-top: 0;
    border: 2px solid #bf0;
    height:35px;
}

#status-btn{
    color:#000;
    background: #bf0;
    border: 2px solid #bf0;
}


#display_notes input[type="checkbox"]{
    width: 20px; /*Desired width*/
    height: 20px; /*Desired height*/
}

/* #owing-banner{
    font-family:
} */

 #referal{
    display:none;
} 
</style>

<?php include 'includes/header.php'; ?>

<!-- Content Goes Here -->
<section class="pages-banner py-5">
    <div class="container py-5">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center text-lg-left text-uppercase">Dealer Portal</h1>
                <p class="text-center text-lg-left">Please choose if you want to update your shop stock or if you want to order new bikes.</p>
            </div>
        </div>
    </div>
</section>

<section class="pages-content py-5" id="default">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="pt-5 text-center">Welcome <u><span id="dealerName"></u> of <span id="dealership"></span>!<br>  What do you want to do today?</h2>
            </div>
    </div>
    </div>
</section>

<!-- Dark or Light Mode button -->
<section class="pages-content py-5" id="mode">
    <div class="container">
        <div class="row">
        <div class="col-12">
            <button type="button" class="btn btn-primary btn-lg" id="bgColor" name="dark">
                 Light Mode 
            </button>
        </div>
        </div>
</section>

<section class="moded pages-content py-5" id="default">
    <div class="container">
        <div class="row">
            <div class="col-12" id="owing-banner">
              <h3 class = "text-center text-light" style="font-size:50px;"> <img src="includes/money-bag.png" style = "heigh:100px; width: 50px;"> Your Parts Credit Owing: <span id= "creditOwingBanner"></span>  <img src="includes/money-bag.png" style = "heigh:100px; width: 50px;"> </h3>
            </div>
        </div>
    </div>
</section>    
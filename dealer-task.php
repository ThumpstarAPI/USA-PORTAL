<?php
    session_start();

    //checks if a session has started.
    if(isset($_SESSION['dealerID'])){
        include("includes/banner.php");
        include("includes/menus.php");
        include("includes/inventory.php");
        include("includes/credit-accounts.php");
        echo "<script type='text/javascript' src = 'scripts/page.js'></script>";
        echo "<script type='text/javascript' src = 'scripts/dealer-inventory.js'></script>";
        echo "<script type='text/javascript' src = 'scripts/invoices.js'></script>";
        include("includes/footer.php");
    }else{
        header("Location:logout.php");
    }
?>
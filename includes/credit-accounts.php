<section class="moded pages-content py-5 " id="">
<div class="container py-5 " id="credit-accounts">
    <div class="row">
        <div class="col-12">
        <h1 class="text-center text-lg-left text-uppercase">Credit Account <button type="button" class="btn btn-primary btn-lg" id="print-btn" name="print_inventory" onclick = "printSection('credit-accounts')">
                 Print A Copy
            </button></h1>

        <div class="col-12"> 
        <p > Credit Earned:<span id ="creditEarned"> </span> <span> <a href="sold-units.php"> View Credit Earned</a></p>
        <p > Credit Paid:<span id ="creditPaid"> </span> </p>
        <p > Parts Credit Owing :<span id ="creditOwing"> </span> </p>
        </div>
            <div class="table-responsive" style="max-height:410px;" id="dealer-table-credit">
                <table class="table table-striped text-light" id ="print_moded invoices">
                    <thead>
                         <th class="text-center">Date</th>
                        <th class="text-center">Invoice Credited</th>
                        <th class="text-center">Amount</th>

                    </thead>
                    
                    <tbody id="invoices"></tbody>

                    
                </table>    
            </div>
            <div class="col-12" style="margin-top:0; padding-top:0;"> 
            <p style="float:right;  margin-right:50px;" > Credit Paid: <span id="creditPaidFooter"> </span> </p>
            </div>
    </div>
</div>
</section>

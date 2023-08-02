<!-- SHOWS DEALERS INVENTORY -->
<section class="moded pages-content py-5" >
<div class="container py-5" id="dealer_inventory">
    <div class="row">
        <div class="col-12">
        <h1 class="text-center text-uppercase">Your Inventory</h1>
            <button type="button" class="btn btn-primary btn-lg" id="print-btn" name="print_inventory" onclick = "printSection('dealer-table-data')">
                 Print A Copy
            </button> 

            
            <div class="table-responsive" style="max-height:410px;" id="dealer-table-data">
            <br>
                <table class="table table-striped text-light" id="print_moded">
                    <thead>
                        <th class="text-center">YEAR</th>
                        <th class="text-center">ORDER</th>
                        <th class="text-center">MODEL</th>
                        <th class="text-center">VIN</th>
                        <th class="text-center">Engine Number</th>
                        <th class="text-center">Stock</th>
                    </thead>
                    <tbody id="dealer-inventory">
                    </tbody>
                </table>    
        </div>
    </div>
</div>
</section>


































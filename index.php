<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="assets/fontawesome/css/all.min.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Company Storefront</title>
  </head>
  <body>
    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-dark">
    <a class="navbar-brand py-4" href="#">
        Storefront Billing Form
    </a>
    </nav>

      <div class="container-fluid py-4">
        <div class="form-group row">
            <div class="col-md-4">
                <label class="mb-0" for="description">Description</label>
            </div>
            <div class="col-md-2">
                <label class="mb-0" for="cost">Cost</label>
            </div>
            <div class="col-md-2">
                <label class="mb-0" for="cost">Quantity</label>
            </div>
            <div class="col-md-1">
                <label class="mb-0" for="cost">VAT(%)</label>
            </div>
            <div class="col-md-2">
                <label class="mb-0" for="cost">Total</label>
            </div>
            <div class="col-md-1 text-center">
                <label class="mb-0" for="cost">Actions</label>
            </div>
        </div>
        <div class="form-group row mb-2 item-fields" id="template">
            <div class="col-md-4">
                <input type="email" class="form-control" name="description">
            </div>
            <div class="col-md-2">
                <input type="number" class="form-control cost" name="cost[]" value="0">
            </div>
            <div class="col-md-2">
                <input type="number" class="form-control quantity" name="quantity[]" value="0">
            </div>
            <div class="col-md-1">
                <input type="number" class="form-control vat" name="vat[]" value="0">
            </div>
            <div class="col-md-2 d-flex align-items-center text-bold">
                <div>$<span class="total">0</span></div>
            </div>
            <div class="col-md-1 d-flex align-items-center justify-content-center text-center text-danger">
                <a class="deleteItemButton"><i class="fa fa-trash"></i></a>
            </div>
        </div>
        <div class="form-group row mb-4 pb-4">
            <div class="col-md-12">
                <button class="btn btn-secondary btn-sm" id="addItemButton">Add item</button>
            </div>
        </div>
        <hr>
        <div class="row d-flex justify-content-end">
            <div class="col-md-5 pr-4 mr-4" id="summaries">
                <div class="d-flex justify-content-between" id="subtotals-elements">
                    <div>
                        Subtotal
                    </div>
                    <div>
                        $<span id="subtotal">0</span>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <div>
                        VAT Total
                    </div>
                    <div>
                        $<span id="vat-total">0</span>
                    </div>
                </div>
                <hr>
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2>Total</h2>
                    </div>
                    <div >
                        <h2>$<span id="total">0</span></h2>
                    </div>
                </div>
            </div>
        </div>
      </div>
    
<script>
$(document).ready(function(){
    $(document).on("click", "#addItemButton", function(e){
        console.log("Add item fields");
        var control = $("#template");
        var clone = $(control).clone();
        $(clone).find("[name='cost[]']").val("0");
        $(clone).find("[name='quantity[]']").val("0");
        $(clone).find("[name='vat[]']").val("0");
        $(clone).find(".total").html("0");
        $(clone).removeAttr('id').insertBefore(this);
    });

    $(document).on("click", ".deleteItemButton", function(e){
        e.preventDefault();
        if($(this).closest('.form-group').attr('id') != "template"){
            console.log("Delete item fields");
            $(this).closest('.form-group').remove();
        }
        updateTotal();
    });

    $(document).on("keyup", "[name='cost[]']", function(e){
        var row = $(this).closest('.form-group');
        updateRowTotal(row);
        updateTotal();
    });

    $(document).on("change", "[name='cost[]']", function(e){
        var row = $(this).closest('.form-group');
        updateRowTotal(row);
        updateTotal();
    });

    $(document).on("keyup", "[name='quantity[]']", function(e){
        var row = $(this).closest('.form-group');
        updateRowTotal(row);
        updateTotal();
    });

    $(document).on("change", "[name='quantity[]']", function(e){
        var row = $(this).closest('.form-group');
        updateRowTotal(row);
        updateTotal();
    });

    $(document).on("keyup", "[name='vat[]']", function(e){
        var row = $(this).closest('.form-group');
        updateRowTotal(row);
        updateTotal();
    });

    $(document).on("change", "[name='vat[]']", function(e){
        var row = $(this).closest('.form-group');
        updateRowTotal(row);
        updateTotal();
    });
});

function updateRowTotal(row){
    console.log("Updating row total");
    var cost = $(row).find("[name='cost[]']").val();
    var quantity = $(row).find("[name='quantity[]']").val();

    var total = cost * quantity;
    $(row).find(".total").html(total);
}

function updateTotal(){
    $(".vat-breakdowns").remove();

    var total = 0;
    var subtotal = 0;
    var vat_total = 0;
    var row_total = 0;
    var row_vat = 0;
    var vat_html = "";


    $(".item-fields").each(function(index, item) {
        row_total = parseInt($(this).find('.total').text());
        row_vat = parseInt($(this).find("[name='vat[]']").val());
        
        row_vat_amount = row_vat/100 * row_total;
        vat_total += row_vat_amount;
        subtotal += row_total;
        
        if(row_vat != 0 && !isNaN(row_vat)){
            if($("#summaries").find("[data-vat='"+row_vat+"']").length != 0){
                console.log("found");
                console.log($("#summaries").find("[data-vat='"+row_vat+"']"));
            }
            else{
                console.log("nomaaa");
                console.log($("#summaries").find("[data-vat='"+row_vat+"']"));
            }
            vat_html += 
            `
            <div class="d-flex justify-content-between vat-breakdowns" data-vat="${row_vat}">
                <div>
                    VAT (${row_vat}%)
                </div>
                <div>
                    $<span id="vat-total">${row_vat_amount}</span>
                </div>
            </div>
            `;
        }
        else{
            row_vat = 0;
        }

        
    });

    total = subtotal + vat_total;

    $("#vat-total").html(vat_total);
    $("#subtotal").html(subtotal);
    $("#total").html(total);
    $(vat_html).insertAfter("#subtotals-elements");
}

</script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
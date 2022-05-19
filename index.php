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
            <div class="col-md-3">
                <label class="mb-0" for="description">Description</label>
            </div>
            <div class="col-md-2">
                <label class="mb-0" for="cost">Cost</label>
            </div>
            <div class="col-md-2">
                <label class="mb-0" for="cost">Cost</label>
            </div>
            <div class="col-md-2">
                <label class="mb-0" for="cost">Cost</label>
            </div>
            <div class="col-md-2">
                <label class="mb-0" for="cost">Total</label>
            </div>
            <div class="col-md-1">
                <label class="mb-0" for="cost">Actions</label>
            </div>
        </div>
        <div class="form-group row mb-2" id="template">
            <div class="col-md-3">
                <input type="email" class="form-control" id="description" name="description">
            </div>
            <div class="col-md-2">
                <input type="number" class="form-control" id="cost" name="cost" value="0">
            </div>
            <div class="col-md-2">
                <input type="number" class="form-control" id="cost" name="quantity" value="0">
            </div>
            <div class="col-md-2">
                <input type="number" class="form-control" id="cost" name="vat" value="0">
            </div>
            <div class="col-md-2">
                <input type="number" class="form-control" id="cost" value="0" name="cost" readonly>
            </div>
            <div class="col-md-1 d-flex align-items-center text-center text-danger">
                <a><i class="fa fa-trash"></i></a>
            </div>
        </div>
        <div class="form-group row mb-4 pb-4">
            <div class="col-md-12">
                <button class="btn btn-info btn-sm" id="addItemButton">Add item</button>
            </div>
        </div>
        <hr>
        <div class="row d-flex justify-content-end">
            <div class="col-md-5 pr-4 mr-4">
                <div class="d-flex justify-content-between">
                    <div>
                        Subtotal
                    </div>
                    <div id="subtotal">
                        $0
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <div>
                        VAT Total
                    </div>
                    <div id="vat-total">
                        $0
                    </div>
                </div>
                <hr>
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2>Total</h2>
                    </div>
                    <div >
                        <h2 id="total">$0</h2>
                    </div>
                </div>
            </div>
        </div>
      </div>
    
<script>
$(document).ready(function(){
    $(document).on("click", "#addItemButton", function(e){
        console.log("dsf");
        var control = $("#template");
        var clone = $(control).clone();
        $(clone).removeAttr('id').insertAfter(control);
    });

    $(document).on("change", "[name='county_id']", function(e){
        var county = $(this).val();
        $.updateOutputs(county);
    });
});
(function($){
    $.updateTotal = function (county){
        $('select').selectpicker();
        $.get("/data/sub_county/get_list_county_filter?county="+county, function(data, status){
            var data = JSON.parse(data);
            var sub_counties = '';
            $.each(data.sub_counties, function(k,v){
                sub_counties += 
                    `
                        <option value='${v.id}'>${v.name}</option>
                    `;

              });
            $('[name="sub_county_id"]').html(sub_counties);
            $('select').selectpicker('refresh');
        });    
    }

    $.updateOutputs = function (county){
        $('select').selectpicker();
        $.get("/data/sub_county/get_list_county_filter?county="+county, function(data, status){
            var data = JSON.parse(data);
            var sub_counties = '';
            $.each(data.sub_counties, function(k,v){
                sub_counties += 
                    `
                        <option value='${v.id}'>${v.name}</option>
                    `;

              });
            $('[name="sub_county_id"]').html(sub_counties);
            $('select').selectpicker('refresh');
        });    
    }
})(jQuery);
</script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
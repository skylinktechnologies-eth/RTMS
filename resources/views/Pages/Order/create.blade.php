<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">

    <!-- Icomoon Font Icons css -->
    <link rel="stylesheet" href="../../fonts/style.css">

    <!-- Main css -->
    <link rel="stylesheet" href="../../css/main.min.css">

    <!-- DateRange css -->
    <link rel="stylesheet" href="../../vendor/daterange/daterange.css" />

    <!-- Chartist css -->
    <link rel="stylesheet" href="../../vendor/chartist/css/chartist.min.css" />
    <link rel="stylesheet" href="../../vendor/chartist/css/chartist-custom.css" />
    <!-- Data Tables -->
    <link rel="stylesheet" href="../../vendor/datatables/dataTables.bs4.css" />
    <link rel="stylesheet" href="../../vendor/datatables/dataTables.bs4-custom.css" />
    <link href="../../vendor/datatables/buttons.bs.css" rel="stylesheet" />
    <!-- Bootstrap Select CSS -->
    <link rel="stylesheet" href="../../vendor/bs-select/bs-select.css" />
    <!-- jQcloud Keywords css -->
    <link rel="stylesheet" href="../../vendor/jqcloud/jqcloud.css" />


</head>

<body style="background-color: rgb(232, 229, 229)">

    <div>
        <nav class="navbar fixed-top bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Fixed top</a>
            </div>
        </nav>

        <div class=" card">
            <div class="card-body"></div>
        </div>


        <div class=" container">
            <div class="card-body"></div>
        </div>


        <div class="row gutters">
            <div class="col-sm-3">

            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="filter" aria-label="filter">
                </div>
            </div>
        </div>
        <hr>
        <form action="{{ route('order.store') }}" method="POST">
                                
            @csrf 
        <div class="row gutters pb-2">
            
                <div class="col-0 ">
                    {{-- <div class="card ">
                    <div class="card-header"></div>
                    <div class="card-body">
                        <ul>
                            <li class=" center">All category</li>
                            <li>Drink</li>
                            <li>berger</li>
                        </ul>
                    </div>
                </div> --}}

                </div>
                <div class="col-6 ">
                    <div class="card ">
                        <div class="card-header">
                            <div class="row">
                                   
                                    <div class="col-sm-4">
                                    <div class="form-group">
                                        <input type="date" name="order_date" class="form-control"
                                            value="{{ now()->toDateString() }}" id="order_date">
                                        @error('order_date')
                                            <div class="alert alert-danger">
                                                {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <select class="form-control selectpicker" id="table_id" name="table_id[]"
                                        data-live-search="true">
                                        <option value="">select Item</option>
                                        @foreach ($tables as $table)
                                            <option value="{{ $table->id }}">
                                                {{ $table->table_name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                               
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <div class="card" style="">
                                        <div class="accordion toggle-icons" id="toggleIcons">
                                            <div class="accordion-container" style="">
                                                <div class="accordion-header" id="toggleIconsOne">
                                                    <a href="" class="" data-toggle="collapse"
                                                        data-target="#toggleIconsCollapseOne" aria-expanded="true"
                                                        aria-controls="toggleIconsCollapseOne">
                                                        <img src="th.jpeg" alt=""
                                                            style="width: 70px;hight:80px">
                                                        <input type="text" readonly placeholder="Piza" id="item_id"
                                                            name="item_id[]" value="piza"
                                                            style="width: 80px;hight:80px;border:none">
                                                    </a>
                                                </div>
                                                <div id="toggleIconsCollapseOne" class="collapse "
                                                    aria-labelledby="toggleIconsOne" data-parent="#toggleIcons">
                                                    <div class="accordion-body">
                                                        <input type="hidden" placeholder="price" id="price"
                                                            name="price[]" value="10">
                                                        <div class="form-group">

                                                            <input type="text" class="form-control" id="quantity"
                                                                name="quantity[]" placeholder="Quantity"
                                                                aria-label="filter">
                                                        </div>
                                                        <div class="form-group">

                                                            <textarea class="form-control" placeholder="remark" id="remark" name="remark[]" aria-label="filter"></textarea>
                                                        </div>
                                                        <div class="center">
                                                            <div class="col"> <a class="btn btn-primary"
                                                                    onclick="addList()"><i class="icon-plus"
                                                                        style="color: white"></i></a></div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>


                            </div>
                        </div>

                    </div>


                </div>

                <div class="col-5">
                    <div class="card">
                        <div class="card-header"></div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-centered border table-nowrap mb-lg-0" id="itemList">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Items</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>subTotal</th>
                                            <th>Remark</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                                <div id="totalAmount"></div>
                            </div>
                        </div>

                    </div>

                </div>

          
        </div>
        <div class="row gutters">
            <div class="col-sm-12">
                <div class="text-center mt-4 ">
                    <button  class="btn btn-primary " type="submit">Submit</button>
                </div>
            </div>
        </div>
       
        </form>


    </div>
    <script>
        // Your JavaScript code goes here
        function addList() {
            // Get values from inputs
            var itemName = $('#item_id').val();
            var price = $('#price').val();
            var quantity = $('#quantity').val();
            var remark = $('#remark').val();

            // Perform any additional logic here (e.g., validation)

            // Calculate subtotal
            var subtotal = price * quantity;

            // Append data to the table (you can modify this based on your table structure)
            var newRow = '<tr><td>' + itemName + '</td><td>' + quantity + '</td><td>' + price + '</td><td>' + subtotal +
                '</td><td>' + remark + '</td></tr>';
            $('#itemList tbody').append(newRow);

            // Calculate and display total amount
            var totalAmount = 0;
            $('#itemList tbody tr').each(function() {
                totalAmount += parseFloat($(this).find('td:nth-child(4)').text()) || 0;
            });

            $('#totalAmount').text('Total Amount: ' + totalAmount);

            // Clear input fields after adding the item
            $('#quantity, #remark').val('');
        }
    </script>




    <script src="../../js/jquery.min.js"></script>
    <script src="../../js/bootstrap.bundle.min.js"></script>
    <script src="../../js/moment.js"></script>


    <!-- *************
   ************ Vendor Js Files *************
  ************* -->
    <!-- Slimscroll JS -->
    <script src="../../vendor/slimscroll/slimscroll.min.js"></script>
    <script src="../../vendor/slimscroll/custom-scrollbar.js"></script>

    <!-- Daterange -->
    <script src="../../vendor/daterange/daterange.js"></script>
    <script src="../../vendor/daterange/custom-daterange.js"></script>

    <!-- Data Tables -->
    <script src="../../vendor/datatables/dataTables.min.js"></script>
    <script src="../../vendor/datatables/dataTables.bootstrap.min.js"></script>

    <!-- Custom Data tables -->
    <script src="../../vendor/datatables/custom/custom-datatables.js"></script>
    <script src="../../vendor/datatables/custom/fixedHeader.js"></script>

    <!-- Download / CSV / Copy / Print -->
    <script src="../../vendor/datatables/buttons.min.js"></script>
    <script src="../../vendor/datatables/jszip.min.js"></script>
    <script src="../../vendor/datatables/pdfmake.min.js"></script>
    <script src="../../vendor/datatables/vfs_fonts.js"></script>
    <script src="../../vendor/datatables/html5.min.js"></script>
    <script src="../../vendor/datatables/buttons.print.min.js"></script>
    <!-- Chartist JS -->
    <script src="../../vendor/chartist/js/chartist.min.js"></script>
    <script src="../../vendor/chartist/js/chartist-tooltip.js"></script>
    <script src="../../vendor/chartist/js/custom/threshold/threshold.js"></script>
    <script src="../../vendor/chartist/js/custom/bar/bar-chart-orders.js"></script>

    <!-- jVector Maps -->
    <script src="../../vendor/jvectormap/jquery-jvectormap-2.0.3.min.js"></script>
    <script src="../../vendor/jvectormap/world-mill-en.js"></script>
    <script src="../../vendor/jvectormap/gdp-data.js"></script>
    <script src="../../vendor/jvectormap/custom/world-map-markers2.js"></script>

    <!-- Rating JS -->
    <script src="../../vendor/rating/raty.js"></script>
    <script src="../../vendor/rating/raty-custom.js"></script>
    <!-- Bootstrap Select JS -->
    <script src="../../vendor/bs-select/bs-select.min.js"></script>

    <!-- Apex Charts -->
    <script src="../../vendor/apex/apexcharts.min.js"></script>
    <script src="../../vendor/apex/quick-dashboard/tasks.js"></script>
    <script src="../../vendor/apex/quick-dashboard/compare-sales.js"></script>
    <script src="../../vendor/apex/quick-dashboard/compare-sales1.js"></script>

    <!-- jQcloud Keywords -->
    <script src="../../vendor/jqcloud/jqcloud-1.0.4.min.js"></script>
    <script src="../../vendor/jqcloud/custom-jqcloud.js"></script>

    <!-- jVector Maps -->
    <script src="../../vendor/jvectormap/jquery-jvectormap-2.0.3.min.js"></script>
    <script src="../../vendor/jvectormap/gdp-data.js"></script>
    <script src="../../vendor/jvectormap/africa-mill.js"></script>

    <!-- Custom JVector Maps -->
    <script src="../../vendor/jvectormap/custom/map-africa1.js"></script>



    <!-- Main JS -->
    <script src="../../js/main.js"></script>
</body>

</html>

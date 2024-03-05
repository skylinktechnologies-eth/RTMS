@extends('Frames.app')
@section('content')
    <div class="main-container">

        <div class="card pt-1" style="">
            <div class="row d-flex align-items-end">

                <div class="col-md-1 d-flex justify-content-end">

                </div>
                <div class="col-md-12">
                    <div class="">
                        <h3 class="text-white"></h3>
                    </div>
                    <ul class="nav nav-tabs  nav-bordered">
                        <li class="nav-item">
                            <a href="{{ route('report.index') }}" aria-expanded="true" class="nav-link ">
                                <span class="d-inline-block d-sm-none"><i class="icon-show_chart "></i></span>
                                <span class="d-none d-sm-inline-block">Sales</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('report.purchase') }}" aria-expanded="true" class="nav-link active">
                                <span class="d-inline-block d-sm-none"><i class="icon-activity"></i></span>
                                <span class="d-none d-sm-inline-block">Purchase</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('report.inventory') }}" aria-expanded="false" class="nav-link">
                                <span class="d-inline-block d-sm-none"><i class="icon-check2"></i></span>
                                <span class="d-none d-sm-inline-block">Inventory</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
            <hr>
        
            <div class="card rounded-3 border-primary px-3 mt-3" >
                <div class="card-header border-all bg-white rounded-3" style="margin-top: -10px;">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="text-info">Purchase Report</h4>
                        <form class="d-flex align-items-center" method="GET" action="">
                            @csrf
                            <div class="form-group mb-0">
                                <div class="row">
                                    <div class="col">
                                        <label for="start_date">From</label>
                                        <input class="form-control date" type="date" id="start_date" name="start_date">
                                    </div>
                                    <div class="col">
                                        <label for="end_date">To</label>
                                        <input class="form-control date" type="date" id="end_date" name="end_date">
                                    </div>
                                    <div class="col-auto mt-3">
                                        <button type="submit" class="btn btn-primary">Go</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @php
                $total = 0;
            @endphp
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="copy-print-purchase" class="table custom-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Date</th>
                                    <th>Supply Item</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($supplyOrderItems as $index => $supplyOrderItem)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $supplyOrderItem->order_date}}</td>
                                        <td>{{ $supplyOrderItem->item->item_name }}</td>
                                        <td>{{ $supplyOrderItem->total_quantity }}</td>
                                        <td>{{ number_format($supplyOrderItem->average_price, 2) }}</td>
                                        <td>{{ number_format($supplyOrderItem->total, 2) }}</td>
                                    </tr>
                                    @php
                                    $total += $supplyOrderItem->total;
                                @endphp
                                @endforeach
                               
                            </tbody>
                             <tr>
                                    <td colspan="5" style="text-align: right;"><strong>Total Amount:</strong></td>
                                    <td> <strong>{{ $total }}</strong></td>
                                </tr>
                        </table>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <script>
      
      var monthText = 'Employees information report';

$('#datatable-button').DataTable({
    dom: 'Bfrtip',
    buttons: [
        {
            extend: 'print',
            title: '',
            customize: function (win) {
                $(win.document.body).find('h1').css('font-size', '18px'); // Change the title font size
                $(win.document.body).find('table').addClass('compact').css('font-size', '14px'); // Change the table font size
            }
        },
        'pdf'
    ]
});


    </script>
@endsection

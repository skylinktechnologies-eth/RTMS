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
                            <a href="{{ route('report.index') }}" aria-expanded="true" class="nav-link active">
                                <span class="d-inline-block d-sm-none"><i class="mdi mdi-account"></i></span>
                                <span class="d-none d-sm-inline-block">Sales</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('report.purchase') }}" aria-expanded="false" class="nav-link ">
                                <span class="d-inline-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
                                <span class="d-none d-sm-inline-block">Purchase</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('report.inventory') }}" aria-expanded="false" class="nav-link">
                                <span class="d-inline-block d-sm-none"><i class="mdi mdi-email-variant"></i></span>
                                <span class="d-none d-sm-inline-block">Inventory</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
            <hr>

            <div class="card rounded-3 border-primary px-3 mt-3">
                <div class="card-header border-all bg-white rounded-3" style="margin-top: -10px;">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="text-info">Sales Report</h4>
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
                        <table id="copy-print-sales" class="table custom-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Date</th>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th>Total </th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($orderItems as $index => $orderItem)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $orderItem->order_date }}</td>
                                        <td>{{ $orderItem->menuItem->item_name }}</td>
                                        <td>{{ $orderItem->total_quantity }}</td>
                                        <td>{{ $orderItem->sub_total }}</td>
                                    </tr>
                                    @php
                                        $total += $orderItem->sub_total;
                                    @endphp
                                @endforeach

                            </tbody>
                            <tr>
                                <td colspan="4" style="text-align: right;"><strong>Total Amount:</strong></td>
                                <td> <strong>{{ $total }}</strong></td>
                            </tr>
                        </table>
                    </div>

                </div>

            </div>
        </div>
    </div>
    {{-- <script>
        $(function() {
            $('#copy-print').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5',
                    'print'
                ],
                'iDisplayLength': 10,
            });
        });
    </script> --}}
@endsection

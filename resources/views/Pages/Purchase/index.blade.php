@extends('Frames.app')
@section('content')
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Purchase</li>
            <li class="breadcrumb-item active">Supply Orders</li>
        </ol>

        <ul class="app-actions">
            <li>
                <a href="#" id="reportrange">
                    <span class="range-text"></span>
                    <i class="icon-chevron-down"></i>
                </a>
            </li>
            <li>
                <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Print">
                    <i class="icon-print"></i>
                </a>
            </li>
            <li>
                <a href="#" data-toggle="tooltip" data-placement="top" title=""
                    data-original-title="Download CSV">
                    <i class="icon-cloud_download"></i>
                </a>
            </li>
        </ul>
    </div>

    <div class="main-container">
     



        @if (session('success'))
            <div class="row">

                <div class="col-md-4">

                </div>
                <div class="col-md-4">

                </div>
                <div class="col-md-4">
                    <div class="alert alert-success px-3" id="success-alert">

                        {{ session('success') }}
                    </div>
                </div>
            </div>
        @endif
        <div class="row gutters">
            <div class="col-sm-12">
                <div class="text-right mb-3">
                    <!-- Button trigger modal -->
                    <a href="{{ route('purchase.create') }}" type="button" class="btn btn-primary">Add New
                        Supply Orders</a>
                </div>
            </div>
        </div>
        <!-- Row start -->
        <div class="row gutters">
            <div class="col-sm-12">
                <div class="table-container">
                    <div class="table-responsive">
                        <table id="basicExample" class="table custom-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Date</th>
                                    <th>Supplier</th>
                                  
                                    <th>Total</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 0;
                                @endphp
                                @php
                                $groupedOrderItems = [];
                            
                                foreach ($orderItems as $orderItem) {
                                    $supplyOrderId = $orderItem->supplyOrder->id;
                            
                                    if (!isset($groupedOrderItems[$supplyOrderId])) {
                                        $groupedOrderItems[$supplyOrderId] = [
                                            'total' => 0,
                                            'orderItem' => $orderItem, // Store one representative order item for details
                                        ];
                                    }
                            
                                    $groupedOrderItems[$supplyOrderId]['total'] += $orderItem->total;
                                }
                            @endphp
                            
                            @foreach ($groupedOrderItems as $supplyOrderId => $groupedOrderItem)
                                @php
                                    $total = $groupedOrderItem['total'];
                                    $orderItem = $groupedOrderItem['orderItem'];
                                @endphp
                             @php
                             $no = $no + 1;
                         @endphp
                                <tr>
                                    <!-- Display details from representative order item -->
                                    <td>{{ $no }}</td>
                                    <td>{{ $orderItem->supplyOrder->order_date }}</td>
                                    <td>{{ $orderItem->supplyOrder->supplier->supplier_name }}</td>
                                   
                                    <td>{{  $total  }}</td>
                                    
                                    <!-- Display action buttons -->
                                    <td>
                                        <div class="d-flex">
                                            <a type="link" href="{{ route('purchase.edit', $orderItem->supply_order_id) }}">
                                                <i class="icon-edit" style="color: blue"></i>
                                            </a>
                            
                                            <form action="{{ route('purchase.destroy', $orderItem->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-link p-0">
                                                    <i class="icon-trash-2" style="color:red"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                               
                            @endforeach
                            


                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <!-- Row end -->
@endsection

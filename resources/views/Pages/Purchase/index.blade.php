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
                    @can('purchase-create')
                        <a href="{{ route('purchase.create') }}" type="button" class="btn btn-primary">Add New
                            Supply Orders</a>
                    @endcan

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
                                    <th>Supplier</th>
                                    <th>Date</th>
                                    <th>Item</th>
                                    <th>Total</th>
                                    <th>Status</th>
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

                                        <td>{{ $orderItem->supplyOrder->supplier->supplier_name }}</td>
                                        <td>{{ $orderItem->supplyOrder->order_date }}</td>

                                        @php
                                            $supplyId = $orderItem->supplyOrder->id;
                                            $supplyStatus = $orderItem->supplyOrder->status;
                                        @endphp
                                        <td> <button type="button" class="btn" data-toggle="modal"
                                                style="background-color: white;color:rgb(3, 89, 180)"
                                                data-target="#viewItem{{ $supplyId }}">view
                                            </button></td>

                                        <!-- Modal -->
                                        <div class="modal fade" id="viewItem{{ $supplyId }}" tabindex="-1"
                                            role="dialog" aria-labelledby="viewItemLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="viewItemLabel">Items</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST"
                                                            action="{{ route('purchase.update', $supplyId) }}">
                                                            @csrf

                                                            <div class="row">
                                                                <div class="col-sm-3 col-3">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputCity1">Item</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-3 col-3">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputCity1">quantity</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-3 col-3">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputCity1">price</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-3 col-3">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputCity1">total</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @foreach ($orderItems as $orderItem)
                                                                @if ($orderItem->supply_order_id == $supplyId)
                                                                    <div class="row">
                                                                        <div class="col-sm-3 col-3">
                                                                            <div class="form-group">

                                                                                <input type="text" class="form-control"
                                                                                    id="category_name" name="item_id"
                                                                                    value=" {{ $orderItem->item->item_name }}"
                                                                                    placeholder="Category Name"style="border-block-color: white;border-color:white">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-3 col-3">
                                                                            <div class="form-group">

                                                                                <input type="text" class="form-control"
                                                                                    id="quantity" name="quantity[]"
                                                                                    value="  {{ $orderItem->quantity }}"
                                                                                    oninput="calculateTotal()"
                                                                                    placeholder="Category Name"
                                                                                    style="border-block-color: white;border-color:white">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-3 col-3">
                                                                            <div class="form-group">

                                                                                <input type="text" class="form-control"
                                                                                    id="price" name="price[]"
                                                                                    value="   {{ $orderItem->price }}"
                                                                                    oninput="calculateTotal()"
                                                                                    placeholder="Category Name"
                                                                                    style="border-block-color: white;border-color:white">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-3 col-3">
                                                                            <div class="form-group">

                                                                                <input type="text" class="form-control"
                                                                                    id="total" name="total[]"
                                                                                    value="  {{ $orderItem->total }}"
                                                                                    placeholder="total"
                                                                                    style="border-block-color: white;border-color:white">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endforeach

                                                            <div class="modal-footer custom">

                                                                <div class="right-side">
                                                                    <button type="submit"
                                                                        class="btn btn-link success btn-block">Save</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <script>
                                                        function calculateTotal() {
                                                            // Get quantity and price values
                                                            var quantity = parseFloat(document.getElementById('quantity').value) || 0;
                                                            var price = parseFloat(document.getElementById('price').value) || 0;

                                                            // Calculate total
                                                            var total = quantity * price;

                                                            // Display the total
                                                            document.getElementById('total').value = total;
                                                        }
                                                    </script>
                                                </div>
                                            </div>
                                        </div>
                                        <td>{{ $total }}</td>
                                        <td class="text-center">
                                            <div class="dropdown">
                                                @if ($supplyStatus == 'Placed')
                                                    <button class="btn btn-primary dropdown-toggle" type="button"
                                                        id="dropdownMenuButton" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">
                                                        {{ $supplyStatus }}
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item"
                                                            href="changeStatusToReceived-{{ $supplyId }}">Received</a>
                                                    </div>
                                                @elseif ($supplyStatus == 'Recieved')
                                                    <button class="btn btn-primary dropdown-toggle" type="button"
                                                        id="dropdownMenuButton" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false"
                                                        style="background-color: rgb(245, 174, 32)">
                                                        {{ $supplyStatus }}
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item"
                                                            href="changeStatusToPlaced-{{ $supplyId }}">Placed</a>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>


                                        <!-- Display action buttons -->
                                        <td>
                                            <div class="d-flex">
                                                @can('purchase-edit')
                                                    <a type="link" href="{{ route('purchase.edit', $supplyId) }}">
                                                        <i class="icon-edit" style="color: blue"></i>
                                                    </a>
                                                @endcan

                                                @can('purchase-delete')
                                                    <form action="{{ route('purchase.destroy', $supplyId) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-link p-0">
                                                            <i class="icon-trash-2" style="color:red"></i>
                                                        </button>
                                                    </form>
                                                @endcan

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

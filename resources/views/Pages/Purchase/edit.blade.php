@extends('Frames.app')
@section('content')
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Perchase</li>
            <li class="breadcrumb-item active">Supplyorders/edit</li>
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
        <div class="container-fluid">
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
            <!-- start page title -->
            <div class="row">
                <div class="col-12">

                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <form method="POST" action="{{ route('purchase.update', $supplyOrder->id) }}">
                                @csrf
                                @method('put')
                                <div class="card-header border-bottom bg-transparent">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h5 class="header-title mb-0">Edit Orders Form</h5>
                                        </div>

                                        <div class="col-lg-4">
                                        </div>

                                    </div>


                                </div>
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="col-lg-12 col-sm-6">
                                                    <div class="form-group row">
                                                        <label for="colFormLabelSm"
                                                            class="col-sm-1 col-form-label col-form-label-sm">Date</label>
                                                        <div class="col-sm-2">
                                                            <input type="date" name="order_date" class="form-control"
                                                                id="order_date" value="{{ $supplyOrder->order_date }}">
                                                            @error('order_date')
                                                                <div class="alert alert-danger">
                                                                    {{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-sm-1">

                                                        </div>
                                                        <label for="colFormLabelSm"
                                                            class="col-sm-1 col-form-label col-form-label-sm">Supplier</label>
                                                        <div class="col-sm-3">
                                                            <select class="form-control selectpicker" id="supplier_id"
                                                                name="supplier_id" data-live-search="true">
                                                                @foreach ($suppliers as $supplier)
                                                                    <option value="{{ $supplier->id }}"
                                                                        {{ old('supplier_id', $supplyOrder->supplier_id) == $supplier->id ? 'selected' : '' }}>
                                                                        {{ $supplier->supplier_name }}
                                                                    </option>
                                                                @endforeach

                                                            </select>
                                                            @error('supplier_id')
                                                                <div class="alert alert-danger">
                                                                    {{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="mt-2">
                                        <div class="row">
                                            <div class="col-lg-8 mb-2">


                                                <div class="card  mt-2">
                                                    <div class="card-body bg-light " style="border-color:white">
                                                        @php
                                                            $no = 0;
                                                        @endphp
                                                        @foreach ($orderItems as $orderItem)
                                                            @if ($supplyOrder->id == $orderItem->supply_order_id)
                                                                <div class="row mt-2">

                                                                    <div class="col "> <select
                                                                            class="form-control selectpicker" id="item_id"
                                                                            name="List[{{ $no }}][item_id]"
                                                                            data-live-search="true">
                                                                            {{-- <option value="">select Item</option> --}}
                                                                            @foreach ($items as $item)
                                                                                <option value="{{ $item->id }}"
                                                                                    {{ old('item_id', $orderItem->item_id) == $item->id ? 'selected' : '' }}>
                                                                                    {{ $item->item_name }}</option>
                                                                            @endforeach

                                                                        </select>
                                                                        @error('List')
                                                                            <div class="alert alert-danger">
                                                                                {{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="col ">
                                                                        <input type="number" id="quantity{{ $orderItem->id }}" step="any"
                                                                            min="0"
                                                                            name="List[{{ $no }}][quantity]"
                                                                            value="{{ $orderItem->quantity }}"
                                                                            oninput="calculateTotal('{{ $orderItem->id }}')" class="form-control"
                                                                            placeholder="Quantity">
                                                                    </div>
                                                                    <div class="col"> <input type="number"
                                                                            id="price{{ $orderItem->id }}" step="any" min="0"
                                                                            oninput="calculateTotal('{{ $orderItem->id }}')"
                                                                            value="{{ $orderItem->price }}"
                                                                            name="List[{{ $no }}][price]"
                                                                            class="form-control" placeholder="U-Price">
                                                                    </div>
                                                                    <div class="col"> <input type="number"
                                                                            id="total{{ $orderItem->id  }}" class="form-control"
                                                                            name="List[{{ $no }}][total]"
                                                                            min="0"
                                                                            value="{{ $orderItem->total }}" readonly
                                                                            placeholder="subTotal"></div>
                                                                    <div class="col">
                                                                    </div>
                                                                </div>
                                                                @php
                                                                    $no = $no + 1;
                                                                @endphp
                                                            @endif
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">

                                            </div>
                                            <div class="col-lg-8">

                                            </div>





                                            <div class="col-lg-4">

                                                <div>
                                                    <div class="table-responsive">
                                                        <table class="table table-centered border mb-0">
                                                            <thead class="bg-light">
                                                                <tr>

                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                <tr>

                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <div class="row m-5">
                                                            <button style="float: right;" class="btn btn-primary"
                                                                type="submit">Submit</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- end card -->

            </div>
        </div>
    </div>




    </div>

    <!-- Add the following script to your HTML file -->
    <script>
        function calculateTotal(Id) {
            // Get quantity and price values
            var quantity = parseFloat(document.getElementById('quantity' + Id).value) || 0;
            var price = parseFloat(document.getElementById('price' + Id).value) || 0;
    
            // Calculate total
            var total = quantity * price;
    
            // Display the total
            document.getElementById('total' + Id).value = total;
        }
    </script>
@endsection

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
                                                <div class="table-responsive">
                                                    <table class="table table-centered border table-nowrap mb-lg-0" id="itemList">
                                                        <thead class="bg-light">
                                                            <tr>
                                                                <th style="width: 25%;">Items</th>
                                                                <th style="width: 25%;">Quantity</th>
                                                                <th style="width: 25%;">Price</th>
                                                                <th style="width: 25%;">Total</th>
                                
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($orderItems as $index => $orderItem)
                                                                <tr>
                                
                                                                    <td>
                                
                                                                        <select class="form-control selectpicker" id="item_id{{ $index }}"
                                                                            name="item_id[]" data-live-search="true">
                                                                            <option value="">select Item</option>
                                                                            @foreach ($items as $item)
                                                                                <option value="{{ $item->id }}"
                                                                                    {{ old('category_id', $orderItem->item_id) == $item->id ? 'selected' : '' }}>
                                                                                    {{ $item->item_name }}</option>
                                                                            @endforeach
                                                                        </select>
                                
                                                                    </td>
                                                                    <td>
                                                                        <input type="number" onchange="getTotal()" id="quantity{{ $index }}"
                                                                            name="quantity[]" class="form-control"
                                                                            value="{{ $orderItem->quantity }}" placeholder="Quantity">
                                                                    </td>
                                                                    <td>
                                                                        <input type="number" onchange="getTotal()" id="price{{ $index }}"
                                                                            step="any" min="0" name="price[]" class="form-control"
                                                                            value="{{ $orderItem->price }}" placeholder="Price">
                                                                    </td>
                                                                    <td>
                                                                        <input type="number" onchange="getTotal()" id="total{{ $index }}"
                                                                            step="any" min="0" name="total[]" class="form-control"
                                                                            value="{{ $orderItem->total }}" placeholder="Total" readonly>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
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
        var rowIndex = 0; // Initialize rowIndex
    
        function addList() {
            var itemId = document.getElementById('item_id').value;
            var itemName = document.getElementById('item_id').options[document.getElementById('item_id').selectedIndex].text;
            var unit = document.getElementById('unit').value;
            var quantity = parseFloat(document.getElementById('quantity').value);
            var price = parseFloat(document.getElementById('price').value);
            var total = quantity * price;
    
            // Create a new row for the item
            var newRow = createRow(itemId, itemName, quantity, unit, price, total);
    
            // Append the new row to the table body
            document.getElementById('itemList').getElementsByTagName('tbody')[0].appendChild(newRow);
    
            // Increment rowIndex for the next iteration
            rowIndex++;
    
            // Update the summary
            updateSummary();
        }
    
        function createRow(itemId, itemName, quantity, unit, price, total) {
            var row = document.createElement('tr');
            
            var columns = [
                itemName,
                quantity + ' ' + unit,
                price,
                total,
                '<a class="btn btn-danger" onclick="removeRow(this)"><i class="icon-minus"></i></a>'
            ];
    
            for (var i = 0; i < columns.length; i++) {
                var cell = document.createElement('td');
                cell.innerHTML = columns[i];
                row.appendChild(cell);
            }
    
            var hiddenFields = ['item_id', 'item_name', 'quantity', 'price', 'total'];
    
            for (var i = 0; i < hiddenFields.length; i++) {
                var input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'item_list[' + rowIndex + '][' + hiddenFields[i] + ']';
                input.value = (i === 0) ? itemId : (i === 1) ? itemName : (i === 2) ? quantity : (i === 3) ? price : total;
                row.appendChild(input);
            }
    
            return row;
        }
    
        function removeRow(btn) {
            var row = btn.parentNode.parentNode;
            row.parentNode.removeChild(row);
    
            // Update the summary
            updateSummary();
        }
    
        function updateSummary() {
            var subTotal = 0;
            var rows = document.getElementById('itemList').getElementsByTagName('tbody')[0].getElementsByTagName('tr');
    
            for (var i = 0; i < rows.length; i++) {
                var cells = rows[i].getElementsByTagName('td');
                var total = parseFloat(cells[3].innerText);
                subTotal += total;
            }
    
            document.getElementById('all_sub').innerText = subTotal;
            document.getElementById('all_total').innerText = subTotal;
            document.getElementById('all_total').value = subTotal;
        }
    </script>
    
@endsection

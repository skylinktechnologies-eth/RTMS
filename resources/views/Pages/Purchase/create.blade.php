@extends('Frames.app')
@section('content')
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Purchase</li>
            <li class="breadcrumb-item active">Supplyorders/Create</li>
        </ol>

        <ul class="app-actions">
            <li>
                <a href="#" id="reportrange">
                    <span class="range-text"></span>
                    <i class="icon-chevron-down"></i>
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
                            <div class="card-header border-bottom bg-transparent">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h5 class="header-title mb-0">Create New Orders Form</h5>
                                    </div>
                                    <div class="col-lg-4">
                                    </div>
                                </div>
                            </div>
                            <form method="POST" action="{{ route('purchase.store') }}">
                                @csrf

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
                                                                value="{{ now()->toDateString() }}" id="order_date"
                                                                required>
                                                            @error('order_date')
                                                                <div class="alert alert-danger">
                                                                    {{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-sm-2">

                                                        </div>
                                                        <label for="colFormLabelSm"
                                                            class="col-sm-1 col-form-label col-form-label-sm">Supplier</label>
                                                        <div class="col-sm-4">
                                                            <select class="form-control selectpicker" id="supplier_id"
                                                                name="supplier_id" data-live-search="true" required>
                                                                <option value="">select </option>
                                                                @foreach ($suppliers as $supplier)
                                                                    <option value="{{ $supplier->id }}">
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
                                                        <div class="row ">
                                                            <div class="col ">
                                                                <select class="form-control selectpicker" id="item_id"
                                                                    name="item_id[]" data-live-search="true" required>
                                                                    <option value="">select Item</option>
                                                                    @foreach ($items as $item)
                                                                        <option value="{{ $item->id }}">
                                                                            {{ $item->item_name }}</option>
                                                                    @endforeach

                                                                </select>
                                                                @error('item_id')
                                                                    <div class="alert alert-danger">
                                                                        {{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col ">
                                                                <input type="number" id="quantity" step="any"
                                                                    min="0" name="quantity[]"
                                                                    oninput="calculateTotal()" class="form-control"
                                                                    placeholder="Quantity" required>
                                                            </div>
                                                            <div class="col">
                                                                <input type="number" id="price" step="any"
                                                                    min="0" oninput="calculateTotal()" name="price[]"
                                                                    class="form-control" placeholder="U-Price" required>
                                                            </div>
                                                            <div class="col">
                                                                <input type="number" id="total" class="form-control"
                                                                    name="total[]" min="0" readonly
                                                                    placeholder="subTotal" required>
                                                            </div>
                                                            <div class="col"> <a class="btn btn-primary"
                                                                    onclick="addList()"><i class="icon-plus"
                                                                        style="color: white"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">

                                            </div>
                                            <div class="col-lg-8">
                                                <div>
                                                    <div class="table-responsive">
                                                        <table class="table table-centered border table-nowrap mb-lg-0"
                                                            id="itemList">
                                                            <thead class="bg-light">
                                                                <tr>
                                                                    <th>Items</th>
                                                                    <th>Quantity</th>
                                                                    <th>Price</th>
                                                                    <th>subTotal</th>
                                                                    <th></th>

                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
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
                                                                    <th scope="row">Total :</th>
                                                                    <td><i id="all_total">0</i></td>
                                                                    <input type="hidden" name="total" id="all_total">

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
    <script>
        var i = 0; // Initialize i
        function addList() {
            // Get the selected item and its details
            var itemId = document.getElementById('item_id').value;
            var itemName = document.getElementById('item_id').options[document.getElementById('item_id').selectedIndex]
                .text;
            var quantity = parseFloat(document.getElementById('quantity').value);
            var price = parseFloat(document.getElementById('price').value);

            // Calculate total for the current item
            var total = quantity * price;

            // Get the table body
            var tableBody = document.getElementById('itemList').getElementsByTagName('tbody')[0];

            // Create a new row for the item
            var newRow = tableBody.insertRow();

            // Insert cells into the new row
            var cell1 = newRow.insertCell(0);
            var cell2 = newRow.insertCell(1);
            var cell3 = newRow.insertCell(2);
            var cell4 = newRow.insertCell(3);
            var cell5 = newRow.insertCell(4);

            // Set the content of each cell
            cell1.innerHTML = itemName;
            cell2.innerHTML = quantity;
            cell3.innerHTML = price;
            cell4.innerHTML = total;
            cell5.innerHTML = '<a class="btn btn-danger" onclick="removeRow(this)"><i class="icon-minus"></i></a>' +
                '<input type="hidden" name="item_list[' + i + '][item_id]" value="' + itemId + '">' +
                '<input type="hidden" name="item_list[' + i + '][quantity]" value="' + quantity + '">' +
                '<input type="hidden" name="item_list[' + i + '][price]" value="' + price + '">' +
                '<input type="hidden" name="item_list[' + i + '][total]" value="' + total + '">';

            // Increment i for the next iteration
            i++;

            // Update the summary
            updateSummary();
        }



        function removeRow(btn) {
            // Remove the row when clicking the minus sign
            var row = btn.parentNode.parentNode;
            row.parentNode.removeChild(row);

            // Update the summary
            updateSummary();
        }

        function updateSummary() {
            // Calculate and update the subtotal and total values
            var subTotal = 0;
            var rows = document.getElementById('itemList').getElementsByTagName('tbody')[0].getElementsByTagName('tr');

            for (var i = 0; i < rows.length; i++) {
                var cells = rows[i].getElementsByTagName('td');
                var total = parseFloat(cells[3].innerText);
                subTotal += total;
            }

            // document.getElementById('all_sub').innerText = subTotal;
            document.getElementById('all_total').innerText = subTotal;
            document.getElementById('all_total').value = subTotal;
        }
    </script>
@endsection

@extends('Frames.app')
@section('content')
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Issuing</li>
            <li class="breadcrumb-item active">Issuing/Create</li>
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
            <div class="col-12">
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="table-container">
                            <div class="t-header">purchase Product</div>
                            <div class="table-responsive">
                                <table id="rowSelection" class="table custom-table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Item </th>
                                            <th> Total Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $no = 0;
                                    @endphp
                                        @foreach ($inventories as $inventory)
                                            @php
                                                $no = $no + 1;
                                            @endphp
                                           
                                                <tr>
                                                    <!-- Display details from representative order item -->
                                                    <td>{{ $no }}</td>
                                                    <td>{{ $inventory->item->item_name }}</td>
                                                   
                                                    <td>
                                                        {{ $inventory->purchased_quantity - $inventory->issued_quantity }}
                                                    </td>
                                                </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header border-bottom bg-transparent">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h5 class="header-title mb-0">Create New Issuing Form</h5>
                                </div>

                                <div class="col-lg-4">
                                </div>

                            </div>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('issuing.store') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-6 col-sm-6">
                                                <div for="contact_name">Date</label>
                                                    <input type="date" name="issued_date" class="form-control"
                                                        value="{{ now()->toDateString() }}" id="issued_date">
                                                    @error('issued_date')
                                                        <div class="alert alert-danger">
                                                            {{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-sm-6">
                                                <div class="form-group">
                                                    <label for="contact_name">Location</label>
                                                    <select class="form-control selectpicker" id="location_id"
                                                        name="location_id" data-live-search="true">
                                                        @foreach ($locations as $location)
                                                            <option value="{{ $location->id }}">
                                                                {{ $location->location_name }}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                    @error('location_id')
                                                        <div class="alert alert-danger">
                                                            {{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-sm-6">
                                                <div class="form-group">
                                                    <label for="contact_name">Issued To(opt)</label>
                                                    <input type="text" class="form-control" id="issued_to"
                                                        name="issued_to" placeholder="issued_to">
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
                                                        <div class="col "> <select class="form-control selectpicker"
                                                                id="item_id" name="item_id[]" data-live-search="true">
                                                                <option value="">select Item</option>
                                                                @foreach ($inventories as $inventory)
                                                                    @if ($inventory->purchased_quantity - $inventory->issued_quantity  > 0)
                                                                        <option value="{{ $inventory->item->id }}">
                                                                            {{ $inventory->item->item_name }}</option>
                                                                    @endif
                                                                @endforeach

                                                            </select>
                                                            @error('item_id')
                                                                <div class="alert alert-danger">
                                                                    {{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col ">
                                                            <input type="number" id="quantity" step="any"
                                                                min="0" name="quantity[]" oninput="calculateTotal()"
                                                                class="form-control" placeholder="Quantity">
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
                            </form>
                        </div>
                    </div>
                </div>
                <!-- end card -->
            </div>
        </div>
    </div>
    <!-- Include this script in your HTML file -->
    <script>
        function calculateTotal() {
            // Your existing calculation logic

            // Check if the entered quantity is greater than the inventory quantity
            var selectedItemId = document.getElementById('item_id').value;
            var inventoryQuantity = getInventoryQuantity(
            selectedItemId); // Replace with your logic to get the inventory quantity
            var enteredQuantity = parseFloat(document.getElementById('quantity').value);

            if (enteredQuantity > inventoryQuantity) {
                alert(
                    'The quantity you entered is greater than the available inventory quantity. Please enter a valid quantity.');
                // Optionally, you can reset the entered quantity to the maximum available
                document.getElementById('quantity').value = inventoryQuantity;
            }
        }

        function getInventoryQuantity(itemId) {
           
            return 100; // Replace with the actual inventory quantity for the selected item
        }
    </script>
  
    <script>
        var i = 0; 
        function addList() {
           
            var itemId = document.getElementById('item_id').value;
            var itemName = document.getElementById('item_id').options[document.getElementById('item_id').selectedIndex]
                .text;
            var quantity = parseFloat(document.getElementById('quantity').value);

            var tableBody = document.getElementById('itemList').getElementsByTagName('tbody')[0];

            var newRow = tableBody.insertRow();

            var cell1 = newRow.insertCell(0);
            var cell2 = newRow.insertCell(1);
            var cell3 = newRow.insertCell(2);

            cell1.innerHTML = itemName;
            cell2.innerHTML = quantity;
            cell3.innerHTML = '<a class="btn btn-danger" onclick="removeRow(this)"><i class="icon-minus"></i></a>' +
                '<input type="hidden" name="item_list[' + i + '][item_id]" value="' + itemId + '">' +
                '<input type="hidden" name="item_list[' + i + '][quantity]" value="' + quantity + '">';

            i++;

            updateSummary();
        }

        function removeRow(btn) {
            
            var row = btn.parentNode.parentNode;
            row.parentNode.removeChild(row);

            updateSummary();
        }

        function updateSummary() {
           
            var subTotal = 0;
            var rows = document.getElementById('itemList').getElementsByTagName('tbody')[0].getElementsByTagName('tr');

            for (var i = 0; i < rows.length; i++) {
                var cells = rows[i].getElementsByTagName('td');
                var total = parseFloat(cells[1].innerText);
                subTotal += total;
            }

            document.getElementById('all_total').innerText = subTotal;
            document.getElementById('all_total').value = subTotal;
        }
    </script>
@endsection

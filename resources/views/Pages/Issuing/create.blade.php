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
                                            <div class="col-8 mb-2">
                                                <div>
                                                    <div class="table-responsive">
                                                        <table class="table table-centered border mb-lg-0">
                                                            <thead class="bg-light">
                                                                <tr>
                                                                    <th style="width: 35%;">
                                                                        <select class="form-control selectpicker"
                                                                            id="item_id" name="item_id[]"
                                                                            data-live-search="true">
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
                                                                    </th>
                                                                    <input type="hidden" id="unit">
                                                                    <input type="hidden" id="item_name">

                                                                    <th>
                                                                        <input type="number" onchange="getTotal()"
                                                                            id="quantity" step="any" min="0"
                                                                            name="quantity[]" class="form-control"
                                                                            placeholder="Quantity">
                                                                    </th>


                                                                    <th>
                                                                        <a class="btn btn-primary" onclick="addList()"><i
                                                                                class="icon-plus"
                                                                                style="color: white"></i></a>
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4">

                                            </div>
                                            <div class="col-8">
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




    </div>

    <!-- Add the following script to your HTML file -->
    <script>
        var i = 0; // Initialize i

        function addList() {
            // Get the selected item and its details
            var itemId = document.getElementById('item_id').value;
            var itemName = document.getElementById('item_id').options[document.getElementById('item_id').selectedIndex]
                .text;
            var unit = document.getElementById('unit').value;
            var quantity = parseFloat(document.getElementById('quantity').value);

            // Create a new row for the item
            var newRow =
                '<tr>' +
                '<td>' + itemName + '</td>' +
                '<td>' + quantity + ' ' + unit + '</td>' +
                '<td><a class="btn btn-danger" onclick="removeRow(this)"><i class="icon-minus"></i></a></td>' +
                '<input type="hidden" name="item_list[' + i + '][item_id]" value="' + itemId + '">' +
                '<input type="hidden" name="item_list[' + i + '][item_name]" value="' + itemName + '">' +
                '<input type="hidden" name="item_list[' + i + '][quantity]" value="' + quantity + '">' +
                '</tr>';

            // Increment i for the next iteration
            i++;

            // Append the new row to the table body
            document.getElementById('itemList').getElementsByTagName('tbody')[0].innerHTML += newRow;

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

            document.getElementById('all_sub').innerText = subTotal;
            document.getElementById('all_total').innerText = subTotal;
            document.getElementById('all_total').value = subTotal;
        }
    </script>
@endsection

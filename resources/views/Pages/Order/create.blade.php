@extends('Frames.app')
@section('content')
<div class="page-header">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Order</li>
        <li class="breadcrumb-item active">order/create</li>
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
            <div>
                <form action="{{ route('order.store') }}" method="POST">

                    @csrf
                    <div class="row gutters ">


                        <div class="col-md-7 col-sm-12 ">
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
                                            <select class="form-control selectpicker" id="table_id" name="table_id"
                                                data-live-search="true" required>
                                                <option value="">select Table</option>
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
                                        @foreach ($menuItems as $menuItem)
                                            <div class="col-md-4 col-sm-6 ">
                                                <div class="card" style="">
                                                    <div class="accordion toggle-icons" id="toggleIcons">
                                                        <div class="accordion-container" style="">
                                                            <div class="accordion-header"
                                                                id="toggleIcons{{ $menuItem->id }}">
                                                                <a href="" class="" data-toggle="collapse"
                                                                    data-target="#toggleIconsCollapse{{ $menuItem->id }}"
                                                                    aria-expanded="true"
                                                                    aria-controls="toggleIconsCollapse{{ $menuItem->id }}">
                                                                    <img src="{{ asset('storage/' . $menuItem->image) }}"
                                                                        alt="" style="width: 80px; height: 60px; ">
                                                                    <p>
                                                                        {{ $menuItem->item_name }}</p>
                                                                </a>
                                                            </div>
                                                            <div id="toggleIconsCollapse{{ $menuItem->id }}"
                                                                class="collapse "
                                                                aria-labelledby="toggleIcons{{ $menuItem->id }}"
                                                                data-parent="#toggleIcons">
                                                                <div class="accordion-body">
                                                                    <input type="hidden" readonly
                                                                        placeholder="{{ $menuItem->item_name }}"
                                                                        id="menu_item_id{{ $menuItem->id }}"
                                                                        name="menu_item_id[]" value="{{ $menuItem->id }}"
                                                                        style="width: 80px; height: 80px; border: none">
                                                                    <input type="hidden" placeholder="price"
                                                                        id="price{{ $menuItem->id }}" name="price[]"
                                                                        value="{{ $menuItem->price }}">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control"
                                                                            id="quantity{{ $menuItem->id }}"
                                                                            name="quantity[]" placeholder="Quantity" value="{{ old('quantity[]') }}"
                                                                            aria-label="filter">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <textarea class="form-control" placeholder="remark" id="remark{{ $menuItem->id }}" name="remark[]" aria-label="filter"></textarea>
                                                                    </div>
                                                                    <div class="center">
                                                                        <div class="col"> <a class="btn btn-primary"
                                                                                onclick="addList({{ $menuItem->id }})"><i
                                                                                    class="icon-plus"
                                                                                    style="color: white"></i></a></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                            </div>


                        </div>

                        <div class="col-md-5 c0l-sm-12">
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
                                                    <th></th>

                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                        <div id="totalAmount">
                                            <p>Total:</p>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>


                    </div>
                    <div class="row gutters">
                        <div class="col-sm-12">
                            <div class="text-center mt-4 ">
                                <button class="btn btn-primary " type="submit">Submit</button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>



        </div>
    </div>




    </div>
    <script>
        function addList(menuItemId) {
            // Get the values from the input fields
            var quantity = document.getElementById('quantity' + menuItemId).value;
            var remark = document.getElementById('remark' + menuItemId).value;

            // Get the values from the hidden inputs
            var menuItemIdValue = document.getElementById('menu_item_id' + menuItemId).value;
            var itemName = document.getElementById('menu_item_id' + menuItemId).placeholder;

            var priceValue = parseFloat(document.getElementById('price' + menuItemId).value);

            // Calculate the subtotal
            var subtotal = priceValue * parseFloat(quantity);

            // Create a new table row
            var table = document.getElementById('itemList'); // Replace 'yourTableId' with the actual ID of your table
            var newRow = table.insertRow();

            // Add cells to the row
            var cell1 = newRow.insertCell(0);
            var cell2 = newRow.insertCell(1);
            var cell3 = newRow.insertCell(2);
            var cell4 = newRow.insertCell(3);
            var cell5 = newRow.insertCell(4);
            var cell6 = newRow.insertCell(5);

            // Populate cells with the input values
            cell1.innerHTML = itemName;
            cell2.innerHTML = quantity;
            cell3.innerHTML = priceValue.toFixed(2); // Display price with two decimal places
            cell4.innerHTML = subtotal.toFixed(2); // Display subtotal with two decimal places
            cell5.innerHTML = remark;
            cell6.innerHTML = '<a class="btn btn-danger" onclick="removeRow(this)">-</a>';


            // Update the total
            updateTotal();
        }

        // Function to update the total
        function updateTotal() {
            var table = document.getElementById('itemList');
            var total = 0;

            // Iterate through each row in the table
            for (var i = 1; i < table.rows.length; i++) {
                // Get the subtotal value from the fourth cell of each row
                var subtotal = parseFloat(table.rows[i].cells[3].innerHTML);

                // Add the subtotal to the total
                total += subtotal;
            }

            // Update the total cell in your table (replace 'totalAmount' with the actual ID of your total cell)
            document.getElementById('totalAmount').innerHTML = '<p>Total: ' + total.toFixed(2) +
            '</p>'; // Display total with two decimal places
        }

        // Function to remove a row
        function removeRow(btn) {
            var row = btn.parentNode.parentNode;
            row.parentNode.removeChild(row);

            // Update the total after removing a row
            updateTotal();
        }
    </script>

    <!-- Add the following script to your HTML file -->
@endsection

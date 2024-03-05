@extends('Frames.app')
@section('content')
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Reservation</li>
            <li class="breadcrumb-item active">Reservation/Create</li>
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

        <div class="card rounded-3 px-3  " >
            <div class="card-header bg-primary rounded-3" style="margin-top: -10px;color:#fff">
                <div style="display: flex; justify-content: space-between;">
                    <strong> Create Reservation </strong>
                    <a href="{{ route('reservation.index') }}" class="text-white"><i class="fas fa-arrow-left"></i>
                        Back</a>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('reservation.store') }}">
                    @csrf
                    <div class="row">
                        <div class=" col-md-4 ">
                            <div class="form-group">
                                <label for="exampleInputEmail3">Reservation Date</label>
                                <input type="date" class="form-control" id="reservation_date"
                                    name="reservation_date" placeholder="reservation date" value="{{ old('reservation_date') }}" required>
                                @error('reservation_date')
                                    <div class="alert alert-danger">
                                        {{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                       
                        <div class=" col-md-4 ">
                            <div class="form-group">
                                <label for="party_size">Number of Customer</label>
                                <input type="number" class="form-control" id="party_size"
                                    placeholder="no of customer" name="party_size" value="{{ old('party_size') }}" required>
                                @error('party_size')
                                    <div class="alert alert-danger">
                                        {{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row ">
                        <div class=" col-md-4 ">
                            <div class="form-group">
                                <label for="contact_name">Contact Name</label>
                                <input type="text" class="form-control" id="contact_name"
                                    name="contact_name" placeholder="contact name" value="{{ old('contact_name') }}" required>
                                @error('contact_name')
                                    <div class="alert alert-danger">
                                        {{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class=" col-md-4 ">
                            <div class="form-group">
                                <label for="contact_number">Contact Number</label>
                                <input type="text" class="form-control" id="contact_number"
                                    name="contact_number" placeholder="contact number" value="{{ old('contact_number') }}" required>

                                @error('contact_number')
                                    <div class="alert alert-danger">
                                        {{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card">

                        <div class="card-body bg-light">
                            <div class="table-responsive">
                                <table class="table table-centered border   bg-light" >
                                    <thead class="">
                                        <tr>
                                            <th style="width: 25%">Tables</th>
                                            <th style="width: 22%"> Start Date</th>
                                            <th style="width: 22%"> End Date</th>
                                            <th style="width: 25%"> Reservation Time</th>
                                            <th></th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>

                            <div class="row" >

                                <div class="col-md-2">
                                    <select class="form-control selectpicker" id="table_id"
                                        name="table_id[]" data-live-search="true" required>
                                        <option value="">select Table</option>
                                        @foreach ($tables as $table)
                                            <option value="{{ $table->id }}" >
                                                {{ $table->table_name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="date" onchange="getTotal()"
                                            id="occupancy_start_date" step="any" min="0"
                                            name="occupancy_start_date[]" class="form-control"
                                            placeholder="Start Date" required >
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="date" onchange="getTotal()"
                                            id="occupancy_end_date" step="any" min="0"
                                            name="occupancy_end_date[]" class="form-control"
                                            placeholder="End Date" required>
                                    </div>

                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <input type="time" onchange="getTotal()"
                                            id="reservation_time" step="any" min="0"
                                            name="reservation_time[]" class="form-control"
                                            placeholder="Time" required>
                                    </div>

                                </div>
                                <div class="col-md-2">
                                    <a class="btn btn-primary" onclick="addList()"><i class="icon-plus"
                                            style="color: white"></i></a>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-centered border   bg-light" id="itemList">
                                    <thead class="">
                                      
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>

                        </div>

                    </div>

                    <div class="col-xl-12">
                        <button type="submit" id="submit" name="submit"
                            class="btn btn-primary float-right">Submit
                            Form</button>
                    </div>

                </form>
            </div>
        </div>

       
    </div>
    <script>
        var i = 0; // Initialize i
    
        function addList() {
            var tableId = document.getElementById('table_id').value;
            var tableSelect = document.getElementById('table_id');
            var selectedTable = tableSelect.options[tableSelect.selectedIndex].text;
            var reservationTime = document.getElementById('reservation_time').value;
            var occupancyStartdate = document.getElementById('occupancy_start_date').value;
            var occupancyEnddate = document.getElementById('occupancy_end_date').value;
    
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
    
            // Set cell content
            cell1.innerHTML = '<td>' + selectedTable + '</td>';
            cell2.innerHTML = '<td>' + occupancyStartdate + '</td>';
            cell3.innerHTML = '<td>' + occupancyEnddate + '</td>';
            cell4.innerHTML = '<td>' + reservationTime + '</td>';
            cell5.innerHTML = '<td><a class="btn btn-danger" onclick="removeRow(this)"><i class="icon-minus"></i></a>' +
                '<input type="hidden" name="table_list[' + i + '][table_id]" value="' + tableId + '">' +
                '<input type="hidden" name="table_list[' + i + '][occupancy_start_date]" value="' + occupancyStartdate +
                '">' + 
                '<input type="hidden" name="table_list[' + i + '][reservation_time]" value="' + reservationTime +
                '">' +
                '<input type="hidden" name="table_list[' + i + '][occupancy_end_date]" value="' + occupancyEnddate + '"></td>';
    
            // Increment i for the next iteration
            i++;
        }
    
        function removeRow(btn) {
            // Remove the row when clicking the minus sign
            var row = btn.parentNode.parentNode;
            row.parentNode.removeChild(row);
        }
    </script>
    
    
    
@endsection

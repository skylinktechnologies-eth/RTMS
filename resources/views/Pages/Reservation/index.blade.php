@extends('Frames.app')
@section('content')
    <style>
        /* Optional: Add custom styling for the card */
        .card {
            margin: 20px;
        }

        /* Style for the DataTable */
        .data_table {
            overflow-x: auto;
            /* Enable horizontal scrolling on small screens */
        }

        /* Style for the DataTable header */
        #example thead {
            background-color: #f4f4f4;
        }

        /* Style for DataTable rows */
        #example tbody tr {
            border-bottom: 1px solid #ddd;
            /* Add border between rows */
        }

        /* Style for DataTable cells */
        #example td {
            padding: 8px;
        }

        /* Responsive table on small screens */
        @media screen and (max-width: 767px) {
            #example {
                overflow-x: auto;
                display: block;
            }

            #example thead,
            #example tbody,
            #example th,
            #example td,
            #example tr {
                display: block;
            }

            #example th {
                text-align: left;
            }

            #example tbody tr {
                margin-bottom: 10px;
            }

            #example td {
                border-bottom: none;
            }

            /* Specify a custom font for the DataTable text */
            .data_table table {
                font-family: 'YourCustomFont', sans-serif;

            }

            /* Optional: You can also apply the custom font to the header if needed */
            .data_table table thead th {
                font-family: 'YourCustomFont', sans-serif;
                font-weight: bold;
            }

            /* Optional: You can adjust the font size and  as needed */
            .data_table table td,
            .data_table table th {
                font-size: 19px;

                /* Add other text properties as needed */
            }
        }
    </style>


    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <a type="link" href="{{ route('reservation.create') }}" style="color: #f4f4f4"><i class=" mdi mdi-plus"></i></a>
        </span> Create Reservation
    </h3>

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
    <div class="col-md-12">
        <div class="card rounded-3 px-3">
            <div class="card-header   rounded-3 " style="margin-top: -10px;color:#9e7b7b">

            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <div class="data_table">
                        <table id="example" class="table  table-bordered" style="width:100%">
                            <thead style="">
                                <tr>
                                    <th>No</th>
                                    <th>Table Name</th>
                                    <th>Reservation Date</th>
                                    <th>Party Size</th>
                                    <th>Contact Name</th>
                                    <th>Contact Number</th>
                                    <th>Status</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>

                                @php
                                    $no = 0;
                                @endphp
                                @foreach ($reservations as $reservation)
                                    @php
                                        $no = $no + 1;
                                    @endphp
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>{{ $reservation->table->table_name }}</td>
                                        <td>{{ $reservation->reservation_date }}</td>
                                        <td>{{ $reservation->party_size }}</td>
                                        <td>{{ $reservation->contact_name }}</td>
                                        <td>{{ $reservation->contact_number }}</td>
                                        @if ($reservation->status == 'Pending')
                                            <td style="color: #fed713">{{ $reservation->status }}</td>
                                        @else
                                            <td>{{ $reservation->status }}</td>
                                        @endif


                                        <td>
                                            <div class="d-flex">

                                                <a type="link" href="{{ route('reservation.edit', $reservation->id) }}">
                                                    <i class=" mdi mdi-lead-pencil " style="margin-right: 5px;"></i>
                                                </a>


                                                <form action="{{ route('reservation.destroy', $reservation->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-link p-0">
                                                        <i class=" mdi mdi-delete" style="color:red"></i>
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


    <!-- Modal -->
    <div class="modal fade " id="addReservations" tabindex="-1" aria-labelledby="addReservationsLabel" aria-hidden="true">
        <div class="modal-dialog " style=" max-width: 700px;">
            <div class="modal-content px-3 rounded-4" style="background-color: #ffffff">
                <div class="modal-header p-3" style="background-color: #b66dff">
                    <h4 class="modal-title " id="addReservationsLabel" style="color: #ffffff">Create Table</h4>
                    <a type="button" data-bs-dismiss="modal" aria-label="Close"><i class=" mdi mdi-close  "
                            style="color: #ffffff"></i></a>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('reservation.store') }}">
                        @csrf
                        <div class="row mt-3">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="exampleInputCity1">Table Name</label>
                                    <select id="mySelect" style="width: 300px;">
                                        <option value="option1">Option 1</option>
                                        <option value="option2">Option 2</option>
                                        <option value="option3">Option 3</option>
                                        <!-- Add more options as needed -->
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputCity1">Capacity</label>
                                    <input type="intiger" class="form-control" id="capacity" name="capacity"
                                        placeholder="Location">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputCity1">Table Name</label>
                                    <input type="text" class="form-control" id="table_name" name="table_name"
                                        placeholder="Table Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputCity1">Capacity</label>
                                    <input type="intiger" class="form-control" id="capacity" name="capacity"
                                        placeholder="Location">
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- Modal -->
@endsection

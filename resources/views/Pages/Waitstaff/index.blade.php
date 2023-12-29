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
            <a type="link" href="{{ route('waitstaff.create') }}" style="color: #f4f4f4"><i class=" mdi mdi-plus"></i></a>
        </span> Create Order Item
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
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Contact Number</th>
                                    <th>Hire Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php
                                    $no = 0;
                                @endphp
                                @foreach ($waitstaffs as $waitstaff)
                                    @php
                                        $no = $no + 1;
                                    @endphp
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>{{ $waitstaff->first_name }}</td>
                                        <td>{{ $waitstaff->last_name }}</td>
                                        <td>{{ $waitstaff->contact_number }}</td>
                                        <td>{{ $waitstaff->hire_date }}</td>
                                        <td>{{ $waitstaff->status }}</td>
                                        <td>
                                            <div class="d-flex">

                                                <a type="link" href="{{ route('waitstaff.edit', $waitstaff->id) }}">
                                                    <i class=" mdi mdi-lead-pencil " style="margin-right: 5px;"></i>
                                                </a>


                                                <form action="{{ route('waitstaff.destroy', $waitstaff->id) }}"
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


   
@endsection

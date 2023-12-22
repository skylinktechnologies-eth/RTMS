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
            <a type="button" data-bs-toggle="modal" data-bs-target="#addCategory"><i class=" mdi mdi-plus"></i></a>
        </span> Create Category
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
                                    <th>Category Name</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>

                                @php
                                    $no = 0;
                                @endphp
                                @foreach ($categories as $category)
                                    @php
                                        $no = $no + 1;
                                    @endphp
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>{{ $category->category_name }}</td>
                                        <td>
                                            <div class="d-flex">

                                                <a href="#">

                                                    <i class=" mdi mdi-lead-pencil " data-bs-toggle="modal"
                                                        data-bs-target="#editCategory{{ $category->id }}"
                                                        style="margin-right: 5px;"></i>
                                                </a>
                                                <form action="{{ route('category.destroy', $category->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-link p-0">
                                                        <i class=" mdi mdi-delete" style="color:red"></i>
                                                    </button>
                                                </form>


                                            </div>


                                        </td>
                                        @include('Pages.Category.edit')
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
    <div class="modal fade " id="addCategory" tabindex="-1" aria-labelledby="addCategoryLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content px-3 rounded-4" style="background-color: #ffffff">
                <div class="modal-header p-3" style="background-color: #b66dff">
                    <h4 class="modal-title " id="addCategoryLabel" style="color: #ffffff">Create Table</h4>
                    <a type="button" data-bs-dismiss="modal" aria-label="Close"><i class=" mdi mdi-close  "
                            style="color: #ffffff"></i></a>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('category.store') }}">
                        @csrf
                        <div class="row mt-3">

                            <div class="form-group">
                                <label for="exampleInputCity1">Category Name</label>
                                <input type="text" class="form-control" id="category_name" name="category_name"
                                    placeholder="Category Name">
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

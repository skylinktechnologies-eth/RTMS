@extends('Frames.app')
@section('content')
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Maintain</li>
            <li class="breadcrumb-item active">Supplier</li>
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
        <div class="row gutters">
            <div class="col-sm-12">
                <div class="text-right mb-3">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addNewSupplier">Add New
                        Supplier</button>


                    <!-- Modal -->
                    <div class="modal fade" id="addNewSupplier" tabindex="-1" role="dialog"
                        aria-labelledby="addNewSupplierLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addNewSupplierLabel">New Supplier</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('supplier.store') }}">
                                        @csrf
                                        <div class="col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="exampleInputCity1"> Name</label>
                                                <input type="text" class="form-control" id="supplier_name"
                                                    name="supplier_name" placeholder="supplier Name"
                                                    value="{{ old('supplier_name') }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputCity1"> Contact number</label>
                                                <input type="number" class="form-control" id="contact_number"
                                                    name="contact_number" placeholder="Contact Number"
                                                    value="{{ old('contact_number') }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputCity1"> Address</label>
                                                <input type="text" class="form-control" id="address" name="address"
                                                    placeholder="address" value="{{ old('address') }}" required>
                                            </div>


                                        </div>
                                        <div class="modal-footer custom">

                                            <div class="center">
                                                <button type="submit" class="btn btn-link success btn-block">Save</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row gutters">
            <div class="col-sm-12">

                <div class="table-container">

                    <div class="table-responsive">
                        <table id="basicExample" class="table custom-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th> Name</th>
                                    <th>Contact Number</th>
                                    <th>Address</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>

                                @php
                                    $no = 0;
                                @endphp
                                @foreach ($suppliers as $supplier)
                                    @php
                                        $no = $no + 1;
                                    @endphp
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>{{ $supplier->supplier_name }}</td>
                                        <td>{{ $supplier->contact_number }}</td>
                                        <td>{{ $supplier->address }}</td>
                                        <td>
                                            <div class="d-flex">
                                                @can('supplier-edit')
                                                    <a href="#" class="edit-card" data-toggle="modal"
                                                        data-target="#editSupplier{{ $supplier->id }}">
                                                        <i class="icon-edit" style="color: blue"></i>
                                                    </a>
                                                @endcan

                                                @can('supplier-delete')
                                                    <form action="{{ route('supplier.destroy', $supplier->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-link p-0">
                                                            <i class=" icon-trash-2" style="color:red"></i>
                                                        </button>
                                                    </form>
                                                @endcan



                                            </div>


                                        </td>

                                    </tr>

                                    <div class="modal fade" id="editSupplier{{ $supplier->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="editSupplierLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editSupplierLabel">Edit Supplier</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">

                                                    <form method="POST"
                                                        action="{{ route('supplier.update', $supplier->id) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="col-sm-12 col-12">
                                                            <div class="form-group">
                                                                <label for="exampleInputCity1"> Name</label>
                                                                <input type="text" class="form-control"
                                                                    id="supplier_name" name="supplier_name"
                                                                    placeholder="supplier Name"
                                                                    value="{{ $supplier->supplier_name }}" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputCity1"> Contact number</label>
                                                                <input type="number" class="form-control"
                                                                    id="contact_number" name="contact_number"
                                                                    placeholder="Contact Number"
                                                                    value="{{ $supplier->contact_number }}" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputCity1"> Address</label>
                                                                <input type="text" class="form-control" id="address"
                                                                    name="address" placeholder="address"
                                                                    value="{{ $supplier->address }}" required>
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer custom">
                                                            <div class="center">
                                                                <button type="submit"
                                                                    class="btn btn-link success btn-block">Save</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
        </div>


    </div>
    <!-- Row end -->
@endsection

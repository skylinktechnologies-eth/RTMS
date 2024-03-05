@extends('Frames.app')
@section('content')
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Mantain</li>
            <li class="breadcrumb-item active">Location</li>
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

        @if (session('danger'))
        <div class="row">

            <div class="col-md-4">

            </div>
            <div class="col-md-4">

            </div>
            <div class="col-md-4">
                <div class="alert alert-danger px-3" id="danger-alert">

                    {{ session('danger') }}
                </div>
            </div>
        </div>
    @endif
        <div class="row gutters">
            <div class="col-sm-12">
                <div class="text-right mb-3">
                    <!-- Button trigger modal -->
                   
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addNewLocation">Add New
                        Location</button>

                    <!-- Modal -->
                    <div class="modal fade" id="addNewLocation" tabindex="-1" role="dialog"
                        aria-labelledby="addNewCategoryLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addNewCategoryLabel">New Location</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('location.store') }}">
                                        @csrf
                                        <div class="col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="exampleInputCity1">Location Name</label>
                                                <input type="text" class="form-control" id="location_name"
                                                    name="location_name" placeholder="Location Name"
                                                    value="{{ old('location_name') }}" required>
                                            </div>


                                        </div>
                                        <div class="modal-footer custom">


                                            <div class="right-side">
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
                                    <th>Location Name</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>

                                @php
                                    $no = 0;
                                @endphp
                                @foreach ($locations as $location)
                                    @php
                                        $no = $no + 1;
                                    @endphp
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>{{ $location->location_name }}</td>
                                        <td>
                                            <div class="d-flex">
                                                @can('location-edit')
                                                <a href="#" class="edit-card" data-toggle="modal"
                                                data-target="#editLocation{{ $location->id }}">
                                                <i class="icon-edit" style="color: blue"></i>
                                            </a>
                                                @endcan
                                               
                                                @can('location-delete')
                                                <form action="{{ route('location.destroy', $location->id) }}"
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

                                    <div class="modal fade" id="editLocation{{ $location->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="editLocationLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editLocationLabel">Edit Contact</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">

                                                    <form method="POST"
                                                        action="{{ route('location.update', $location->id) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="col-sm-12 col-12">
                                                            <div class="form-group">
                                                                <label for="exampleInputCity1">Location Name</label>
                                                                <input type="text" class="form-control"
                                                                    id="location_name" name="location_name"
                                                                    value="{{ $location->location_name }}"
                                                                    placeholder="Table Name" required>
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
@endsection

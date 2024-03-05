@extends('Frames.app')
@section('content')
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Tables</li>
            <li class="breadcrumb-item active">Table</li>
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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addNewTable">Add New
                        Table</button>

                    <!-- Modal -->
                    <div class="modal fade" id="addNewTable" tabindex="-1" role="dialog"
                        aria-labelledby="addNewTableLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addNewTableLabel">New Table</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('table.store') }}">
                                        @csrf
                                        <div class="col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="exampleInputCity1">Table Name</label>
                                                <input type="text" class="form-control" id="table_name" name="table_name"
                                                    placeholder="Table Name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputCity1">Capacity</label>
                                                <input type="number" class="form-control" id="capacity" name="capacity"
                                                    placeholder="Capacity" required>
                                            </div>

                                        </div>
                                        <div class="modal-footer custom">
                                            
                                            <div class="divider"></div>
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
                <!-- Edit Contact Modal -->

            </div>
            @foreach ($tables as $table)
                <div class="col-xl-3 col-lg-4 col-sm-6 col-12">
                    <figure class="user-card">
                        <figcaption>
                            @can('table-edit')
                            <a href="#" class="edit-card" data-toggle="modal"
                            data-target="#editTable{{ $table->id }}">
                            <i class="icon-mode_edit"></i>
                        </a>
                            @endcan
                            
                            <img src="tableimage.jpg" alt="Admin Templates & Dashboards" class="profile">
                            <h5>{{ $table->table_name }}</h5>
                            <ul class="list-group">
                                <li class="list-group-item">capacity:{{ $table->capacity }}</li>
                                @if ( $table->status == "Vacant")
                                <li class="list-group-item" style="color: rgb(0, 30, 255)">{{ $table->status }}</li>
                                @else
                                <li class="list-group-item">{{ $table->status }}</li>
                                @endif
                             
                            </ul>
                            @can('table-delete')
                            <form action="{{ route('table.destroy', $table->id) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-link p-0 float-right" >
                                    <i class=" icon-trash-2" style="color:red"></i>
                                </button>
                            </form>
                            @endcan
                           
                        </figcaption>
                    </figure>
                </div>
                <div class="modal fade" id="editTable{{ $table->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="editTableLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editTableLabel">Edit Table</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form method="POST" action="{{ route('table.update', $table->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="col-sm-12 col-12">

                                        <div class="form-group">
                                            <label for="exampleInputCity1">Table Name</label>
                                            <input type="text" class="form-control" id="table_name" name="table_name"
                                                value="{{ $table->table_name }}" placeholder="Table Name" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-12">
                                        <div class="form-group">
                                            <label for="exampleInputCity1">Capacity</label>
                                            <input type="number" class="form-control" id="capacity" name="capacity"
                                                value="{{ $table->capacity }}" placeholder="Location" required>
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
            @endforeach
        </div>
 

    </div>
@endsection


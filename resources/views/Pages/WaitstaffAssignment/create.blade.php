@extends('Frames.app')
@section('content')
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Waitstaff</li>
            <li class="breadcrumb-item active">Assign waitstaff</li>
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
      
            <div class="card rounded-3 px-3 border-primary">
                <div class="card-header bg-primary rounded-3" style="margin-top: -10px;color:#fff">
                    <div style="display: flex; justify-content: space-between;">
                        <strong>Wiatstaff Assign</strong>
                        <a href="{{ route('waitstaff.index') }}" class="text-white"><i class="fas fa-arrow-left"></i>
                            Back</a>
                    </div>
                </div>
                <div class="card-body">
                   

                    <form method="POST" action="{{ route('waitstaffAssignment.store', $waitstaff->id) }}"
                        enctype="multipart/form-data">
                        @csrf


                        <div class="row gutters mt-2" >
                            <div class="col-sm-4">
                                <div class="form-group ">
                                    
                                    <input type="text" name="waitstaff_id" class="form-control"
                                        value="{{ $waitstaff->first_name }} {{ $waitstaff->last_name }}" id="waitstaff_id"
                                        readonly>
                                    @error('waitstaff_id')
                                        <div class="alert alert-danger">
                                            {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-sm-5"></div>
                            <div class="col-sm-3">
                                <div class="form-group ">
                                    <input type="date" id="assignment_date" name="assignment_date" class="form-control"
                                        value="{{ now()->toDateString() }}">
    
                                </div>
                            </div>
                        </div>
                        <div class="row gutters bg-light mr-2 pb-3 ">
                            <div class="col-6  mt-3">
                                <select id="table_id" name="table_id" class="form-control selectpicker"
                                    data-live-search="true" required>
                                    <option value="">Select Tables</option>
                                    @foreach ($tables as $table)
                                        <option value="{{ $table->id }}">{{ $table->table_name }}</option>
                                    @endforeach
                                </select>
                                @error('table_id')
                                    <div class="alert alert-danger">
                                        {{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6 mt-3 ">
                                <button type="submit" class="btn btn-gradient-primary me-2 "><i class=" icon-plus"
                                        style="color: green; font-size:20px"></i></button>

                            </div>

                        </div>
                    </form>
                    <div class="card mt-3">
                        <div class="card-header ">

                        </div>
                        <div class="card-body border-primary">
                            <div class="table-responsive">
                                <div class="data_table">
                                    <table id="example" class="table  table-bordered" style="width:100%">
                                        <thead style="">
                                            <tr>
                                                <th>No</th>
                                                <th>Table Name</th>
                                                <th>Assignment Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @php
                                                $no = 0;
                                            @endphp
                                            @foreach ($staffAssigns as $staffAssign)
                                                @if ($staffAssign->waitstaff_id == $waitstaff->id)
                                                    @php
                                                        $no = $no + 1;
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $no }}</td>
                                                        <td>{{ $staffAssign->table->table_name }}</td>
                                                        <td>{{ $staffAssign->assignment_date }}</td>
                                                        <td>
                                                            <div class="d-flex">
                                                                <a type="link"
                                                                    href="{{ route('waitstaffAssignment.edit', $staffAssign->id) }}">
                                                                    <i class="icon-edit" style="color: blue"></i>
                                                                </a>
                                                                <form
                                                                    action="{{ route('waitstaffAssignment.destroy', $staffAssign->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button class="btn btn-link p-0">
                                                                        <i class=" icon-trash-2" style="color:red"></i>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
           
        </div>
    </div>
@endsection

@extends('Frames.app')
@section('content')
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
    <div class="col-10 grid-margin stretch-card">
        <div class="card">

            <div class="card-body">
                <h4 class="card-title">Create Waitstaff Assignment</h4>

                <form method="POST" action="{{ route('waitstaffAssignment.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputName1"> Waitstaff Name</label>
                        <select id="selectDropdown" class="form-control select2" name="waitstaff_id">
                            <option value="">select</option>
                            @foreach ($waitstaffs as $waitstaff)
                                <option value="{{ $waitstaff->id }}">{{ $waitstaff->first_name }}{{ $waitstaff->last_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('waitstaff_id')
                            <div class="alert alert-danger">
                                {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputName1"> Table Name</label>
                        <select id="table_id" class="form-control select2" name="table_id">
                            <option value="">select</option>
                            @foreach ($tables as $table)
                                <option value="{{ $table->id }}">{{ $table->table_name }}</option>
                            @endforeach
                        </select>
                        @error('table_id')
                            <div class="alert alert-danger">
                                {{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail3"> Assignment Date</label>
                        <input type="date" class="form-control" id="assignment_date" name="assignment_date"
                            placeholder="assignment_date ">
                        @error('assignment_date')
                            <div class="alert alert-danger">
                                {{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection

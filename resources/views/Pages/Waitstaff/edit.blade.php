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
                <h4 class="card-title">Edit Staff</h4>

                <form method="POST" action="{{ route('waitstaff.update',$waitstaff->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="exampleInputName1"> First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $waitstaff->first_name }}"
                            placeholder="first_name ">
                        @error('first_name')
                            <div class="alert alert-danger">
                                {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputName1"> Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name"  value="{{ $waitstaff->last_name }}" placeholder="last_name ">
                        @error('last_name')
                            <div class="alert alert-danger">
                                {{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail3"> Contact Number</label>
                        <input type="text" class="form-control" id="contact_number" name="contact_number"  value="{{ $waitstaff->contact_number }}" placeholder="contact_number ">
                        @error('contact_number')
                            <div class="alert alert-danger">
                                {{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail3"> Hire Date</label>
                        <input type="date" class="form-control" id="hire_date" name="hire_date"  value="{{ $waitstaff->hire_date }}" placeholder="hire_date ">
                        @error('hire_date')
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

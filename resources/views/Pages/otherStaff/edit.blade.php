@extends('Frames.app')
@section('content')
<div class="page-header">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Staff</li>
        <li class="breadcrumb-item active"> Other Staff/Edit</li>
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
    <div class="card rounded-3 px-3  h-100">
        <div class="card-header bg-primary rounded-3" style="margin-top: -10px;color:#fff">
            <div style="display: flex; justify-content: space-between;">
                <strong> Edit Other staff </strong>
                <a href="{{ route('otherstaff.index') }}" class="text-white"><i class="fas fa-arrow-left"></i>
                    Back</a>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('otherstaff.update',$otherstaff->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">

                    <div class="col-4">
                        <div class="form-group">
                            <label for="exampleInputName1"> First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name"
                                placeholder="first_name " value="{{ $otherstaff->first_name }}"   required>
                            @error('first_name')
                                <div class="alert alert-danger">
                                    {{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-4">


                        <div class="form-group">
                            <label for="exampleInputName1"> Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name"
                                placeholder="last_name " value="{{  $otherstaff->last_name }}" required>
                            @error('last_name')
                                <div class="alert alert-danger">
                                    {{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="exampleInputEmail3"> Contact Number</label>
                            <input type="text" class="form-control" id="contact_number" name="contact_number"
                                placeholder="contact_number " value="{{ $otherstaff->contact_number }}"  required>
                            @error('contact_number')
                                <div class="alert alert-danger">
                                    {{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="exampleInputEmail3"> Hire Date</label>
                            <input type="date" class="form-control" id="hire_date" name="hire_date"
                                placeholder=" " value="{{ $otherstaff->hire_date }}" required>
                            @error('hire_date')
                                <div class="alert alert-danger">
                                    {{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-xl-12">
                    <button type="submit" id="submit" name="submit" class="btn btn-primary float-right">Submit
                        Form</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

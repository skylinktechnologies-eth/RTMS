@extends('Frames.app')
@section('content')
<div class="page-header">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">waitStaff</li>
        <li class="breadcrumb-item active">Staff/Create</li>
    </ol>

    <ul class="app-actions">
        <li>
            <a href="#" id="reportrange">
                <span class="range-text"></span>
                <i class="icon-chevron-down"></i>
            </a>
        </li>
        <li>
            <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Print">
                <i class="icon-print"></i>
            </a>
        </li>
        <li>
            <a href="#" data-toggle="tooltip" data-placement="top" title=""
                data-original-title="Download CSV">
                <i class="icon-cloud_download"></i>
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

    <div class="row justify-content-center gutters">
        <div class="col-lg-10 col-sm-12 col-12">

            <div class="card m-0">
                <div class="card-header">
                    <h4>Create Staff</h4>
                </div>
                <div class="card-body">

                    <!-- Row start -->
                    <div class="row gutters">
                        <div class="col-lg-10 col-sm-12 col-12">
                            <form method="POST" action="{{ route('waitstaff.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputName1"> First Name</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name"
                                        placeholder="first_name ">
                                    @error('first_name')
                                        <div class="alert alert-danger">
                                            {{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputName1"> Last Name</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name"
                                        placeholder="last_name ">
                                    @error('last_name')
                                        <div class="alert alert-danger">
                                            {{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail3"> Contact Number</label>
                                    <input type="text" class="form-control" id="contact_number" name="contact_number"
                                        placeholder="contact_number ">
                                    @error('contact_number')
                                        <div class="alert alert-danger">
                                            {{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail3"> Hire Date</label>
                                    <input type="date" class="form-control" id="hire_date" name="hire_date"
                                        placeholder="hire_date ">
                                    @error('hire_date')
                                        <div class="alert alert-danger">
                                            {{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-xl-12">
                                    <button type="submit" id="submit" name="submit"
                                        class="btn btn-primary float-right">Submit
                                        Form</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div> 
@endsection

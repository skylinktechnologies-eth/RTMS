@extends('Frames.app')
@section('content')
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Orders</li>
            <li class="breadcrumb-item active">Order/Create</li>
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
                        <h4>Create Reservation</h4>
                    </div>
                    <div class="card-body">

                        <!-- Row start -->
                        <div class="row gutters">
                            <div class="col-lg-10 col-sm-12 col-12">
                                <form method="POST" action="{{ route('order.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="exampleInputName1"> Table Name</label>
                                        <select class="form-control selectpicker" id="table_id" name="table_id"
                                                data-live-search="true">
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
                                        <label for="exampleInputEmail3"> Order Date</label>
                                        <input type="date" class="form-control" id="order_date" name="order_date"
                                            placeholder="Order date ">
                                        @error('order_date')
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






@extends('Frames.app')
@section('content')
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Tables</li>
            <li class="breadcrumb-item active">Reservation/Create</li>
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
                        <h4>Edit Reservation</h4>
                    </div>
                    <div class="card-body">

                        <!-- Row start -->
                        <div class="row gutters">
                            <div class="col-lg-10 col-sm-12 col-12">
                                <form method="POST" action="{{ route('reservation.update',$reservation->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="exampleInputName1"> Table Name</label>
                                        <select class="form-control selectpicker" id="table_id" name="table_id"
                                        data-live-search="true">
                                            @foreach ($tables as $table)
                                                <option value="{{ $table->id }}"  {{ old('table_id', $reservation->table_id) == $table->id ? 'selected' : '' }}>
                                                    {{ $table->table_name }}</option>
                                            @endforeach
                
                                        </select>
                                        @error('table_id')
                                            <div class="alert alert-danger">
                                                {{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail3">Reservation Date</label>
                                        <input type="date" class="form-control" id="reservation_date" name="reservation_date" value="{{ $reservation->reservation_date }}"
                                            placeholder="reservation_date">
                                        @error('reservation_date')
                                            <div class="alert alert-danger">
                                                {{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="party_size">Party Size</label>
                                        <input type="number" class="form-control" id="party_size" placeholder="party_size" value="{{ $reservation->party_size }}"
                                            name="party_size">
                                        @error('party_size')
                                            <div class="alert alert-danger">
                                                {{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="contact_name">Contact Name</label>
                                        <input type="text" class="form-control" id="contact_name" name="contact_name"  value="{{ $reservation->contact_name }}"
                                            placeholder="contact_name">
                                        @error('contact_name')
                                            <div class="alert alert-danger">
                                                {{ $message }}</div>
                                        @enderror
                                    </div>
                
                                    <div class="form-group">
                                        <label for="contact_number">Contact Number</label>
                                        <input type="text" class="form-control" id="contact_number" name="contact_number"  value="{{ $reservation->contact_number }}"
                                            placeholder="contact_number">
                
                                            @error('contact_number')
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



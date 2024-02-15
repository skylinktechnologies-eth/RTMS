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

        <div class="card rounded-3 px-3  h-100">
            <div class="card-header bg-primary rounded-3" style="margin-top: -10px;color:#fff">
                <div style="display: flex; justify-content: space-between;">
                    <strong> Edit Reservation </strong>
                    <a href="{{ route('reservation.index') }}" class="text-white"><i class="fas fa-arrow-left"></i>
                        Back</a>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('reservation.update', $reservation->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class=" col-md-4 ">
                            <div class="form-group">
                                <label for="exampleInputEmail3">Reservation Date</label>
                                <input type="date" class="form-control" id="reservation_date" name="reservation_date"
                                    value="{{ $reservation->reservation_date }}" placeholder="reservation_date">
                                @error('reservation_date')
                                    <div class="alert alert-danger">
                                        {{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class=" col-md-4 ">
                            <div class="form-group">
                                <label for="party_size">Party Size</label>
                                <input type="number" class="form-control" id="party_size" placeholder="party_size"
                                    value="{{ $reservation->party_size }}" name="party_size">
                                @error('party_size')
                                    <div class="alert alert-danger">
                                        {{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row ">
                        <div class=" col-md-4 ">
                            <div class="form-group">
                                <label for="contact_name">Contact Name</label>
                                <input type="text" class="form-control" id="contact_name" name="contact_name"
                                    placeholder="contact_name" value="{{ $reservation->contact_name }}">
                                @error('contact_name')
                                    <div class="alert alert-danger">
                                        {{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class=" col-md-4 ">
                            <div class="form-group">
                                <label for="contact_number">Contact Number</label>
                                <input type="text" class="form-control" id="contact_number" name="contact_number"
                                    placeholder="contact_number" value="{{ $reservation->contact_number }}">

                                @error('contact_number')
                                    <div class="alert alert-danger">
                                        {{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card">

                        <div class="card-body bg-light">
                            <div class="table-responsive">
                                <table class="table table-centered border   bg-light">
                                    <thead class="">
                                        <tr>
                                            <th style="width: 25%">Tables</th>
                                            <th style="width: 22%"> Start Date</th>
                                            <th style="width: 22%"> End Date</th>
                                            <th style="width: 25%">Reservation Time</th>
                                            <th></th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>

                            @php
                                $no = 0;
                            @endphp
                            @foreach ($details as $detail)
                                @if ($reservation->id == $detail->reservation_id)
                                    <div class="row mt-2">
                                        <div class="col-md-2">
                                            <select class="form-control selectpicker" id="table_id"
                                                name="List[{{ $no }}][table_id]" data-live-search="true">
                                                <option value="">select Table</option>
                                                @foreach ($tables as $table)
                                                    <option value="{{ $table->id }}"
                                                        {{ old('table_id', $detail->table_id) == $table->id ? 'selected' : '' }}>
                                                        {{ $table->table_name }}</option>
                                                @endforeach

                                            </select>
                                            @error('List')
                                                <div class="alert alert-danger">
                                                    {{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="date" onchange="getTotal()" id="occupancy_start_date"
                                                    step="any" min="0"
                                                    name="List[{{ $no }}][occupancy_start_date]"
                                                    value="{{ $detail->occupancy_start_date }}" class="form-control"
                                                    placeholder="Start Date">

                                                @error('List')
                                                    <div class="alert alert-danger">
                                                        {{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="date" onchange="getTotal()" id="occupancy_end_date"
                                                    step="any" min="0"
                                                    name="List[{{ $no }}][occupancy_end_date]"
                                                    value="{{ $detail->occupancy_end_date }}" class="form-control"
                                                    placeholder="End Date">
                                                @error('List')
                                                    <div class="alert alert-danger">
                                                        {{ $message }}</div>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="time" onchange="getTotal()" id="reservation_time"
                                                    step="any" min="0"
                                                    name="List[{{ $no }}][reservation_time]"
                                                    value="{{ $detail->reservation_time }}" class="form-control"
                                                    placeholder="Time">
                                                @error('List')
                                                    <div class="alert alert-danger">
                                                        {{ $message }}</div>
                                                @enderror
                                            </div>

                                        </div>
                                        

                                    </div>
                                    @php
                                        $no = $no + 1;
                                    @endphp
                                @endif
                            @endforeach
                            <div class="table-responsive">
                                <table class="table table-centered border   bg-light" id="itemList">
                                    <thead class="">

                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
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

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
    <div class="col-9 grid-margin stretch-card">
        <div class="card">
           
            <div class="card-body">
                <h4 class="card-title">Create Reservation</h4>

                <form method="POST" action="{{ route('reservation.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputName1"> Table Name</label>
                        <select class="form-control" id="mySelect" name="table_id">
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
                        <label for="exampleInputEmail3">Reservation Date</label>
                        <input type="date" class="form-control" id="reservation_date" name="reservation_date"
                            placeholder="reservation_date">
                        @error('reservation_date')
                            <div class="alert alert-danger">
                                {{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="party_size">Party Size</label>
                        <input type="number" class="form-control" id="party_size" placeholder="party_size"
                            name="party_size">
                        @error('party_size')
                            <div class="alert alert-danger">
                                {{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="contact_name">Contact Name</label>
                        <input type="text" class="form-control" id="contact_name" name="contact_name"
                            placeholder="contact_name">
                        @error('contact_name')
                            <div class="alert alert-danger">
                                {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="contact_number">Contact Number</label>
                        <input type="text" class="form-control" id="contact_number" name="contact_number"
                            placeholder="contact_number">

                            @error('contact_number')
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

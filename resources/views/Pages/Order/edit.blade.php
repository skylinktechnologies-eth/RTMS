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
                <h4 class="card-title">Edit Orders</h4>

                <form method="POST" action="{{ route('order.update', $order->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="exampleInputName1"> Table Name</label>
                        <select class="form-control" id="mySelect" name="table_id">
                            @foreach ($tables as $table)
                                <option value="{{ $table->id }}"
                                    {{ old('table_id', $order->table_id) == $table->id ? 'selected' : '' }}>
                                    {{ $table->table_name }}</option>
                            @endforeach

                        </select>
                        @error('table_id')
                            <div class="alert alert-danger">
                                {{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail3">Order Date</label>
                        <input type="date" class="form-control" id="order_date" name="order_date"
                            value="{{ $order->order_date }}" placeholder="">
                        @error('order_date')
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

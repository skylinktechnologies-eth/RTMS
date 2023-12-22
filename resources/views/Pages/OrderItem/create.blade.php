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
                <h4 class="card-title">Create Order Item</h4>

                <form method="POST" action="{{ route('orderItem.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputName1"> Orders</label>
                        <select class="form-control" id="mySelect" name="order_id">
                            @foreach ($orders as $order)
                                <option value="{{ $order->id }}">{{ $order->id }}</option>
                            @endforeach
                        </select>
                        @error('order_id')
                            <div class="alert alert-danger">
                                {{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleInputName1"> Items</label>
                        <select class="form-control" id="myItem" name="menu_item_id">
                            @foreach ($items as $item)
                                <option value="{{ $item->id }}">{{ $item->item_name }}</option>
                            @endforeach
                        </select>
                        @error('menu_item_id')
                            <div class="alert alert-danger">
                                {{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail3"> Quantity</label>
                        <input type="date" class="form-control" id="quantity" name="quantity"
                            placeholder="quantity ">
                        @error('quantity')
                            <div class="alert alert-danger">
                                {{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail3"> Sub Total</label>
                        <input type="date" class="form-control" id="sub_total" name="sub_total"
                            placeholder="sub total ">
                        @error('sub_total')
                            <div class="alert alert-danger">
                                {{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail3"> Remark</label>
                        <input type="date" class="form-control" id="remark" name="remark"
                            placeholder="remark ">
                        @error('remark')
                            <div class="alert alert-danger">
                                {{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('#myItem').select2({
                placeholder: 'Select an option',
                allowClear: true, // Enables the clear button
            });
    
    
        });
    </script>
@endsection

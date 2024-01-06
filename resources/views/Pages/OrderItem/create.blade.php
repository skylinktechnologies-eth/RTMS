@extends('Frames.app')
@section('content')
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Orders</li>
            <li class="breadcrumb-item active">OrderItem/Create</li>
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
                        <h4>Create Order Item</h4>
                    </div>
                    <div class="card-body">

                        <!-- Row start -->
                        <div class="row gutters">
                            <div class="col-lg-10 col-sm-12 col-12">
                                <form method="POST" action="{{ route('orderItem.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="exampleInputName1"> Orders</label>
                                        <select class="form-control selectpicker" id="order_id" name="order_id"
                                        data-live-search="true">
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
                                        <input type="number" class="form-control" id="quantity" name="quantity"
                                            placeholder="quantity ">
                                        @error('quantity')
                                            <div class="alert alert-danger">
                                                {{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail3"> Sub Total</label>
                                        <input type="number" class="form-control" id="sub_total" name="sub_total"
                                            placeholder="sub total ">
                                        @error('sub_total')
                                            <div class="alert alert-danger">
                                                {{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail3"> Remark</label>
                                        <input type="text" class="form-control" id="remark" name="remark"
                                            placeholder="remark ">
                                        @error('remark')
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



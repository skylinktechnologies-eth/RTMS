@extends('Frames.app')
@section('content')
    <div class="page-header">
        <ol class="breadcrumb">

            <li class="breadcrumb-item active">Menu Item/Create</li>
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

        <div class="card rounded-3 px-3  " style="height: 450px;">
            <div class="card-header bg-primary rounded-3" style="margin-top: -10px;color:#fff">
                <div style="display: flex; justify-content: space-between;">
                    <strong> Create Product </strong>
                    <a href="{{ route('menuItem.index') }}" class="text-white"><i class="fas fa-arrow-left"></i>
                        Back</a>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('menuItem.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputName1"> Category Name</label>
                                <select class="form-control selectpicker" id="category_id" name="category_id"
                                    data-live-search="true">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach

                                </select>

                                @error('category_id')
                                    <div class="alert alert-danger">
                                        {{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail3"> Item Name</label>
                                <input type="text" class="form-control" id="item_name" name="item_name"
                                    placeholder="Item name">
                                @error('item_name')
                                    <div class="alert alert-danger">
                                        {{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="party_size">Image</label>
                                    <input type="file" class="form-control" id="image" placeholder="image"
                                        name="image">

                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="contact_name">Price</label>
                                    <input type="number" class="form-control" id="price" name="price"
                                        placeholder="Price">
                                    @error('price')
                                        <div class="alert alert-danger">
                                            {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 text-center mt-3">
                            <button type="submit" id="submit" name="submit" class="btn btn-primary ">Submit
                                Form</button>
                        </div>
                </form>
            </div>
        </div>

        
    </div>
@endsection

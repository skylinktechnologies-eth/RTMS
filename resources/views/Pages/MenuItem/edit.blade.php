@extends('Frames.app')
@section('content')
    <div class="page-header">
        <ol class="breadcrumb">

            <li class="breadcrumb-item active">Menu Item/Edit</li>
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
                        <h4>Edit Menu Item</h4>
                    </div>
                    <div class="card-body">

                        <!-- Row start -->
                        <div class="row gutters">
                            <div class="col-lg-10 col-sm-12 col-12">
                                <form method="POST" action="{{ route('menuItem.update', $item->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="exampleInputName1"> Category Name</label>
                                        <select class="form-control selectpicker" id="category_id" name="category_id"
                                        data-live-search="true">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('category_id', $item->category_id) == $category->id ? 'selected' : '' }}>
                                                    {{ $category->category_name }}</option>
                                            @endforeach
                
                                        </select>
                                        @error('category_id')
                                            <div class="alert alert-danger">
                                                {{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail3">Item Name</label>
                                        <input type="text" class="form-control" id="item_name" name="item_name"
                                            value="{{ $item->item_name }}" placeholder="">
                                        @error('item_name')
                                            <div class="alert alert-danger">
                                                {{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="party_size">Image</label>
                                        <input type="file" class="form-control" id="image" placeholder="" value="{{ $item->image }}"
                                            name="image">
                
                                    </div>
                                    <div class="form-group">
                                        <label for="contact_name">Price</label>
                                        <input type="text" class="form-control" id="price" name="price" value="{{ $item->price }}"
                                            placeholder="">
                                        @error('price')
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






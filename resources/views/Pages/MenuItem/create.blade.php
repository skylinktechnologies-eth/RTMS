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
                <h4 class="card-title">Create Menu Item</h4>

                <form method="POST" action="{{ route('menuItem.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputName1"> Category Name</label>
                        <select class="form-control" id="mySelect" name="category_id">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach

                        </select>
                        @error('category_id')
                            <div class="alert alert-danger">
                                {{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail3"> Item Name</label>
                        <input type="text" class="form-control" id="item_name" name="item_name"
                            placeholder="Item name">
                        @error('item_name')
                            <div class="alert alert-danger">
                                {{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="party_size">Image</label>
                        <input type="file" class="form-control" id="image" placeholder="image"
                            name="image">
                        @error('image')
                            <div class="alert alert-danger">
                                {{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="contact_name">Price</label>
                        <input type="number" class="form-control" id="price" name="price"
                            placeholder="Price">
                        @error('price')
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
